<!-- TOP HEADER -->
<header class="h-16 flex items-center justify-between px-6 bg-dark-card border-b border-dark-border">
    <button @click="sidebarOpen = !sidebarOpen" class="text-gray-400 hover:text-white focus:outline-none">
        <i class="fas fa-bars text-xl"></i>
    </button>

    <div class="flex items-center gap-6">
        <!-- Search -->
        <div class="relative hidden md:block">
            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
                <i class="fas fa-search"></i>
            </span>
            <input
                class="bg-dark-bg border border-dark-border text-sm rounded-full pl-10 pr-4 py-2 focus:border-greenik-500 focus:ring-0 outline-none text-white w-64"
                type="text" placeholder="Search orders, products...">
        </div>

        <!-- Notifications -->
        <button class="relative text-gray-400 hover:text-white">
            <i class="fas fa-bell"></i>
            <span class="absolute top-0 right-0 block h-2 w-2 rounded-full ring-2 ring-dark-card bg-red-500"></span>
        </button>


        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <div class="text-red-500">
                <i class="fas fa-sign-out-alt text-red-500"></i> Logout
            </div>
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
            @csrf
        </form>

    </div>
</header>