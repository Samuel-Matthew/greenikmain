<!-- <div x-show="currentTab === 'orders'" class="space-y-6">
    <h2 class="text-2xl font-bold text-white mb-6">Order Management</h2>

    <div class="bg-dark-card rounded-xl border border-dark-border overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-800 text-gray-400 text-xs uppercase">
                <tr>
                    <th class="p-4">Order ID</th>
                    <th class="p-4">Customer</th>
                    <th class="p-4">Date</th>
                    <th class="p-4">Payment</th>
                    <th class="p-4">Status</th>
                    <th class="p-4">Total</th>
                    <th class="p-4 text-right">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-800 text-sm">
                <tr class="hover:bg-gray-800/50">
                    <td class="p-4 text-greenik-500 font-mono">#ORD-9921</td>
                    <td class="p-4">John Doe <br><span class="text-xs text-gray-500">Lagos, NG</span>
                    </td>
                    <td class="p-4">Nov 24, 2024</td>
                    <td class="p-4"><i class="fab fa-cc-stripe mr-1"></i> Paid</td>
                    <td class="p-4"><span
                            class="px-2 py-1 bg-blue-900/30 text-blue-400 rounded text-xs">Processing</span>
                    </td>
                    <td class="p-4 text-white font-bold">₦1,200.00</td>
                    <td class="p-4 text-right">
                        <button
                            class="text-gray-400 hover:text-white text-xs border border-gray-600 px-2 py-1 rounded">View</button>
                        <button
                            class="text-gray-400 hover:text-white text-xs border border-gray-600 px-2 py-1 rounded ml-1"><i
                                class="fas fa-download"></i></button>
                    </td>
                </tr>
                <tr class="hover:bg-gray-800/50">
                    <td class="p-4 text-greenik-500 font-mono">#ORD-9920</td>
                    <td class="p-4">Sarah Smith <br><span class="text-xs text-gray-500">Abuja, NG</span>
                    </td>
                    <td class="p-4">Nov 23, 2024</td>
                    <td class="p-4"><i class="fas fa-money-bill mr-1"></i> COD</td>
                    <td class="p-4"><span
                            class="px-2 py-1 bg-yellow-900/30 text-yellow-400 rounded text-xs">Pending</span>
                    </td>
                    <td class="p-4 text-white font-bold">₦450.00</td>
                    <td class="p-4 text-right">
                        <button
                            class="text-gray-400 hover:text-white text-xs border border-gray-600 px-2 py-1 rounded">View</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div> -->

