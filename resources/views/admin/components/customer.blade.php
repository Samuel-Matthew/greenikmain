<!-- CUSTOMER MANAGEMENT SECTION -->
<div x-show="currentTab === 'customers'" x-data="customerManager()" @customer-tab.window="init()" class="space-y-6">

    <div class="flex flex-col md:flex-row justify-between items-center">
        <h2 class="text-2xl font-bold text-white">Customer Base</h2>
        <!-- <button
            class="bg-greenik-600 hover:bg-greenik-500 text-black font-bold px-4 py-2 rounded text-sm transition flex items-center gap-2">
            <i class="fas fa-plus"></i> Add Customer
        </button> -->
    </div>

    <!-- Customer Metrics -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Total Customers -->
        <div class="bg-dark-card p-6 rounded-xl border border-dark-border flex items-center justify-between">
            <div>
                <p class="text-gray-400 text-sm">Total Customers</p>
                <h3 class="text-2xl font-bold text-white mt-1" x-text="metrics.total || '0'"></h3>
                <p class="text-xs text-greenik-500 mt-2"><i class="fas fa-arrow-up"></i> <span
                        x-text="'+' + metrics.newThisMonth + ' this month'"></span></p>
            </div>
            <div class="h-12 w-12 rounded-full bg-gray-800 flex items-center justify-center text-gray-400">
                <i class="fas fa-users text-lg"></i>
            </div>
        </div>

        <!-- Active/VIP -->
        <div class="bg-dark-card p-6 rounded-xl border border-dark-border flex items-center justify-between">
            <div>
                <p class="text-gray-400 text-sm">Active</p>
                <h3 class="text-2xl font-bold text-white mt-1" x-text="metrics.active || '0'"></h3>
                <p class="text-xs text-gray-500 mt-2">Placed order in last 30 days</p>
            </div>
            <div class="h-12 w-12 rounded-full bg-blue-900/30 flex items-center justify-center text-blue-400">
                <i class="fas fa-crown text-lg"></i>
            </div>
        </div>

        <!-- Blocked/Inactive -->
        <div class="bg-dark-card p-6 rounded-xl border border-dark-border flex items-center justify-between">
            <div>
                <p class="text-gray-400 text-sm">Blocked / Inactive</p>
                <h3 class="text-2xl font-bold text-white mt-1" x-text="metrics.blocked || '0'"></h3>
                <p class="text-xs text-red-500 mt-2">Requires attention</p>
            </div>
            <div class="h-12 w-12 rounded-full bg-red-900/30 flex items-center justify-center text-red-400">
                <i class="fas fa-user-slash text-lg"></i>
            </div>
        </div>
    </div>

    <!-- Filters & Search -->
    <div class="flex flex-col md:flex-row gap-4 bg-dark-card p-4 rounded-xl border border-dark-border">
        <div class="relative flex-1">
            <i class="fas fa-search absolute left-3 top-3 text-gray-500 text-xs"></i>
            <input x-model="search" type="text" placeholder="Search by name, email or phone..."
                class="w-full bg-dark-bg border border-dark-border text-sm rounded pl-8 pr-3 py-2 text-white focus:border-greenik-500 outline-none">
        </div>
        <div class="flex gap-3">
            <select x-model="filterStatus"
                class="bg-dark-bg border border-dark-border text-sm rounded px-3 py-2 text-white outline-none">
                <option value="All">All Status</option>
                <option value="Active">Active</option>
                <option value="Blocked">Blocked</option>
            </select>
            <select class="bg-dark-bg border border-dark-border text-sm rounded px-3 py-2 text-white outline-none">
                <option value="Newest">Newest First</option>
                <option value="Spent">Highest Spent</option>
                <option value="Orders">Most Orders</option>
            </select>
        </div>
    </div>

    <!-- Customers Table -->
    <div class="bg-dark-card rounded-xl border border-dark-border overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-800 text-gray-400 text-xs uppercase">
                <tr>
                    <th class="p-4">Customer</th>
                    <th class="p-4">Contact Info</th>
                    <th class="p-4">Orders</th>
                    <th class="p-4">Total Spent</th>
                    <th class="p-4">Last Active</th>
                    <th class="p-4">Status</th>
                    <th class="p-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-800 text-sm">
                <template x-for="customer in filteredCustomers" :key="customer.id">
                    <tr class="hover:bg-gray-800/50 transition duration-150 group">
                        <!-- Name & Avatar -->
                        <td class="p-4">
                            <div class="flex items-center gap-3">
                                <img :src="customer.avatar" class="w-10 h-10 rounded-full border border-dark-border">
                                <div>
                                    <p class="font-medium text-white" x-text="customer.name"></p>
                                    <!-- <span x-show="customer.vip"
                                        class="text-[10px] bg-yellow-900/40 text-yellow-500 border border-yellow-800 px-1.5 rounded">VIP</span> -->
                                </div>
                            </div>
                        </td>

                        <!-- Contact -->
                        <td class="p-4">
                            <div class="text-gray-300" x-text="customer.email"></div>
                            <!-- <div class="text-xs text-gray-500" x-text="customer.phone"></div> -->
                        </td>

                        <!-- Orders Count -->
                        <td class="p-4 text-gray-300" x-text="customer.orders + ' Orders'"></td>

                        <!-- Spent -->
                        <td class="p-4 font-bold text-greenik-500" x-text="customer.spent"></td>

                        <!-- Last Active -->
                        <td class="p-4 text-gray-400 text-xs" x-text="customer.lastActive"></td>

                        <!-- Status -->
                        <td class="p-4">
                            <span
                                :class="customer.status === 'Active' ? 'bg-green-900/30 text-green-400 border-green-900' : 'bg-red-900/30 text-red-400 border-red-900'"
                                class="px-2 py-1 rounded-full text-xs border" x-text="customer.status"></span>
                        </td>

                        <!-- Actions -->
                        <td class="p-4 text-right">
                            <button @click="viewCustomer(customer)"
                                class="text-gray-400 hover:text-white bg-gray-700 hover:bg-gray-600 px-3 py-1 rounded text-xs transition">
                                Profile
                            </button>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>

    <!-- CUSTOMER PROFILE MODAL -->
    <div x-show="activeCustomer" class="fixed inset-0 z-50 overflow-hidden" x-cloak>

        <div class="absolute inset-0 bg-black/70 backdrop-blur-sm" @click="activeCustomer = null"></div>

        <div class="absolute inset-y-0 right-0 max-w-2xl w-full bg-dark-card border-l border-dark-border shadow-2xl flex flex-col transform transition-transform duration-300"
            x-transition:enter="translate-x-full" x-transition:enter-end="translate-x-0"
            x-transition:leave="translate-x-0" x-transition:leave-end="translate-x-full">

            <!-- Modal Header -->
            <div class="flex items-center justify-between p-6 border-b border-dark-border bg-gray-900">
                <h3 class="text-xl font-bold text-white">Customer Profile</h3>
                <button @click="activeCustomer = null" class="text-gray-400 hover:text-white">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <div class="flex-1 overflow-y-auto" x-if="activeCustomer">

                <!-- Profile Header -->
                <div class="p-6 flex flex-col items-center border-b border-dark-border bg-dark-bg/50">
                    <img :src="activeCustomer.avatar"
                        class="w-24 h-24 rounded-full border-4 border-dark-card mb-4 shadow-lg">
                    <h2 class="text-2xl font-bold text-white" x-text="activeCustomer.name"></h2>
                    <p class="text-gray-400 mb-4" x-text="activeCustomer.email"></p>

                    <div class="flex gap-3 w-full max-w-sm">
                        <button
                            class="flex-1 bg-greenik-600 hover:bg-greenik-500 text-black font-bold py-2 rounded transition">
                            <i class="fas fa-envelope mr-2"></i> Email
                        </button>
                        <button @click="toggleBlock(activeCustomer)"
                            :class="activeCustomer.status === 'Active' ? 'bg-dark-card border border-dark-border text-gray-300 hover:text-red-500 hover:border-red-500' : 'bg-red-600 text-white border border-red-600'"
                            class="flex-1 py-2 rounded transition font-medium">
                            <i class="fas fa-ban mr-2"></i> <span
                                x-text="activeCustomer.status === 'Active' ? 'Block' : 'Unblock'"></span>
                        </button>
                    </div>
                </div>

                <!-- Details Grid -->
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Stats -->
                    <div class="bg-dark-bg p-4 rounded-lg border border-dark-border">
                        <h4 class="text-gray-500 text-xs uppercase mb-3 font-bold">Purchase Stats</h4>
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-gray-400">Total Spent</span>
                            <span class="text-greenik-500 font-bold text-lg" x-text="activeCustomer.spent"></span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-400">Total Orders</span>
                            <span class="text-white" x-text="activeCustomer.orders"></span>
                        </div>
                    </div>

                    <!-- Contact -->
                    <div class="bg-dark-bg p-4 rounded-lg border border-dark-border">
                        <h4 class="text-gray-500 text-xs uppercase mb-3 font-bold">Contact Details</h4>
                        <div class="space-y-2 text-sm">
                            <div class="flex gap-3">
                                <i class="fas fa-phone text-gray-500 mt-1"></i>
                                <span class="text-gray-300" x-text="activeCustomer.email"></span>
                            </div>
                            <div class="flex gap-3">
                                <i class="fas fa-map-marker-alt text-gray-500 mt-1"></i>
                                <span class="text-gray-300">12 Solar Blvd, Lekki Phase 1, Lagos, Nigeria</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity / Orders -->
                <div class="p-6 pt-0">
                    <h4 class="text-white font-bold mb-4 border-b border-dark-border pb-2">Recent Orders</h4>

                    <div class="space-y-3">
                        <!-- Mock Order History Loop -->
                        <div class="flex items-center justify-between bg-dark-bg p-3 rounded border border-dark-border">
                            <div class="flex items-center gap-3">
                                <div
                                    class="h-10 w-10 rounded bg-gray-800 flex items-center justify-center text-greenik-500">
                                    <i class="fas fa-box"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-white">#ORD-9921</p>
                                    <p class="text-xs text-gray-500">Nov 24, 2024</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-white font-medium">$1,200.00</p>
                                <span
                                    class="text-[10px] bg-green-900/30 text-green-400 px-2 py-0.5 rounded">Delivered</span>
                            </div>
                        </div>

                        <div class="flex items-center justify-between bg-dark-bg p-3 rounded border border-dark-border">
                            <div class="flex items-center gap-3">
                                <div
                                    class="h-10 w-10 rounded bg-gray-800 flex items-center justify-center text-gray-400">
                                    <i class="fas fa-box"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-white">#ORD-9850</p>
                                    <p class="text-xs text-gray-500">Oct 12, 2024</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-white font-medium">$450.00</p>
                                <span
                                    class="text-[10px] bg-green-900/30 text-green-400 px-2 py-0.5 rounded">Delivered</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- COMPONENT LOGIC -->
