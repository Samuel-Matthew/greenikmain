<div x-show="currentTab === 'payments'" class="space-y-6">

    <h2 class="text-2xl font-bold text-white">Financial Transactions</h2>

    <!-- Financial Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Total Sales -->
        <div
            class="bg-dark-card p-6 rounded-xl border border-dark-border flex items-center justify-between relative overflow-hidden group">
            <div>
                <p class="text-sm text-gray-400">Total Sales</p>
                <p class="text-2xl font-bold text-white mt-1">₦<span
                        x-text="totalSales?.toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2})"></span>
                </p>
                <p class="text-xs mt-2" :class="salesGrowth >= 0 ? 'text-greenik-500' : 'text-red-500'">
                    <i :class="salesGrowth >= 0 ? 'fas fa-arrow-up' : 'fas fa-arrow-down'"></i>
                    <span x-text="salesGrowth >= 0 ? '+' + salesGrowth + '%' : salesGrowth + '%'"></span> vs last week
                </p>
            </div>
            <div class="p-3 bg-greenik-900/50 rounded-lg text-greenik-500">
                <i class="fas fa-dollar-sign text-xl"></i>
            </div>
        </div>

        <!-- Success Rate -->
        <div class="bg-dark-card p-6 rounded-xl border border-dark-border flex items-center justify-between">
            <div>
                <p class="text-gray-400 text-sm">Successful Payments</p>
                <h3 class="text-2xl font-bold text-white mt-1"><span x-text="successRate"></span>%</h3>
            </div>
            <div class="h-10 w-10 rounded-full bg-blue-900/30 flex items-center justify-center text-blue-500">
                <i class="fas fa-check-circle"></i>
            </div>
        </div>

        <!-- Refunds/Failed -->
        <div class="bg-dark-card p-6 rounded-xl border border-dark-border flex items-center justify-between">
            <div>
                <p class="text-gray-400 text-sm">Refunds & Failed</p>
                <h3 class="text-2xl font-bold text-white mt-1">
                    ₦<span
                        x-text="transactions.filter(t => t.status === 'refunded' || t.status === 'failed').reduce((sum, t) => sum + parseFloat(t.amount || 0), 0).toLocaleString('en-US', {minimumFractionDigits: 2})"></span>
                </h3>
            </div>
            <div class="h-10 w-10 rounded-full bg-red-900/30 flex items-center justify-center text-red-500">
                <i class="fas fa-undo"></i>
            </div>
        </div>
    </div>

    <!-- Filters & Actions -->
    <div
        class="flex flex-col lg:flex-row justify-between items-center gap-4 bg-dark-card p-4 rounded-xl border border-dark-border">

        <!-- Search & Date -->
        <div class="flex flex-1 gap-4 w-full">
            <div class="relative flex-1 max-w-xs">
                <i class="fas fa-search absolute left-3 top-3 text-gray-500 text-xs"></i>
                <input x-model="search" type="text" placeholder="Search Transaction ID..."
                    class="w-full bg-dark-bg border border-dark-border text-sm rounded pl-8 pr-3 py-2 text-white focus:border-greenik-500 outline-none">
            </div>
            <input type="date"
                class="bg-dark-bg border border-dark-border text-sm rounded px-3 py-2 text-gray-400 focus:border-greenik-500 outline-none">
        </div>

        <!-- Dropdowns -->
        <div class="flex gap-3 w-full lg:w-auto">
            <select x-model="filterGateway"
                class="bg-dark-bg border border-dark-border text-sm rounded px-3 py-2 text-white outline-none">
                <option value="All">All Gateways</option>
                <option value="paystack">Paystack</option>
                <option value="flutterwave">Flutterwave</option>
                <option value="stripe">Stripe</option>
                <option value="bank_transfer">Bank Transfer</option>
            </select>

            <select x-model="filterStatus"
                class="bg-dark-bg border border-dark-border text-sm rounded px-3 py-2 text-white outline-none">
                <option value="All">All Status</option>
                <option value="success">Success</option>
                <option value="pending">Pending</option>
                <option value="failed">Failed</option>
                <option value="refunded">Refunded</option>
            </select>

            <button
                class="bg-greenik-600 hover:bg-greenik-500 text-black font-bold px-4 py-2 rounded text-sm transition">
                <i class="fas fa-file-csv mr-2"></i> Export
            </button>
        </div>
    </div>

    <!-- Transactions Table -->
    <div class="bg-dark-card rounded-xl border border-dark-border overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead class="bg-[#309983]/10 text-gray-400 text-xs uppercase">
                <tr>
                    <th class="p-4">Trans. ID</th>
                    <th class="p-4">Date</th>
                    <th class="p-4">Order Ref</th>
                    <th class="p-4">Gateway</th>
                    <th class="p-4">Amount</th>
                    <th class="p-4">Status</th>
                    <th class="p-4 text-right">Details</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-800 text-sm">
                <template x-for="txn in filteredTransactions" :key="txn.id">
                    <tr class="hover:bg-gray-800/50 transition duration-150" @click="viewReceipt(txn)">
                        <!-- ID -->
                        <td class="p-4 font-mono text-gray-300"
                            x-text="(txn.reference || 'TXN000').substring(0, 8) + '...'"></td>

                        <!-- Date -->
                        <td class="p-4 text-gray-400 text-xs">
                            <div
                                x-text="new Date(txn.created_at).toLocaleDateString('en-US', {month: 'short', day: 'numeric', year: 'numeric'})">
                            </div>
                            <div
                                x-text="new Date(txn.created_at).toLocaleTimeString('en-US', {hour: '2-digit', minute: '2-digit', hour12: true})">
                            </div>
                        </td>

                        <!-- Description/Order -->
                        <td class="p-4">
                            <span class="text-greenik-500 hover:underline cursor-pointer"
                                x-text="txn.order_id || 'N/A'"></span>
                            <div class="text-xs text-gray-500" x-text="txn.user_email"></div>
                            <!-- <div class="text-xs text-gray-500" x-text="txn.user_email || 'guest@example.com'"></div> -->
                        </td>

                        <!-- Gateway -->
                        <td class="p-4">
                            <div class="flex items-center gap-2">
                                <span class="w-6 h-6 rounded bg-white flex items-center justify-center text-xs">
                                    <i :class="getGatewayIcon(txn.payment_method) + ' text-gray-900'"></i>
                                </span>
                                <span class="text-gray-300 capitalize"
                                    x-text="(txn.payment_method || '').replace('_', ' ')"></span>
                            </div>
                        </td>

                        <!-- Amount -->
                        <td class="p-4 font-bold text-white">₦<span
                                x-text="parseFloat(txn.amount || 0).toLocaleString('en-US', {minimumFractionDigits: 2})"></span>
                        </td>

                        <!-- Status -->
                        <td class="p-4">
                            <span :class="getStatusBadge(txn.status)"
                                class="px-2 py-1 rounded-full text-xs border font-medium flex w-fit items-center gap-1">
                                <i :class="getStatusIcon(txn.status)"></i>
                                <span class="capitalize" x-text="txn.status"></span>
                            </span>
                        </td>

                        <!-- Action -->
                        <td class="p-4 text-right">
                            <button @click.stop="viewReceipt(txn)"
                                class="text-gray-400 hover:text-white p-2 rounded hover:bg-gray-700 transition">
                                <i class="fas fa-eye"></i>
                            </button>
                        </td>
                    </tr>
                </template>
                <template x-if="filteredTransactions.length === 0 && transactions.length > 0">
                    <tr>
                        <td colspan="7" class="p-4 text-center text-gray-400">
                            <i class="fas fa-filter mr-2"></i>No transactions match your filters
                        </td>
                    </tr>
                </template>
                <template x-if="transactions.length === 0">
                    <tr>
                        <td colspan="7" class="p-4 text-center text-gray-400">
                            <i class="fas fa-inbox mr-2"></i>No transactions found
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>

        <!-- Pagination Info -->
        <div class="p-4 border-t border-dark-border flex justify-between items-center text-xs text-gray-400">
            <span>Showing <span x-text="((currentPage - 1) * itemsPerPage) + 1"></span>-<span
                    x-text="Math.min(currentPage * itemsPerPage, allFilteredTransactions.length)"></span> of <span
                    x-text="allFilteredTransactions.length"></span> transactions</span>
            <div class="flex gap-1">
                <button @click="currentPage = Math.max(1, currentPage - 1)" :disabled="currentPage === 1"
                    class="px-3 py-1 rounded border border-dark-border hover:bg-gray-700 disabled:opacity-50 disabled:cursor-not-allowed transition">Prev</button>
                <template x-for="page in totalPages" :key="page">
                    <button @click="currentPage = page"
                        :class="currentPage === page ? 'bg-greenik-600 text-black font-bold' : 'border border-dark-border hover:bg-gray-700'"
                        class="px-3 py-1 rounded transition" x-text="page"
                        x-show="page <= 5 || (page >= currentPage - 1 && page <= currentPage + 1) || page > totalPages - 2"></button>
                </template>
                <button @click="currentPage = Math.min(totalPages, currentPage + 1)"
                    :disabled="currentPage === totalPages"
                    class="px-3 py-1 rounded border border-dark-border hover:bg-gray-700 disabled:opacity-50 disabled:cursor-not-allowed transition">Next</button>
            </div>
        </div>
    </div>

    <!-- TRANSACTION DETAIL MODAL -->
    <div x-show="activeTxn" class="fixed inset-0 z-50 flex items-center justify-center p-4" x-cloak>
        <div class="absolute inset-0 bg-black/80 backdrop-blur-sm" @click="activeTxn = null"></div>

        <div class="relative bg-dark-card w-full max-w-md rounded-xl border border-dark-border shadow-2xl p-6"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100">

            <button @click="activeTxn = null" class="absolute top-4 right-4 text-gray-500 hover:text-white">
                <i class="fas fa-times"></i>
            </button>

            <!-- Modal Content -->
            <div class="text-center mb-6">
                <div
                    class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-dark-bg border border-dark-border mb-4">
                    <i class="fas fa-wallet text-2xl text-white" x-show="activeTxn"></i>
                </div>
                <h3 class="text-xl font-bold text-white">
                    <span x-show="activeTxn">₦<span
                            x-text="activeTxn?.amount?.toLocaleString() || '0.00'"></span></span>
                </h3>
                <p class="text-sm text-gray-400">Transaction Details</p>
            </div>

            <div class="space-y-4 text-sm" x-show="activeTxn">
                <div class="flex justify-between border-b border-dark-border pb-2">
                    <span class="text-gray-400">Status</span>
                    <span class="px-2 py-0.5 rounded text-xs capitalize"
                        :class="activeTxn?.status === 'success' ? 'bg-green-900/30 text-green-400' : 
                                 activeTxn?.status === 'pending' ? 'bg-yellow-900/30 text-yellow-400' : 
                                 activeTxn?.status === 'failed' ? 'bg-red-900/30 text-red-400' : 'bg-blue-900/30 text-blue-400'" x-text="activeTxn?.status"></span>
                </div>
                <div class="flex justify-between border-b border-dark-border pb-2">
                    <span class="text-gray-400">Transaction ID</span>
                    <span class="text-white font-mono text-xs select-all" x-text="activeTxn?.reference"></span>
                </div>
                <div class="flex justify-between border-b border-dark-border pb-2">
                    <span class="text-gray-400">Payment Method</span>
                    <span class="text-white capitalize"
                        x-text="(activeTxn?.payment_method || '').replace('_', ' ') + ' (**** 4242)'"></span>
                </div>
                <div class="flex justify-between border-b border-dark-border pb-2">
                    <span class="text-gray-400">Customer</span>
                    <span class="text-white text-sm" x-text="activeTxn?.user_name"></span>
                </div>
                <div class="flex justify-between border-b border-dark-border pb-2">
                    <span class="text-gray-400">Email</span>
                    <span class="text-white text-sm" x-text="activeTxn?.user_email"></span>
                </div>
                <div class="flex justify-between border-b border-dark-border pb-2">
                    <span class="text-gray-400">Order ID</span>
                    <span class="text-white text-sm" x-text="activeTxn?.order_id || 'N/A'"></span>
                </div>
                <div class="flex justify-between pt-2">
                    <span class="text-gray-400">Gateway Fee</span>
                    <span class="text-red-400">-₦<span
                            x-text="(activeTxn?.amount * 0.015)?.toFixed(2) || '0.00'"></span></span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-400">Net Earnings</span>
                    <span class="text-greenik-500 font-bold">₦<span
                            x-text="(activeTxn?.amount * 0.985)?.toLocaleString() || '0.00'"></span></span>
                </div>
            </div>

            <div class="mt-8 flex gap-3">
                <button
                    class="flex-1 bg-dark-bg border border-dark-border text-white py-2 rounded hover:bg-gray-800 transition">
                    Email Receipt
                </button>
                <button class="flex-1 bg-greenik-600 text-black font-bold py-2 rounded hover:bg-greenik-500 transition">
                    Download PDF
                </button>
            </div>
        </div>
    </div>

</div>