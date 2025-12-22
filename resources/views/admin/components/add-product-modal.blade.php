<div x-show="modalOpen && !editingProduct"
    class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 backdrop-blur-sm" x-transition x-cloak>
    <div
        class="bg-dark-card w-full max-w-3xl rounded-xl border border-dark-border shadow-2xl overflow-hidden max-h-[90vh] overflow-y-auto">
        <div class="flex justify-between items-center p-6 border-b border-dark-border bg-[#309983]/10">
            <h3 class="text-xl font-bold text-white">Add New Product</h3>
            <button @click="modalOpen = false; resetForm()" class="text-gray-400 hover:text-white"><i
                    class="fas fa-times"></i></button>
        </div>

        <form id="addProductForm" action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data"
            class="p-6 space-y-6">
            @csrf
            <!-- Basic Info -->
            <div class="grid grid-cols-2 gap-6">
                <div class="col-span-2">
                    <label class="block text-sm text-gray-400 mb-1">Product Title</label>
                    <input type="text" name="name" x-model="formData.name"
                        class="w-full bg-dark-bg border border-dark-border rounded p-2 text-white" required
                        placeholder="e.g. 10KW Solar Inverter">
                </div>
                <div>
                    <label class="block text-sm text-gray-400 mb-1">Category</label>
                    <select name="category_id" x-model="formData.category_id"
                        class="w-full bg-dark-bg border border-dark-border rounded p-2 text-white" required>
                        <option value="">-- Select Category --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm text-gray-400 mb-1">Brand / Store</label>
                    <input type="text" name="brand" x-model="formData.brand"
                        class="w-full bg-dark-bg border border-dark-border rounded p-2 text-white"
                        placeholder="e.g. Tesla">
                </div>
                <div>
                    <label class="block text-sm text-gray-400 mb-1">Description</label>
                    <textarea name="description" x-model="formData.description"
                        class="w-full bg-dark-bg border border-dark-border rounded p-2 text-white h-20" required
                        placeholder="Product description..."></textarea>
                </div>
            </div>

            <!-- Pricing & Stock -->
            <div class="grid grid-cols-3 gap-6">
                <div>
                    <label class="block text-sm text-gray-400 mb-1">Price</label>
                    <input type="number" name="price" step="0.01" x-model="formData.price"
                        class="w-full bg-dark-bg border border-dark-border rounded p-2 text-white" required
                        placeholder="0.00">
                </div>
                <div>
                    <label class="block text-sm text-gray-400 mb-1">Stock Qty</label>
                    <input type="number" name="stock" x-model="formData.stock"
                        class="w-full bg-dark-bg border border-dark-border rounded p-2 text-white" required
                        placeholder="0">
                </div>
                <div>
                    <label class="block text-sm text-gray-400 mb-1">SKU (auto-generated)</label>
                    <input type="text" name="sku" x-model="formData.sku"
                        class="w-full bg-dark-bg border border-dark-border rounded p-2 text-white" readonly
                        placeholder="Auto-generated">
                </div>
            </div>

            <!-- Variations -->
            <div id="specs-area" class="border-t border-dark-border pt-4 specs-area">
                <h4 class="text-white font-medium mb-3">Variations</h4>
                <div class="flex gap-4 spec-row">
                    <input name="spec_key[]" type="text"
                        class="bg-dark-bg border border-dark-border rounded p-2 text-white w-1/3"
                        placeholder="Option Name (e.g. Wattage)">
                    <input name="spec_value[]" type="text"
                        class="bg-dark-bg border border-dark-border rounded p-2 text-white flex-1"
                        placeholder="Values (e.g. 5KW, 10KW, 15KW)">
                    <button type="button" onclick="addSpec()" class="bg-gray-700 text-white px-3 rounded"><i
                            class="fas fa-plus"></i></button>
                </div>
            </div>



            <!-- SEO -->
            <div class="border-t border-dark-border pt-4">
                <h4 class="text-white font-medium mb-3">SEO Configuration</h4>
                <div class="space-y-3">
                    <input type="text" name="meta_title" x-model="formData.meta_title"
                        class="w-full bg-dark-bg border border-dark-border rounded p-2 text-white"
                        placeholder="Meta Title">
                    <textarea name="meta_description" x-model="formData.meta_description"
                        class="w-full bg-dark-bg border border-dark-border rounded p-2 text-white h-20"
                        placeholder="Meta Description"></textarea>
                </div>
            </div>


            <!-- images -->
            <div x-data="imageUpload()" @drop.window.prevent="handleDrop($event)">
                <label class="block text-white font-medium">Photos & Media</label>

                <!-- Drag & Drop Area -->
                <div class="relative border-2 border-dashed border-gray-400 rounded-lg p-6 text-center cursor-pointer bg-[#309983]/10 hover:bg-[#309983]/20"
                    @dragover.prevent="dragging = true" @dragleave.prevent="dragging = false"
                    @drop.prevent="handleDrop($event)" @click="$refs.fileInput.click()"
                    :class="{'border-blue-500 bg-gray-700': dragging}">

                    <input type="file" name="images[]" multiple class="hidden" x-ref="fileInput"
                        @change="handleFileInput($event)" accept="image/*">

                    <div class="flex flex-col items-center justify-center">
                        <div class="text-2xl text-gray-400">+</div>
                        <div class="text-green-400">Upload a file</div>
                        <div class="text-gray-400 text-sm">or drag and drop PNG, JPG, GIF up to 10MB</div>
                    </div>
                </div>

                <!-- Preview Thumbnails -->
                <div class="flex flex-wrap gap-3 mt-3">
                    <template x-for="(file, index) in files" :key="index">
                        <div class="relative w-32 h-32 border border-gray-600 rounded overflow-hidden">
                            <img :src="file.url" class="w-full h-full object-cover">
                            <button type="button" @click="removeFile(index)"
                                class="absolute top-1 right-1 bg-red-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs">
                                x
                            </button>
                        </div>
                    </template>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex justify-end gap-3 pt-4 border-t border-dark-border">
                <button type="button" @click="modalOpen = false; resetForm()"
                    class="px-4 py-2 rounded border border-dark-border text-gray-300 hover:bg-gray-800">Cancel</button>
                <button type="submit"
                    class="px-6 py-2 rounded bg-greenik-600 text-black font-bold hover:bg-greenik-500">Save
                    Product</button>
            </div>



            <script>
                function addSpec() {
                    const wrapper = document.getElementById('specs-area');
                    const row = document.createElement('div');
                    row.classList.add('spec-row');
                    row.innerHTML = `
                                  <div class="flex my-2 gap-4 spec-row">
                                <input name="spec_key[]" type="text"
                                    class="bg-dark-bg border border-dark-border rounded p-2 text-white w-1/3"
                                    placeholder="Option Name (e.g. Wattage)">
                                <input name="spec_value[]" type="text"
                                    class="bg-dark-bg border border-dark-border rounded p-2 text-white flex-1"
                                    placeholder="Values (e.g. 5KW, 10KW, 15KW)">
                                    </div>
                            `;
                    wrapper.appendChild(row);
                }

            </script>



            <script>
                function imageUpload() {
                    return {
                        files: [],
                        dragging: false,
                        allSelectedFiles: new DataTransfer(), // Keep track of all selected files

                        handleFileInput(event) {
                            const selectedFiles = event.target.files;

                            // Add new files to the DataTransfer object
                            for (let file of selectedFiles) {
                                this.allSelectedFiles.items.add(file);
                            }

                            // Update the file input with all accumulated files
                            this.$refs.fileInput.files = this.allSelectedFiles.files;

                            // Add to preview
                            this.addFiles(selectedFiles);
                        },

                        handleDrop(event) {
                            this.dragging = false;
                            const selectedFiles = event.dataTransfer.files;

                            // Add dropped files to DataTransfer object
                            for (let file of selectedFiles) {
                                this.allSelectedFiles.items.add(file);
                            }

                            // Update the file input with all accumulated files
                            this.$refs.fileInput.files = this.allSelectedFiles.files;

                            this.addFiles(selectedFiles);
                        },

                        addFiles(selectedFiles) {
                            for (let i = 0; i < selectedFiles.length; i++) {
                                const file = selectedFiles[i];
                                if (!file.type.startsWith('image/')) continue;

                                // Check if file already exists in preview
                                if (this.files.some(f => f.file.name === file.name && f.file.size === file.size)) {
                                    continue;
                                }

                                const reader = new FileReader();
                                reader.onload = (e) => {
                                    this.files.push({
                                        file: file,
                                        url: e.target.result
                                    });
                                };
                                reader.readAsDataURL(file);
                            }
                        },

                        removeFile(index) {
                            // Remove from preview
                            const removedFile = this.files[index];
                            this.files.splice(index, 1);

                            // Remove from tracked files
                            for (let i = 0; i < this.allSelectedFiles.items.length; i++) {
                                const item = this.allSelectedFiles.items[i];
                                if (item.getAsFile().name === removedFile.file.name &&
                                    item.getAsFile().size === removedFile.file.size) {
                                    this.allSelectedFiles.items.remove(i);
                                    break;
                                }
                            }

                            // Update file input
                            this.$refs.fileInput.files = this.allSelectedFiles.files;
                        }
                    }
                }
            </script>
    </div>
    </form>
</div>
</div>