<script>
    function customerManager() {
        return {
            search: '',
            filterStatus: 'All',
            activeCustomer: null,
            customers: [],
            metrics: {
                total: 0,
                active: 0,
                newThisMonth: 0,
                blocked: 0
            },
            loading: true,
            error: null,

            async init() {
                try {
                    this.loading = true;
                    const response = await fetch('/admin/api/customers');

                    if (!response.ok) {
                        throw new Error('Failed to fetch customers');
                    }

                    const data = await response.json();
                    this.customers = data.customers || [];
                    this.metrics = data.metrics || {
                        total: 0,
                        active: 0,
                        newThisMonth: 0,
                        blocked: 0
                    };
                } catch (err) {
                    this.error = err.message;
                    console.error('Error fetching customers:', err);
                } finally {
                    this.loading = false;
                }
            },

            get filteredCustomers() {
                return this.customers.filter(c => {
                    const matchesSearch = c.name.toLowerCase().includes(this.search.toLowerCase()) ||
                        c.email.toLowerCase().includes(this.search.toLowerCase()) ||
                        (c.phone && c.phone.toLowerCase().includes(this.search.toLowerCase()));
                    const matchesStatus = this.filterStatus === 'All' || c.status === this.filterStatus;
                    return matchesSearch && matchesStatus;
                });
            },

            viewCustomer(customer) {
                this.activeCustomer = JSON.parse(JSON.stringify(customer));
            },

            toggleBlock(customer) {
                if (customer.status === 'Active') {
                    if (confirm('Are you sure you want to block this customer? They will not be able to place orders.')) {
                        customer.status = 'Blocked';
                        // Here you could add a fetch call to update the backend
                    }
                } else {
                    customer.status = 'Active';
                    // Here you could add a fetch call to update the backend
                }
            }
        }
    }
</script>