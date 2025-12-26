<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>myorders - GREENIK</title>
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
<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 pt-32">
    <div class="flex justify-center">
        <!-- Main Content -->
        <div class="w-full lg:max-w-4xl">
            <h1 class="text-2xl font-bold text-white mb-6">Order History</h1>
            
            @if($orders->count() > 0)
                <div class="space-y-6" id="orders-list-container">
                    @foreach($orders as $order)
                        <div class="order-card bg-[#309983]/10 border border-gray-700 rounded-xl overflow-hidden hover:border-gray-600 transition" data-status="{{ $order->status }}">

                            <!-- Card Header -->
                            <div class="bg-[#309983]/10 px-6 py-4 flex items-center justify-between border-b border-gray-700">
                                <div class="flex gap-12 text-sm">
                                    <div>
                                        <p class="text-gray-400 text-xs uppercase tracking-wide mb-1">Placed</p>
                                        <p class="text-white font-semibold">{{ $order->created_at->format('M d, Y') }}</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-400 text-xs uppercase tracking-wide mb-1">Total</p>
                                        <p class="text-white font-semibold">₦{{ number_format($order->total, 2) }}</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-400 text-xs uppercase tracking-wide mb-1">Order #</p>
                                        <p class="text-white font-semibold">GRN-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</p>
                                    </div>
                                </div>
                                @if($order->status === 'cancelled')
                                    <a href="{{ route('order.failed', $order->id) }}" class="text-primary text-sm font-medium hover:text-primary/80 transition">View Order</a>
                                @else
                                    <a href="{{ route('order.details', $order->id) }}" class="text-primary text-sm font-medium hover:text-primary/80 transition">View Order</a>
                                @endif
                            </div>

                            <!-- Card Body -->
                            <div class="px-6 py-6">
                                <div class="flex items-center justify-between mb-4">
                                    <div >
                                        <h4 class="text-lg font-bold text-white">
                                            Status: 
                                            @switch($order->status)
                                                @case('pending')
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
                                        </h4>
                                    </div>

                                    <!-- Status Badge -->
                                    <span class="px-3 py-1 rounded text-xs font-bold border
                                        @if($order->status === 'delivered')
                                            bg-green-500/10 text-green-400 border-green-500/20
                                        @elseif($order->status === 'pending')
                                            bg-yellow-500/10 text-yellow-400 border-yellow-500/20
                                        @elseif($order->status === 'shipped')
                                            bg-blue-500/10 text-blue-400 border-blue-500/20
                                        @endif
                                    ">
                                        {{ strtoupper($order->status) }}
                                    </span>
                                </div>

                                <!-- Items Preview -->
                                <div class="flex items-center gap-3">
                                    @foreach($order->items as $item)
                                        <div class="relative">
                                            <div class="h-20 w-20 rounded bg-gray-800 border border-gray-700 overflow-hidden flex-shrink-0">
                                               @php
                                $images = $item->product->image_url ?? [];
                                $imageUrl = '';
                                if (is_array($images) && count($images) > 0) {
                                    $imageUrl = $images[0];
                                    if (!str_starts_with($imageUrl, 'http')) {
                                        $imageUrl = asset('storage/' . $imageUrl);
                                    }
                                } else {
                                    $imageFile = 'https://via.placeholder.com/100';
                                }
                            @endphp
                                                @if($imageUrl)
                                                    <img src="{{ $imageUrl }}" alt="{{ $item->product->name ?? 'Product' }}" class="h-full w-full object-cover" onerror="this.style.display='none'">
                                                @endif
                                                <div class="h-full w-full bg-gray-700 flex items-center justify-center" @if($imageUrl) style="display:none;" @endif>
                                                    <i class="ri-image-add-line text-gray-500 text-lg"></i>
                                                </div>
                                            </div>
                                            @if($item->quantity > 1)
                                                <div class="absolute -top-2 -right-2 h-5 w-5 rounded-full bg-primary text-black text-xs flex items-center justify-center font-bold">
                                                    {{ $item->quantity }}
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Card Footer -->
                            <div class="bg-[#309983]/10 px-6 py-3 border-t border-gray-700 flex justify-between items-center">
                                <span class="text-sm text-gray-400">{{ $order->items->count() }} {{ $order->items->count() === 1 ? 'Item' : 'Items' }}</span>
                                <button class="text-white hover:text-primary text-sm font-medium transition">
                                    Buy Again
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-20">
                    <i class="ri-inbox-line text-gray-600 text-6xl mb-4 block"></i>
                    <h3 class="text-white text-xl font-semibold mb-2">No Orders Yet</h3>
                    <p class="text-gray-400 mb-6">You haven't placed any orders yet. Start shopping today!</p>
                    <a href="{{ route('user.product') }}" class="inline-block bg-primary text-black px-6 py-2 rounded-lg font-medium hover:bg-primary/90 transition">
                        Browse Products
                    </a>
                </div>
            @endif
        </div>
    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filterButtons = document.querySelectorAll('.filter-btn');
        const orderCards = document.querySelectorAll('.order-card');

        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                const filterValue = this.getAttribute('data-filter');

                // Update active button
                filterButtons.forEach(btn => {
                    btn.classList.remove('active', 'text-primary', 'border-b-2', 'border-primary');
                    btn.classList.add('text-gray-400', 'hover:text-white');
                });
                this.classList.add('active', 'text-primary', 'border-b-2', 'border-primary');
                this.classList.remove('text-gray-400', 'hover:text-white');

                // Filter orders
                orderCards.forEach(card => {
                    if (filterValue === 'all' || card.getAttribute('data-status') === filterValue) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });
    });
</script>
</body>
</html>