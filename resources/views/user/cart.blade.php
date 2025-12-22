<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>cart - GREENIK</title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="stylesheet" href="./src/output.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./src/mycss.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link
        href="https://fonts.googleapis.com/css2?family=Pacifico&amp;family=Inter:wght@300;400;500;600;700&amp;display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])    
</head>

<body class="bg-black text-white font-sans overflow-x-hidden">
    @include('components.header')

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 mt-10">
        <h2 class="text-3xl font-bold text-white mb-8">Shopping Cart</h2>

        @if ($message = Session::get('success'))
            <div class="fixed top-20 left-1/2 transform -translate-x-1/2 z-50 p-4 bg-green-500/20 border border-green-500 rounded text-green-100 min-w-96">
                {{ $message }}
            </div>
        @endif

        @if ($message = Session::get('error'))
            <div class="fixed top-20 left-1/2 transform -translate-x-1/2 z-50 p-4 bg-red-500/20 border border-red-500 rounded text-red-100 min-w-96">
                {{ $message }}
            </div>
        @endif

        @if ($cartItems->isEmpty())
            <!-- Empty State -->
            <div class="flex flex-col items-center justify-center py-20 bg-[#309983]/10 border border-gray-700 rounded-xl">
                <div class="w-24 h-24 rounded-full bg-[#309983]/10 flex items-center justify-center mb-6 text-gray-600">
                    <i class="fa-solid fa-basket-shopping text-4xl"></i>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">Your cart is empty</h3>
                <a href="{{ route('user.product') }}"
                    class="mt-4 bg-green-500 text-black font-bold py-3 px-8 rounded-lg hover:bg-green-400 transition">
                    Start Shopping
                </a>
            </div>
        @else
                    <!-- Cart Content -->
                    <form id="checkoutForm" action="{{ route('user.checkout') }}" method="GET">
                        <div class="lg:grid lg:grid-cols-12 lg:gap-x-12 lg:items-start">

                            <!-- Cart Items List -->
                            <section class="lg:col-span-8">

                                <!-- Table Header / Select All -->
                                <div class="flex items-center gap-4 mb-4 px-2">
                                    <input type="checkbox" id="selectAllCheckbox"
                                        class="custom-checkbox rounded bg-gray-800 border border-gray-700 w-5 h-5 cursor-pointer">
                                    <span class="text-sm font-medium text-gray-400">Select All items</span>
                                </div>

                                <div class="bg-[#309983]/10 border border-gray-700 rounded-xl overflow-hidden">
                                    <ul class="divide-y divide-gray-700">
                                        @foreach ($cartItems as $item)
                                            @php
        $images = $item->product->image_url ?? [];
        $imageFile = '';
        if (is_array($images) && count($images) > 0) {
            $imageFile = $images[0];
            // Check if it's a full URL or a relative path
            if (!str_starts_with($imageFile, 'http')) {
                $imageFile = asset('storage/' . $imageFile);
            }
        } else {
            $imageFile = 'https://via.placeholder.com/100';
        }
                                            @endphp
                                            <li class="p-6 flex items-start sm:items-center gap-4 hover:bg-white/5 transition duration-150 cart-item"
                                                data-item-id="{{ $item->id }}" data-price="{{ $item->product->price }}"
                                                data-quantity="{{ $item->quantity }}">

                                                <!-- CHECKBOX FOR EACH ITEM -->
                                                <div class="flex-shrink-0 pt-2 sm:pt-0">
                                                    <input type="checkbox" name="selected_items[]" value="{{ $item->id }}"
                                                        class="item-checkbox custom-checkbox rounded bg-gray-800 border border-gray-700 w-5 h-5 cursor-pointer">
                                                </div>

                                                <!-- Image -->
                                                <div
                                                    class="h-24 w-24 flex-shrink-0 overflow-hidden rounded-lg border border-gray-700 bg-gray-800">
                                                    <img src="{{ $imageFile }}" alt="{{ $item->product->name }}"
                                                        class="h-full w-full object-cover object-center item-image">
                                                </div>

                                                <!-- Details -->
                                                <div class="flex-1 flex flex-col sm:flex-row sm:justify-between sm:items-center item-details"
                                                    id="details-{{ $item->id }}">
                                                    <div class="sm:pr-4">
                                                        <h3 class="font-bold text-white text-lg">{{ $item->product->name }}</h3>
                                                        <p class="mt-1 text-sm text-green-500">
                                                            {{ $item->product->category->name ?? 'N/A' }}
                                                        </p>
                                                    </div>

                                                    <!-- Actions -->
                                                    <div class="mt-4 sm:mt-0 flex items-center justify-between sm:space-x-6">
                                                        <p class="hidden sm:block font-bold text-white text-lg item-price">
                                                            ₦{{ number_format($item->product->price, 2) }}</p>

                                                        <!-- Qty -->
                                                        <div class="flex items-center border border-gray-700 rounded-lg bg-gray-800">
                                                            <button type="button" class="qty-btn-minus px-3 py-1 text-gray-400 hover:text-white transition" data-item-id="{{ $item->id }}" data-action="decrement">-</button>
                                                            <span
                                                                class="w-8 text-center text-white text-sm font-medium item-qty">{{ $item->quantity }}</span>
                                                            <button type="button" class="qty-btn-plus px-3 py-1 text-gray-400 hover:text-white transition" data-item-id="{{ $item->id }}" data-action="increment">+</button>
                                                        </div>

                                                        <!-- Remove -->
                                                        <button type="button" class="remove-btn text-gray-400 hover:text-red-400 transition p-2" data-item-id="{{ $item->id }}" title="Remove item">
                                                            <i class="fa-solid fa-trash-can"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </section>

                            <!-- Summary -->
                            <section class="lg:col-span-4 mt-8 lg:mt-0">
                                <div class="bg-[#309983]/10 border border-gray-700 rounded-xl p-6 sticky top-24">
                                    <h2 class="text-lg font-bold text-white mb-6">Order Summary</h2>

                                    <div class="flow-root space-y-4">
                                        <div class="flex items-center justify-between text-gray-400 text-sm">
                                            <p>Selected Items</p>
                                            <p class="font-medium text-white" id="selectedItemsCount">0</p>
                                        </div>
                                        <div class="flex items-center justify-between text-gray-400 text-sm">
                                            <p>Subtotal</p>
                                            <p class="font-medium text-white" id="subtotal">₦0.00</p>
                                        </div>
                                        <div class="flex items-center justify-between text-gray-400 text-sm">
                                            <p>Shipping Estimate</p>
                                            <p class="font-medium text-white" id="shipping">₦0.00</p>
                                        </div>
                                        <div class="flex items-center justify-between text-gray-400 text-sm">
                                            <p>Tax Estimate</p>
                                            <p class="font-medium text-white" id="tax">₦0.00</p>
                                        </div>
                                        <div class="border-t border-gray-700 pt-4 flex items-center justify-between">
                                            <p class="text-base font-bold text-white">Total</p>
                                            <p class="text-2xl font-bold text-green-500" id="total">₦0.00</p>
                                        </div>
                                    </div>

                                    <div class="mt-6">
                                        <button type="button" id="checkoutBtn" disabled
                                            class="w-full bg-green-500 text-black font-bold py-3 rounded-lg hover:bg-green-400 transition shadow-lg shadow-green-500/20 disabled:opacity-50 disabled:cursor-not-allowed">
                                            Checkout (<span id="checkoutCount">0</span>)
                                        </button>
                                        <a href="{{ route('user.product') }}"
                                            class="w-full mt-4 text-sm text-gray-400 hover:text-white transition block text-center">
                                            Continue Shopping
                                        </a>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </form>
        @endif
    </main>

    @include('components.footer')

    <script>
        // Helper function to show success/error messages
        function showNotification(message, type = 'success') {
            const div = document.createElement('div');
            div.className = type === 'success' 
                ? 'fixed top-20 left-1/2 transform -translate-x-1/2 z-50 p-4 bg-green-500/20 border border-green-500 rounded text-green-100 min-w-96'
                : 'fixed top-20 left-1/2 transform -translate-x-1/2 z-50 p-4 bg-red-500/20 border border-red-500 rounded text-red-100 min-w-96';
            div.textContent = message;
            document.body.appendChild(div);
            
            // Auto-hide after 3 seconds
            setTimeout(() => {
                div.style.transition = 'opacity 0.3s ease';
                div.style.opacity = '0';
                setTimeout(() => div.remove(), 300);
            }, 3000);
        }

        document.addEventListener('DOMContentLoaded', function () {
            // Auto-hide success and error messages after 3 seconds
            const successMsg = document.querySelector('.bg-green-500\\/20');
            const errorMsg = document.querySelector('.bg-red-500\\/20');

            if (successMsg) {
                setTimeout(() => {
                    successMsg.style.transition = 'opacity 0.3s ease';
                    successMsg.style.opacity = '0';
                    setTimeout(() => successMsg.remove(), 300);
                }, 2000);
            }

            if (errorMsg) {
                setTimeout(() => {
                    errorMsg.style.transition = 'opacity 0.3s ease';
                    errorMsg.style.opacity = '0';
                    setTimeout(() => errorMsg.remove(), 300);
                }, 2000);
            }

            const selectAllCheckbox = document.getElementById('selectAllCheckbox');
            const itemCheckboxes = document.querySelectorAll('.item-checkbox');
            const checkoutForm = document.getElementById('checkoutForm');
            const checkoutBtn = document.getElementById('checkoutBtn');

            // Update order summary
            function updateOrderSummary() {
                const checkedItems = document.querySelectorAll('.item-checkbox:checked');
                let subtotal = 0;
                let selectedCount = checkedItems.length;

                checkedItems.forEach(checkbox => {
                    const cartItem = checkbox.closest('.cart-item');
                    const price = parseFloat(cartItem.dataset.price);
                    const quantity = parseInt(cartItem.querySelector('.item-qty').textContent);
                    subtotal += price * quantity;
                });

                const shipping = subtotal > 0 ? 15.00 : 0;
                const tax = subtotal * 0.01;
                const total = subtotal + shipping + tax;

                document.getElementById('selectedItemsCount').textContent = selectedCount;
                document.getElementById('subtotal').textContent = '₦' + subtotal.toFixed(2);
                document.getElementById('shipping').textContent = '₦' + shipping.toFixed(2);
                document.getElementById('tax').textContent = '₦' + tax.toFixed(2);
                document.getElementById('total').textContent = '₦' + total.toFixed(2);
                document.getElementById('checkoutCount').textContent = selectedCount;
                document.getElementById('checkoutBtn').disabled = selectedCount === 0;
            }

            // Select All functionality
            selectAllCheckbox.addEventListener('change', function () {
                itemCheckboxes.forEach(checkbox => {
                    checkbox.checked = this.checked;
                });
                updateOrderSummary();
            });

            // Individual checkbox change
            itemCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function () {
                    const allChecked = Array.from(itemCheckboxes).every(cb => cb.checked);
                    const someChecked = Array.from(itemCheckboxes).some(cb => cb.checked);
                    selectAllCheckbox.checked = allChecked;
                    selectAllCheckbox.indeterminate = someChecked && !allChecked;
                    updateOrderSummary();
                });
            });

            // Update summary when quantity changes
            document.querySelectorAll('.qty-btn-minus, .qty-btn-plus').forEach(btn => {
                btn.addEventListener('click', async function (e) {
                    e.preventDefault();
                    const itemId = this.dataset.itemId;
                    const action = this.dataset.action;
                    const cartItem = document.querySelector(`[data-item-id="${itemId}"]`).closest('.cart-item');
                    const currentQty = parseInt(cartItem.querySelector('.item-qty').textContent);
                    const newQty = action === 'increment' ? currentQty + 1 : currentQty - 1;
                    
                    // Prevent quantity from going below 1
                    if (newQty < 1) {
                        showNotification('Quantity must be at least 1', 'error');
                        return;
                    }

                    try {
                        const formData = new FormData();
                        formData.append('quantity', newQty);
                        formData.append('_method', 'PATCH');
                        
                        const response = await fetch(`{{ route('cart.update', ':item') }}`.replace(':item', itemId), {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}',
                                'X-Requested-With': 'XMLHttpRequest'
                            },
                            body: formData
                        });

                        if (response.ok) {
                            // Update the quantity display
                            cartItem.querySelector('.item-qty').textContent = newQty;
                            // Update the cart item's data attribute
                            cartItem.dataset.quantity = newQty;
                            // Update the order summary
                            updateOrderSummary();
                            showNotification('Cart updated!', 'success');
                        } else {
                            showNotification('Failed to update quantity', 'error');
                        }
                    } catch (error) {
                        console.error('Error:', error);
                        showNotification('Error updating cart', 'error');
                    }
                });
            });

            // Remove item from cart
            document.querySelectorAll('.remove-btn').forEach(btn => {
                btn.addEventListener('click', async function (e) {
                    e.preventDefault();
                    if (!confirm('Are you sure you want to remove this item?')) {
                        return;
                    }

                    const itemId = this.dataset.itemId;
                    try {
                        const formData = new FormData();
                        formData.append('_method', 'DELETE');
                        
                        const response = await fetch(`{{ route('cart.remove', ':item') }}`.replace(':item', itemId), {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}',
                                'X-Requested-With': 'XMLHttpRequest'
                            },
                            body: formData
                        });

                        if (response.ok) {
                            // Remove the item from DOM
                            const cartItem = document.querySelector(`[data-item-id="${itemId}"]`).closest('.cart-item');
                            cartItem.remove();
                            
                            // Check if cart is empty
                            if (document.querySelectorAll('.cart-item').length === 0) {
                                location.reload();
                            } else {
                                updateOrderSummary();
                                showNotification('Item removed from cart!', 'success');
                            }
                        } else {
                            showNotification('Failed to remove item', 'error');
                        }
                    } catch (error) {
                        console.error('Error:', error);
                        showNotification('Error removing item', 'error');
                    }
                });
            });

            // Checkout button click handler
            checkoutBtn.addEventListener('click', function (e) {
                e.preventDefault();
                const checkedItems = document.querySelectorAll('.item-checkbox:checked');
                if (checkedItems.length === 0) {
                    showNotification('Please select at least one item to checkout', 'error');
                    return;
                }

                // Build query string with selected items
                const selectedIds = Array.from(checkedItems).map(cb => cb.value);
                const queryString = selectedIds.map(id => `selected_items[]=${id}`).join('&');
                
                // Redirect to checkout with selected items
                window.location.href = `{{ route('user.checkout') }}?${queryString}`;
            });

            // Initial summary update
            updateOrderSummary();
        });


       
        
     
    </script>
</body>

</html>