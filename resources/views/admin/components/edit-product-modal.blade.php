<div x-show="modalOpen && editingProduct" x-cloak
    class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 backdrop-blur-sm">
    <div
        class="bg-dark-card w-full max-w-3xl rounded-xl border border-dark-border shadow-2xl overflow-hidden max-h-[90vh] overflow-y-auto">
        <div class="flex justify-between items-center p-6 border-b border-dark-border bg-[#309983]/10">
            <h3 class="text-xl font-bold text-white">Edit Product</h3>
            <button @click="modalOpen = false; editingProduct = null; resetForm()"
                class="text-gray-400 hover:text-white"><i class="fas fa-times"></i></button>
        </div>

        <form id="editProductForm" :action="`{{ url('/products') }}/${editingProduct?.id}`" method="POST"
            enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf
            @method('PATCH')

            <div class="grid grid-cols-2 gap-6">
                <div class="col-span-2">
                    <label class="block text-sm text-gray-400 mb-1">Product Title</label>
                    <input type="text" name="name" x-model="formData.name"
                        class="w-full bg-dark-bg border border-dark-border rounded p-2 text-white" required
                        placeholder="Product title">
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
                        class="w-full bg-dark-bg border border-dark-border rounded p-2 text-white" placeholder="Brand">
                </div>

                <div>
                    <label class="block text-sm text-gray-400 mb-1">Description</label>
                    <textarea name="description" x-model="formData.description"
                        class="w-full bg-dark-bg border border-dark-border rounded p-2 text-white h-20"
                        required></textarea>
                </div>
            </div>

            <div class="grid grid-cols-3 gap-6">
                <div>
                    <label class="block text-sm text-gray-400 mb-1">Price</label>
                    <input type="number" name="price" step="0.01" x-model="formData.price"
                        class="w-full bg-dark-bg border border-dark-border rounded p-2 text-white" required>
                </div>
                <div>
                    <label class="block text-sm text-gray-400 mb-1">Stock Qty</label>
                    <input type="number" name="stock" x-model="formData.stock"
                        class="w-full bg-dark-bg border border-dark-border rounded p-2 text-white" required>
                </div>
                <div>
                    <label class="block text-sm text-gray-400 mb-1">SKU</label>
                    <input type="text" name="sku" x-model="formData.sku"
                        class="w-full bg-dark-bg border border-dark-border rounded p-2 text-white" readonly>
                </div>
            </div>

            <!-- Existing images previews (will submit remaining via existing_images[]) -->

            <div x-data="imageUpload()" @drop.window.prevent="handleDrop($event)">
                <label class="block text-white font-medium">Photos & Media</label>
                <div class="border-t border-dark-border pt-4">
                    <h4 class="text-white font-medium mb-3">Current Images</h4>
                    <div class="flex flex-wrap gap-3">
                        <template x-for="(img, i) in formData.image_url || []" :key="'existing-' + i">
                            <div class="relative w-32 h-32 border border-gray-600 rounded overflow-hidden">
                                <img :src="'/storage/' + img.replace(/\\\\/g, '/')" class="w-full h-full object-cover"
                                    @@error="$el.src='https://via.placeholder.com/128?text=Image+Failed'">
                                <button type="button" @click="removeExistingImage(i)"
                                    class="absolute top-1 right-1 bg-red-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs">x</button>
                                <input type="hidden" name="existing_images[]" :value="img.replace(/\\\\/g, '/')">
                            </div>
                        </template>
                        <div x-show="!(formData.image_url && formData.image_url.length)" class="text-sm text-gray-400">
                            No
                            existing images</div>
                    </div>
                </div>

                <!-- Drag & Drop Area -->
                <div class="relative border-2 border-dashed border-gray-400 rounded-lg p-6 text-center cursor-pointer bg-gray-800 hover:bg-gray-700 mt-4"
                    @dragover.prevent="dragging = true" @dragleave.prevent="dragging = false"
                    @drop.prevent="handleDrop($event)" @click="$refs.fileInput.click()"
                    :class="{'border-blue-500 bg-gray-700': dragging}">

                    <input type="file" name="images[]" multiple class="hidden" x-ref="fileInput"
                        @change="handleFileInput($event)" accept="image/*">

                    <div class="flex flex-col items-center justify-center">
                        <div class="text-2xl text-gray-400">+</div>
                        <div class="text-green-400">Upload new file</div>
                        <div class="text-gray-400 text-sm">or drag and drop PNG, JPG, GIF up to 10MB</div>
                    </div>
                </div>

                <!-- Preview Thumbnails for New Uploads -->
                <div x-show="files.length > 0" class="mt-4">
                    <h4 class="text-white font-medium mb-3">New Images to Upload</h4>
                    <div class="flex flex-wrap gap-3">
                        <template x-for="(file, index) in files" :key="'new-' + index">
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
            </div>

            <!-- Actions -->
            <div class="flex justify-end gap-3 pt-4 border-t border-dark-border">
                <button type="button" @click="modalOpen = false; editingProduct = null; resetForm()"
                    class="px-4 py-2 rounded border border-dark-border text-gray-300 hover:bg-gray-800">Cancel</button>
                <button type="submit"
                    class="px-6 py-2 rounded bg-greenik-600 text-black font-bold hover:bg-greenik-500">Update
                    Product</button>
            </div>
        </form>
    </div>
</div>

<script>
    function imageUpload() {
        return {
            files: [],
            dragging: false,
            allSelectedFiles: new DataTransfer(),

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
            },

            removeExistingImage(index) {
                // Remove from existing images array
                this.formData.image_url.splice(index, 1);
            }
        }
    }
</script>