<header>
    <!-- nav -->
    <nav class="fixed top-0 left-0 right-0 z-50 nav-sticky">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center">
                    <h1 class="text-2xl font-display text-primary">GREENIK</h1>
                </div>
                <!-- Desktop links -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('index') }}"
                        class="text-gray-300 hover:text-primary transition-colors">Home</a>
                    <a href="{{ route('product') }}"
                        class="text-gray-300 hover:text-primary transition-colors">Products</a>
                    <a href="{{ route('solutions') }}"
                        class="text-gray-300 hover:text-primary transition-colors">Solutions</a>
                    <a href="{{ route('about') }}" class="text-gray-300 hover:text-primary transition-colors">About</a>
                    <a href="{{ route('contact') }}"
                        class="text-gray-300 hover:text-primary transition-colors">Contact</a>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <div class="w-8 h-8 p-3 flex items-center justify-center">
                            <i class="ri-search-line search z-1"></i>
                        </div>
                        <input type="text" placeholder="Search products..."
                            class="search-input absolute right-0 top-0 px-4 w-0 h-8 bg-gray-900 border border-gray-700 rounded-xl px-3 text-sm text-white placeholder-gray-400 focus:w-64 focus:outline-none focus:border-primary transition-all duration-300">
                    </div>
                    <div class="relative">
                        <div class="w-8 h-8 flex items-center justify-center">
                            <i
                                class="ri-shopping-cart-line text-gray-400 hover:text-primary cursor-pointer transition-colors"></i>
                        </div>
                        <span id="cart-count"
                            class="absolute -top-2 -right-2 bg-primary text-black text-xs rounded-full w-5 h-5 flex items-center justify-center font-medium">0</span>
                    </div>

                    <!-- Desktop styled login icon -->
                    <a href="{{ route('login') }}">
                        <div class="hidden md:flex items-center justify-center w-9 h-9 rounded-full border border-gray-700 text-gray-400 hover:bg-primary hover:text-black transition-colors cursor-pointer"
                            title="Login" aria-label="Login">
                            <i class="ri-login-box-line text-lg"></i>
                        </div>
                    </a>

                    <!-- Mobile hamburger -->
                    <button id="mobile-menu-button" aria-expanded="false" aria-label="Open menu"
                        class="md:hidden inline-flex items-center justify-center p-2 rounded-md text-gray-300 hover:text-primary hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-primary">
                        <i class="ri-menu-line text-2xl"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile dropdown menu -->
        <div id="mobile-menu"
            class="md:hidden hidden absolute top-full left-0 right-0 bg-black border-t border-gray-800 z-40">
            <div class="px-4 py-3 space-y-2">
                <a href="{{route('index')}}"
                    class="block text-gray-300 hover:text-primary px-3 py-2 rounded-md">Home</a>
                <a href="{{route('product')}}"
                    class="block text-gray-300 hover:text-primary px-3 py-2 rounded-md">Products</a>
                <a href="{{route('solutions')}}"
                    class="block text-gray-300 hover:text-primary px-3 py-2 rounded-md">Solutions</a>
                <a href="{{route('about')}}"
                    class="block text-gray-300 hover:text-primary px-3 py-2 rounded-md">About</a>
                <a href="{{route('contact')}}"
                    class="block text-gray-300 hover:text-primary px-3 py-2 rounded-md">Contact</a>
                <a href="{{ route('login') }}"
                    class="flex items-center gap-2 text-gray-300 hover:text-primary px-3 py-2 rounded-md"><i
                        class="ri-login-box-line"></i><span>Login</span></a>
            </div>
        </div>

    </nav>
</header>