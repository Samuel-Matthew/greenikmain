<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display the user's orders.
     */
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())
            ->with('items.product')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('user.myorders', compact('orders'));
    }

    /**
     * Display order details.
     */
    public function details(Order $order)
    {
        // Check if user owns this order
        if ($order->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        $order->load('items.product');

        return view('user.order-details', compact('order'));
    }

    /**
     * Display failed order details.
     */
    public function failedOrder(Order $order)
    {
        // Check if user owns this order
        if ($order->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        // Check if order status is cancelled
        if ($order->status !== 'cancelled') {
            abort(403, 'This order was not cancelled');
        }

        $order->load('items.product', 'transaction');

        return view('user.failedorder', compact('order'));
    }

    /**
     * Generate order invoice.
     */
    public function invoice(Order $order)
    {
        // Check if user owns this order
        if ($order->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        $order->load('items.product');

        // TODO: Generate PDF invoice
        return view('user.order-invoice', compact('order'));
    }

    /**
     * Store a newly created order.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'total' => 'required|numeric|min:0',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric|min:0',
        ]);

        $order = Order::create([
            'user_id' => auth()->id(),
            'total' => $validated['total'],
            'status' => 'pending',
        ]);

        foreach ($validated['items'] as $item) {
            $order->items()->create([
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        return response()->json([
            'message' => 'Order created successfully',
            'order' => $order,
        ], 201);
    }

    /**
     * Update order status.
     */
    public function updateStatus(Order $order, Request $request)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,failed,shipped,delivered,cancelled',
        ]);

        $order->update(['status' => $validated['status']]);

        return response()->json([
            'message' => 'Order status updated',
            'order' => $order,
        ]);
    }

    /**
     * Get all orders with live data from database
     */
    public function getAllOrders()
    {
        try {
            $orders = Order::with('items.product', 'user')
                ->orderBy('created_at', 'desc')
                ->get()
                ->map(function ($order) {
                    return [
                        'id' => $order->order_number,
                        'customer' => $order->first_name . ' ' . $order->last_name,
                        'email' => $order->email,
                        'location' => $order->city . ', NG',
                        'date' => $order->created_at->format('M d, Y'),
                        'method' => $order->payment_method,
                        'status' => ucfirst($order->status),
                        'total' => '₦' . number_format($order->total, 2),
                        'items' => $order->items->map(function ($item) {
                            return [
                                'name' => $item->product->name,
                                'variant' => $item->product->category->name ?? 'N/A',
                                'price' => '₦' . number_format($item->price * $item->quantity, 2),
                                'qty' => $item->quantity
                            ];
                        })->toArray()
                    ];
                });

            return response()->json([
                'success' => true,
                'data' => $orders
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching orders: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update order status
     */
    public function updateOrderStatus(Request $request)
    {
        try {
            $validated = $request->validate([
                'order_id' => 'required|string',
                'status' => 'required|string|in:processing,paid,shipped,delivered,cancelled'
            ]);

            $order = Order::where('order_number', $validated['order_id'])->first();

            if (!$order) {
                return response()->json([
                    'success' => false,
                    'message' => 'Order not found with ID: ' . $validated['order_id']
                ], 404);
            }

            $oldStatus = $order->status;
            $order->update([
                'status' => strtolower($validated['status'])
            ]);

            \Log::info('Order status updated', [
                'order_number' => $validated['order_id'],
                'old_status' => $oldStatus,
                'new_status' => strtolower($validated['status'])
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Order status updated successfully',
                'order' => $order
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error: ' . implode(', ', $e->errors()['status'] ?? $e->errors()['order_id'] ?? ['Unknown validation error'])
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Error updating order status', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Error updating order: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show order confirmation page
     */
    public function orderConfirmed($id)
    {
        $order = Order::with('items.product')->findOrFail($id);
        return view('user.orderconfirmed', compact('order'));
    }
}

