# Frontend Payment Integration - Quick Reference

## Updated Payment Flow

### Step 1: Initiate Checkout
```javascript
const checkoutData = {
  email: 'user@example.com',
  shipping_address: '123 Main St',
  phone: '08012345678',
  selected_items: [1, 2, 3],
  first_name: 'John',
  last_name: 'Doe',
  city: 'Lagos',
  state: 'Lagos',
  postal_code: '100001'
};

fetch('/checkout/complete', {
  method: 'POST',
  headers: {
    'Content-Type': 'application/json',
    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
  },
  body: JSON.stringify(checkoutData)
})
.then(response => response.json())
.then(data => {
  if (data.success) {
    // Store reference for later verification
    sessionStorage.setItem('paymentReference', data.reference);
    
    // Redirect to Paystack
    window.location.href = data.authorization_url;
  } else {
    showError(data.message);
  }
});
```

**Response** (Changed - no order_id):
```json
{
  "success": true,
  "authorization_url": "https://checkout.paystack.com/...",
  "reference": "ref_1234567890"
}
```

### Step 2: Verify Payment (After User Returns)
```javascript
function verifyPayment() {
  const reference = sessionStorage.getItem('paymentReference');
  
  if (!reference) {
    showError('Payment reference not found');
    return;
  }

  fetch('/payment/verify', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
    },
    body: JSON.stringify({ reference: reference })
  })
  .then(response => response.json())
  .then(data => {
    if (data.success && data.status === 'success') {
      // Payment successful - order now created
      showSuccess('Payment successful!');
      
      // Redirect with order_id (now returned from verify)
      window.location.href = `/order-confirmed/${data.order_id}`;
    } else if (!data.success && data.status === 'failed') {
      // Payment failed - cancelled order created for record
      showError('Payment failed: ' + data.message);
      
      // Keep cart items for retry
      setTimeout(() => {
        window.location.href = '/cart';
      }, 2000);
    } else {
      showError('Verification error: ' + data.message);
    }
  })
  .catch(error => {
    console.error('Verification error:', error);
    showError('An error occurred during verification');
  });
}

// Call verification automatically on return or manually
// If using callback URL, Paystack will redirect here automatically
```

**Response (Success - Changed)**:
```json
{
  "success": true,
  "status": "success",
  "order_id": 1,
  "order_number": "GRN-00001",
  "message": "Payment verified successfully"
}
```

**Response (Failure)**:
```json
{
  "success": false,
  "status": "failed",
  "order_id": 1,
  "payment_status": "abandoned",
  "message": "Payment failed"
}
```

### Step 3: Handle Modal Close (Optional)
```javascript
// If using Paystack modal instead of redirect
PaystackPop.setup({
  key: 'your_paystack_public_key',
  email: checkoutData.email,
  amount: 0, // Paystack has the amount
  ref: sessionStorage.getItem('paymentReference'),
  onClose: function() {
    // User closed modal - check payment status after delay
    // Webhook might process it
    setTimeout(() => {
      verifyPayment();
    }, 2000);
  },
  onSuccess: function(response) {
    // Payment successful - verify
    verifyPayment();
  }
}).openIframe();
```

## Key Changes from Previous Version

| Aspect | Before | After |
|--------|--------|-------|
| **Order Creation** | During checkout | After verification |
| **Checkout Response** | Returns order_id | Returns reference |
| **Stock Deduction** | During checkout | After successful payment |
| **Cart Deletion** | During checkout | Only on success |
| **Failed Orders** | Not created | Created as cancelled |
| **Order Number** | Generated early | Generated at creation |
| **Session Data** | None | Stores checkout details |

## Error Handling

### Checkout Fails
```javascript
// Response 400
{
  "success": false,
  "message": "Cart empty" | "Invalid items" | "Error: ..."
}

// Action: Show error and redirect to cart
```

### Verification Fails
```javascript
// Response 400
{
  "success": false,
  "status": "failed",
  "message": "Payment failed",
  "order_id": 1  // Still created as cancelled
}

// Action: Show error, offer to retry, keep cart items
```

### Session Expired
```javascript
// Response 400
{
  "success": false,
  "message": "Checkout data not found"
}

// Action: Redirect to checkout form to start over
```

## Complete Checkout Example

