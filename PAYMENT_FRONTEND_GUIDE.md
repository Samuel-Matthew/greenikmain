# Frontend Integration Guide for Payment System

## JavaScript Payment Flow

### 1. Initiate Checkout
```javascript
// Collect checkout form data
const checkoutData = {
  email: document.getElementById('email').value,
  shipping_address: document.getElementById('address').value,
  phone: document.getElementById('phone').value,
  selected_items: [1, 2, 3], // Array of cart item IDs
  first_name: document.getElementById('first_name').value,
  last_name: document.getElementById('last_name').value,
  city: document.getElementById('city').value,
  state: document.getElementById('state').value,
  postal_code: document.getElementById('postal_code').value
};

// Send checkout request
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
    // Open Paystack payment modal
    PaystackPop.setup({
      key: 'your_paystack_public_key', // Get from .env
      email: checkoutData.email,
      amount: 0, // Not needed - Paystack has amount
      ref: data.authorization_url.split('ref=')[1], // Extract reference
      onClose: function() {
        handlePaymentClosed(data.order_id);
      },
      onSuccess: function(response) {
        handlePaymentSuccess(response.reference, data.order_id);
      }
    }).openIframe();
    
    // Or redirect to authorization URL
    // window.location.href = data.authorization_url;
  } else {
    showError(data.message);
  }
})
.catch(error => {
  console.error('Error:', error);
  showError('An error occurred during checkout');
});
```

### 2. Handle Payment Success
```javascript
function handlePaymentSuccess(reference, orderId) {
  // Show loading state
  showLoading('Verifying payment...');
  
  // Verify payment with backend
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
    hideLoading();
    
    if (data.success && data.status === 'success') {
      // Payment successful
      showSuccess('Payment successful! Redirecting...');
      
      // Redirect to order confirmation after short delay
      setTimeout(() => {
        window.location.href = `/order-confirmed/${data.order_id}`;
      }, 2000);
    } else {
      // Payment failed
      showError(data.message || 'Payment verification failed');
      
      // Option to retry or go back to cart
      showRetryOptions();
    }
  })
  .catch(error => {
    hideLoading();
    console.error('Verification error:', error);
    showError('Error verifying payment. Please try again.');
  });
}
```

### 3. Handle Payment Modal Closed
```javascript
function handlePaymentClosed(orderId) {
  // User closed payment modal without completing payment
  // Check payment status after a delay (webhook might process it)
  
  setTimeout(() => {
    // Get the reference from page data or sessionStorage
    const reference = sessionStorage.getItem('paymentReference');
    
    if (reference) {
      verifyPaymentStatus(reference, orderId);
    } else {
      // No reference available, offer manual verification or retry
      showPaymentPendingMessage(orderId);
    }
  }, 2000); // Wait for webhook to potentially process
}

function verifyPaymentStatus(reference, orderId) {
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
    if (data.status === 'success') {
      // Payment was processed successfully
      showSuccess('Payment confirmed!');
      setTimeout(() => {
        window.location.href = `/order-confirmed/${data.order_id}`;
      }, 2000);
    } else if (data.status === 'failed') {
      // Payment failed
      showError('Payment failed. ' + data.message);
      showRetryOptions();
    } else if (data.status === 'error') {
      // Verification error, but payment might still process
      showWarning('Verifying payment status...');
    }
  });
}
```

### 4. Mark Transaction Failed (Fallback)
```javascript
function markPaymentFailed(reference) {
  fetch('/payment/mark-failed', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
    },
    body: JSON.stringify({ reference: reference })
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      showWarning('Payment marked as failed. You can try again.');
      redirectToCart();
    } else {
      showError('Error marking payment as failed.');
    }
  })
  .catch(error => {
    console.error('Error:', error);
  });
}
```

## Complete Checkout Form Example

