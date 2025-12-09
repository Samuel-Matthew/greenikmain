<div x-show="!['dashboard', 'products', 'orders', 'cms', 'settings','payments','customers','inventory'].includes(currentTab)"
    class="flex flex-col items-center justify-center h-96 text-center">
    <div class="bg-dark-card p-8 rounded-full mb-4">
        <i class="fas fa-tools text-4xl text-gray-600"></i>
    </div>
    <h2 class="text-2xl font-bold text-white">Feature Section Not Ready</h2>
    <p class="text-gray-400 mt-2 max-w-md">The UI structure for <span x-text="currentTab"
            class="capitalize font-bold text-greenik-500"></span> is in progress..</p>
</div>