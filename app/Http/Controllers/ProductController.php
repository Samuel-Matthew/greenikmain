<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Schema;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')->paginate(15);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = ProductCategory::all();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate incoming data
        $rules = [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:product_categories,id',
            'brand' => 'nullable|string|max:255',
            'sku' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'spec_key' => 'nullable|array',
            'spec_key.*' => 'nullable|string',
            'spec_value' => 'nullable|array',
            'spec_value.*' => 'nullable|string',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:10240'
        ];

        // If sku column exists, enforce unique rule
        if (Schema::hasColumn('products', 'sku')) {
            $rules['sku'] = 'nullable|string|unique:products,sku';
        }

        $validated = $request->validate($rules);

        // Prepare data to insert
        $data = $validated;

        // Generate slug
        $data['slug'] = Str::slug($validated['name']);

        // Handle SKU generation only if column exists
        if (Schema::hasColumn('products', 'sku')) {
            if (empty($data['sku'])) {
                $data['sku'] = $this->generateSKU($data['name']);
            }
        } else {
            unset($data['sku']);
        }

        // Store images
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');
                $imagePaths[] = $path;
            }
        }

        // Store all image paths as array (or null if no images)
        if (!empty($imagePaths)) {
            $data['image_url'] = $imagePaths;
        }

        // Convert specs inputs (spec_key[] / spec_value[]) into a JSON structure
        $specs = null;
        $specKeys = $request->input('spec_key', []);
        $specValues = $request->input('spec_value', []);
        if (!empty($specKeys) && is_array($specKeys)) {
            $specs = [];
            foreach ($specKeys as $i => $key) {
                $key = trim($key);
                if ($key === '')
                    continue;
                $val = isset($specValues[$i]) ? $specValues[$i] : '';
                // Split comma-separated values, trim and filter empties
                $values = array_filter(array_map('trim', explode(',', (string) $val)), fn($v) => $v !== '');
                $specs[$key] = array_values($values);
            }
        }

        if (!empty($specs)) {
            $data['specs'] = $specs;
        }

        // Always remove spec_key and spec_value from data - they're processed into specs
        unset($data['spec_key'], $data['spec_value']);

        // Create product
        $product = Product::create($data);

        // Store additional images metadata if needed
        if (!empty($imagePaths) && count($imagePaths) > 1) {
            // You can store additional images in a separate table or JSON
            // For now, storing first image. Extend this as needed.
        }

        return redirect()->route('admin.dashboard')->with('success', 'Product created successfully')->with('tab', 'products');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = ProductCategory::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {

        $rules = [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:product_categories,id',
            'brand' => 'nullable|string|max:255',
            'sku' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'spec_key' => 'nullable|array',
            'spec_key.*' => 'nullable|string',
            'spec_value' => 'nullable|array',
            'spec_value.*' => 'nullable|string',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:10240'
        ];

        if (Schema::hasColumn('products', 'sku')) {
            $rules['sku'] = 'nullable|string|unique:products,sku,' . $product->id;
        }

        $validated = $request->validate($rules);

        $data = $validated;

        $data['slug'] = Str::slug($validated['name']);

        // Handle images - merge new uploads with existing images
        $imagePaths = [];

        // Get existing images that weren't deleted
        $existingImages = $request->input('existing_images', []);
        if (!empty($existingImages)) {
            $imagePaths = is_array($existingImages) ? $existingImages : [$existingImages];
        }

        // Add new uploads to the array
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');
                $imagePaths[] = $path;
            }
        }

        // Only update image_url if there are images to save
        if (!empty($imagePaths)) {
            $data['image_url'] = $imagePaths;
        } else {
            // If no images, don't update the field (keep existing)
            unset($data['image_url']);
        }

        // Handle SKU
        if (Schema::hasColumn('products', 'sku')) {
            if (empty($data['sku'])) {
                $data['sku'] = $this->generateSKU($data['name']);
            }
        } else {
            unset($data['sku']);
        }

        // Convert specs inputs into JSON-compatible array
        $specKeys = $request->input('spec_key', []);
        $specValues = $request->input('spec_value', []);
        $specs = [];
        if (!empty($specKeys) && is_array($specKeys)) {
            foreach ($specKeys as $i => $key) {
                $key = trim($key);
                if ($key === '')
                    continue;
                $val = isset($specValues[$i]) ? $specValues[$i] : '';
                $values = array_filter(array_map('trim', explode(',', (string) $val)), fn($v) => $v !== '');
                $specs[$key] = array_values($values);
            }
        }

        if (!empty($specs)) {
            $data['specs'] = $specs;
        }

        // Always remove spec_key and spec_value from data
        unset($data['spec_key'], $data['spec_value']);

        $product->update($data);

        return redirect()->route('admin.dashboard')->with('success', 'Product updated successfully')->with('tab', 'products');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json([
            'success' => true,
            'message' => 'Product deleted successfully'
        ]);
    }

    /**
     * Generate a unique SKU
     */
    private function generateSKU($productName)
    {
        $basesku = strtoupper(substr($productName, 0, 3)) . '-' . strtoupper(substr($productName, -3));
        $sku = $basesku;
        $counter = 1;

        while (Product::where('sku', $sku)->exists()) {
            $sku = $basesku . '-' . $counter;
            $counter++;
        }

        return $sku;
    }
}

