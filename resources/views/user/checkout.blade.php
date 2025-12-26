<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Checkout - GREENIK</title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Inter:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-black text-white font-sans overflow-x-hidden">
    @include('components.header')

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 mt-10">

        <!-- Breadcrumb -->
        <div class="mb-8 flex items-center text-sm text-gray-500">
            <a href="{{ route('user.index') }}" class="hover:text-green-500 transition">Home</a>
            <i class="fa-solid fa-chevron-right text-xs mx-3"></i>
            <a href="{{ route('user.cart') }}" class="hover:text-green-500 transition">Cart</a>
            <i class="fa-solid fa-chevron-right text-xs mx-3"></i>
            <span class="text-white">Checkout</span>
        </div>

        @php
$subtotal = 0;
foreach ($cartItems as $item) {
    $subtotal += $item->product->price * $item->quantity;
}
$shipping = 15.00;
$tax = $subtotal * 0.01;
$total = $subtotal + $shipping + $tax;
        @endphp

        @if ($cartItems->isEmpty())
            <div class="text-center py-20">
                <h2 class="text-2xl font-bold text-white mb-4">Your cart is empty</h2>
                <a href="{{ route('user.cart') }}"
                    class="inline-block bg-green-500 text-black px-8 py-3 rounded-lg font-bold hover:bg-green-400 transition">
                    Back to Cart
                </a>
            </div>
        @else
                                                                    <div class="lg:grid lg:grid-cols-12 lg:gap-x-12 lg:items-start">

                                                                        <!-- LEFT COLUMN: Forms -->
                                                                        <section class="lg:col-span-7">
                                                                            <form id="checkoutForm">
                                                                                @csrf


                                                                                <!-- Section: Shipping -->
                                                                                <div class="bg-[#309983]/10 border border-gray-700 rounded-xl p-6 mb-6">
                                                                                    <h2 class="text-lg font-medium text-white mb-4">Shipping Details</h2>
                                                                                    <div class="grid grid-cols-1 gap-y-4 gap-x-4 sm:grid-cols-2">
                                                                                        <div class="sm:col-span-1">
                                                                                            <label class="block text-sm font-medium text-gray-400 mb-1">First name</label>
                                                                                            <input type="text" name="first_name" required
                                                                                                class="w-full bg-[#309983]/10 border border-gray-700 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500 transition">
                                                                                            @error('first_name')
                                                                                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                                                                            @enderror
                                                                                        </div>
                                                                                        <div class="sm:col-span-1">
                                                                                            <label class="block text-sm font-medium text-gray-400 mb-1">Last name</label>
                                                                                            <input type="text" name="last_name" required
                                                                                                class="w-full bg-[#309983]/10 border border-gray-700 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500 transition">
                                                                                            @error('last_name')
                                                                                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                                                                            @enderror
                                                                                        </div>
                                                                                        <div>
                                                                                            <label class="block text-sm font-medium text-gray-400 mb-1">Email address</label>
                                                                                            <input type="email" name="email" required value="{{ auth()->user()->email }}"
                                                                                                class="w-full bg-[#309983]/10 border border-gray-700 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500 transition">
                                                                                            @error('email')
                                                                                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                                                                            @enderror
                                                                                        </div>
                                                                                        <div class="sm:col-span-1">
                                                                                            <label class="block text-sm font-medium text-gray-400 mb-1">Phone</label>
                                                                                            <input type="text" name="phone" required
                                                                                                class="w-full bg-[#309983]/10 border border-gray-700 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500 transition">
                                                                                            @error('phone')
                                                                                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                                                                            @enderror
                                                                                        </div>
                                                                                        <div class="sm:col-span-2">
                                                                                            <label class="block text-sm font-medium text-gray-400 mb-1">Address</label>
                                                                                            <input type="text" name="shipping_address" required
                                                                                                class="w-full bg-[#309983]/10 border border-gray-700 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500 transition">
                                                                                            @error('shipping_address')
                                                                                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                                                                            @enderror
                                                                                        </div>
                                                                                        <div class="sm:col-span-1">
                                                                                            <label class="block text-sm font-medium text-gray-400 mb-1">City</label>
                                                                                            <input type="text" name="city" required
                                                                                                class="w-full bg-[#309983]/10 border border-gray-700 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500 transition">
                                                                                            @error('city')
                                                                                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                                                                            @enderror
                                                                                        </div>
                                                                                        <div class="sm:col-span-1">
                                                                                            <label class="block text-sm font-medium text-gray-400 mb-1">State</label>
                                                                                            <input type="text" name="state" required
                                                                                                class="w-full bg-[#309983]/10 border border-gray-700 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500 transition">
                                                                                            @error('city')
                                                                                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                                                                            @enderror
                                                                                        </div>
                                                                                        <div class="sm:col-span-1">
                                                                                            <label class="block text-sm font-medium text-gray-400 mb-1">Postal code</label>
                                                                                            <input type="text" name="postal_code" required
                                                                                                class="w-full bg-[#309983]/10 border border-gray-700 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500 transition">
                                                                                            @error('postal_code')
                                                                                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                                                                            @enderror
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                <input type="number" name="amout" value="{{ intval($total * 100) }}" hidden>

                                                                                <!-- Hidden selected items -->
                                                                                @foreach ($cartItems as $item)
                                                                                    <input type="hidden" name="selected_items[]" value="{{ $item->id }}">
                                                                                @endforeach

                                                                                <!-- Pay Button -->
                                                                                <button type="submit" id="payBtn" data-total="{{ $total }}"
                                                                                    class="w-full bg-green-500 hover:bg-green-400 disabled:opacity-50 disabled:cursor-not-allowed text-black font-bold py-4 rounded-xl text-lg transition shadow-lg shadow-green-500/20 flex items-center justify-center">
                                                                                    <span id="payText">Pay ₦<span id="payAmount" name="amount">{{ number_format($total, 2) }}</span></span>

                                                                                    <span id="processingText" class="hidden flex items-center">
                                                                                        <i class="fa-solid fa-circle-notch fa-spin mr-2"></i> Processing...
                                                                                    </span>
                                                                                </button>

                                                                            </form>
                                                                        </section>

                                                                        <!-- RIGHT COLUMN: Order Summary -->
                                                                        <section class="mt-10 lg:mt-0 lg:col-span-5">
                                                                            <div class="bg-[#309983]/10 border border-gray-700 rounded-xl p-6 sticky top-24">
                                                                                <h2 class="text-lg font-medium text-white mb-6">Order Summary</h2>

                                                                                <ul class="divide-y divide-gray-700 mb-6">
                                                                                    @foreach ($cartItems as $item)
                                                                                        @php
        $images = $item->product->image_url ?? [];
        $imageFile = '';
        if (is_array($images) && count($images) > 0) {
            $imageFile = $images[0];
            if (!str_starts_with($imageFile, 'http')) {
                $imageFile = asset('storage/' . $imageFile);
            }
        } else {
            $imageFile = 'https://via.placeholder.com/100';
        }
                                                                                        @endphp
                                                                                        <li class="flex py-4">
                                                                                            <div
                                                                                                class="h-16 w-16 flex-shrink-0 overflow-hidden rounded-md border border-gray-700 bg-gray-800">
                                                                                                <img src="{{ $imageFile }}" alt="{{ $item->product->name }}"
                                                                                                    class="h-full w-full object-cover object-center">
                                                                                            </div>
                                                                                            <div class="ml-4 flex flex-1 flex-col">
                                                                                                <div>
                                                                                                    <div class="flex justify-between text-base font-medium text-white">
                                                                                                        <h3>{{ $item->product->name }}</h3>
                                                                                                        <p class="ml-4">₦{{ number_format($item->product->price * $item->quantity, 2) }}
                                                                                                        </p>
                                                                                                    </div>
                                                                                                    <p class="mt-1 text-xs text-gray-500">{{ $item->product->category->name ?? 'N/A' }}
                                                                                                    </p>
                                                                                                </div>
                                                                                                <div class="flex flex-1 items-end justify-between text-sm">
                                                                                                    <p class="text-gray-400">Qty <span>{{ $item->quantity }}</span></p>
                                                                                                </div>
                                                                                            </div>
                                                                                        </li>
                                                                                    @endforeach
                                                                                </ul>

                                                                                <div class="space-y-3 border-t border-gray-700 pt-6">
                                                                                    <div class="flex justify-between text-sm text-gray-400">
                                                                                        <p>Subtotal</p>
                                                                                        <p class="text-white">₦{{ number_format($subtotal, 2) }}</p>
                                                                                    </div>
                                                                                    <div class="flex justify-between text-sm text-gray-400">
                                                                                        <p>Shipping</p>
                                                                                        <p class="text-white">₦{{ number_format($shipping, 2) }}</p>
                                                                                    </div>
                                                                                    <div class="flex justify-between text-sm text-gray-400">
                                                                                        <p>Tax (Estimated)</p>
                                                                                        <p class="text-white">₦{{ number_format($tax, 2) }}</p>
                                                                                    </div>
                                                                                    <div class="border-t border-gray-700 pt-4 flex justify-between items-center">
                                                                                        <p class="text-base font-bold text-white">Total</p>
                                                                                        <p class="text-2xl font-bold text-green-500">₦{{ number_format($total, 2) }}</p>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="mt-6 flex items-center justify-center gap-2 text-xs text-gray-500">
                                                                                    <i class="fa-solid fa-lock"></i> Secure Encrypted Checkout
                                                                                </div>
                                                                            </div>
                                                                        </section>
                                                                    </div>
        @endif
    </main>

    @include('components.footer')

    <script>
