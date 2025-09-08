<nav x-data="{ open: false }" class="bg-white shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            
            <!-- Left Section (Logo + Links) -->
            <div class="flex items-center space-x-8">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center space-x-2">
                    <x-application-logo class="h-8 w-auto text-indigo-600" />
                    <span class="text-xl font-bold text-gray-800 tracking-wide">DGAPR STORE</span>
                </a>

                <!-- Nav Links -->
                <div class="hidden md:flex items-center space-x-6">
                    @hasanyrole('admin|super_admin')
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            Dashboard
                        </x-nav-link>
                    @endhasanyrole

                    @role('super_admin')
                        <x-nav-link :href="route('superadmin.admin.index')" :active="request()->routeIs('superadmin.admin.index')">
                            Admin Manager
                        </x-nav-link>
                    @endrole
                </div>
            </div>

            <!-- Right Section (Cart + User) -->
            <div class="flex items-center space-x-6">
                
                <!-- Cart -->
                <a href="{{ route('cart.index') }}" class="relative text-gray-600 hover:text-indigo-600 transition">
                    <i class="bi bi-cart-fill text-2xl"></i>
                    <span id="cart-count"
                          class="absolute -top-2 -right-3 bg-indigo-600 text-white text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center shadow">
                        {{ $cartCount ?? 0 }}
                    </span>
                </a>

                <!-- Authenticated -->
                @if (Auth::check())
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center space-x-2 text-gray-700 hover:text-indigo-600 focus:outline-none">
                                <span class="font-medium">{{ Auth::user()->name }}</span>
                                <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 
                                    0L10 10.586l3.293-3.293a1 1 0 
                                    111.414 1.414l-4 4a1 1 0 
                                    01-1.414 0l-4-4a1 1 0 
                                    010-1.414z" clip-rule="evenodd"/>
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">Profile</x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    Log Out
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <!-- Guest -->
                    <div class="hidden sm:flex items-center space-x-4">
                        <a href="{{ route('login') }}" class="text-sm font-medium text-gray-600 hover:text-indigo-600">Login</a>
                        <a href="{{ route('register') }}" class="px-3 py-1 rounded-md bg-indigo-600 text-white text-sm font-medium hover:bg-indigo-700">Register</a>
                    </div>
                @endif

                <!-- Mobile Hamburger -->
                <div class="sm:hidden">
                    <button @click="open = !open"
                        class="p-2 rounded-md text-gray-600 hover:text-indigo-600 hover:bg-gray-100 transition">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"/>
                            <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div :class="{'block': open, 'hidden': !open}" class="sm:hidden bg-white border-t">
        <div class="px-4 py-3 space-y-2">
            @hasanyrole('admin|super_admin')
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">Dashboard</x-responsive-nav-link>
            @endhasanyrole
            @role('super_admin')
                <x-responsive-nav-link :href="route('superadmin.admin.index')" :active="request()->routeIs('superadmin.admin.index')">Admin Manager</x-responsive-nav-link>
            @endrole
        </div>

        @if (Auth::check())
            <div class="border-t px-4 py-3">
                <div class="font-medium text-gray-800">{{ Auth::user()->name }}</div>
                <div class="text-sm text-gray-500">{{ Auth::user()->email }}</div>
                <form method="POST" action="{{ route('logout') }}" class="mt-2">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        Log Out
                    </x-responsive-nav-link>
                </form>
            </div>
        @else
            <div class="border-t px-4 py-3 space-y-2">
                <a href="{{ route('login') }}" class="block text-sm font-medium text-gray-600 hover:text-indigo-600">Login</a>
                <a href="{{ route('register') }}" class="block text-sm font-medium text-indigo-600">Register</a>
            </div>
        @endif
    </div>
</nav>
