# Payment Processing Flow Documentation

## Overview
This document outlines the complete payment processing workflow using Paystack integration for the Greenik e-commerce platform.

## Payment Flow Stages

### 1. **Checkout Initiation** (`completeCheckout`)
- **Route**: `POST /checkout/complete`
- **Purpose**: Create order and initiate Paystack payment
- **Request Body**:
  ```json
  {
    "email": "user@example.com",
    "shipping_address": "123 Main St",
    "phone": "08012345678",
    "selected_items": [1, 2, 3],
    "first_name": "John",
    "last_name": "Doe",
    "city": "Lagos",
    "state": "Lagos",
    "postal_code": "100001"
  }
  ```
- **Process**:
  1. Validates input
  2. Retrieves cart items
  3. Creates Order with status: `processing`
  4. Creates OrderItems (stock decremented)
  5. **Cart items NOT deleted yet** (deleted only on successful payment)
  6. Sends initialization request to Paystack
  7. Creates Transaction record with status: `pending`
  8. Returns Paystack authorization URL

- **Response**:
  ```json
  {
    "success": true,
    "authorization_url": "https://checkout.paystack.com/...",
    "order_id": 1
  }
  ```

### 2. **Payment Verification** (`verifyPayment`)
- **Route**: `POST /payment/verify`
- **Purpose**: Verify payment with Paystack and update order/transaction status
- **Request Body**:
  ```json
  {
    "reference": "paystack_reference_code"
  }
  ```
- **Status Updates**:
  
  **On Success**:
  - Order status: `processing` → `paid`
  - Transaction status: `pending` → `success`
  - Cart items are deleted
  - Response: `200 OK`
  
  **On Failure/Abandoned**:
  - Order status: `processing` → `cancelled`
  - Transaction status: `pending` → `failed`
  - Cart items remain (user can retry)
  - Response: `400 Bad Request`

- **Response (Success)**:
  ```json
  {
    "success": true,
    "message": "Payment verified successfully",
    "status": "success",
    "order_id": 1,
    "order_number": "GRN-00001"
  }
  ```

- **Response (Failed)**:
  ```json
  {
    "success": false,
    "message": "Payment was not successful or was abandoned",
    "status": "failed",
    "payment_status": "abandoned",
    "order_id": 1
  }
  ```

### 3. **Mark Transaction Failed** (`markTransactionFailed`)
- **Route**: `POST /payment/mark-failed`
- **Purpose**: Manually mark a transaction as failed (fallback)
- **Request Body**:
  ```json
  {
    "reference": "paystack_reference_code"
  }
  ```
- **Process**:
  1. Validates transaction exists
  2. Verifies user ownership
  3. Updates Transaction status: `pending` → `failed`
  4. Updates Order status: `processing` → `cancelled`

- **Response**:
  ```json
  {
    "success": true,
    "message": "Transaction marked as failed",
    "order_id": 1
  }
  ```

### 4. **Payment Callback** (`paymentCallback`)
- **Route**: `GET /payment/callback`
- **Purpose**: Redirect URL from Paystack (user redirected back after payment)
- **Query Parameters**: `?reference=paystack_reference`
- **Process**:
  1. Verifies payment with Paystack
  2. Updates order and transaction
  3. Redirects to order confirmation page or error

- **On Success**: Redirects to `/order-confirmed/{id}`
- **On Failure**: Redirects to `/cart` with error message

### 5. **Paystack Webhook** (`handleWebhook`)
- **Route**: `POST /webhooks/paystack`
- **Purpose**: Handle real-time payment events from Paystack
- **Purpose**: Process payment updates even if user closes modal
- **Security**: 
  - Verifies X-Paystack-Signature header
  - Uses PAYSTACK_SECRET_KEY for HMAC-SHA512 signature
  
- **Handles Events**:
  
  **charge.success**:
  - Updates Order status: `processing` → `paid`
  - Updates Transaction status: `pending` → `success`
  - Deletes cart items
  
  **charge.failed**:
  - Updates Order status: `processing` → `cancelled`
  - Updates Transaction status: `pending` → `failed`

