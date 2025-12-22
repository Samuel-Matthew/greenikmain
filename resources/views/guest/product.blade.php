<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GREENIK - Products</title>
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

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- @if (Route::is('index'))
        @vite(['resources/js/search-functionality.js', 'resources/js/nav.js'])
    @endif -->
</head>

<body class="bg-black text-white font-sans overflow-x-hidden">
    @include('components.guestheader');


    <!-- Page Header -->
    <section class="pt-24 pb-8 bg-[#309983]/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-8">
                <nav class="text-sm text-gray-400 mb-4">
                    <a href="index.html" class="hover:text-primary">Home</a>
                    <span class="mx-2">/</span>
                    <span class="text-white">Products</span>
                </nav>
                <h1 class="text-5xl font-bold mb-4">Clean Energy Products</h1>
                <p class="text-xl text-gray-300 max-w-3xl mx-auto">Discover our comprehensive range of solar panels,
                    wind turbines, batteries, and accessories designed to power your sustainable future.</p>
            </div>
        </div>
    </section>

    <!-- Main Product Section -->
    <section class="py-8 bg-black min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-8">

                <!-- Sidebar Filters -->
                <div class="lg:w-1/4">
                    <div class="bg-[#309983]/10 rounded-xl p-6 sticky top-24">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-semibold">Filters</h3>
                            <button id="clear-filters" class="text-sm text-gray-400 hover:text-primary">Clear
                                All</button>
                        </div>
                        <!-- Price Range -->
                        <div class="mb-8">
                            <h4 class="font-medium mb-4">Price Range</h4>
                            <div class="space-y-4">
                                <input type="range" min="0" max="1000000" value="1000000" class="w-full price-range-slider"
                                    id="price-range">
                                <div class="flex justify-between text-sm text-gray-400">
                                    <span>₦0</span>
                                    <span id="price-value">500000</span>
                                    <span>₦1000000+</span>
                                </div>
                            </div>
                        </div>
                        <!-- Brands -->
                        <div class="mb-8">
                            <h4 class="font-medium mb-4">Brands</h4>
                            <div class="space-y-3">
                                @forelse($brands as $brand)
                                    <label class="flex items-center gap-3 cursor-pointer">
                                        <input type="checkbox" class="custom-checkbox" data-brand="{{ $brand }}">
                                        <span class="text-sm">{{ $brand }}</span>
                                    </label>
                                @empty
                                    <p class="text-sm text-gray-400">No brands available</p>
                                @endforelse
                            </div>
                        </div>
                        <!-- Rating -->
                        <div class="mb-8">
                            <h4 class="font-medium mb-4">Customer Rating</h4>
                            <div class="space-y-3">
                                <label class="flex items-center gap-3 cursor-pointer">
                                    <input type="checkbox" class="custom-checkbox" data-rating="4">
                                    <div class="flex items-center gap-2">
                                        <div class="flex star-rating">
                                            <i class="ri-star-fill text-sm"></i>
                                            <i class="ri-star-fill text-sm"></i>
                                            <i class="ri-star-fill text-sm"></i>
                                            <i class="ri-star-fill text-sm"></i>
                                            <i class="ri-star-line text-sm"></i>
                                        </div>
                                        <span class="text-sm text-gray-400">&amp; up</span>
                                    </div>
                                </label>
                                <label class="flex items-center gap-3 cursor-pointer">
                                    <input type="checkbox" class="custom-checkbox" data-rating="3">
                                    <div class="flex items-center gap-2">
                                        <div class="flex star-rating">
                                            <i class="ri-star-fill text-sm"></i>
                                            <i class="ri-star-fill text-sm"></i>
                                            <i class="ri-star-fill text-sm"></i>
                                            <i class="ri-star-line text-sm"></i>
                                            <i class="ri-star-line text-sm"></i>
                                        </div>
                                        <span class="text-sm text-gray-400">&amp; up</span>
                                    </div>
                                </label>
                            </div>
                        </div>
                        <!-- Power Capacity -->
                        <!-- <div class="mb-8">
                                <h4 class="font-medium mb-4">Power Capacity</h4>
                                <div class="space-y-3">
                                    <label class="flex items-center gap-3 cursor-pointer">
                                        <input type="checkbox" class="custom-checkbox" data-capacity="small">
                                        <span class="text-sm">Under 5kW</span>
                                    </label>
                                    <label class="flex items-center gap-3 cursor-pointer">
                                        <input type="checkbox" class="custom-checkbox" data-capacity="medium">
                                        <span class="text-sm">5kW - 15kW</span>
                                    </label>
                                    <label class="flex items-center gap-3 cursor-pointer">
                                        <input type="checkbox" class="custom-checkbox" data-capacity="large">
                                        <span class="text-sm">Over 15kW</span>
                                    </label>
                                </div>
                            </div> -->
                    </div>
                </div>

                <!-- Main Content -->
                <div class="lg:w-3/4">
                    <!-- Search and Category Filters -->
                    <div class="mb-8">
                        <div class="flex flex-col md:flex-row gap-4 mb-6">
                            <div class="flex-1 relative">
                                <input type="text" id="product-search"
                                    placeholder="Search products by name, model, or specifications..."
                                    class="w-full bg-[#309983]/10 bg-[#309983]/10 border border-[#309983]/10 rounded-lg px-4 py-3 pl-12 text-white placeholder-gray-400 focus:outline-none focus:border-primary">
                                <div
                                    class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 flex items-center justify-center">
                                    <i class="ri-search-line text-gray-400"></i>
                                </div>
                            </div>
                        </div>
                        <!-- Category Filters -->
                        <div class="flex flex-wrap gap-3 mb-6">
                            <a href="{{ route('product') }}"
                                class="category-filter px-4 py-2 rounded-lg text-sm font-medium whitespace-nowrap {{ !isset($selectedCategory) || !$selectedCategory ? 'filter-active bg-primary text-black' : 'bg-[#309983]/10 hover:bg-[#309983]/20' }}"
                                data-category="all">All Products</a>
                            <a href="{{ route('product', ['category' => 'solar']) }}"
                                class="category-filter px-4 py-2 rounded-lg text-sm font-medium bg-[#309983]/10 hover:bg-[#309983]/20 whitespace-nowrap {{ (isset($selectedCategory) && $selectedCategory === 'solar') ? 'filter-active bg-primary text-black' : '' }}"
                                data-category="solar">Solar Solutions</a>
                            <a href="{{ route('product', ['category' => 'wind']) }}"
                                class="category-filter px-4 py-2 rounded-lg text-sm font-medium bg-[#309983]/10 hover:bg-[#309983]/20 whitespace-nowrap {{ (isset($selectedCategory) && $selectedCategory === 'wind') ? 'filter-active bg-primary text-black' : '' }}"
                                data-category="wind">Wind Power</a>
                            <a href="{{ route('product', ['category' => 'ev']) }}"
                                class="category-filter px-4 py-2 rounded-lg text-sm font-medium bg-[#309983]/10 hover:bg-[#309983]/20 whitespace-nowrap {{ (isset($selectedCategory) && $selectedCategory === 'ev') ? 'filter-active bg-primary text-black' : '' }}"
                                data-category="ev">EV Chargers</a>
                            <a href="{{ route('product', ['category' => 'batteries']) }}"
                                class="category-filter px-4 py-2 rounded-lg text-sm font-medium bg-[#309983]/10 hover:bg-[#309983]/20 whitespace-nowrap {{ (isset($selectedCategory) && $selectedCategory === 'batteries') ? 'filter-active bg-primary text-black' : '' }}"
                                data-category="batteries">Batteries</a>
                            <a href="{{ route('product', ['category' => 'accessories']) }}"
                                class="category-filter px-4 py-2 rounded-lg text-sm font-medium bg-[#309983]/10 hover:bg-[#309983]/20 whitespace-nowrap {{ (isset($selectedCategory) && $selectedCategory === 'accessories') ? 'filter-active bg-primary text-black' : '' }}"
                                data-category="accessories">Accessories</a>
                        </div>
                        <!-- Sorting and View Options -->
                        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
                            <div class="flex items-center gap-4">
                                <span class="text-gray-400" id="results-count">Showing 1 of 6 products</span>
                            </div>
                            <div class="flex items-center gap-4">
                                <div class="flex items-center gap-2">
                                    <span class="text-sm text-gray-400">Sort by:</span>
                                    <select id="sort-select"
                                        class="bg-[#309983]/10 border border-gray-700 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:border-primary pr-8">
                                        <option value="popular">Most Popular</option>
                                        <option value="price-low">Price: Low to High</option>
                                        <option value="price-high">Price: High to Low</option>
                                        <option value="newest">Newest First</option>
                                        <option value="rating">Highest Rated</option>
                                    </select>
                                </div>
                                <div class="flex items-center gap-2 bg-[#309983]/10 rounded-lg p-1">
                                    <button id="grid-view" class="p-2 rounded bg-primary text-black">
                                        <div class="w-4 h-4 flex items-center justify-center">
                                            <i class="ri-grid-fill text-sm"></i>
                                        </div>
                                    </button>
                                    <button id="list-view" class="p-2 rounded text-gray-400 hover:text-white">
                                        <div class="w-4 h-4 flex items-center justify-center">
                                            <i class="ri-list-check text-sm"></i>
                                        </div>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- Product Grid -->
                        <div id="product-grid" class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 mb-8">
                            @forelse($products as $product)
                                                    @php
    $stock = isset($product->stock) ? (int) $product->stock : 0;
    $categoryName = $product->category->name ?? 'Product';
    $brand = $product->brand ?? 'Unknown Brand';
    $price = isset($product->price) ? number_format($product->price, 2) : '0.00';
    $img = 'https://via.placeholder.com/400x250?text=No+Image';
    if (!empty($product->image_url)) {
        if (is_array($product->image_url) && count($product->image_url)) {
            $img = asset('storage/' . str_replace('\\', '/', $product->image_url[0]));
        } elseif (is_string($product->image_url)) {
            $img = asset('storage/' . str_replace('\\', '/', $product->image_url));
        }
    }
                                                    @endphp
                                                    <div class="product-card bg-[#309983]/10 rounded-xl overflow-hidden card-hover"
                                                        data-category="{{ strtolower($categoryName) }}" data-price="{{ $product->price }}"
                                                        data-rating="4.5" data-brand="{{ $brand }}"
                                                        data-specs="{{ json_encode($product->specs ?? []) }}"
                                                        data-images="{{ json_encode(array_map(function ($img) {
        return asset('storage/' . str_replace('\\\\', '/', $img)); }, (array) ($product->image_url ?? []))) }}" data-product-id="{{ $product->id }}"
                                                        data-product-name="{{ $product->name }}"
                                                        data-product-desc="{{ $product->description }}">
                                                        <div class="relative">
                                                            <img src="{{ $img }}" alt="{{ $product->name }}"
                                                                class="w-full h-48 object-cover object-top">
                                                            @if($stock <= 0)
                                                                <div
                                                                    class="absolute top-3 left-3 bg-red-600 text-white px-2 py-1 rounded text-xs font-medium">
                                                                    Out of Stock</div>
                                                            @elseif($stock < 10)
                                                                <div
                                                                    class="absolute top-3 left-3 bg-yellow-600 text-white px-2 py-1 rounded text-xs font-medium">
                                                                    Low Stock</div>
                                                            @else
                                                                <div
                                                                    class="absolute top-3 left-3 bg-primary text-black px-2 py-1 rounded text-xs font-medium">
                                                                    In Stock</div>
                                                            @endif
                                                            <div class="absolute top-3 right-3">
                                                                <input type="checkbox" class="compare-checkbox opacity-0 absolute">
                                                                <div
                                                                    class="w-8 h-8 bg-black/50 rounded-full flex items-center justify-center cursor-pointer hover:bg-black/70">
                                                                    <i class="ri-add-line text-white text-sm"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="p-6">
                                                            <div class="flex items-center gap-2 mb-2">
                                                                <span
                                                                    class="bg-gray-800 text-primary px-2 py-1 rounded text-xs">{{ $categoryName }}</span>
                                                                <span class="text-gray-400 text-xs">{{ $brand }}</span>
                                                            </div>
                                                            <h3 class="text-lg font-semibold mb-2">{{ $product->name }}</h3>
                                                            <p class="text-gray-400 text-sm mb-4">{{ Str::limit($product->description, 100) }}
                                                            </p>
                                                            <div class="flex items-center gap-2 mb-4">
                                                                <div class="flex star-rating">
                                                                    <i class="ri-star-fill text-sm"></i>
                                                                    <i class="ri-star-fill text-sm"></i>
                                                                    <i class="ri-star-fill text-sm"></i>
                                                                    <i class="ri-star-fill text-sm"></i>
                                                                    <i class="ri-star-half-line text-sm"></i>
                                                                </div>
                                                                <span class="text-sm text-gray-400">4.5 (24 reviews)</span>
                                                            </div>
                                                            <div class="flex items-center justify-between mb-4">
                                                                <div>
                                                                    <span class="text-2xl font-bold text-primary">₦{{ $price }}</span>
                                                                </div>
                                                                <span class="text-sm text-gray-400">{{ $stock }} in stock</span>
                                                            </div>
                                                            <div class="flex gap-2">
                                                                <form action="{{ route('cart.add') }}" method="POST" class="flex-1" id="add-to-cart-form">
                                                                    @csrf
                                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                                    <input type="hidden" name="quantity" value="1">
                                                                    <button type="submit"
                                                                        class="w-full add-to-cart bg-primary text-black px-4 py-2 rounded-lg font-medium hover:bg-green-400 transition-colors whitespace-nowrap {{ $stock <= 0 ? 'opacity-50 cursor-not-allowed' : '' }}"
                                                                        {{ $stock <= 0 ? 'disabled' : '' }}>Add to Cart
                                                                    </button>
                                                                </form>
                                                                <button
                                                                    class="quick-view px-4 py-2 border border-gray-700 rounded-lg hover:border-primary transition-colors whitespace-nowrap">
                                                                    <div class="w-5 h-5 flex items-center justify-center">
                                                                        <i class="ri-eye-line"></i>
                                                                    </div>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                            @empty
                                <div class="col-span-3 text-center py-12">
                                    <p class="text-gray-400 text-lg">No products available at this time.</p>
                                </div>
                            @endforelse
                        </div>
                        <!-- Pagination -->
                        <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                            <div class="flex items-center gap-2">
                                <button
                                    class="px-4 py-2 border border-gray-700 rounded-lg hover:border-primary transition-colors whitespace-nowrap">Previous</button>
                                <div class="flex items-center gap-1">
                                    <button class="w-10 h-10 bg-primary text-black rounded-lg font-medium">1</button>
                                    <button class="w-10 h-10 bg-gray-800 hover:bg-gray-700 rounded-lg">2</button>
                                    <button class="w-10 h-10 bg-gray-800 hover:bg-gray-700 rounded-lg">3</button>
                                    <span class="px-2 text-gray-400">...</span>
                                    <button class="w-10 h-10 bg-gray-800 hover:bg-gray-700 rounded-lg">12</button>
                                </div>
                                <button
                                    class="px-4 py-2 border border-gray-700 rounded-lg hover:border-primary transition-colors whitespace-nowrap">Next</button>
                            </div>
                            <button id="back-to-top"
                                class="px-4 py-2 bg-primary rounded-lg transition-colors whitespace-nowrap">
                                <div class="flex items-center gap-2">
                                    <i class="ri-arrow-up-line"></i>
                                    <span>Back to Top</span>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Comparison Bar -->
    <!-- <div id="comparison-bar"
            class="fixed bottom-0 left-0 right-0 bg-gray-900 border-t border-gray-700 p-4 comparison-bar z-40">
            <div class="max-w-7xl mx-auto flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <span class="text-sm font-medium">Compare Products (<span id="compare-count">0</span>)</span>
                    <div id="compare-items" class="flex items-center gap-2"></div>
                </div>
                <div class="flex items-center gap-3">
                    <button id="clear-comparison" class="text-sm text-gray-400 hover:text-white">Clear All</button>
                    <button id="compare-products"
                        class="bg-primary text-black px-6 py-2 !rounded-lg font-medium hover:bg-green-400 transition-colors whitespace-nowrap">Compare
                        Products</button>
                </div>
            </div>
        </div> -->
    <!-- Footer -->
    @include('components.footer')



    <!-- Quick View Modal -->
    <div id="quick-view-modal"
        class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden items-center justify-center p-4">
        <div class="bg-gray-900 rounded-xl max-w-6xl w-full max-h-[90vh] overflow-y-auto">
            <div class=" bg-gray-900 border-b border-gray-800 p-6 flex items-center justify-between">
                <h2 class="text-2xl font-bold" id="modal-product-title">Product Details</h2>
                <button id="close-modal"
                    class="w-10 h-10 flex items-center justify-center hover:bg-gray-800 rounded-lg transition-colors">
                    <i class="ri-close-line text-xl"></i>
                </button>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Product Images -->
                    <div class="space-y-4">
                        <div class="relative">
                            <img id="modal-main-image" src="" alt=""
                                class="w-full h-96 object-cover object-top rounded-xl">
                            <div class="absolute top-4 left-4" id="modal-badges"></div>
                        </div>
                        <div class="grid grid-cols-4 gap-2">
                            <img class="modal-thumb w-full h-20 object-cover object-top rounded cursor-pointer border-2 border-transparent hover:border-primary transition-colors"
                                src="" alt="">
                            <img class="modal-thumb w-full h-20 object-cover object-top rounded cursor-pointer border-2 border-transparent hover:border-primary transition-colors"
                                src="" alt="">
                            <img class="modal-thumb w-full h-20 object-cover object-top rounded cursor-pointer border-2 border-transparent hover:border-primary transition-colors"
                                src="" alt="">
                            <img class="modal-thumb w-full h-20 object-cover object-top rounded cursor-pointer border-2 border-transparent hover:border-primary transition-colors"
                                src="" alt="">
                        </div>
                    </div>
                    <!-- Product Info -->
                    <div class="space-y-6">
                        <div>
                            <div class="flex items-center gap-2 mb-2">
                                <span id="modal-category"
                                    class="bg-gray-800 text-primary px-2 py-1 rounded text-xs"></span>
                                <span id="modal-brand" class="text-gray-400 text-xs"></span>
                            </div>
                            <h3 id="modal-product-name" class="text-2xl font-bold mb-2"></h3>
                            <div class="flex items-center gap-2 mb-4">
                                <div id="modal-rating" class="flex star-rating"></div>
                                <span id="modal-rating-text" class="text-sm text-gray-400"></span>
                            </div>
                            <div class="flex items-center gap-4 mb-4">
                                <span id="modal-price" class="text-3xl font-bold text-primary"></span>
                                <span id="modal-capacity" class="text-sm text-gray-400"></span>
                            </div>
                            <div class="flex items-center gap-2 mb-4">
                                <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                                <span class="text-sm text-green-400">In Stock - Ships within 2-3 business days</span>
                            </div>
                        </div>
                        <div>
                            <h4 class="font-semibold mb-3">Description</h4>
                            <p id="modal-description" class="text-gray-300 leading-relaxed"></p>
                        </div>
                        <div>
                            <h4 class="font-semibold mb-3">Key Specifications</h4>
                            <div id="modal-specs" class="grid grid-cols-2 gap-4 text-sm">
                                <!-- Specs will be populated dynamically from product data -->
                            </div>
                        </div>
                        <div>
                            <h4 class="font-semibold mb-3">Shipping Information</h4>
                            <div class="space-y-2 text-sm text-gray-300">
                                <div class="flex items-center gap-2">
                                    <i class="ri-truck-line text-primary"></i>
                                    <span>Free shipping on orders over ₦50000</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <i class="ri-time-line text-primary"></i>
                                    <span>Standard delivery: 5-7 business days</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <i class="ri-shield-check-line text-primary"></i>
                                    <span>White glove delivery available</span>
                                </div>
                            </div>
                        </div>
                        <div class="flex gap-3">
                            <button id="modal-add-cart"
                                class="flex-1 bg-primary text-black px-6 py-3 !rounded-lg font-medium hover:bg-green-400 transition-colors whitespace-nowrap">Add
                                to Cart</button>
                            <button
                                class="px-6 py-3 border border-gray-700 rounded-lg hover:border-primary transition-colors whitespace-nowrap">Buy
                                now</button>
                        </div>
                    </div>
                </div>
                <!-- Customer Reviews Section -->
                <div class="border-t border-gray-800 pt-6 mt-8">
                    <h4 class="font-semibold mb-4">Customer Reviews</h4>
                    <div class="space-y-4">
                        <div class="bg-gray-800 rounded-xl p-4">
                            <div class="flex items-center justify-between mb-2">
                                <div class="flex items-center gap-2">
                                    <div
                                        class="w-8 h-8 bg-primary rounded-full flex items-center justify-center text-black font-medium text-sm">
                                        JD</div>
                                    <span class="font-medium">John Davidson</span>
                                </div>
                                <div class="flex star-rating">
                                    <i class="ri-star-fill text-sm"></i>
                                    <i class="ri-star-fill text-sm"></i>
                                    <i class="ri-star-fill text-sm"></i>
                                    <i class="ri-star-fill text-sm"></i>
                                    <i class="ri-star-fill text-sm"></i>
                                </div>
                            </div>
                            <p class="text-gray-300 text-sm">Excellent solar kit! Installation was straightforward and
                                the performance exceeds expectations. Great value for the price.</p>
                            <div class="text-xs text-gray-400 mt-2">Verified Purchase • 2 months ago</div>
                        </div>
                        <div class="bg-gray-800 rounded-xl p-4">
                            <div class="flex items-center justify-between mb-2">
                                <div class="flex items-center gap-2">
                                    <div
                                        class="w-8 h-8 bg-primary rounded-full flex items-center justify-center text-black font-medium text-sm">
                                        SM</div>
                                    <span class="font-medium">Sarah Mitchell</span>
                                </div>
                                <div class="flex star-rating">
                                    <i class="ri-star-fill text-sm"></i>
                                    <i class="ri-star-fill text-sm"></i>
                                    <i class="ri-star-fill text-sm"></i>
                                    <i class="ri-star-fill text-sm"></i>
                                    <i class="ri-star-line text-sm"></i>
                                </div>
                            </div>
                            <p class="text-gray-300 text-sm">High quality components and detailed instructions. Customer
                                service was very helpful during the installation process.</p>
                            <div class="text-xs text-gray-400 mt-2">Verified Purchase • 1 month ago</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- <script src="js/product.js"></script>
    <script src="js/search-functionality.js"></script>
    <script src="js/nav.js"></script> -->

    <!-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Prevent page refresh on add to cart
            const addToCartForms = document.querySelectorAll('#add-to-cart-form');
            
            addToCartForms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    const formData = new FormData(this);
                    
                    fetch(this.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Handle success response
                        console.log('Added to cart:', data);
                        // You can show a success message here if needed
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
                });
            });
        });
    </script> -->
    
</body>

</html>