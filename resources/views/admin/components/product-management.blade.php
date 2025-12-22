<div x-show="currentTab === 'products'" class="space-y-6">
    <div class="flex flex-col md:flex-row justify-between items-center">
        <h2 class="text-2xl font-bold text-white">Product Inventory</h2>
        <div class="flex gap-3 mt-4 md:mt-0">
            <button class="px-4 py-2 bg-dark-card border border-dark-border rounded text-sm hover:text-white"><i
                    class="fas fa-file-export mr-2"></i>Export</button>
            <button @click="modalOpen = true"
                class="px-4 py-2 bg-greenik-600 hover:bg-greenik-500 text-black font-bold rounded text-sm"><i
                    class="fas fa-plus mr-2"></i>Add Product</button>
        </div>
    </div>

    <!-- Filters -->
    <div class="flex gap-4 mb-4">
        <select class="bg-dark-card border border-dark-border text-sm rounded px-3 py-2 outline-none w-40">
            <option>All Categories</option>
            <option>Solar</option>
            <option>Wind</option>
        </select>
        <select class="bg-dark-card border border-dark-border text-sm rounded px-3 py-2 outline-none w-40">
            <option>All Status</option>
            <option>Published</option>
            <option>Draft</option>
        </select>
    </div>

    <!-- Product Table -->
    <div class="bg-dark-card rounded-xl border border-dark-border overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead class="bg-[#309983]/10 text-gray-400 text-xs uppercase">
                <tr>
                    <th class="p-4">Product</th>
                    <th class="p-4">Category</th>
                    <th class="p-4">Brand/Store</th>
                    <th class="p-4">Stock</th>
                    <th class="p-4">Price</th>
                    <th class="p-4">Status</th>
                    <th class="p-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-800 text-sm">
                @forelse($products as $product)
                    @php
                        $stock = isset($product->stock) ? (int) $product->stock : 0;
                        $barWidth = $stock > 100 ? 100 : $stock;
                        if ($stock <= 0) {
                            $barClass = 'bg-gray-700';
                            $statusText = 'Out of stock';
                            $statusBadge = 'bg-gray-800/40 text-gray-300 border-gray-800';
                        } elseif ($stock < 10) {
                            $barClass = 'bg-red-500';
                            $statusText = 'Low Stock';
                            $statusBadge = 'bg-red-900/40 text-red-400 border-red-900';
                        } elseif ($stock < 50) {
                            $barClass = 'bg-yellow-500';
                            $statusText = 'Low Stock';
                            $statusBadge = 'bg-yellow-900/40 text-yellow-400 border-yellow-900';
                        } else {
                            $barClass = 'bg-greenik-500';
                            $statusText = 'Published';
                            $statusBadge = 'bg-green-900/40 text-green-400 border-green-900';
                        }

                        $img = 'https://via.placeholder.com/40';
                        if (!empty($product->image_url)) {
                            if (is_array($product->image_url) && count($product->image_url)) {
                                $img = '/storage/' . $product->image_url[0];
                            } elseif (is_string($product->image_url)) {
                                $img = '/storage/' . $product->image_url;
                            }
                        }

                        $categoryName = $product->category->name ?? '-';
                        $brand = $product->brand ?? '-';
                        $price = isset($product->price) ? number_format($product->price, 2) : '0.00';
                    @endphp
                    <tr class="hover:bg-[#309983]/10 transition">
                        <td class="p-4 flex items-center gap-3">
                            <img src="{{ $img }}" class="w-10 h-10 rounded object-cover">
                            <span class="font-medium text-white">{{ $product->name }}</span>
                        </td>
                        <td class="p-4">{{ $categoryName }}</td>
                        <td class="p-4">{{ $brand }}</td>
                        <td class="p-4">
                            <div class="w-full bg-gray-700 rounded-full h-1.5 w-20 mb-1">
                                <div class="{{ $barClass }} h-1.5 rounded-full" style="width: {{ $barWidth }}%"></div>
                            </div>
                            @if($stock > 0)
                                <span class="text-xs{{ $stock < 10 ? ' text-red-400' : '' }}">{{ $stock }} in stock</span>
                            @else
                                <span class="text-xs text-gray-400">Out of stock</span>
                            @endif
                        </td>
                        <td class="p-4 text-white font-bold">₦{{ $price }}</td>
                        <td class="p-4"><span
                                class="px-2 py-1 {{ $statusBadge }} rounded text-xs border">{{ $statusText }}</span></td>
                        <td class="p-4 text-right">
                            <button @click="loadProductEdit({
                                                                id: {{ $product->id }},
                                                                name: '{{ addslashes($product->name) }}',
                                                                category_id: '{{ $product->category_id }}',
                                                                brand: '{{ addslashes($product->brand ?? '') }}',
                                                                description: '{{ addslashes($product->description) }}',
                                                                price: '{{ $product->price }}',
                                                                stock: '{{ $product->stock }}',
                                                                sku: '{{ $product->sku ?? '' }}',
                                                                meta_title: '{{ addslashes($product->meta_title ?? '') }}',
                                                                meta_description: '{{ addslashes($product->meta_description ?? '') }}',
                                                                image_url: {{ json_encode($product->image_url ?? []) }}
                                                            })" class="text-gray-400 hover:text-white mx-1"><i
                                    class="fas fa-edit"></i></button>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline-block"
                                onsubmit="return confirm('Delete this product?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-gray-400 hover:text-red-500 mx-1"><i
                                        class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="p-4 text-center text-gray-400" colspan="7">No products found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>