- **Response**:
  ```json
  {
    "status": "ok",
    "message": "Charge success processed",
    "order_id": 1
  }
  ```

## Order Status States

```
processing → [payment flow] → paid (success) / cancelled (failed)
     ↓
   shipping → delivered
```

## Transaction Status States

```
pending → [payment verification] → success / failed / abandoned
```

## API Endpoints Summary

| Method | Endpoint | Auth | Purpose |
|--------|----------|------|---------|
| POST | `/checkout/complete` | Yes | Create order & initiate payment |
| POST | `/payment/verify` | Yes | Verify payment status |
| POST | `/payment/mark-failed` | Yes | Mark transaction as failed |
| GET | `/payment/callback` | Yes | Paystack redirect callback |
| POST | `/webhooks/paystack` | No | Paystack webhook handler |

## Error Handling

### Common Error Responses

**400 Bad Request**:
```json
{
  "success": false,
  "message": "Payment was not successful or was abandoned",
  "status": "failed"
}
```

**404 Not Found**:
```json
{
  "success": false,
  "message": "Order or transaction not found",
  "status": "error"
}
```

**403 Forbidden**:
```json
{
  "success": false,
  "message": "Unauthorized access",
  "status": "error"
}
```

**500 Internal Server Error**:
```json
{
  "success": false,
  "message": "Error: {error_message}",
  "status": "error"
}
```

## Key Features

✅ **Dual Verification**: Both frontend verification and webhook handling
✅ **Cart Management**: Items deleted only on successful payment
✅ **Stock Management**: Decremented immediately on order creation
✅ **Transaction Tracking**: Complete audit trail with references
✅ **Webhook Security**: HMAC-SHA512 signature verification
✅ **Error Recovery**: Users can retry failed payments
✅ **Metadata Handling**: Order and user IDs passed through Paystack metadata

## Best Practices Implemented

1. **Idempotent Operations**: Webhook can be called multiple times safely
2. **Proper Status Transitions**: Clear before/after states for debugging
3. **Security**: Signature verification and user ownership checks
4. **Error Messages**: Descriptive JSON responses for frontend handling
5. **Data Consistency**: Atomic transactions where possible
6. **Audit Trail**: All status changes logged via timestamps

## Configuration

Add to `.env`:
```
PAYSTACK_SECRET_KEY=your_paystack_secret_key
PAYSTACK_PUBLIC_KEY=your_paystack_public_key
```

Configure Paystack webhook in dashboard:
- URL: `https://yourdomain.com/webhooks/paystack`
- Events: `charge.success`, `charge.failed`

## Testing

### Manual Testing Flow

1. **Create Order**:
   ```bash
   POST /checkout/complete
   ```

2. **Verify Payment** (after manual Paystack completion):
   ```bash
   POST /payment/verify
   Body: {"reference": "reference_code"}
   ```

3. **Check Order Status**:
   ```bash
   GET /orders/{order_id}
   ```

### Webhook Testing

Use Postman or curl with signature:
```bash
SIGNATURE=$(echo -n '{"event":"charge.success","data":...}' | openssl dgst -sha512 -hmac "$PAYSTACK_SECRET_KEY" -binary | base64)

curl -X POST https://yourdomain.com/webhooks/paystack \
  -H "X-Paystack-Signature: $SIGNATURE" \
  -H "Content-Type: application/json" \
  -d '{"event":"charge.success","data":{...}}'
```

## Troubleshooting

| Issue | Cause | Solution |
|-------|-------|----------|
| Payment verified but order not updated | Transaction/Order not found | Check database integrity |
| Webhook not processing | Invalid signature | Verify PAYSTACK_SECRET_KEY |
| Cart items not deleting | Success verification failed | Check payment verification logic |
| Duplicate orders | Race condition | Implement database constraints |