document.addEventListener('DOMContentLoaded', () => {
    const checkoutForm = document.getElementById('checkoutForm');
    const payBtn = document.getElementById('payBtn');
    const payText = document.getElementById('payText');
    const processingText = document.getElementById('processingText');

    // Notification helper
    const showNotification = (message, type = 'success') => {
        const div = document.createElement('div');
        div.className = type === 'success'
            ? 'fixed top-20 left-1/2 transform -translate-x-1/2 z-50 p-4 bg-green-500/20 border border-green-500 rounded text-green-100 min-w-96'
            : 'fixed top-20 left-1/2 transform -translate-x-1/2 z-50 p-4 bg-red-500/20 border border-red-500 rounded text-red-100 min-w-96';
        div.textContent = message;
        document.body.appendChild(div);
        setTimeout(() => {
            div.style.transition = 'opacity 0.3s ease';
            div.style.opacity = '0';
            setTimeout(() => div.remove(), 3000);
        }, 6000);
    };

    checkoutForm.addEventListener('submit', async e => {
        e.preventDefault();

        // Validate required fields
        const fields = ['first_name', 'last_name', 'email', 'phone', 'shipping_address', 'city', 'postal_code'];
        for (let name of fields) {
            const input = checkoutForm.querySelector(`input[name="${name}"]`);
            if (!input?.value.trim()) {
                showNotification('Please fill in all required fields', 'error');
                return;
            }
        }

        // Show processing state
        payBtn.disabled = true;
        payText.classList.add('hidden');
        processingText.classList.remove('hidden');

        try {
            // Submit form to create order and get payment URL
            const formData = new FormData(checkoutForm);
            const response = await fetch('{{ route("checkout.complete") }}', {
                method: 'POST',
                body: formData,
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            });
            
            const data = await response.json();
            
            if (!data.success) {
                showNotification(data.message || 'Payment processing failed', 'error');
                payBtn.disabled = false;
                payText.classList.remove('hidden');
                processingText.classList.add('hidden');
                return;
            }

            // Store order ID in session storage for verification after payment
            sessionStorage.setItem('pending_order_id', data.order_id);

            // Redirect to Paystack payment page
            window.location.href = data.authorization_url;

        } catch (err) {
            console.error(err);
            showNotification('Error: ' + err.message, 'error');
            payBtn.disabled = false;
            payText.classList.remove('hidden');
            processingText.classList.add('hidden');
        }
    });
});
</script>


</body>

</html>