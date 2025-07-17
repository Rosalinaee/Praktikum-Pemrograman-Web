<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    @auth
                        @if (auth()->user()->role === 'admin')
                            <x-nav-link :href="route('products.index')" :active="request()->routeIs('products.*')">Produk</x-nav-link>
                            <x-nav-link :href="route('categories.index')" :active="request()->routeIs('categories.*')">Kategori</x-nav-link>
                        @else
                            <x-nav-link :href="route('katalog')" :active="request()->routeIs('katalog')">Katalog</x-nav-link>
                        @endif
                    @endauth
                </div>
            </div>

            <!-- Right Side -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @guest
                    <div class="flex space-x-4">
                        <a class="text-gray-700 hover:text-gray-900" href="{{ route('login.admin') }}">Login Admin</a>
                        <a class="text-gray-700 hover:text-gray-900" href="{{ route('login.user') }}">Login User</a>
                    </div>
                @else
                    <div class="flex items-center space-x-4">
                        <span class="text-gray-700">Halo, {{ Auth::user()->name }} ({{ Auth::user()->role }})</span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="text-red-500 hover:text-red-700" type="submit">Logout</button>
                        </form>
                    </div>
                @endguest
            </div>

            <!-- Hamburger (Mobile) -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        @guest
            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link :href="route('login.admin')">Login Admin</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('login.user')">Login User</x-responsive-nav-link>
            </div>
        @else
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">{{ auth()->user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ auth()->user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">Profile</x-responsive-nav-link>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                            Logout
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @endguest
    </div>
</nav>
