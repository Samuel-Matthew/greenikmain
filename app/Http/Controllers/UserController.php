<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Cart;
use App\Models\CartItem;

class UserController extends Controller
{


    // index
    public function index()
    {
        return view('user.index');
    }
    // products
    public function product(Request $request)
    {
        $query = Product::query();

        if ($request->has('category')) {
            $category = $request->input('category');
            $query->whereHas('category', function ($q) use ($category) {
                $q->where('name', 'like', '%' . $category . '%');
            });
        }

        $products = $query->get();
        $brands = Product::all()->pluck('brand')->unique()->filter()->sort()->values();
        $selectedCategory = $request->input('category', null);

        return view('user.product', compact('products', 'brands', 'selectedCategory'));
    }
    // solutions
    public function solutions()
    {
        return view('user.solutions');
    }

    // about
    public function about()
    {
        return view('user.about');
    }

    // contact
    public function contact()
    {
        return view('user.contact');
    }

    // profile
    public function profile()
    {
        return view('user.profile');
    }

    // checkout
    public function checkout(Request $request)
    {
        $cart = Cart::where('user_id', auth()->id())->first();

        // Get selected items from query parameters
        $selectedIds = $request->query('selected_items', []);

        if (empty($selectedIds)) {
            // If no items specified, get all cart items
            $cartItems = $cart ? $cart->items()->with('product')->get() : collect();
        } else {
            // Get only selected items
            $cartItems = $cart ? $cart->items()->whereIn('id', $selectedIds)->with('product')->get() : collect();

            if ($cartItems->isEmpty()) {
                return redirect()->route('user.cart')->with('error', 'Invalid items selected');
            }
        }

        return view('user.checkout', compact('cartItems'));
    }

    // order confirmed
    // public function orderconfirmed($id)
    // {
    //     $order = Order::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
    //     $order->load('items.product');
    //     return view('user.orderconfirmed', compact('order'));
    // }
    // cart
    public function cart()
    {
        $cart = Cart::where('user_id', auth()->id())->first();
        $cartItems = $cart ? $cart->items()->with('product')->get() : collect();
        return view('user.cart', compact('cartItems'));
    }

    // settings
    public function settings()
    {
        return view('user.settings');
    }

    // orders
    public function orders()
    {
        $orders = Order::where('user_id', auth()->id())->get();
        return view('user.orders', compact('orders'));
    }

    // orderdetails
    public function orderDetails($id)
    {
        $order = Order::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        return view('user.orders.show', compact('order'));
    }
}
