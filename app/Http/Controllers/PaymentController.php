<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Transaction;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    /**
     * Show checkout page
     */
    public function checkout(Request $request)
    {
        $cart = Cart::where('user_id', auth()->id())->first();

        // Get selected items from query parameters
        $selectedIds = $request->query('selected_items', []);

        $cartItems = $cart
            ? ($selectedIds
                ? $cart->items()->whereIn('id', $selectedIds)->with('product')->get()
                : $cart->items()->with('product')->get())
            : collect();

        if ($selectedIds && $cartItems->isEmpty()) {
            return redirect()->route('user.cart')->with('error', 'Invalid items selected');
        }

        return view('user.checkout', compact('cartItems'));
    }

    /**
     * Initiate Paystack payment
     */
    public function initiatePayment(Request $request)
    {
        $validated = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'email' => 'required|email',
            'amount' => 'required|numeric|min:1'
        ]);

        $order = Order::where('id', $validated['order_id'])
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $amountInKobo = (int) ($validated['amount'] * 100);

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('PAYSTACK_SECRET_KEY'),
            ])->withoutVerifying()->post('https://api.paystack.co/transaction/initialize', [
                        'email' => $validated['email'],
                        'amount' => $amountInKobo,
                        'metadata' => [
                            'order_id' => $order->id,
                            'user_id' => auth()->id(),
                        ],
                        'channels' => ['bank_transfer', 'card', 'ussd'],

                    ]);

            if (!$response->successful()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to initialize payment'
                ], 400);
            }

            $data = $response->json();

            // Create or update transaction as pending
            Transaction::updateOrCreate(
                [
                    'order_id' => $order->id,
                    'user_id' => auth()->id()
                ],
                [
                    'amount' => $validated['amount'],
                    // change to pending later
                    'status' => 'failed',
                    'payment_method' => 'paystack',
                    'reference' => $data['data']['reference'] ?? null
                ]
            );

            return response()->json([
                'success' => true,
                'data' => $data['data'],
                'authorization_url' => $data['data']['authorization_url']
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Verify Paystack payment - Updates order and transaction status
     */
    public function verifyPayment(Request $request)
    {
        $validated = $request->validate([
            'reference' => 'required|string'
        ]);

        $reference = $validated['reference'];

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('PAYSTACK_SECRET_KEY'),
            ])->withoutVerifying()->get('https://api.paystack.co/transaction/verify/' . $reference);

            if (!$response->successful()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to verify payment',
                    'status' => 'error'
                ], 400);
            }

            $data = $response->json();
            $paymentStatus = $data['data']['status'] ?? null;
            $orderId = $data['data']['metadata']['order_id'] ?? null;
            $userId = $data['data']['metadata']['user_id'] ?? null;

            $order = Order::find($orderId);
            $transaction = Transaction::where('reference', $reference)->first();

            if (!$order || !$transaction) {
                return response()->json([
                    'success' => false,
                    'message' => 'Order or transaction not found',
                    'status' => 'error'
                ], 404);
            }

            // Verify ownership
            if ($order->user_id !== (int) $userId) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized access',
                    'status' => 'error'
                ], 403);
            }

            if ($paymentStatus === 'success') {
                // Payment successful
                $order->update(['status' => 'paid']);
                $transaction->update(['status' => 'success']);

                // Delete cart items only on successful payment
                $cart = Cart::where('user_id', auth()->id())->first();
                if ($cart) {
                    CartItem::where('cart_id', $cart->id)->delete();
                }

                return response()->json([
                    'success' => true,
                    'message' => 'Payment verified successfully',
                    'status' => 'success',
                    'order_id' => $orderId,
                    'order_number' => $order->order_number,

                ]);
            } else {
                // Payment failed or abandoned
                $order->update(['status' => 'cancelled']);
                $transaction->update(['status' => 'failed']);

                return response()->json([
                    'success' => false,
                    'message' => 'Payment was not successful or was abandoned',
                    'status' => 'failed',
                    'payment_status' => $paymentStatus,
                    'order_id' => $orderId
                ], 400);
            }

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage(),
                'status' => 'error'
            ], 500);
        }
    }

    /**
     * Mark transaction as failed
     */
    public function markTransactionFailed(Request $request)
    {
        $validated = $request->validate([
            'reference' => 'required|string'
        ]);

        try {
            $transaction = Transaction::where('reference', $validated['reference'])->first();

            if (!$transaction) {
                return response()->json([
                    'success' => false,
                    'message' => 'Transaction not found'
                ], 404);
            }

            // Verify user owns this transaction
            if ($transaction->user_id !== auth()->id()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized'
                ], 403);
            }

            $order = $transaction->order;

            // Update statuses
            $transaction->update(['status' => 'failed']);
            $order->update(['status' => 'cancelled']);

            return response()->json([
                'success' => true,
                'message' => 'Transaction marked as failed',
                'order_id' => $order->id
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Complete checkout with Paystack payment
     */
    public function completeCheckout(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'shipping_address' => 'required|string|min:10',
            'phone' => 'required|string',
            'selected_items' => 'required|array|min:1',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'postal_code' => 'required|string'
        ]);

        $cart = Cart::where('user_id', auth()->id())->first();
        if (!$cart) {
            return response()->json(['success' => false, 'message' => 'Cart is empty!'], 400);
        }

        $selectedItems = CartItem::whereIn('id', $validated['selected_items'])->get();
        if ($selectedItems->isEmpty()) {
            return response()->json(['success' => false, 'message' => 'No items selected!'], 400);
        }

        try {
            $subtotal = 0;

            // Create order
            $order = Order::create([
                'user_id' => auth()->id(),
                'order_number' => 'GRN-' . str_pad(Order::count() + 1, 5, '0', STR_PAD_LEFT),
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'address' => $validated['shipping_address'],
                'city' => $validated['city'],
                'state' => $validated['state'],
                'postal_code' => $validated['postal_code'],
                'payment_method' => 'paystack',
                'total' => 0,
                'subtotal' => 0,
                'shipping_fee' => 15.00,
                'tax' => 0,
                'status' => 'cancelled'
            ]);

            // Add order items
            foreach ($selectedItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price
                ]);

                $subtotal += $item->product->price * $item->quantity;

                // Reduce stock
                $item->product->decrement('stock', $item->quantity);

                // Remove from cart
                // $item->delete();
            }

            // Calculate totals
            $shipping = 15.00;
            $tax = $subtotal * 0.01;
            $total = $subtotal + $shipping + $tax;

            // Update order with calculated totals
            $order->update([
                'subtotal' => $subtotal,
                'tax' => $tax,
                'total' => $total
            ]);

            // Initialize Paystack payment
            $amountInKobo = (int) ($total * 100);

            $paymentResponse = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('PAYSTACK_SECRET_KEY'),
            ])->withoutVerifying()->post('https://api.paystack.co/transaction/initialize', [
                        'email' => $validated['email'],
                        'amount' => $amountInKobo,
                        'metadata' => [
                            'order_id' => $order->id,
                            'user_id' => auth()->id(),
                        ],
                        'callback_url' => route('payment.callback')
                    ]);

            if (!$paymentResponse->successful()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to initialize payment'
                ], 400);
            }

            $paymentData = $paymentResponse->json();
            $reference = $paymentData['data']['reference'] ?? null;
            $authorizationUrl = $paymentData['data']['authorization_url'] ?? null;

            // Create transaction record
            Transaction::create([
                'order_id' => $order->id,
                'user_id' => auth()->id(),
                'amount' => $total,
                // change to pending later
                'status' => 'failed',
                'payment_method' => 'paystack',
                'reference' => $reference
            ]);

            // Return authorization URL to redirect user to Paystack
            return response()->json([
                'success' => true,
                'message' => 'Redirecting to payment',
                'authorization_url' => $authorizationUrl,
                'order_id' => $order->id
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Handle payment callback from Paystack
     */
    public function paymentCallback(Request $request)
    {
        $reference = $request->query('reference');

        if (!$reference) {
            return redirect()->route('user.cart')->with('error', 'Invalid payment reference');
        }

        try {
            // Verify payment with Paystack
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('PAYSTACK_SECRET_KEY'),
            ])->withoutVerifying()->get('https://api.paystack.co/transaction/verify/' . $reference);

            if (!$response->successful()) {
                return redirect()->route('user.cart')->with('error', 'Failed to verify payment');
            }

            $data = $response->json();
            $paymentStatus = $data['data']['status'] ?? null;

            if ($paymentStatus !== 'success') {
                return redirect()->route('user.cart')->with('error', 'Payment was not successful');
            }

            $orderId = $data['data']['metadata']['order_id'] ?? null;
            $order = Order::find($orderId);
            $transaction = Transaction::where('reference', $reference)->first();

            if ($order && $transaction) {
                // Mark order as paid
                $order->update(['status' => 'paid']);

                // Mark transaction as completed
                $transaction->update(['status' => 'success']);

                // Delete cart items only on successful payment
                $cart = Cart::where('user_id', auth()->id())->first();
                if ($cart) {
                    CartItem::where('cart_id', $cart->id)->delete();
                }

                return redirect()->route('user.orderconfirmedq', $orderId)->with('success', 'Payment successful');
            }

            return redirect()->route('user.cart')->with('error', 'Order or transaction not found');

            // return redirect()->route('user.cart')->with('error', 'Order not found');

        } catch (\Exception $e) {
            return redirect()->route('user.cart')->with('error', 'Error: ' . $e->getMessage());
        }
    }

}
