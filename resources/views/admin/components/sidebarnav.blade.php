<!-- 1. SIDEBAR NAVIGATION -->
<aside :class="sidebarOpen ? 'w-64' : 'w-20'"
    class="flex-shrink-0 flex flex-col border-r border-dark-border bg-dark-card transition-all duration-300 relative z-20">
    <!-- Brand -->
    <div class="h-16 flex items-center justify-center border-b border-dark-border">
        <h1 class="text-2xl font-bold italic text-greenik-500 tracking-wider">
            <i x-show="!sidebarOpen sidebarOpen" class="fas fa-leaf"></i>
            <span x-show="sidebarOpen">GREENIK</span>
        </h1>
    </div>

    <!-- Menu -->
    <nav class="flex-1 overflow-y-auto py-4 space-y-1">
        <!-- Helper to generate links -->
        <template x-for="item in [
                    {id: 'dashboard', icon: 'fa-chart-pie', label: 'Overview'},
                    {id: 'products', icon: 'fa-box-open', label: 'Products'},
                    {id: 'orders', icon: 'fa-shopping-cart', label: 'Orders'},
                    {id: 'customers', icon: 'fa-users', label: 'Customers'},
                    {id: 'inventory', icon: 'fa-warehouse', label: 'Inventory'},
                    {id: 'payments', icon: 'fa-credit-card', label: 'Transactions'},
                    {id: 'coupons', icon: 'fa-ticket-alt', label: 'Coupons'},
                    {id: 'reviews', icon: 'fa-star', label: 'Reviews'},
                    {id: 'cms', icon: 'fa-desktop', label: 'Website CMS'},
                    {id: 'users', icon: 'fa-user-shield', label: 'Admin Roles'},
                    {id: 'settings', icon: 'fa-cog', label: 'Settings'}

                   
                ]">
            <a href="#" @click.prevent="switchTab(item.id)"
                :class="currentTab === item.id ? 'bg-greenik-900/40 text-greenik-400 border-r-4 border-greenik-500' : 'text-gray-400 hover:bg-[#309983]/10 hover:text-white'"
                class="flex items-center px-6 py-3 transition-colors group">
                <i :class="['fas', item.icon, 'w-5 text-center']"></i>
                <span x-show="sidebarOpen" class="ml-3 text-sm font-medium" x-text="item.label"></span>
            </a>
        </template>
    </nav>

    <!-- User Info -->
    <div class="p-4 border-t border-dark-border">
        <div class="flex items-center gap-3">
            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->first_name . ' ' . auth()->user()->last_name) }}&background=00d284&color=000"
                class="w-9 h-9 rounded-full">
            <div x-show="sidebarOpen">
                <p class="text-sm font-semibold text-white">{{ auth()->user()->first_name ?? 'Admin' }}
                    {{ auth()->user()->last_name ?? 'User' }}</p>
                <p class="text-xs text-gray-500">{{ ucfirst(auth()->user()->role ?? 'admin') }}</p>
            </div>
        </div>


    </div>
</aside>