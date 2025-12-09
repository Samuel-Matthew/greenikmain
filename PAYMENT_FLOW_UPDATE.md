# Payment Flow Update - Order Creation on Payment Verification

## 🎯 Major Change

**Old Flow**: Order created BEFORE payment verification → Updated on success/failure
**New Flow**: Order created AFTER payment verification → Created only on success/failure

## 📊 New Payment Flow

```
User Checkout
    ↓
POST /checkout/complete
├─ Validates cart & items
├─ Calculates totals
├─ Stores checkout data in SESSION
├─ Sends to Paystack (NO order created)
├─ Stores payment reference in SESSION
└─ Returns authorization URL
    ↓
User Completes Paystack Payment
    ↓
POST /payment/verify
├─ Verifies with Paystack
├─ Retrieves checkout data from SESSION
├─ ON SUCCESS:
│  ├─ Creates Order (status: paid)
│  ├─ Creates OrderItems (stock decremented)
│  ├─ Creates Transaction (status: success)
│  ├─ Deletes cart items
│  ├─ Clears session
│  └─ Returns success response
└─ ON FAILURE:
   ├─ Creates Order (status: cancelled) [for record]
   ├─ Creates Transaction (status: failed)
   ├─ Clears session
   └─ Returns failure response
```

## 🔄 Method Changes

### 1. `completeCheckout()` - SIMPLIFIED
**Before**: Created order, orderitems, decremented stock
**After**: 
- Validates cart
- Calculates totals
- Stores checkout data in session
- Initializes Paystack payment ONLY
- Returns authorization URL

```php
// Session data stored:
session(['checkout_data' => [
    'email', 'first_name', 'last_name', 'phone',
    'shipping_address', 'city', 'state', 'postal_code',
    'selected_items', 'subtotal', 'tax', 'total'
]]);
```

### 2. `verifyPayment()` - ENHANCED
**Before**: Updated existing order and transaction
**After**:
- Retrieves checkout data from session
- Calls Paystack verification
- **Creates order ONLY after verification**
- Creates order items and decrements stock
- Creates transaction record
- Clears session data

**Success Path**:
```json
{
  "success": true,
  "status": "success",
  "order_id": 1,
  "order_number": "GRN-00001"
}
```

**Failure Path** (still creates cancelled order for record):
```json
{
  "success": false,
  "status": "failed",
  "order_id": 1,
  "message": "Payment failed"
}
```

### 3. `markTransactionFailed()` - ENHANCED
**Before**: Updated existing transaction
**After**:
- Retrieves checkout data from session
- Creates cancelled order
- Creates failed transaction
- Returns order info

```json
{
  "success": true,
  "order_id": 1,
  "order_number": "GRN-00001",
  "message": "Transaction marked as failed"
}
```

### 4. `paymentCallback()` - REFACTORED
**Before**: Verified and updated order directly
**After**:
- Calls `verifyPayment()` internally
- Handles response and redirects accordingly
- All order creation happens in `verifyPayment()`

## 📝 Updated API Responses

### POST /checkout/complete
```json
{
  "success": true,
  "authorization_url": "https://checkout.paystack.com/...",
  "reference": "ref_code"
}
```
✅ Returns reference (no order_id anymore)

### POST /payment/verify
```json
{
  "success": true,
  "status": "success",
  "order_id": 1,
  "order_number": "GRN-00001",
  "message": "Payment verified successfully"
}
```
✅ Now includes order info after creation

### POST /payment/mark-failed
```json
{
  "success": true,
  "order_id": 1,
  "order_number": "GRN-00001",
  "message": "Transaction marked as failed"
}
```
✅ Creates order as cancelled

## 🔒 Benefits

1. **No Orphaned Orders**: Orders only exist for completed (success/failed) payments
2. **Data Consistency**: Order state matches actual payment state
3. **Better Audit Trail**: Only real payment attempts create orders
4. **Cleaner Database**: No "processing" orders lingering in the system
5. **Session-based Safety**: Checkout data preserved across requests
6. **Failed Order Records**: Cancelled orders still created for reference

## 🧠 Session Data Flow

