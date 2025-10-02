<nav x-data="{ open: false }" class="sticky top-0 z-50 bg-white border-b border-gray-100 shadow">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16"> <!-- items-center เพื่อให้อยู่กลางแนวตั้ง -->

          <!-- Left: Logo + Links -->
<div class="flex items-center space-x-8">
  <!-- Logo --> <div class="shrink-0 flex items-center"> <a href="{{ route('dashboard') }}"> <img src="{{ asset('images/โก้.png') }}" alt="Collecta Logo" class="h-16 md:h-21 mx-auto"> </a> </div>

                <!-- Navigation Links -->
                <div class="hidden sm:flex space-x-8">
                    <x-nav-link :href="route('products.index')" :active="request()->routeIs('products.index')">
                        {{ __('หน้าแรก') }}
                    </x-nav-link>

                    @auth
                        @if(Auth::user()->isAdmin())
                            <x-nav-link :href="route('products.create')" :active="request()->routeIs('products.create')">
                                {{ __('เพิ่มสินค้าใหม่') }}
                            </x-nav-link>
                        @else
                            <x-nav-link :href="route('cart.index')" :active="request()->routeIs('cart.index')">
                                {{ __('ตะกร้า') }}
                                @if(session('cart') && count(session('cart')) > 0)
                                    <span class="ml-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                                        {{ count(session('cart')) }}
                                    </span>
                                @endif
                            </x-nav-link>
                        @endif
                    @endauth

                    @guest
                        <x-nav-link :href="route('cart.index')" :active="request()->routeIs('cart.index')">
                            {{ __('ตะกร้า') }}
                            @if(session('cart') && count(session('cart')) > 0)
                                <span class="ml-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                                    {{ count(session('cart')) }}
                                </span>
                            @endif
                        </x-nav-link>
                    @endguest
                </div>
            </div>

            <!-- Right Side: Login/Register or User Dropdown -->
            <div class="hidden sm:flex items-center gap-4">
                @guest
                    <a href="{{ route('login') }}" class="btn-pastel-pink">
                        🔑 เข้าสู่ระบบ
                    </a>
                    <a href="{{ route('register') }}" class="btn-pastel-orange">
                        📝 สมัครสมาชิก
                    </a>
                @endguest

                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 transition">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            @if(Auth::user()->isAdmin())
                                <x-dropdown-link :href="route('products.create')">
                                    {{ __('เพิ่มสินค้าใหม่') }}
                                </x-dropdown-link>
                            @endif

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @endauth
            </div>

            <!-- Hamburger (Mobile) -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu (Mobile) -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('products.index')" :active="request()->routeIs('products.index')">
                {{ __('หน้าแรก') }}
            </x-responsive-nav-link>

            @auth
                @if(Auth::user()->isAdmin())
                    <x-responsive-nav-link :href="route('products.create')" :active="request()->routeIs('products.create')">
                        {{ __('เพิ่มสินค้าใหม่') }}
                    </x-responsive-nav-link>
                @else
                    <x-responsive-nav-link :href="route('cart.index')" :active="request()->routeIs('cart.index')">
                        {{ __('ตะกร้า') }}
                        @if(session('cart') && count(session('cart')) > 0)
                            <span class="ml-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                                {{ count(session('cart')) }}
                            </span>
                        @endif
                    </x-responsive-nav-link>
                @endif
            @endauth

            @guest
                <x-responsive-nav-link :href="route('cart.index')" :active="request()->routeIs('cart.index')">
                    {{ __('ตะกร้า') }}
                    @if(session('cart') && count(session('cart')) > 0)
                        <span class="ml-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                            {{ count(session('cart')) }}
                        </span>
                    @endif
                </x-responsive-nav-link>
            @endguest
        </div>

        <!-- Right Side Mobile -->
        <div class="pt-4 pb-1 border-t border-gray-200 px-4 flex flex-col gap-2">
            @guest
                <a href="{{ route('login') }}" class="w-full text-center px-4 py-2 rounded-lg bg-green-600 text-white font-semibold shadow hover:bg-green-700 transition">
                    🔑 เข้าสู่ระบบ
                </a>
                <a href="{{ route('register') }}" class="w-full text-center px-4 py-2 rounded-lg bg-white border border-green-600 text-green-700 font-semibold shadow hover:bg-green-50 transition">
                    📝 สมัครสมาชิก
                </a>
            @endguest

            @auth
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>

                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                @if(Auth::user()->isAdmin())
                    <x-responsive-nav-link :href="route('products.create')">
                        {{ __('เพิ่มสินค้าใหม่') }}
                    </x-responsive-nav-link>
                @endif

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            @endauth
        </div>
    </div>
</nav>
