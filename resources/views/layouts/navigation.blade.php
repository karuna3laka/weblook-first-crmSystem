<nav x-data="{ open: false }" class="bg-white border-b border-gray-200 shadow-sm fixed w-full z-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between h-16 items-center">
        <!-- Logo / Brand -->
        <div>
            <a href="{{ route('dashboard') }}" class="text-xl font-semibold text-gray-900 tracking-tight">
                Weblook CRM - Karun3laka
            </a>
        </div>

        <!-- Desktop Nav Links -->
        <div class="hidden sm:flex space-x-6 items-center">
            <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-black transition {{ request()->routeIs('dashboard') ? 'font-bold' : '' }}">
                Dashboard
            </a>
            <a href="{{ route('customers.index') }}" class="text-gray-700 hover:text-black transition {{ request()->routeIs('customers.*') ? 'font-bold' : '' }}">
                Customers
            </a>
            <a href="{{ route('invoices.index') }}" class="text-gray-700 hover:text-black transition {{ request()->routeIs('invoices.*') ? 'font-bold' : '' }}">
                Invoices
            </a>
            <a href="{{ route('proposals.index') }}" class="text-gray-700 hover:text-black transition {{ request()->routeIs('proposals.*') ? 'font-bold' : '' }}">
                Proposals
            </a>
            <a href="{{ route('profile') }}" class="text-gray-700 hover:text-black transition {{ request()->routeIs('profile') ? 'font-bold' : '' }}">
                Profile
            </a>

            <!-- Logout -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="bg-black hover:bg-red-900 text-white px-4 py-2 rounded-xl transition">
                    Logout
                </button>
            </form>
        </div>

        <!-- Mobile Hamburger -->
        <div class="sm:hidden">
            <button @click="open = ! open" class="p-2 rounded-md text-gray-600 hover:bg-gray-100 focus:outline-none">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{ 'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                          stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16"/>
                    <path :class="{ 'hidden': ! open, 'inline-flex': open }" class="hidden"
                          stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div :class="{ 'block': open, 'hidden': ! open }" class="hidden sm:hidden bg-white border-t border-gray-200">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                Dashboard
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('customers.index')" :active="request()->routeIs('customers.*')">
                Customers
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('invoices.index')" :active="request()->routeIs('invoices.*')">
                Invoices
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('proposals.index')" :active="request()->routeIs('proposals.*')">
                Proposals
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('profile')" :active="request()->routeIs('profile')">
                Profile
            </x-responsive-nav-link>

            <!-- Mobile Logout -->
            <form method="POST" action="{{ route('logout') }}" class="border-t border-gray-200">
                @csrf
                <x-responsive-nav-link :href="route('logout')"
                    onclick="event.preventDefault(); this.closest('form').submit();">
                    Logout
                </x-responsive-nav-link>
            </form>
        </div>
    </div>
</nav>
