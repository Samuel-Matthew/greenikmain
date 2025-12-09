<div x-show="currentTab === 'cms'" class="space-y-6">
    <h2 class="text-2xl font-bold text-white mb-6">Website CMS</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Homepage Hero -->
        <div class="bg-dark-card p-6 rounded-xl border border-dark-border">
            <h3 class="font-bold text-white mb-4 border-b border-gray-700 pb-2">Homepage Hero Section
            </h3>
            <div class="space-y-4">
                <div>
                    <label class="block text-xs text-gray-500 mb-1">Main Headline</label>
                    <input type="text" class="w-full bg-dark-bg border border-dark-border rounded px-3 py-2 text-white"
                        value="Power Your World with Clean Energy">
                </div>
                <div>
                    <label class="block text-xs text-gray-500 mb-1">Sub-Headline</label>
                    <textarea
                        class="w-full bg-dark-bg border border-dark-border rounded px-3 py-2 text-white h-20">Affordable solar, wind, and green accessories for every home.</textarea>
                </div>
                <div>
                    <label class="block text-xs text-gray-500 mb-1">Hero Image</label>
                    <div
                        class="border-2 border-dashed border-dark-border rounded p-4 text-center hover:border-greenik-500 cursor-pointer">
                        <p class="text-xs text-gray-400">Click to upload new banner</p>
                    </div>
                </div>
                <button class="w-full bg-greenik-600 text-black font-bold py-2 rounded hover:bg-greenik-500">Save
                    Changes</button>
            </div>
        </div>

        <!-- Banners -->
        <div class="bg-dark-card p-6 rounded-xl border border-dark-border">
            <h3 class="font-bold text-white mb-4 border-b border-gray-700 pb-2">Promotional Banners</h3>
            <div class="space-y-3">
                <div class="flex items-center justify-between bg-dark-bg p-3 rounded border border-dark-border">
                    <span class="text-sm">Black Friday Sale</span>
                    <div
                        class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
                        <input type="checkbox" name="toggle" id="toggle1"
                            class="toggle-checkbox absolute block w-5 h-5 rounded-full bg-white border-4 appearance-none cursor-pointer"
                            checked />
                        <label for="toggle1"
                            class="toggle-label block overflow-hidden h-5 rounded-full bg-greenik-500 cursor-pointer"></label>
                    </div>
                </div>
                <div class="flex items-center justify-between bg-dark-bg p-3 rounded border border-dark-border">
                    <span class="text-sm">Free Shipping Banner</span>
                    <div
                        class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
                        <input type="checkbox" name="toggle" id="toggle2"
                            class="toggle-checkbox absolute block w-5 h-5 rounded-full bg-white border-4 appearance-none cursor-pointer" />
                        <label for="toggle2"
                            class="toggle-label block overflow-hidden h-5 rounded-full bg-gray-600 cursor-pointer"></label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>