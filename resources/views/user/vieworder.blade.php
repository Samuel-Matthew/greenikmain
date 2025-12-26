<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmed - GREENIK</title>
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

        <!-- Success Banner -->
        <div class="text-center mb-10">
            <div
                class="w-20 h-20 bg-green-500 rounded-full flex items-center justify-center mx-auto mb-6 shadow-[0_0_20px_rgba(34,197,94,0.3)]">
                <i class="fa-solid fa-check text-black text-4xl"></i>
            </div>
            <h1 class="text-3xl sm:text-4xl font-bold text-white mb-2">Order Confirmed!</h1>
            <p class="text-gray-400 text-lg">Thank you, <span
                    class="text-white font-semibold">{{ $order->first_name }}</span>. We have received your order.</p>
            <p class="text-green-500 mt-2 font-mono">{{ $order->order_number }}</p>
        </div>

        <!-- Order Tracker -->
        <div class="max-w-4xl mx-auto mb-12">
            <div class="relative">
                <div class="absolute inset-0 flex items-center" aria-hidden="true">
                    <div class="w-full border-t border-gray-700"></div>
                </div>
                <div class="relative flex justify-between">
                    <div>
                        <div
                            class="bg-green-500 h-8 w-8 rounded-full flex items-center justify-center ring-8 ring-black text-black">
                            <i class="fa-solid fa-check text-xs"></i>
                        </div>
                        <div class="absolute -ml-2 mt-2 text-xs font-semibold text-green-500">Confirmed</div>
                    </div>
                    <div>
                        <div
                            class="bg-gray-700 h-8 w-8 rounded-full flex items-center justify-center ring-8 ring-black text-gray-400">
                            <i class="fa-solid fa-box text-xs"></i>
                        </div>
                        <div class="absolute -ml-1 mt-2 text-xs font-semibold text-gray-500">Processing</div>
                    </div>
                    <div>
                        <div
                            class="bg-gray-700 h-8 w-8 rounded-full flex items-center justify-center ring-8 ring-black text-gray-400">
                            <i class="fa-solid fa-truck text-xs"></i>
                        </div>
                        <div class="absolute -ml-1 mt-2 text-xs font-semibold text-gray-500">Shipped</div>
                    </div>
                    <div>
                        <div
                            class="bg-gray-700 h-8 w-8 rounded-full flex items-center justify-center ring-8 ring-black text-gray-400">
                            <i class="fa-solid fa-house text-xs"></i>
                        </div>
                        <div class="absolute -ml-2 mt-2 text-xs font-semibold text-gray-500">Delivered</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-4xl mx-auto grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Order Details Left -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Items Card -->
                <div class="bg-gray-900 border border-gray-700 rounded-xl overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-700 bg-white/5">
                        <h3 class="text-white font-bold">Order Items</h3>
                    </div>
                    <ul class="divide-y divide-gray-700">
                        @foreach ($order->items as $item)
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
                            <li class="p-6 flex items-center">
                                <div
                                    class="h-16 w-16 flex-shrink-0 overflow-hidden rounded-md border border-gray-700 bg-gray-800">
                                    <img src="{{ $imageFile }}" alt="{{ $item->product->name }}"
                                        class="h-full w-full object-cover object-center">
                                </div>
                                <div class="ml-4 flex-1">
                                    <h4 class="text-white font-medium">{{ $item->product->name }}</h4>
                                    <p class="text-green-500 text-sm">{{ $item->product->category->name ?? 'N/A' }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-white font-medium">
                                        ${{ number_format($item->price * $item->quantity, 2) }}</p>
                                    <p class="text-gray-500 text-sm">Qty: {{ $item->quantity }}</p>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Shipping & Billing Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-gray-900 border border-gray-700 rounded-xl p-6">
                        <h3 class="text-white font-bold mb-4 flex items-center gap-2"><i
                                class="fa-solid fa-location-dot text-green-500"></i> Shipping Address</h3>
                        <p class="text-gray-400 text-sm leading-relaxed">
                            <span class="block text-white">{{ $order->first_name }} {{ $order->last_name }}</span>
                            <span class="block">{{ $order->address }}</span>
                            <span class="block">{{ $order->city }}, {{ $order->postal_code }}</span>
                            <span class="block">{{ $order->email }}</span>
                        </p>
                    </div>
                    <div class="bg-gray-900 border border-gray-700 rounded-xl p-6">
                        <h3 class="text-white font-bold mb-4 flex items-center gap-2"><i
                                class="fa-solid fa-credit-card text-green-500"></i> Payment Method</h3>
                        <div class="flex items-center gap-3 mb-2">
                            <i class="fa-brands fa-cc-visa text-white text-2xl"></i>
                            <span class="text-gray-300">Card
                                ({{ $order->transaction->payment_method ?? 'card' }})</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Summary Right -->
            <div class="lg:col-span-1">
                <div class="bg-gray-900 border border-gray-700 rounded-xl p-6">
                    <h3 class="text-white font-bold mb-4">Payment Summary</h3>
                    @php
$subtotal = $order->subtotal;
$shipping = $order->shipping_fee;
$tax = $order->tax;
$total = $order->total;
                    @endphp
                    <div class="space-y-3">
                        <div class="flex justify-between text-sm text-gray-400">
                            <p>Subtotal</p>
                            <p class="text-white">${{ number_format($subtotal, 2) }}</p>
                        </div>
                        <div class="flex justify-between text-sm text-gray-400">
                            <p>Shipping</p>
                            <p class="text-white">${{ number_format($shipping, 2) }}</p>
                        </div>
                        <div class="flex justify-between text-sm text-gray-400">
                            <p>Tax</p>
                            <p class="text-white">${{ number_format($tax, 2) }}</p>
                        </div>
                        <div class="border-t border-gray-700 pt-4 flex justify-between items-center">
                            <p class="text-base font-bold text-white">Grand Total</p>
                            <p class="text-2xl font-bold text-green-500">${{ number_format($total, 2) }}</p>
                        </div>
                    </div>
                    <div class="mt-8 space-y-3">
                        <button onclick="window.print()"
                            class="w-full bg-gray-800 hover:bg-white/10 text-white font-medium py-3 rounded-lg transition flex items-center justify-center gap-2">
                            <i class="fa-solid fa-print"></i> Print Receipt
                        </button>
                        <a href="{{ route('user.index') }}"
                            class="w-full bg-green-500 text-black font-bold py-3 rounded-lg hover:bg-green-400 transition text-center block">
                            Continue Shopping
                        </a>
                    </div>
                </div>
                <div class="mt-6 text-center">
                    <p class="text-xs text-gray-500">Need help? <a href="{{ route('user.contact') }}"
                            class="text-green-500 hover:underline">Contact Support</a></p>
                </div>
            </div>
        </div>
    </main>

    @include('components.footer')
</body>

</html>