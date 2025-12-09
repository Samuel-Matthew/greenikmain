 <div x-show="currentTab === 'settings'" class="space-y-6">
                    <h2 class="text-2xl font-bold text-white mb-6">System Settings</h2>

                    <div class="bg-dark-card p-6 rounded-xl border border-dark-border">
                        <!-- Tabs for settings -->
                        <div class="flex border-b border-dark-border mb-6">
                            <button class="px-4 py-2 text-greenik-500 border-b-2 border-greenik-500">General</button>
                            <button class="px-4 py-2 text-gray-400 hover:text-white">Payments (API)</button>
                            <button class="px-4 py-2 text-gray-400 hover:text-white">Shipping</button>
                            <button class="px-4 py-2 text-gray-400 hover:text-white">Security</button>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm text-gray-400 mb-1">Store Name</label>
                                <input type="text" value="Greenik Solutions"
                                    class="w-full bg-dark-bg border border-dark-border rounded p-2 text-white">
                            </div>
                            <div>
                                <label class="block text-sm text-gray-400 mb-1">Support Email</label>
                                <input type="email" value="support@greenik.com"
                                    class="w-full bg-dark-bg border border-dark-border rounded p-2 text-white">
                            </div>
                            <div>
                                <label class="block text-sm text-gray-400 mb-1">Currency</label>
                                <select class="w-full bg-dark-bg border border-dark-border rounded p-2 text-white">
                                    <option>USD ($)</option>
                                    <option>NGN (₦)</option>
                                    <option>EUR (€)</option>
                                </select>
                            </div>
                        </div>
                        <div class="mt-6 text-right">
                            <button
                                class="bg-greenik-600 text-black px-6 py-2 rounded font-bold hover:bg-greenik-500">Save
                                Configuration</button>
                        </div>
                    </div>
                </div>