### Session Storage (completeCheckout)
```php
session(['checkout_data' => [
    'email' => 'user@example.com',
    'shipping_address' => '123 Main St',
    'phone' => '08012345678',
    'selected_items' => [1, 2, 3],
    'first_name' => 'John',
    'last_name' => 'Doe',
    'city' => 'Lagos',
    'state' => 'Lagos',
    'postal_code' => '100001',
    'subtotal' => 50000,
    'tax' => 500,
    'total' => 50515
]]);
```

### Session Retrieval (verifyPayment)
```php
$checkoutData = session('checkout_data');
// Use to create order with same data
```

### Session Cleanup
```php
session()->forget('checkout_data');
session()->forget('payment_reference');
```

## 📋 Order Creation States

### Success Path
```
Order Status: paid
Transaction Status: success
Stock: DECREMENTED
Cart Items: DELETED
Session: CLEARED
```

### Failure Path
```
Order Status: cancelled
Transaction Status: failed
Stock: NOT decremented
Cart Items: PRESERVED
Session: CLEARED
```

## 🔄 Cart Item Deletion

**When**: Only when payment is verified as success
**Where**: In `verifyPayment()` on success
**How**: `$cart->items()->delete()`

Cart items are NOT deleted if:
- Payment fails
- User abandons payment
- Transaction is marked failed

This allows users to retry with the same items.

## 📌 Key Implementation Details

### 1. Checkout Data Persistence
- Stored in session (server-side)
- Survives redirect to Paystack
- Retrieved after payment completion
- Cleared after order creation

### 2. Order Number Generation
```php
'order_number' => 'GRN-' . str_pad(Order::count() + 1, 5, '0', STR_PAD_LEFT)
```
- Generated at order creation time
- Same logic for both success and failed orders

### 3. Stock Management
- Stock only decremented on successful payment
- If verification fails, stock NOT affected
- Allows user to keep items in cart and retry

### 4. Cart Cleanup
- ONLY deleted on successful payment
- Happens in `verifyPayment()` on success path
- Preserves cart for retry scenarios

## 🧪 Testing Scenarios

### Scenario 1: Successful Payment
1. POST /checkout/complete (no order yet)
2. User completes Paystack
3. POST /payment/verify
4. Order created with status: `paid`
5. Cart deleted

### Scenario 2: Failed Payment
1. POST /checkout/complete (no order yet)
2. User payment fails on Paystack
3. POST /payment/verify
4. Order created with status: `cancelled` (for record)
5. Cart preserved
6. User can retry

### Scenario 3: Manual Failure
1. POST /checkout/complete (no order yet)
2. User abandons modal
3. POST /payment/mark-failed
4. Order created with status: `cancelled`
5. Transaction status: `failed`

## ⚠️ Migration Notes

If updating existing implementation:

1. **No Migration Needed**: Sessions are ephemeral
2. **Clear Cart**: Old pending orders should be handled separately
3. **Update Frontend**: No longer returns order_id from checkout
4. **Update Tests**: Adjust test expectations for new flow

## 🚀 Frontend Integration Update

### Old Checkout Response
```javascript
{
  "success": true,
  "authorization_url": "...",
  "order_id": 1  // ❌ No longer returned
}
```

### New Checkout Response
```javascript
{
  "success": true,
  "authorization_url": "...",
  "reference": "ref_code"  // ✅ Now includes reference
}
```

### Updated Verification Call
```javascript
// After Paystack completes
fetch('/payment/verify', {
  method: 'POST',
  body: JSON.stringify({ reference: reference })
})
.then(response => response.json())
.then(data => {
  if (data.status === 'success') {
    // Order now created - redirect with order_id
    window.location.href = `/order-confirmed/${data.order_id}`;
  }
});
```

## 📊 Database Impact

### Before
```
Orders Table: Contains processing → paid/cancelled
CartItems: Deleted on success
Transactions: Created before verification
```

### After
```
Orders Table: Only contains paid (success) and cancelled (failed records)
CartItems: Deleted ONLY on success
Transactions: Created after verification
```

## 🎉 Summary

The new flow provides:
- ✅ Order creation only on verified payments
- ✅ Cleaner database (no orphaned processing orders)
- ✅ Better audit trail
- ✅ Reduced redundancy
- ✅ Session-based data persistence
- ✅ Proper cleanup after payment
- ✅ Same functionality with better structure