```html
<form id="checkout-form">
  <input type="email" name="email" id="email" required>
  <input type="text" name="first_name" id="first_name" required>
  <input type="text" name="last_name" id="last_name" required>
  <input type="tel" name="phone" id="phone" required>
  <textarea name="shipping_address" id="address" required></textarea>
  <input type="text" name="city" id="city" required>
  <input type="text" name="state" id="state" required>
  <input type="text" name="postal_code" id="postal_code" required>
  
  <button type="submit" class="btn btn-primary">Proceed to Payment</button>
</form>

<script>
document.getElementById('checkout-form').addEventListener('submit', async (e) => {
  e.preventDefault();
  
  // Get selected items
  const selectedItems = Array.from(
    document.querySelectorAll('input[name="selected_items"]:checked')
  ).map(el => parseInt(el.value));
  
  if (selectedItems.length === 0) {
    showError('Please select at least one item');
    return;
  }
  
  // Collect form data
  const checkoutData = {
    email: document.getElementById('email').value,
    shipping_address: document.getElementById('address').value,
    phone: document.getElementById('phone').value,
    selected_items: selectedItems,
    first_name: document.getElementById('first_name').value,
    last_name: document.getElementById('last_name').value,
    city: document.getElementById('city').value,
    state: document.getElementById('state').value,
    postal_code: document.getElementById('postal_code').value
  };
  
  try {
    showLoading('Processing checkout...');
    
    const response = await fetch('/checkout/complete', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
      },
      body: JSON.stringify(checkoutData)
    });
    
    const data = await response.json();
    hideLoading();
    
    if (data.success) {
      // Store reference and redirect to Paystack
      sessionStorage.setItem('paymentReference', data.reference);
      window.location.href = data.authorization_url;
    } else {
      showError(data.message || 'Checkout failed');
    }
  } catch (error) {
    hideLoading();
    console.error('Error:', error);
    showError('An error occurred during checkout');
  }
});

// On return from Paystack, verify payment
// This should be called automatically or on page load if returning from Paystack
if (sessionStorage.getItem('paymentReference')) {
  verifyPayment();
}
</script>
```

## Frontend Utilities

```javascript
// Show loading state
function showLoading(message = 'Processing...') {
  document.getElementById('loading').innerHTML = `
    <div class="spinner"></div>
    <p>${message}</p>
  `;
  document.getElementById('loading').style.display = 'flex';
}

function hideLoading() {
  document.getElementById('loading').style.display = 'none';
}

// Show messages
function showSuccess(message) {
  console.log('✓ ' + message);
  // Show toast or alert
}

function showError(message) {
  console.error('✗ ' + message);
  // Show error toast or alert
}

// Redirect with delay
function redirectAfterDelay(url, delay = 2000) {
  setTimeout(() => {
    window.location.href = url;
  }, delay);
}

// Get CSRF token
function getCsrfToken() {
  return document.querySelector('meta[name="csrf-token"]').content;
}
```

## Environment Configuration

Add to your frontend config:
```javascript
const API_CONFIG = {
  PAYSTACK_PUBLIC_KEY: 'pk_live_your_public_key',
  BASE_URL: 'https://yourdomain.com',
  ENDPOINTS: {
    CHECKOUT: '/checkout/complete',
    VERIFY: '/payment/verify',
    MARK_FAILED: '/payment/mark-failed'
  }
};
```

## Testing the Flow

### Step-by-Step Test
1. Fill checkout form with test data
2. Submit form
3. Verify you're redirected to Paystack
4. Use test card (4084084084084081 for success)
5. Complete payment
6. Verify payment and check redirect to order confirmation
7. Verify order was created with correct status
8. Verify cart items were deleted

### Test Card Numbers
- **Success**: 4084084084084081
- **Failed**: 4111111111111111
- **Insufficient Funds**: 4000000000000002

All use any future expiry date and CVV: 123

## Troubleshooting

### "Checkout data not found"
- User sessions expired
- Browser cookies disabled
- Session storage cleared
- **Fix**: Start checkout process again

### "Invalid items"
- Items were removed from cart
- Session mismatch
- **Fix**: Refresh and select items again

### Order not created
- Payment verification failed
- Session data missing
- **Fix**: Check browser console and server logs

### Cart items not deleted
- Payment didn't complete as success
- Verify payment wasn't called
- **Fix**: Check payment status, call verify manually

## Performance Tips

1. Store reference in sessionStorage (not localStorage)
2. Clear session data after successful verification
3. Add timeout for verification check (2-5 seconds)
4. Cache cart items before checkout
5. Disable form submission while processing

