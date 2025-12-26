<!DOCTYPE html>
<html lang="en" class="dark">

@php
// Ensure categories variable is available
if (!isset($categories)) {
    $categories = \App\Models\ProductCategory::all();
}
@endphp

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Greenik | Admin Portal</title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <!-- Tailwind CSS -->
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Alpine.js for interactions -->
    <!-- <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script> -->

    @vite(['resources/css/app.css', 'resources/js/app.js'])



    <style>
        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #0a0a0a;
        }

        ::-webkit-scrollbar-thumb {
            background: #333;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #00d284;
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
</head>


<body class="bg-dark-bg text-gray-300 font-sans antialiased" x-data="dashboardData()" x-init="init()" x-cloak>
<!-- js -->
    <script>
        function dashboardData() {
            return {
                // ========== CORE STATE ==========
                currentTab: localStorage.getItem('admin_tab') ?? 'dashboard',
                sidebarOpen: true,
                modalOpen: false,
                editingProduct: null,
                activeTxn: null,
                isLoading: false,

                // ========== SEARCH & FILTER STATE ==========
                search: '',
                filterGateway: 'All',
                filterStatus: 'All',
                currentPage: 1,
                itemsPerPage: 15,
                orderSearch: '',
                orderStatusFilter: 'all',
                orderCurrentPage: 1,
                orderItemsPerPage: 15,

                // ========== DATA COLLECTIONS ==========
                products: @json($products),
                orders: @json($orders),
                transactions: @json($transactions->items()),
                categories: @json($categories),

                // ========== DASHBOARD METRICS (INITIALIZED FROM BLADE) ==========
                totalSales: {{ $totalSales }},
                totalOrders: {{ $totalOrders }},
                totalCustomers: {{ $totalCustomers }},
                totalProducts: {{ $totalProducts }},
                pendingOrders: {{ $pendingOrders }},
                newCustomers: {{ $newCustomers }},
                salesGrowth: {{ $salesGrowth }},
                successRate: {{ $successRate }},

                // ========== FORM DATA ==========
                formData: {
                    name: '',
                    category_id: '',
                    brand: '',
                    description: '',
                    price: '',
                    stock: '',
                    sku: '',
                    meta_title: '',
                    meta_description: '',
                    image_url: []
                },

                // ========== COMPUTED GETTERS ==========
                get allFilteredTransactions() {
                    return this.transactions.filter(txn => {
                        const matchSearch = txn.reference?.toLowerCase().includes(this.search.toLowerCase()) ||
                            txn.id.toString().includes(this.search);
                        const matchGateway = this.filterGateway === 'All' || txn.payment_method === this.filterGateway;
                        const matchStatus = this.filterStatus === 'All' || txn.status === this.filterStatus;
                        return matchSearch && matchGateway && matchStatus;
                    });
                },

                get filteredTransactions() {
                    const start = (this.currentPage - 1) * this.itemsPerPage;
                    const end = start + this.itemsPerPage;
                    return this.allFilteredTransactions.slice(start, end);
                },

                get totalPages() {
                    return Math.ceil(this.allFilteredTransactions.length / this.itemsPerPage);
                },

                get allFilteredOrders() {
                    return this.orders.filter(order => {
                        const matchSearch = order.order_number?.toLowerCase().includes(this.orderSearch.toLowerCase()) ||
                            order.id.toString().includes(this.orderSearch);
                        const matchStatus = this.orderStatusFilter === 'all' || order.status?.toLowerCase() === this.orderStatusFilter;
                        return matchSearch && matchStatus;
                    });
                },

                get filteredOrders() {
                    const start = (this.orderCurrentPage - 1) * this.orderItemsPerPage;
                    const end = start + this.orderItemsPerPage;
                    return this.allFilteredOrders.slice(start, end);
                },

                get orderTotalPages() {
                    return Math.ceil(this.allFilteredOrders.length / this.orderItemsPerPage);
                },

                // ========== ICON & STYLING METHODS ==========
                getGatewayIcon(gateway) {
                    const icons = {
                        'paystack': 'fab fa-cc-paypal',
                        'flutterwave': 'fab fa-cc-visa',
                        'stripe': 'fab fa-cc-stripe',
                        'bank_transfer': 'fas fa-university'
                    };
                    return icons[gateway?.toLowerCase()] || 'fas fa-wallet';
                },

                getStatusIcon(status) {
                    const icons = {
                        'success': 'fas fa-check-circle',
                        'pending': 'fas fa-clock',
                        'failed': 'fas fa-times-circle',
                        'refunded': 'fas fa-undo'
                    };
                    return icons[status?.toLowerCase()] || 'fas fa-circle';
                },

                getStatusBadge(status) {
                    const badges = {
                        'success': 'bg-green-900/30 border-green-600 text-green-400',
                        'pending': 'bg-yellow-900/30 border-yellow-600 text-yellow-400',
                        'failed': 'bg-red-900/30 border-red-600 text-red-400',
                        'refunded': 'bg-blue-900/30 border-blue-600 text-blue-400'
                    };
                    return badges[status?.toLowerCase()] || 'bg-gray-900/30 border-gray-600 text-gray-400';
                },

                getOrderStatusColor(status) {
                    const colors = {
                        'processing': 'bg-blue-900/30 text-blue-400 border-blue-900',
                        'paid': 'bg-green-900/30 text-green-400 border-green-900',
                        'shipped': 'bg-purple-900/30 text-purple-400 border-purple-900',
                        'delivered': 'bg-green-900/30 text-green-400 border-green-900',
                        'cancelled': 'bg-red-900/30 text-red-400 border-red-900'
                    };
                    return colors[status?.toLowerCase()] || 'bg-gray-800 text-gray-400';
                },

                getPaymentIcon(method) {
                    const icons = {
                        'paystack': 'fas fa-layer-group text-blue-300',
                        'stripe': 'fab fa-cc-stripe text-blue-400',
                        'paypal': 'fab fa-paypal text-blue-600',
                        'cod': 'fas fa-money-bill-wave text-green-400'
                    };
                    return icons[method?.toLowerCase()] || 'fas fa-credit-card';
                },

                // ========== TRANSACTION MODAL ==========
                viewReceipt(txn) {
                    this.activeTxn = txn;
                },

                // ========== PRODUCT FORM ==========
                loadProductEdit(product) {
                    this.editingProduct = product;
                    this.formData = {
                        name: product.name,
                        category_id: product.category_id,
                        brand: product.brand || '',
                        description: product.description,
                        price: product.price,
                        stock: product.stock,
                        sku: product.sku || '',
                        meta_title: product.meta_title || '',
                        meta_description: product.meta_description || '',
                        image_url: product.image_url || []
                    };
                    this.modalOpen = true;
                },

                resetForm() {
                    this.editingProduct = null;
                    this.formData = {
                        name: '',
                        category_id: '',
                        brand: '',
                        description: '',
                        price: '',
                        stock: '',
                        sku: '',
                        meta_title: '',
                        meta_description: '',
                        image_url: []
                    };
                },

                // ========== SPA TAB SWITCHING ==========
                switchTab(tab) {
                    this.currentTab = tab;
                    localStorage.setItem('admin_tab', tab);
                    if (tab === 'customers') {
                        // Dispatch event to customer component
                        setTimeout(() => {
                            window.dispatchEvent(new CustomEvent('customer-tab'));
                        }, 0);
                    }
                    if (tab === 'inventory') {
                        // Dispatch event to inventory component
                        setTimeout(() => {
                            window.dispatchEvent(new CustomEvent('inventory-tab'));
                        }, 0);
                    }
                    this.loadTabData(tab);
                },

                // ========== DYNAMIC DATA LOADING ==========
                async loadTabData(tab) {
                    this.isLoading = true;
                    try {
                        switch (tab) {
                            case 'dashboard':
                                await this.fetchDashboardData();
                                break;
                            case 'products':
                                await this.fetchProductsData();
                                break;
                            case 'orders':
                                await this.fetchOrdersData();
                                break;
                            case 'payments':
                                await this.fetchTransactionsData();
                                break;
                            case 'customers':
                                // The customers component handles its own data loading
                                // via the init() method when the customer-tab event is fired
                                break;
                            case 'inventory':
                                // The inventory component handles its own data loading
                                // via the init() method when the inventory-tab event is fired
                                break;
                        }
                    } catch (error) {
                        console.error('Error loading tab data:', error);
                    } finally {
                        this.isLoading = false;
                    }
                },

                async fetchDashboardData() {
                    try {
                        const response = await fetch('/admin/api/dashboard', {
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            }
                        });
                        const data = await response.json();
                        this.totalSales = data.totalSales;
                        this.totalOrders = data.totalOrders;
                        this.totalCustomers = data.totalCustomers;
                        this.totalProducts = data.totalProducts;
                        this.pendingOrders = data.pendingOrders;
                        this.newCustomers = data.newCustomers;
                        this.salesGrowth = data.salesGrowth;
                        this.products = data.products;
                    } catch (error) {
                        console.error('Dashboard fetch error:', error);
                    }
                },

                async fetchProductsData() {
                    try {
                        const response = await fetch('/admin/api/products', {
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            }
                        });
                        this.products = await response.json();
                    } catch (error) {
                        console.error('Products fetch error:', error);
                    }
                },

                async fetchOrdersData() {
                    try {
                        const response = await fetch('/admin/api/orders', {
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            }
                        });
                        this.orders = await response.json();
                    } catch (error) {
                        console.error('Orders fetch error:', error);
                    }
                },

                async fetchTransactionsData() {
                    try {
                        const response = await fetch('/admin/api/transactions', {
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            }
                        });
                        const data = await response.json();
                        this.transactions = data.transactions;
                        this.successRate = data.successRate;
                    } catch (error) {
                        console.error('Transactions fetch error:', error);
                    }
                },

                // ========== INITIALIZATION ==========
                init() {
                    // Only fetch if not on dashboard (dashboard already has initial data)
                    if (this.currentTab !== 'dashboard') {
                        this.loadTabData(this.currentTab);
                        if (this.currentTab === 'customers') {
                            // Dispatch event to customer component
                            setTimeout(() => {
                                window.dispatchEvent(new CustomEvent('customer-tab'));
                            }, 100);
                        }
                        if (this.currentTab === 'inventory') {
                            // Dispatch event to inventory component
                            setTimeout(() => {
                                window.dispatchEvent(new CustomEvent('inventory-tab'));
                            }, 100);
                        }
                    }
                }
            }
        }
    </script>

    <div class="flex h-screen overflow-hidden">

        <!--  SIDEBAR NAVIGATION -->
        @include('admin.components.sidebarnav')


        <!-- MAIN CONTENT WRAPPER -->
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden">

            <!-- TOP HEADER -->
            @include('admin.components.header')


            <!-- DYNAMIC CONTENT AREA -->
            <main class="flex-1 overflow-y-auto p-6">

                <!-- Success Message -->
                @if(session('success'))
                    <div class="mb-6 p-4 bg-green-900/30 border border-green-600 rounded-lg text-green-300 flex items-center justify-between"
                        x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-check-circle"></i>
                            <span>{{ session('success') }}</span>
                        </div>
                        <button @click="show = false" class="text-green-300 hover:text-green-100">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                @endif

                <!--  DASHBOARD OVERVIEW -->
                <div x-show="currentTab === 'dashboard'" class="space-y-6">
                    <h2 class="text-2xl font-bold text-white mb-6">Dashboard Overview</h2>

                    <!-- Stats Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <!-- Card 1 -->
                        <div
                            class="bg-dark-card p-6 rounded-xl border border-dark-border flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-400">Total Sales</p>
                                <p class="text-2xl font-bold text-white mt-1">₦<span
                                        x-text="totalSales?.toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2})"></span>
                                </p>
                                <p class="text-xs mt-2" :class="salesGrowth >= 0 ? 'text-greenik-500' : 'text-red-500'">
                                    <i :class="salesGrowth >= 0 ? 'fas fa-arrow-up' : 'fas fa-arrow-down'"></i>
                                    <span
                                        x-text="salesGrowth >= 0 ? '+' + salesGrowth + '%' : salesGrowth + '%'"></span>
                                    vs last week
                                </p>
                            </div>
                            <div class="p-3 bg-greenik-900/50 rounded-lg text-greenik-500">
                                <i class="fas fa-dollar-sign text-xl"></i>
                            </div>
                        </div>
                        <!-- Card 2 -->
                        <div
                            class="bg-dark-card p-6 rounded-xl border border-dark-border flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-400">Total Orders</p>
                                <p class="text-2xl font-bold text-white mt-1" x-text="totalOrders"></p>
                                <p class="text-xs text-yellow-500 mt-2"><i class="fas fa-clock"></i>
                                    <span x-text="pendingOrders"></span> Processing
                                </p>
                            </div>
                            <div class="p-3 bg-blue-900/30 rounded-lg text-blue-500">
                                <i class="fas fa-shopping-bag text-xl"></i>
                            </div>
                        </div>
                        <!-- Card 3 -->
                        <div
                            class="bg-dark-card p-6 rounded-xl border border-dark-border flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-400">Customers</p>
                                <p class="text-2xl font-bold text-white mt-1" x-text="totalCustomers"></p>
                                <p class="text-xs text-greenik-500 mt-2"><i class="fas fa-user-plus"></i>
                                    <span x-text="'+' + newCustomers"></span> this week
                                </p>
                            </div>
                            <div class="p-3 bg-purple-900/30 rounded-lg text-purple-500">
                                <i class="fas fa-users text-xl"></i>
                            </div>
                        </div>
                        <!-- Card 4 -->
                        <div
                            class="bg-dark-card p-6 rounded-xl border border-dark-border flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-400">Products</p>
                                <p class="text-2xl font-bold text-white mt-1" x-text="totalProducts"></p>
                                <p class="text-xs text-greenik-500 mt-2"><i class="fas fa-check-circle"></i> All active
                                </p>
                            </div>
                            <div class="p-3 bg-orange-900/30 rounded-lg text-orange-500">
                                <i class="fas fa-box text-xl"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Charts & Lists -->
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <!-- Revenue Chart (Simulated) -->
                        <div class="lg:col-span-2 bg-dark-card p-6 rounded-xl border border-dark-border">
                            <div class="flex justify-between items-center mb-6">
                                <h3 class="font-bold text-white">Revenue Report</h3>
                                <select
                                    class="bg-dark-bg border border-dark-border text-xs rounded px-2 py-1 outline-none">
                                    <option>Last 7 Days</option>
                                    <option>Last Month</option>
                                </select>
                            </div>
                            <!-- CSS Bar Chart -->
                            <div class="flex items-end space-x-4 h-64 pb-2 border-b border-gray-700">
                                <div class="w-full bg-greenik-600/20 rounded-t hover:bg-greenik-600 transition-all relative group"
                                    style="height: 40%">
                                    <span
                                        class="hidden group-hover:block absolute -top-8 left-1/2 -translate-x-1/2 bg-white text-black text-xs p-1 rounded">$4k</span>
                                </div>
                                <div class="w-full bg-greenik-600/20 rounded-t hover:bg-greenik-600 transition-all relative group"
                                    style="height: 65%"></div>
                                <div class="w-full bg-greenik-600 rounded-t shadow-[0_0_15px_rgba(0,210,132,0.5)] relative group"
                                    style="height: 85%">
                                    <span
                                        class="hidden group-hover:block absolute -top-8 left-1/2 -translate-x-1/2 bg-white text-black text-xs p-1 rounded">$12k</span>
                                </div>
                                <div class="w-full bg-greenik-600/20 rounded-t hover:bg-greenik-600 transition-all"
                                    style="height: 50%"></div>
                                <div class="w-full bg-greenik-600/20 rounded-t hover:bg-greenik-600 transition-all"
                                    style="height: 60%"></div>
                                <div class="w-full bg-greenik-600/20 rounded-t hover:bg-greenik-600 transition-all"
                                    style="height: 75%"></div>
                                <div class="w-full bg-greenik-600/20 rounded-t hover:bg-greenik-600 transition-all"
                                    style="height: 45%"></div>
                            </div>
                            <div class="flex justify-between text-xs text-gray-500 mt-2">
                                <span>Mon</span><span>Tue</span><span>Wed</span><span>Thu</span><span>Fri</span><span>Sat</span><span>Sun</span>
                            </div>
                        </div>

                        <!-- Popular Products -->
                        <div class="bg-dark-card p-6 rounded-xl border border-dark-border">
                            <h3 class="font-bold text-white mb-4">Recent Products</h3>
                            <div class="space-y-4">
                                <template x-for="product in products.slice(0, 3)" :key="product.id">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded bg-gray-700 overflow-hidden">
                                            <img :src="product.image_url && Array.isArray(product.image_url) && product.image_url.length > 0 
                                                ? '/storage/' + product.image_url[0]
                                                : 'https://via.placeholder.com/40?text=No+Image'" :alt="product.name"
                                                class="w-full h-full object-cover">
                                        </div>
                                        <div class="flex-1">
                                            <p class="text-sm font-medium text-white" x-text="product.name"></p>
                                            <p class="text-xs text-gray-500"
                                                x-text="product.category?.name || 'Uncategorized'"></p>
                                        </div>
                                        <p class="text-sm font-bold text-greenik-500">
                                            ₦<span
                                                x-text="product.price?.toLocaleString('en-US', {minimumFractionDigits: 2})"></span>
                                        </p>
                                    </div>
                                </template>
                                <template x-if="products.length === 0">
                                    <div class="text-center py-6">
                                        <p class="text-gray-400 text-sm">No products added yet</p>
                                    </div>
                                </template>
                            </div>
                            <button @click="switchTab('products')"
                                class="w-full mt-6 py-2 border border-gray-600 rounded text-sm hover:bg-gray-800 transition">View
                                All Products</button>
                        </div>
                    </div>
                </div>

                <!--  PRODUCT MANAGEMENT -->
                @include('admin.components.product-management')


                <!-- ORDER MANAGEMENT -->
                @include('admin.components.order-management', ['orders' => $orders])


                <!--  CMS / WEBSITE CONTENT -->
                @include('admin.components.cms')

                <!--  Transactions -->
                @include('admin.components.transactions')


                <!--  SETTINGS -->
                @include('admin.components.settings')


                <!-- PLACEHOLDER FOR OTHER TABS -->
                @include('admin.components.placeholder')

                <!-- CUSTOMERS-->
                @include('admin.components.customer')

                <!-- INVENTORY-->
                @include('admin.components.inventory')


            </main>
        </div>
    </div>

    <!-- MODAL: ADD PRODUCT -->
    @include('admin.components.add-product-modal', ['categories' => $categories])

    <!-- MODAL: EDIT PRODUCT -->
    @include('admin.components.edit-product-modal', ['categories' => $categories])


</body>

</html>