```html
<form id="checkout-form">
  <div class="form-group">
    <label>Email</label>
    <input type="email" name="email" id="email" required>
  </div>

  <div class="form-group">
    <label>First Name</label>
    <input type="text" name="first_name" id="first_name" required>
  </div>

  <div class="form-group">
    <label>Last Name</label>
    <input type="text" name="last_name" id="last_name" required>
  </div>

  <div class="form-group">
    <label>Phone</label>
    <input type="tel" name="phone" id="phone" required>
  </div>

  <div class="form-group">
    <label>Shipping Address</label>
    <textarea name="shipping_address" id="address" required></textarea>
  </div>

  <div class="form-group">
    <label>City</label>
    <input type="text" name="city" id="city" required>
  </div>

  <div class="form-group">
    <label>State</label>
    <input type="text" name="state" id="state" required>
  </div>

  <div class="form-group">
    <label>Postal Code</label>
    <input type="text" name="postal_code" id="postal_code" required>
  </div>

  <button type="submit" class="btn btn-primary">Proceed to Payment</button>
</form>

<script>
document.getElementById('checkout-form').addEventListener('submit', function(e) {
  e.preventDefault();
  
  // Collect selected items from cart
  const selectedItems = Array.from(
    document.querySelectorAll('input[name="selected_items"]:checked')
  ).map(el => parseInt(el.value));
  
  if (selectedItems.length === 0) {
    alert('Please select at least one item');
    return;
  }
  
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
  
  // Submit checkout
  submitCheckout(checkoutData);
});
</script>
```

## Order Confirmation Page

After successful payment, user is redirected to:
```
GET /order-confirmed/{id}
```

This page should display:
- ✓ Order number
- ✓ Order total and breakdown
- ✓ Items ordered
- ✓ Shipping address
- ✓ Estimated delivery date
- ✓ Order status (should be "paid")
- ✓ Print receipt/invoice option

## Status Display Logic

```javascript
function getStatusBadge(status) {
  const statusStyles = {
    'processing': { color: 'bg-yellow-500', label: 'Processing' },
    'paid': { color: 'bg-blue-500', label: 'Paid' },
    'shipped': { color: 'bg-purple-500', label: 'Shipped' },
    'delivered': { color: 'bg-green-500', label: 'Delivered' },
    'cancelled': { color: 'bg-red-500', label: 'Cancelled' }
  };
  
  const style = statusStyles[status] || statusStyles['processing'];
  return `<span class="badge ${style.color}">${style.label}</span>`;
}
```

## Error Handling Best Practices

```javascript
const errorMessages = {
  'Failed to verify payment': 'Payment verification failed. Please try again.',
  'Payment was not successful': 'Your payment was declined. Please try another payment method.',
  'Order or transaction not found': 'Order not found. Please contact support.',
  'Unauthorized access': 'You do not have permission to access this order.',
  'Payment not successful': 'Payment was cancelled or declined.'
};

function showError(message) {
  const mappedMessage = errorMessages[message] || message;
  // Show error toast/modal
  console.error('Payment Error:', mappedMessage);
  // Display to user
}
```

## Loading States

```javascript
function showLoading(message = 'Processing...') {
  document.getElementById('loading-modal').innerHTML = `
    <div class="spinner"></div>
    <p>${message}</p>
  `;
  document.getElementById('loading-modal').style.display = 'flex';
}

function hideLoading() {
  document.getElementById('loading-modal').style.display = 'none';
}

function showSuccess(message) {
  // Show success toast
  console.log('Success:', message);
}

function showError(message) {
  // Show error toast
  console.error('Error:', message);
}

function showWarning(message) {
  // Show warning toast
  console.warn('Warning:', message);
}
```

## Environment Variables for Frontend

Add to your `.env` or `.env.local`:
```
VITE_PAYSTACK_PUBLIC_KEY=pk_live_your_public_key
VITE_API_BASE_URL=https://yourdomain.com
```

Then use in JavaScript:
```javascript
const paystackKey = import.meta.env.VITE_PAYSTACK_PUBLIC_KEY;
```

## Testing Payment Flow

### Test Card Numbers (from Paystack)
- **Successful Payment**: 4084084084084081
- **Failed Payment**: 4111111111111111
- **Insufficient Funds**: 4000000000000002

### Test Flow
1. Go to checkout page
2. Fill in form with test data
3. Select items and click "Proceed to Payment"
4. Use test card number
5. Verify successful payment redirects to confirmation
6. Check order status is "paid"
7. Verify cart is empty

## Webhook Troubleshooting

If webhook processing seems delayed:
1. Manually call `/payment/verify` endpoint
2. Check browser console for errors
3. Review `storage/logs/laravel.log` for webhook logs
4. Verify CSRF token is included in requests
5. Test with `markTransactionFailed` as fallback

