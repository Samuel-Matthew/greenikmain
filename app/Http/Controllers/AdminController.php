<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Order;
use App\Models\User;
use App\Models\Transaction;

class AdminController extends Controller
{
    // ========== MAIN DASHBOARD VIEW ==========
    public function adminDashboard()
    {
        $categories = ProductCategory::all();
        $products = Product::with('category')->get();
        $orders = Order::with('items.product', 'user')->orderBy('created_at', 'desc')->get();
        $totalProducts = $products->count();

        // Calculate dashboard statistics
        $totalSales = $orders->sum('total');
        $totalOrders = $orders->count();
        $pendingOrders = $orders->where('status', 'processing')->count();
        $totalCustomers = User::where('role', '!=', 'admin')->count();

        // Calculate previous week sales for comparison
        $currentWeekSales = $orders->where('created_at', '>=', now()->subDays(7))->sum('total');
        $previousWeekSales = $orders->where('created_at', '>=', now()->subDays(14))
            ->where('created_at', '<', now()->subDays(7))->sum('total');

        $salesGrowth = $previousWeekSales > 0
            ? round((($currentWeekSales - $previousWeekSales) / $previousWeekSales) * 100, 1)
            : 0;

        // Get new customers this week
        $newCustomers = User::where('role', '!=', 'admin')
            ->where('created_at', '>=', now()->subDays(7))
            ->count();

        // Get transactions data
        $transactions = Transaction::with('user', 'order')
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->through(function ($txn) {
                $userName = '';
                if ($txn->user) {
                    $userName = trim(($txn->user->first_name ?? '') . ' ' . ($txn->user->last_name ?? ''));
                }
                return [
                    'id' => $txn->id,
                    'reference' => $txn->reference,
                    'amount' => $txn->amount,
                    'payment_method' => $txn->payment_method,
                    'status' => $txn->status,
                    'created_at' => $txn->created_at,
                    'user_id' => $txn->user_id,
                    'user_email' => $txn->user?->email ?? 'guest@example.com',
                    'user_name' => $userName ?: 'Guest',
                    'order_id' => $txn->order_id,
                ];
            });

        // Calculate transaction statistics
        $successfulTransactions = Transaction::where('status', 'success')->count();
        $totalTransactions = Transaction::count();
        $successRate = $totalTransactions > 0
            ? round(($successfulTransactions / $totalTransactions) * 100, 1)
            : 0;

        return view('admin.admin-dasboard', compact(
            'categories',
            'products',
            'orders',
            'totalProducts',
            'totalSales',
            'totalOrders',
            'pendingOrders',
            'totalCustomers',
            'salesGrowth',
            'newCustomers',
            'transactions',
            'successRate'
        ));
    }

    // ========== API ENDPOINTS FOR SPA ==========

    /**
     * Fetch dashboard metrics and data
     */
    public function apiDashboard()
    {
        $orders = Order::with('items.product', 'user')->orderBy('created_at', 'desc')->get();
        $products = Product::with('category')->get();

        $totalSales = $orders->sum('total');
        $totalOrders = $orders->count();
        $pendingOrders = $orders->where('status', 'processing')->count();
        $totalCustomers = User::where('role', '!=', 'admin')->count();
        $totalProducts = $products->count();

        $currentWeekSales = $orders->where('created_at', '>=', now()->subDays(7))->sum('total');
        $previousWeekSales = $orders->where('created_at', '>=', now()->subDays(14))
            ->where('created_at', '<', now()->subDays(7))->sum('total');

        $salesGrowth = $previousWeekSales > 0
            ? round((($currentWeekSales - $previousWeekSales) / $previousWeekSales) * 100, 1)
            : 0;

        $newCustomers = User::where('role', '!=', 'admin')
            ->where('created_at', '>=', now()->subDays(7))
            ->count();

        return response()->json([
            'totalSales' => $totalSales,
            'totalOrders' => $totalOrders,
            'pendingOrders' => $pendingOrders,
            'totalCustomers' => $totalCustomers,
            'totalProducts' => $totalProducts,
            'newCustomers' => $newCustomers,
            'salesGrowth' => $salesGrowth,
            'products' => $products->take(3)->toArray()
        ]);
    }

    /**
     * Fetch all products
     */
    public function apiProducts()
    {
        $products = Product::with('category')->orderBy('created_at', 'desc')->get();

        return response()->json($products);
    }

    /**
     * Fetch all orders
     */
    public function apiOrders()
    {
        $orders = Order::with('items.product', 'user')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($orders);
    }

    /**
     * Fetch all transactions
     */
    public function apiTransactions()
    {
        $transactions = Transaction::with('user', 'order')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($txn) {
                $userName = '';
                if ($txn->user) {
                    $userName = trim(($txn->user->first_name ?? '') . ' ' . ($txn->user->last_name ?? ''));
                }
                return [
                    'id' => $txn->id,
                    'reference' => $txn->reference,
                    'amount' => $txn->amount,
                    'payment_method' => $txn->payment_method,
                    'status' => $txn->status,
                    'created_at' => $txn->created_at,
                    'user_id' => $txn->user_id,
                    'user_email' => $txn->user?->email ?? 'guest@example.com',
                    'user_name' => $userName ?: 'Guest',
                    'order_id' => $txn->order_id,
                ];
            });

        $successfulTransactions = $transactions->where('status', 'success')->count();
        $totalTransactions = $transactions->count();
        $successRate = $totalTransactions > 0
            ? round(($successfulTransactions / $totalTransactions) * 100, 1)
            : 0;

