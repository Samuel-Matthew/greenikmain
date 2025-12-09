<div x-show="currentTab === 'inventory'" x-data="inventoryManager()" @inventory-tab.window="init()" class="space-y-6">

    <div class="flex flex-col md:flex-row justify-between items-center">
        <h2 class="text-2xl font-bold text-white">Inventory Management</h2>
        <div class="flex gap-3">
            <button
                class="bg-dark-card hover:bg-gray-800 text-white border border-dark-border px-4 py-2 rounded text-sm transition">
                <i class="fas fa-file-download mr-2"></i> Stock Report
            </button>
            <!-- <button
                class="bg-greenik-600 hover:bg-greenik-500 text-black font-bold px-4 py-2 rounded text-sm transition">
                <i class="fas fa-plus mr-2"></i> Receive Stock
            </button> -->
        </div>
    </div>

    <!-- Inventory KPIs -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <!-- Total Items -->
        <div class="bg-dark-card p-6 rounded-xl border border-dark-border">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-400 text-xs uppercase font-bold">Total Products</p>
                    <h3 class="text-2xl font-bold text-white mt-1" x-text="metrics.totalProducts || '0'"></h3>
                </div>
                <i class="fas fa-boxes text-gray-600 text-xl"></i>
            </div>
            <div class="mt-4 h-1 w-full bg-gray-800 rounded overflow-hidden">
                <div class="h-full bg-blue-500 w-3/4"></div>
            </div>
        </div>

        <!-- Inventory Value -->
        <div class="bg-dark-card p-6 rounded-xl border border-dark-border">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-400 text-xs uppercase font-bold">Total Value</p>
                    <h3 class="text-2xl font-bold text-greenik-500 mt-1">₦<span
                            x-text="formatCurrency(metrics.totalValue || 0)"></span></h3>
                </div>
                <i class="fas fa-dollar-sign text-gray-600 text-xl"></i>
            </div>
            <div class="mt-4 text-xs text-gray-400">
                <i class="fas fa-arrow-up text-greenik-500"></i> Inventory holdings
            </div>
        </div>

        <!-- Low Stock Alert -->
        <div class="bg-dark-card p-6 rounded-xl border border-dark-border relative overflow-hidden">
            <div class="absolute right-0 top-0 w-16 h-16 bg-red-500/10 rounded-bl-full -mr-8 -mt-8"></div>
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-400 text-xs uppercase font-bold text-red-400">Low Stock</p>
                    <h3 class="text-2xl font-bold text-white mt-1" x-text="metrics.lowStock || '0'"></h3>
                </div>
                <i class="fas fa-exclamation-triangle text-red-500 text-xl"></i>
            </div>
            <p class="mt-4 text-xs text-red-400 font-medium">Restock needed immediately</p>
        </div>

        <!-- Out of Stock -->
        <div class="bg-dark-card p-6 rounded-xl border border-dark-border">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-400 text-xs uppercase font-bold">Out of Stock</p>
                    <h3 class="text-2xl font-bold text-white mt-1" x-text="metrics.outOfStock || '0'"></h3>
                </div>
                <i class="fas fa-ban text-gray-600 text-xl"></i>
            </div>
            <div class="mt-4 text-xs text-gray-400">
                Lost revenue: <span class="text-white" x-text="'₦' + formatCurrency(metrics.lostRevenue || 0)"></span>
            </div>
        </div>
    </div>

    <!-- Controls -->
    <div class="bg-dark-card p-4 rounded-xl border border-dark-border flex flex-col md:flex-row gap-4">
        <div class="relative flex-1">
            <i class="fas fa-search absolute left-3 top-3 text-gray-500 text-xs"></i>
            <input x-model="search" type="text" placeholder="Search by SKU, Product Name..."
                class="w-full bg-dark-bg border border-dark-border text-sm rounded pl-8 pr-3 py-2 text-white focus:border-greenik-500 outline-none">
        </div>
        <div class="flex gap-3 overflow-x-auto">
            <select x-model="filterCategory"
                class="bg-dark-bg border border-dark-border text-sm rounded px-3 py-2 text-white outline-none min-w-[140px]">
                <option value="All">All Categories</option>
                <option value="Solar">Solar Panels</option>
                <option value="Inverters">Inverters</option>
                <option value="Batteries">Batteries</option>
            </select>
            <select x-model="filterStock"
                class="bg-dark-bg border border-dark-border text-sm rounded px-3 py-2 text-white outline-none min-w-[140px]">
                <option value="All">All Stock Levels</option>
                <option value="Low">Low Stock</option>
                <option value="Out">Out of Stock</option>
            </select>
            <select
                class="bg-dark-bg border border-dark-border text-sm rounded px-3 py-2 text-white outline-none min-w-[140px]">
                <option value="All">All Suppliers</option>
                <option value="Tesla">Tesla</option>
                <option value="SunPower">SunPower</option>
            </select>
        </div>
    </div>

    <!-- Inventory Table -->
    <div class="bg-dark-card rounded-xl border border-dark-border overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead class="bg-[#309983]/10 text-gray-400 text-xs uppercase">
                <tr>
                    <th class="p-4">Item Details</th>
                    <th class="p-4">SKU</th>
                    <th class="p-4">Supplier</th>
                    <th class="p-4 w-1/4">Stock Level</th>
                    <th class="p-4">Status</th>
                    <th class="p-4 text-right">Adjust</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-800 text-sm">
                <template x-for="item in filteredInventory" :key="item.sku">
                    <tr class="hover:bg-[#309983]/10 transition duration-150">
                        <!-- Item -->
                        <td class="p-4">
                            <div class="flex items-center gap-3">
                                <div
                                    class="h-10 w-10 rounded flex items-center justify-center bg-gray-700 flex-shrink-0 overflow-hidden">
                                    <img x-show="item.image" :src="item.image" :alt="item.name"
                                        class="w-full h-full object-cover" x-cloak>
                                    <i x-show="!item.image" :class="item.icon" class="text-gray-400"></i>
                                </div>
                                <div>
                                    <p class="font-medium text-white" x-text="item.name"></p>
                                    <p class="text-xs text-gray-500" x-text="item.category"></p>
                                </div>
                            </div>
                        </td>

                        <!-- SKU -->
                        <td class="p-4 font-mono text-gray-400 text-xs" x-text="item.sku"></td>

                        <!-- Supplier -->
                        <td class="p-4 text-gray-300" x-text="item.supplier"></td>

                        <!-- Stock Level Visual -->
                        <td class="p-4">
                            <div class="flex justify-between text-xs mb-1">
                                <span class="text-white font-bold" x-text="item.qty + ' units'"></span>
                                <span class="text-gray-500" x-text="'Min: ' + item.min"></span>
                            </div>
                            <div class="w-full bg-gray-700 rounded-full h-2">
                                <div class="h-2 rounded-full transition-all duration-500"
                                    :class="getStockColor(item.qty, item.min)"
                                    :style="`width: ${Math.min((item.qty / item.max) * 100, 100)}%`"></div>
                            </div>
                        </td>

                        <!-- Status Badge -->
                        <td class="p-4">
                            <span :class="getStatusBadge(item.qty, item.min)"
                                class="px-2 py-1 rounded text-[10px] border uppercase tracking-wide font-bold">
                                <span x-text="getStatusText(item.qty, item.min)"></span>
                            </span>
                        </td>

                        <!-- Actions -->
                        <td class="p-4 text-right">
                            <button @click="openAdjustModal(item)"
                                class="bg-dark-bg hover:bg-gray-700 border border-dark-border text-white px-3 py-1.5 rounded text-xs transition">
                                <i class="fas fa-sliders-h"></i>
                            </button>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>

    <!-- ADJUST STOCK MODAL -->
    <div x-show="adjustItem" class="fixed inset-0 z-50 flex items-center justify-center p-4" x-cloak>

        <div class="absolute inset-0 bg-black/80 backdrop-blur-sm" @click="adjustItem = null"></div>

        <div class="relative bg-dark-card w-full max-w-sm rounded-xl border border-dark-border shadow-2xl overflow-hidden"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100">

            <!-- Header -->
            <div class="p-5 border-b border-dark-border bg-gray-900 flex justify-between items-center">
                <h3 class="text-lg font-bold text-white">Adjust Stock</h3>
                <button @click="adjustItem = null" class="text-gray-400 hover:text-white"><i
                        class="fas fa-times"></i></button>
            </div>

            <div class="p-6" x-if="adjustItem">
                <div class="flex items-center gap-3 mb-6">
                    <div
                        class="h-12 w-12 rounded flex items-center justify-center bg-gray-800 flex-shrink-0 overflow-hidden">
                        <img x-show="adjustItem.image" :src="adjustItem.image" :alt="adjustItem.name"
                            class="w-full h-full object-cover" x-cloak>
                        <i x-show="!adjustItem.image" :class="adjustItem.icon" class="text-greenik-500 text-xl"></i>
                    </div>
                    <div>
                        <p class="text-white font-medium" x-text="adjustItem.name"></p>
                        <p class="text-sm text-gray-400">Current Stock: <span class="text-white font-bold"
                                x-text="adjustItem.qty"></span></p>
                    </div>
                </div>

                <form @submit.prevent="saveStock">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-xs text-gray-500 mb-1 uppercase font-bold">Adjustment Type</label>
                            <div class="grid grid-cols-2 gap-2">
                                <button type="button" @click="adjustmentType = 'add'"
                                    :class="adjustmentType === 'add' ? 'bg-greenik-600 text-black border-greenik-600' : 'bg-dark-bg text-gray-400 border-dark-border'"
                                    class="border py-2 rounded text-sm font-medium transition">
                                    <i class="fas fa-plus mr-1"></i> Add
                                </button>
                                <button type="button" @click="adjustmentType = 'remove'"
                                    :class="adjustmentType === 'remove' ? 'bg-red-600 text-white border-red-600' : 'bg-dark-bg text-gray-400 border-dark-border'"
                                    class="border py-2 rounded text-sm font-medium transition">
                                    <i class="fas fa-minus mr-1"></i> Remove
                                </button>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs text-gray-500 mb-1 uppercase font-bold">Quantity</label>
                            <input x-model="adjustQty" type="number" min="1"
                                class="w-full bg-dark-bg border border-dark-border rounded p-2 text-white focus:border-greenik-500 outline-none text-lg font-mono">
                        </div>

                        <div>
                            <label class="block text-xs text-gray-500 mb-1 uppercase font-bold">Reason</label>
                            <select
                                class="w-full bg-dark-bg border border-dark-border rounded p-2 text-white text-sm outline-none">
                                <option>New Shipment Received</option>
                                <option>Customer Return</option>
                                <option>Damaged / Defective</option>
                                <option>Inventory Correction</option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-6 pt-4 border-t border-dark-border flex justify-end gap-3">
                        <button type="button" @click="adjustItem = null"
                            class="px-4 py-2 rounded text-gray-400 hover:text-white text-sm">Cancel</button>
                        <button type="submit"
                            class="bg-white text-black font-bold px-6 py-2 rounded hover:bg-gray-200 transition text-sm">Save
                            Adjustment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

<!-- COMPONENT LOGIC -->
<script>
    function inventoryManager() {
        return {
            search: '',
            filterCategory: 'All',
            filterStock: 'All',

            // Modal States
            adjustItem: null,
            adjustmentType: 'add',
            adjustQty: 1,

            // Data
            items: [],
            metrics: {
                totalProducts: 0,
                totalValue: 0,
                lowStock: 0,
                outOfStock: 0,
                lostRevenue: 0
            },
            loading: true,
            error: null,

            async init() {
                try {
                    this.loading = true;
                    const response = await fetch('/admin/api/inventory');

                    if (!response.ok) {
                        throw new Error('Failed to fetch inventory');
                    }

                    const data = await response.json();
                    this.items = data.items || [];
                    this.metrics = data.metrics || {
                        totalProducts: 0,
                        totalValue: 0,
                        lowStock: 0,
                        outOfStock: 0,
                        lostRevenue: 0
                    };
                } catch (err) {
                    this.error = err.message;
                    console.error('Error fetching inventory:', err);
                } finally {
                    this.loading = false;
                }
            },

            // Filter Logic
            get filteredInventory() {
                return this.items.filter(item => {
                    const matchesSearch = item.name.toLowerCase().includes(this.search.toLowerCase()) ||
                        item.sku.toLowerCase().includes(this.search.toLowerCase());
                    const matchesCategory = this.filterCategory === 'All' || item.category === this.filterCategory;

                    let matchesStock = true;
                    if (this.filterStock === 'Low') matchesStock = item.qty <= item.min && item.qty > 0;
                    if (this.filterStock === 'Out') matchesStock = item.qty === 0;

                    return matchesSearch && matchesCategory && matchesStock;
                });
            },

            // Modal Logic
            openAdjustModal(item) {
                this.adjustItem = JSON.parse(JSON.stringify(item));
                this.adjustQty = 1;
                this.adjustmentType = 'add';
            },

            saveStock() {
                if (!this.adjustItem) return;

                // Find and update the item
                const idx = this.items.findIndex(i => i.sku === this.adjustItem.sku);
                if (idx !== -1) {
                    if (this.adjustmentType === 'add') {
                        this.items[idx].qty += parseInt(this.adjustQty);
                    } else {
                        this.items[idx].qty = Math.max(0, this.items[idx].qty - parseInt(this.adjustQty));
                    }
                }

                // Close
                this.adjustItem = null;
            },

            // Styling Helpers
            getStockColor(qty, min) {
                if (qty === 0) return 'bg-gray-600';
                if (qty <= min) return 'bg-red-500';
                if (qty <= min * 1.5) return 'bg-yellow-500';
                return 'bg-greenik-500';
            },

            getStatusBadge(qty, min) {
                if (qty === 0) return 'bg-gray-700 text-gray-400 border-gray-600';
                if (qty <= min) return 'bg-red-900/30 text-red-400 border-red-900';
                if (qty <= min * 1.5) return 'bg-yellow-900/30 text-yellow-400 border-yellow-900';
                return 'bg-green-900/30 text-green-400 border-green-900';
            },

            getStatusText(qty, min) {
                if (qty === 0) return 'Out of Stock';
                if (qty <= min) return 'Critical';
                if (qty <= min * 1.5) return 'Low Stock';
                return 'In Stock';
            },

            formatCurrency(value) {
                return new Intl.NumberFormat('en-NG', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                }).format(value);
            }
        }
    }
</script>