<x-layout>
    <div class="w-full mt-10 mb-28 px-4 md:px-16">
        {{-- Header with Role Badge --}}
        <div class="flex justify-between items-center mb-8">
            <div class="flex items-center gap-4">
                <h1 class="text-2xl font-bold">My Dashboard</h1>
                @if (auth()->user()->is_seller)
                    <span
                        class="px-3 py-1 text-sm font-medium bg-primary-color/10 text-primary-color rounded-full">Seller</span>
                @endif
            </div>
            @if (!auth()->user()->is_seller)
                <a href="{{ route('dashboard.profile') }}" class="text-primary-color hover:text-primary-color/90">
                    Become a Seller
                </a>
            @endif
        </div>

        {{-- Stats Overview --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            @if (auth()->user()->is_seller)
                <x-dashboard.stat-card title="Total Sales" value="{{ $totalSales }}" icon="cash" type="money" />
                <x-dashboard.stat-card title="Active Products" value="{{ $activeProducts }}" icon="box" />
                <x-dashboard.stat-card title="Pending Orders" value="{{ $pendingOrders }}" icon="clock" />
            @else
                <x-dashboard.stat-card title="Total Orders" value="{{ $totalOrders }}" icon="shopping-bag" />
                <x-dashboard.stat-card title="Wishlist Items" value="{{ $wishlistCount }}" icon="heart" />
                <x-dashboard.stat-card title="Active Orders" value="{{ $activeOrders }}" icon="truck" />
            @endif
        </div>

        {{-- Main Content Grid --}}
        <div class="flex flex-col md:flex-row gap-6">
            {{-- Sidebar Navigation --}}
            <aside class="w-full md:w-64 md:sticky md:top-4 md:h-[calc(100vh-8rem)]">
                <nav class="bg-white rounded-lg shadow p-4">
                    <x-dashboard.nav-section title="Account">
                        <x-dashboard.nav-item route="profile" icon="user">Profile</x-dashboard.nav-item>
                        <x-dashboard.nav-item route="address" icon="map">Address</x-dashboard.nav-item>
                    </x-dashboard.nav-section>

                    @if (auth()->user()->is_seller)
                        <x-dashboard.nav-section title="Store Management">
                            <x-dashboard.nav-item route="products" icon="tag">Products</x-dashboard.nav-item>
                            <x-dashboard.nav-item route="orders" icon="shopping-cart">Orders</x-dashboard.nav-item>
                            <x-dashboard.nav-item route="analytics" icon="chart">Analytics</x-dashboard.nav-item>
                        </x-dashboard.nav-section>
                    @else
                        <x-dashboard.nav-section title="Shopping">
                            <x-dashboard.nav-item route="orders" icon="shopping-bag">My Orders</x-dashboard.nav-item>
                            <x-dashboard.nav-item route="wishlist" icon="heart">Wishlist</x-dashboard.nav-item>
                            <x-dashboard.nav-item route="reviews" icon="star">My Reviews</x-dashboard.nav-item>
                        </x-dashboard.nav-section>

                        {{-- New Seller Section --}}
                        <x-dashboard.nav-section title="Seller">
                            <x-dashboard.nav-item route="become-seller" icon="store">Become a
                                Seller</x-dashboard.nav-item>
                        </x-dashboard.nav-section>
                    @endif
                </nav>
            </aside>

            {{-- Main Content Area --}}
            <div class="flex-1">
                <div class="bg-white rounded-lg shadow p-6">
                    {{-- Content placeholder for the active tab --}}
                    <div id="content" class="min-h-[500px]">
                        @yield('dashboard-content')
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Quick Action Buttons --}}
    <div class="fixed bottom-6 right-6 flex flex-col gap-4">
        @if (auth()->user()->is_seller)
            <button onclick="showAddProductModal()"
                class="p-4 bg-primary-color text-white rounded-full shadow-lg hover:bg-primary-color/90">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
            </button>
        @endif
        <button onclick="scrollToTop()" class="p-4 bg-gray-100 text-gray-600 rounded-full shadow-lg hover:bg-gray-200">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
            </svg>
        </button>
    </div>
</x-layout>
