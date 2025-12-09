<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class PageController extends Controller
{
    public function index()
    {
        return view('guest.index');
    }
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

        return view('guest.product', compact('products', 'brands', 'selectedCategory'));
    }
    public function solution()
    {
        return view('guest.solutions');
    }
    public function about()
    {
        return view('guest.about');
    }
    public function contact()
    {
        return view('guest.contact');
    }
}