<!-- ORDER MANAGEMENT SECTION -->
<div x-show="currentTab === 'orders'" class="space-y-6">

    <div class="flex flex-col md:flex-row justify-between items-center">
        <h2 class="text-2xl font-bold text-white">Order Management</h2>

        <!-- Filter Controls -->
        <div class="flex gap-3">
            <div class="relative">
                <i class="fas fa-search absolute left-3 top-3 text-gray-500 text-xs"></i>
                <input x-model="orderSearch" type="text" placeholder="Search Order ID..."
                    class="bg-dark-card border border-dark-border text-sm rounded pl-8 pr-3 py-2 text-white focus:border-greenik-500 outline-none">
            </div>
            <select x-model="orderStatusFilter"
                class="bg-dark-card border border-dark-border text-sm rounded px-3 py-2 text-white outline-none">
                <option value="all">All Status</option>
                <option value="processing">Processing</option>
                <option value="paid">Paid</option>
                <option value="shipped">Shipped</option>
                <option value="delivered">Delivered</option>
                <option value="cancelled">Cancelled</option>
            </select>
        </div>
    </div>

    <!-- MAIN ORDERS TABLE -->
    <div class="bg-dark-card rounded-xl border border-dark-border overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead class="bg-[#309983]/10 text-gray-400 text-xs uppercase">
                <tr>
                    <th class="p-4">Order ID</th>
                    <th class="p-4">Customer</th>
                    <th class="p-4">Date</th>
                    <th class="p-4">Total</th>
                    <th class="p-4">Payment</th>
                    <th class="p-4">Status</th>
                    <th class="p-4 text-right">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-800 text-sm">
                <template x-for="order in filteredOrders" :key="order.id">
                    <tr class="hover:bg-[#309983]/10 transition duration-150">
                        <td class="p-4 text-greenik-500 font-mono font-medium" x-text="order.order_number"></td>
                        <td class="p-4">
                            <div class="font-medium text-white" x-text="order.first_name + ' ' + order.last_name"></div>
                            <div class="text-xs text-gray-500" x-text="order.state + ', NG'"></div>
                        </td>
                        <td class="p-4 text-gray-300"
                            x-text="new Date(order.created_at).toLocaleDateString('en-US', {month: 'short', day: 'numeric', year: 'numeric'})">
                        </td>
                        <td class="p-4 text-white font-bold">₦<span
                                x-text="parseFloat(order.total).toLocaleString('en-US', {minimumFractionDigits: 2})"></span>
                        </td>
                        <td class="p-4 text-gray-400">
                            <i :class="getPaymentIcon(order.payment_method) + ' mr-1'"></i>
                            <span
                                x-text="order.payment_method ? order.payment_method.charAt(0).toUpperCase() + order.payment_method.slice(1) : 'Unknown'"></span>
                        </td>
                        <td class="p-4">
                            <span :class="getOrderStatusColor(order.status)"
                                class="px-2 py-1 rounded text-xs border uppercase tracking-wider font-semibold"
                                x-text="order.status.charAt(0).toUpperCase() + order.status.slice(1)"></span>
                        </td>
                        <td class="p-4 text-right">
                            <button @click="openOrderModal(order)"
                                class="text-gray-300 hover:text-white bg-gray-700 hover:bg-gray-600 px-3 py-1 rounded text-xs transition">
                                Manage
                            </button>
                        </td>
                    </tr>
                </template>
                <template x-if="filteredOrders.length === 0 && orders.length > 0">
                    <tr>
                        <td colspan="7" class="p-8 text-center text-gray-400">
                            <i class="fas fa-filter mr-2"></i>No orders match your filters
                        </td>
                    </tr>
                </template>
                <template x-if="orders.length === 0">
                    <tr>
                        <td colspan="7" class="p-8 text-center text-gray-500">
                            No orders found.
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div
        class="p-4 border-t border-dark-border flex justify-between items-center text-xs text-gray-400 bg-dark-card rounded-b-xl">
        <span>Showing <span x-text="((orderCurrentPage - 1) * orderItemsPerPage) + 1"></span>-<span
                x-text="Math.min(orderCurrentPage * orderItemsPerPage, allFilteredOrders.length)"></span> of <span
                x-text="allFilteredOrders.length"></span> orders</span>
        <div class="flex gap-1">
            <button @click="orderCurrentPage = Math.max(1, orderCurrentPage - 1)" :disabled="orderCurrentPage === 1"
                class="px-3 py-1 rounded border border-dark-border hover:bg-gray-700 disabled:opacity-50 disabled:cursor-not-allowed transition">Prev</button>
            <template x-for="page in orderTotalPages" :key="page">
                <button @click="orderCurrentPage = page"
                    :class="orderCurrentPage === page ? 'bg-greenik-600 text-black font-bold' : 'border border-dark-border hover:bg-gray-700'"
                    class="px-3 py-1 rounded transition" x-text="page"
                    x-show="page <= 5 || (page >= orderCurrentPage - 1 && page <= orderCurrentPage + 1) || page > orderTotalPages - 2"></button>
            </template>
            <button @click="orderCurrentPage = Math.min(orderTotalPages, orderCurrentPage + 1)"
                :disabled="orderCurrentPage === orderTotalPages"
                class="px-3 py-1 rounded border border-dark-border hover:bg-gray-700 disabled:opacity-50 disabled:cursor-not-allowed transition">Next</button>
        </div>
    </div>
    <div id="orderModal" class="fixed inset-0 z-50 overflow-hidden hidden"
        x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" x-cloak>

        <!-- Backdrop -->
        <div class="absolute inset-0 bg-black/70 backdrop-blur-sm" onclick="closeOrderModal()"></div>

        <!-- Panel -->
        <div
            class="absolute inset-y-0 right-0 max-w-2xl w-full bg-dark-card border-l border-dark-border shadow-2xl flex flex-col transform transition-transform duration-300">

            <!-- Modal Header -->
            <div class="flex items-center justify-between p-6 border-b border-dark-border bg-[#309983]/10">
                <div>
                    <h3 class="text-xl font-bold text-white flex items-center gap-3">
                        <span id="modalOrderId"></span>
                        <span id="modalStatusBadge" class="text-xs px-2 py-0.5 rounded border"></span>
                    </h3>
                    <p class="text-xs text-gray-400 mt-1" id="modalOrderDate"></p>
                </div>
                <button onclick="closeOrderModal()" class="text-gray-400 hover:text-white">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <!-- Modal Content -->
            <div class="flex-1 overflow-y-auto p-6 space-y-8">

                <!-- Status Manager -->
                <div class="bg-dark-bg p-5 rounded-lg border border-dark-border">
                    <label class="block text-sm font-medium text-gray-400 mb-3 uppercase tracking-wide">Update Order
                        Status</label>
                    <div class="flex flex-col sm:flex-row gap-4 items-center">
                        <div class="relative w-full">
                            <select id="statusSelect"
                                class="w-full appearance-none bg-dark-card border border-dark-border text-white py-2 px-4 pr-8 rounded focus:outline-none focus:border-greenik-500">
                                <option value="processing">Processing</option>
                                <option value="paid">Paid</option>
                                <option value="shipped">Shipped</option>
                                <option value="delivered">Delivered</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                            <div
                                class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-white">
                                <i class="fas fa-chevron-down text-xs"></i>
                            </div>
                        </div>
                        <button onclick="updateOrderStatus()"
                            class="w-full sm:w-auto bg-greenik-600 hover:bg-greenik-500 text-black font-bold py-2 px-6 rounded transition shadow-[0_0_15px_rgba(0,210,132,0.2)]">
                            Update
                        </button>
                    </div>
                    <p class="text-xs text-gray-500 mt-2">
                        <i class="fas fa-info-circle mr-1"></i>
                        Changing status will update the order in the system.
                    </p>
                </div>

                <!-- Product List -->
                <div>
                    <h4 class="text-white font-bold mb-4 border-b border-dark-border pb-2">Items Ordered</h4>
                    <div id="modalItems" class="space-y-4">
                        <!-- Items will be populated here -->
                    </div>
                    <div class="mt-4 pt-4 border-t border-dark-border flex justify-between items-center">
                        <span class="text-gray-400">Total</span>
                        <span class="text-white font-bold text-lg" id="modalTotal"></span>
                    </div>
                </div>

                <!-- Customer & Shipping Info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h4 class="text-white font-bold mb-3 text-sm uppercase text-gray-500">Customer Details</h4>
                        <div class="text-sm space-y-1">
                            <p class="text-white font-medium" id="modalCustomer"></p>
                            <p class="text-gray-400" id="modalEmail"></p>
                            <p class="text-gray-400" id="modalPhone"></p>
                        </div>
                    </div>
                    <div>
                        <h4 class="text-white font-bold mb-3 text-sm uppercase text-gray-500">Shipping Address</h4>
                        <div class="text-sm space-y-1">
                            <p class="text-gray-300" id="modalAddress"></p>
                            <p class="text-gray-300" id="modalLocation"></p>
                            <p class="text-gray-300">Nigeria</p>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Modal Footer -->
            <div class="p-6 border-t border-dark-border bg-[#309983]/10 flex justify-between">
                <button class="text-gray-400 hover:text-white flex items-center gap-2">
                    <i class="fas fa-print"></i> Print Invoice
                </button>
                <button class="text-red-400 hover:text-red-300 flex items-center gap-2 text-sm">
                    <i class="fas fa-undo"></i> Refund Order
                </button>
            </div>
        </div>
    </div>

</div>

<!-- COMPONENT LOGIC -->
<script>
    let currentOrderId = null;
    let currentOrderNumber = null;

    function getOrderStatusColor(status) {
        const colors = {
            'processing': 'bg-blue-900/30 text-blue-400 border-blue-900',
            'paid': 'bg-green-900/30 text-green-400 border-green-900',
            'shipped': 'bg-purple-900/30 text-purple-400 border-purple-900',
            'delivered': 'bg-green-900/30 text-green-400 border-green-900',
            'cancelled': 'bg-red-900/30 text-red-400 border-red-900'
        };
        return colors[status?.toLowerCase()] || 'bg-gray-800 text-gray-400';
    }

    function getPaymentIcon(method) {
        const icons = {
            'paystack': 'fas fa-layer-group text-blue-300',
            'stripe': 'fab fa-cc-stripe text-blue-400',
            'paypal': 'fab fa-paypal text-blue-600',
            'cod': 'fas fa-money-bill-wave text-green-400'
        };
        return icons[method?.toLowerCase()] || 'fas fa-credit-card';
    }

    // These functions need to be accessible from the Alpine component
    window.openOrderModal = function (order) {
        if (!order) return;

        currentOrderId = order.id;
        currentOrderNumber = order.order_number;

        const statusBadge = document.getElementById('modalStatusBadge');
        statusBadge.textContent = order.status.charAt(0).toUpperCase() + order.status.slice(1);
        statusBadge.className = 'text-xs px-2 py-0.5 rounded border ' + getOrderStatusColor(order.status);

        document.getElementById('modalOrderId').textContent = order.order_number;
        document.getElementById('modalOrderDate').textContent = 'Placed on ' + new Date(order.created_at).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
        document.getElementById('modalCustomer').textContent = order.first_name + ' ' + order.last_name;
        document.getElementById('modalEmail').textContent = order.email;
        document.getElementById('modalPhone').textContent = order.phone || 'Not provided';
        document.getElementById('modalAddress').textContent = order.address;
        document.getElementById('modalLocation').textContent = order.state + ', NG';
        document.getElementById('modalTotal').textContent = '₦' + parseFloat(order.total).toLocaleString('en-US', { minimumFractionDigits: 2 });
        document.getElementById('statusSelect').value = order.status;

        fetchOrderItems(order.id);
        document.getElementById('orderModal').classList.remove('hidden');
    };

    window.closeOrderModal = function () {
        document.getElementById('orderModal').classList.add('hidden');
        currentOrderId = null;
    };

    function fetchOrderItems(orderId) {
        const itemsContainer = document.getElementById('modalItems');
        itemsContainer.innerHTML = '<p class="text-gray-400 text-sm">Order items are displayed in the order summary.</p>';
    }

    window.updateOrderStatus = async function () {
        if (!currentOrderNumber) {
            showNotification('No order selected', 'error');
            return;
        }

        const newStatus = document.getElementById('statusSelect').value;

        try {
            const csrfToken = document.querySelector('meta[name="csrf-token"]');
            if (!csrfToken) {
                showNotification('Security token missing', 'error');
                return;
            }

            const response = await fetch('{{ route("admin.orders.update-status") }}', {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken.content,
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({
                    order_id: currentOrderNumber,
                    status: newStatus
                })
            });

            if (!response.ok) {
                const errorData = await response.json();
                showNotification(`Error ${response.status}: ${errorData.message || 'Failed to update order'}`, 'error');
                console.error('Response error:', errorData);
                return;
            }

            const data = await response.json();
            if (data.success) {
                showNotification(`Order ${currentOrderNumber} updated to ${newStatus}`, 'success');

                // Reload the page to reflect changes
                setTimeout(() => {
                    location.reload();
                }, 1500);
            } else {
                showNotification('Failed to update order: ' + (data.message || 'Unknown error'), 'error');
            }
        } catch (error) {
            console.error('Error updating order status:', error);
            showNotification('Error updating order status: ' + error.message, 'error');
        }
    };

    function showNotification(message, type = 'success') {
        const div = document.createElement('div');
        div.className = type === 'success'
            ? 'fixed top-20 left-1/2 transform -translate-x-1/2 z-50 p-4 bg-green-500/20 border border-green-500 rounded text-green-100 min-w-96'
            : 'fixed top-20 left-1/2 transform -translate-x-1/2 z-50 p-4 bg-red-500/20 border border-red-500 rounded text-red-100 min-w-96';
        div.textContent = message;
        document.body.appendChild(div);
        setTimeout(() => {
            div.style.transition = 'opacity 0.3s ease';
            div.style.opacity = '0';
            setTimeout(() => div.remove(), 300);
        }, 3000);
    }
</script>