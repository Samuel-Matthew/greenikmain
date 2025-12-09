<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Transaction;
use App\Models\Product;

class CartController extends Controller
{
    // Add to cart
    public function addToCart(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = Cart::firstOrCreate(
            ['user_id' => auth()->id()],
            ['status' => 'active']
        );

        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $validated['product_id'])
            ->first();

        if ($cartItem) {
            $cartItem->quantity += $validated['quantity'];
            $cartItem->save();
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $validated['product_id'],
                'quantity' => $validated['quantity']
            ]);
        }

        return redirect()->back()->with('success', 'Item added to cart!');
    }

    // Update cart item quantity
    public function updateCart(Request $request, CartItem $cartItem)
    {
        if ($cartItem->cart->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cartItem->update(['quantity' => $validated['quantity']]);

        // Return JSON for AJAX requests
        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'message' => 'Cart updated!']);
        }

        return redirect()->back()->with('success', 'Cart updated!');
    }

    // Remove item from cart
    public function removeFromCart(Request $request, CartItem $cartItem)
    {
        if ($cartItem->cart->user_id !== auth()->id()) {
            abort(403);
        }

        $cartItem->delete();

        // Return JSON for AJAX requests
        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'message' => 'Item removed from cart!']);
        }

        return redirect()->back()->with('success', 'Item removed from cart!');
    }

    // Process checkout
    public function processCheckout(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'shipping_address' => 'required|string|min:10',
            'phone' => 'required|string',
            'selected_items' => 'required|array|min:1',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'city' => 'required|string',
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
                'address' => $validated['shipping_address'],
                'phone' => $validated['phone'],
                'city' => $validated['city'],
                'state' => $validated['state'],
                'postal_code' => $validated['postal_code'],
                'payment_method' => 'paystack',
                'total' => 0,
                'subtotal' => 0,
                'shipping_fee' => 15.00,
                'tax' => 0,
                'status' => 'processing'
            ]);

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
                $item->delete();
            }

            $shipping = 15.00;
            $tax = $subtotal * 0.01;
            $total = $subtotal + $shipping + $tax;

            $order->update([
                'total' => $total,
                'subtotal' => $subtotal,
                'shipping_fee' => $shipping,
                'tax' => $tax
            ]);

            return response()->json([
                'success' => true,
                'order_id' => $order->id,
                'amount' => $total,
                'email' => $validated['email'],
                'message' => 'Order created successfully. Ready for payment.'
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error processing order: ' . $e->getMessage()], 500);
        }
    }
}

