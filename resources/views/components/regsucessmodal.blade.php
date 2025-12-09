<!-- ================= SUCCESS MODAL ================= -->
<div x-show="successOpen" class="fixed inset-0 z-[60] flex items-center justify-center p-4 bg-black/90 backdrop-blur-md"
    x-cloak>
    <div class="bg-greenik-card border border-greenik-border rounded-2xl p-8 max-w-sm w-full text-center">
        <div
            class="w-16 h-16 bg-greenik-primary/20 rounded-full flex items-center justify-center mx-auto mb-4 text-greenik-primary">
            <i class="fa-solid fa-check text-3xl"></i>
        </div>
        <h2 class="text-2xl font-bold text-white mb-2">Registration successful</h2>
        <p class="text-gray-400 mb-6">Thank you for going green with Greenik.</p>
        <button @click="resetStore()"
            class="w-full bg-greenik-primary text-greenik-dark font-bold py-3 rounded-lg hover:bg-greenik-primaryHover transition">Go
            to login</button>
    </div>
</div>