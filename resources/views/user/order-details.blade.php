<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmed - GREENIK</title>
    <link rel="stylesheet" href="./src/output.css">
    <link rel="stylesheet" href="./src/mycss.css">
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
<div class="bg-black text-white font-sans overflow-x-hidden">
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 pt-32">
        <!-- Back Button -->
        <!-- <div class="mb-6">
            <a href="{{ route('user.orders') }}" class="text-primary hover:text-primary/80 transition flex items-center gap-2">
                <i class="ri-arrow-left-line"></i> Back to Orders
            </a>
        </div> -->

        <!-- Success Banner -->
        <div class="text-center mb-10">
            <div class="w-20 h-20 bg-primary rounded-full flex items-center justify-center mx-auto mb-6 shadow-[0_0_20px_rgba(34,197,94,0.3)]">
                <i class="ri-check-line text-black text-4xl"></i>
            </div>
            <h1 class="text-3xl sm:text-4xl font-bold text-white mb-2">Order Details</h1>
            <p class="text-gray-400 text-lg">Order #<span class="text-white font-semibold">GRN-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span></p>
            <p class="text-primary mt-2">Status: 
                @switch($order->status)
                    @case('paid')
                        paid
                    @case('processing')
                        Processing
                    @break
                    @case('shipped')
                        Shipped
                    @break
                    @case('delivered')
                        Delivered
                    @break
                    @default
                        {{ ucfirst($order->status) }}
                @endswitch
            </p>
        </div>

        <!-- Order Tracker -->
        <div class="max-w-4xl mx-auto mb-12">
            <div class="relative">
                <!-- Progress Bar Background -->
                <div class="absolute inset-0 flex items-center" aria-hidden="true">
                    <div class="w-full border-t-4 border-gray-700"></div>
                </div>
                <!-- Progress Bar Fill -->
                <div class="absolute inset-0 flex items-center" aria-hidden="true">
                    <div class="border-t-4 border-primary transition-all duration-500" style="width: @if($order->status === 'paid') 0%
                     @elseif($order->status === 'processing') 33.33% 
                     @elseif($order->status === 'shipped') 66.66% 
                     @elseif($order->status === 'delivered') 100% @else 0% @endif;"></div>
                </div>
                <div class="relative flex justify-between">
                    <!-- Step 1: Confirmed (always complete after payment) -->
                    <div>
                        <div class="@if($order->status !== 'processing' && $order->status !== 'shipped' && $order->status !== 'delivered') bg-primary @else bg-primary @endif h-8 w-8 rounded-full flex items-center justify-center ring-8 ring-black @if($order->status !== 'processing' && $order->status !== 'shipped' && $order->status !== 'delivered') text-black @else text-black @endif">
                            <i class="ri-check-line text-xs"></i>
                        </div>
                        <div class="absolute -ml-2 mt-2 text-xs font-semibold @if($order->status !== 'processing' && $order->status !== 'shipped' && $order->status !== 'delivered') text-primary @else text-primary @endif">Confirmed</div>
                    </div>
                    <!-- Step 2: Processing -->
                    <div>
                        <div class="@if(in_array($order->status, ['processing', 'shipped', 'delivered'])) bg-primary @else bg-gray-700 @endif h-8 w-8 rounded-full flex items-center justify-center ring-8 ring-black @if(in_array($order->status, ['processing', 'shipped', 'delivered'])) text-black @else text-gray-400 @endif">
                            <i class="ri-box-1-line text-xs"></i>
                        </div>
                        <div class="absolute -ml-1 mt-2 text-xs font-semibold @if(in_array($order->status, ['processing', 'shipped', 'delivered'])) text-primary @else text-gray-500 @endif">Processing</div>
                    </div>
                    <!-- Step 3: Shipped -->
                    <div>
                        <div class="@if(in_array($order->status, ['shipped', 'delivered'])) bg-primary @else bg-gray-700 @endif h-8 w-8 rounded-full flex items-center justify-center ring-8 ring-black @if(in_array($order->status, ['shipped', 'delivered'])) text-black @else text-gray-400 @endif">
                            <i class="ri-truck-line text-xs"></i>
                        </div>
                        <div class="absolute -ml-1 mt-2 text-xs font-semibold @if(in_array($order->status, ['shipped', 'delivered'])) text-primary @else text-gray-500 @endif">Shipped</div>
                    </div>
                    <!-- Step 4: Delivered -->
                    <div>
                        <div class="@if($order->status === 'delivered') bg-primary @else bg-gray-700 @endif h-8 w-8 rounded-full flex items-center justify-center ring-8 ring-black @if($order->status === 'delivered') text-black @else text-gray-400 @endif">
                            <i class="ri-home-line text-xs"></i>
                        </div>
                        <div class="absolute -ml-2 mt-2 text-xs font-semibold @if($order->status === 'delivered') text-primary @else text-gray-500 @endif">Delivered</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-4xl mx-auto grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Order Details Left -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Items Card -->
                <div class="bg-[#309983]/10 border border-gray-700 rounded-xl overflow-hidden">
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
                                <div class="h-16 w-16 flex-shrink-0 overflow-hidden rounded-md border border-gray-700 bg-gray-800">
                                    <img src="{{ $imageFile }}" alt="{{ $item->product->name }}" class="h-full w-full object-cover object-center">
                                </div>
                                <div class="ml-4 flex-1">
                                    <h4 class="text-white font-medium">{{ $item->product->name }}</h4>
                                    <p class="text-primary text-sm">{{ $item->product->category->name ?? 'N/A' }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-white font-medium">₦{{ number_format($item->price * $item->quantity, 2) }}</p>
                                    <p class="text-gray-500 text-sm">Qty: {{ $item->quantity }}</p>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Shipping & Billing Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-[#309983]/10 border border-gray-700 rounded-xl p-6">
                        <h3 class="text-white font-bold mb-4 flex items-center gap-2"><i class="ri-map-pin-line text-primary"></i> Shipping Address</h3>
                        <p class="text-gray-400 text-sm leading-relaxed">
                            <span class="block text-white">{{ auth()->user()->name }}</span>
                            <span class="block">{{ auth()->user()->email }}</span>
                            <span class="block">{{ $order->address ?? 'N/A' }}</span>
                            <span class="block">{{ $order->city ?? 'N/A' }}, {{ $order->postal_code ?? 'N/A' }}</span>
                        </p>
                    </div>
                    <div class="bg-[#309983]/10 border border-gray-700 rounded-xl p-6">
                        <h3 class="text-white font-bold mb-4 flex items-center gap-2"><i class="ri-bank-card-line text-primary"></i> Payment Info</h3>
                        <div class="flex items-center gap-3 mb-2">
                            <i class="ri-bank-card-2-line text-white text-2xl"></i>
                            <span class="text-gray-300">
                                @if($order->payment_method)
                                    {{ ucfirst($order->payment_method) }}
                                @else
                                    Payment Processed
                                @endif
                            </span>
                        </div>
                        <p class="text-gray-500 text-xs mt-2">Placed on {{ $order->created_at->format('M d, Y \a\t h:i A') }}</p>
                    </div>
                </div>
            </div>

            <!-- Summary Right -->
            <div class="lg:col-span-1">
                <div class="bg-[#309983]/10 border border-gray-700 rounded-xl p-6">
                    <h3 class="text-white font-bold mb-4">Payment Summary</h3>
                    @php
                        $subtotal = $order->subtotal ?? 0;
                        $shipping = $order->shipping_fee ?? 0;
                        $tax = $order->tax ?? 0;
                        $total = $order->total ?? 0;
                    @endphp
                    <div class="space-y-3">
                        @if($subtotal > 0)
                            <div class="flex justify-between text-sm text-gray-400">
                                <p>Subtotal</p>
                                <p class="text-white">₦{{ number_format($subtotal, 2) }}</p>
                            </div>
                        @endif
                        @if($shipping > 0)
                            <div class="flex justify-between text-sm text-gray-400">
                                <p>Shipping</p>
                                <p class="text-white">₦{{ number_format($shipping, 2) }}</p>
                            </div>
                        @endif
                        @if($tax > 0)
                            <div class="flex justify-between text-sm text-gray-400">
                                <p>Tax</p>
                                <p class="text-white">₦{{ number_format($tax, 2) }}</p>
                            </div>
                        @endif
                        <div class="border-t border-gray-700 pt-4 flex justify-between items-center">
                            <p class="text-base font-bold text-white">Grand Total</p>
                            <p class="text-xl font-bold text-primary">₦{{ number_format($total, 2) }}</p>
                        </div>
                    </div>
                    <div class="mt-8 space-y-3">
                        <button onclick="window.print()" class="w-full bg-[#309983]/10 hover:bg-white/10 text-white font-medium py-3 rounded-lg transition flex items-center justify-center gap-2">
                            <i class="ri-printer-line"></i> Print Receipt
                        </button>
                        <a href="{{ route('user.orders') }}" class="w-full bg-primary text-black font-bold py-3 rounded-lg hover:bg-primary/90 transition text-center block">
                            Back to Orders
                        </a>
                    </div>
                </div>
                <div class="mt-6 text-center">
                    <p class="text-xs text-gray-500">Need help? <a href="{{ route('user.contact') }}" class="text-primary hover:underline">Contact Support</a></p>
                </div>
            </div>
        </div>
    </main>
</div>
</body>
</html>