        return response()->json([
            'transactions' => $transactions->values()->toArray(),
            'successRate' => $successRate
        ]);
    }

    /**
     * Fetch all customers with their order data
     */
    public function apiCustomers()
    {
        $customers = User::where('role', '!=', 'admin')
            ->with('orders', 'transactions')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($user) {
                $totalSpent = $user->orders->sum('total') ?? 0;
                $orderCount = $user->orders->count();
                $lastOrder = $user->orders->sortByDesc('created_at')->first();

                return [
                    'id' => $user->id,
                    'name' => trim(($user->first_name ?? '') . ' ' . ($user->last_name ?? '')),
                    'email' => $user->email,
                    'phone' => $user->phone ?? 'N/A',
                    'avatar' => 'https://ui-avatars.com/api/?name=' . urlencode(trim(($user->first_name ?? '') . ' ' . ($user->last_name ?? ''))) . '&background=random',
                    'orders' => $orderCount,
                    'spent' => '₦' . number_format($totalSpent, 2),
                    'spent_raw' => $totalSpent,
                    'lastActive' => $lastOrder ? $lastOrder->created_at->diffForHumans() : 'Never',
                    'status' => 'Active',
                    // 'vip' => $totalSpent > 5000,
                ];
            });

        // Calculate metrics
        $totalCustomers = $customers->count();
        $activeCustomers = $customers->where('status', 'Active')->count();
        $newCustomersThisMonth = User::where('role', '!=', 'admin')
            ->where('created_at', '>=', now()->subDays(30))
            ->count();

        return response()->json([
            'customers' => $customers->values()->toArray(),
            'metrics' => [
                'total' => $totalCustomers,
                'active' => $activeCustomers,
                'newThisMonth' => $newCustomersThisMonth,
                'blocked' => 0
            ]
        ]);
    }

    /**
     * Fetch all products with inventory data
     */
    public function apiInventory()
    {
        $products = Product::with('category')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($product) {
                $icon = match (strtolower($product->category?->name ?? '')) {
                    'solar' => 'fas fa-solar-panel',
                    'inverters' => 'fas fa-bolt',
                    'batteries' => 'fas fa-car-battery',
                    'ev chargers' => 'fas fa-charging-station',
                    default => 'fas fa-box'
                };

                // Get first image URL from image_url array
                $imageUrl = null;
                if ($product->image_url && is_array($product->image_url) && count($product->image_url) > 0) {
                    $imageUrl = '/storage/' . $product->image_url[0];
                }

                return [
                    'id' => $product->id,
                    'sku' => $product->sku ?? 'SKU-' . $product->id,
                    'name' => $product->name,
                    'category' => $product->category?->name ?? 'Uncategorized',
                    'supplier' => $product->brand ?? 'Generic',
                    'qty' => $product->stock ?? 0,
                    'min' => 20,
                    'max' => 200,
                    'icon' => $icon,
                    'image' => $imageUrl,
                    'price' => $product->price ?? 0,
                ];
            });

        // Calculate inventory metrics
        $totalProducts = $products->count();
        $totalValue = $products->sum(function ($p) {
            return $p['qty'] * $p['price'];
        });
        $lowStockCount = $products->where('qty', '<=', 20)->where('qty', '>', 0)->count();
        $outOfStockCount = $products->where('qty', 0)->count();
        $lostRevenue = $outOfStockCount > 0 ? 2400 : 0; // Mock calculation

        return response()->json([
            'items' => $products->values()->toArray(),
            'metrics' => [
                'totalProducts' => $totalProducts,
                'totalValue' => $totalValue,
                'lowStock' => $lowStockCount,
                'outOfStock' => $outOfStockCount,
                'lostRevenue' => $lostRevenue
            ]
        ]);
    }

    /**
     * Fetch orders for a specific customer
     */
    public function apiCustomerOrders($customerId)
    {
        $orders = Order::where('user_id', $customerId)
            ->with('items.product', 'transaction')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($order) {
                $statusColors = [
                    'pending' => ['bg' => 'bg-yellow-900/30', 'text' => 'text-yellow-400'],
                    'processing' => ['bg' => 'bg-blue-900/30', 'text' => 'text-blue-400'],
                    'shipped' => ['bg' => 'bg-purple-900/30', 'text' => 'text-purple-400'],
                    'delivered' => ['bg' => 'bg-green-900/30', 'text' => 'text-green-400'],
                    'cancelled' => ['bg' => 'bg-red-900/30', 'text' => 'text-red-400'],
                    'failed' => ['bg' => 'bg-red-900/30', 'text' => 'text-red-400'],
                ];

                $status = strtolower($order->status) ?? 'pending';
                $colors = $statusColors[$status] ?? $statusColors['pending'];

                return [
                    'id' => $order->id,
                    'order_number' => $order->order_number ?? '#ORD-' . str_pad($order->id, 4, '0', STR_PAD_LEFT),
                    'total' => '₦' . number_format($order->total, 2),
                    'total_raw' => $order->total,
                    'status' => ucfirst($status),
                    'date' => $order->created_at->format('M d, Y'),
                    'created_at' => $order->created_at,
                    'status_color_bg' => $colors['bg'],
                    'status_color_text' => $colors['text'],
                    'items_count' => $order->items->count(),
                    'items' => $order->items->map(function ($item) {
                        return [
                            'id' => $item->id,
                            'product_name' => $item->product?->name ?? 'Unknown',
                            'quantity' => $item->quantity,
                            'price' => $item->price,
                        ];
                    })->toArray(),
                ];
            });

        return response()->json([
            'orders' => $orders->values()->toArray(),
        ]);
    }
}