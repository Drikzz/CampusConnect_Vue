<x-layout>
    <div class="relative min-h-screen bg-gray-100">
        <div class="flex">
            {{-- Sidebar --}}
            <aside class="w-64 bg-white min-h-screen">
                {{-- Logo Section --}}
                <div class="h-16 flex items-center px-6 border-b">
                    <img src="{{ asset('assets/seller-img/campconnect.jpg') }}" class="h-8 w-8 rounded" alt="Logo">
                    <span class="ml-2 text-xl font-bold">Seller Central</span>
                </div>

                {{-- Navigation with User Controls --}}
                <nav class="p-4 space-y-2">
                    {{-- User Info --}}
                    <div class="flex items-center gap-3 px-4 py-3 mb-4">
                        <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center">
                            <span class="text-sm font-medium">{{ substr(Auth::user()->first_name, 0, 1) }}</span>
                        </div>
                        <span class="text-sm font-medium">{{ Auth::user()->first_name }}</span>
                    </div>

                    {{-- Navigation Links --}}
                    <a href="{{ route('seller.dashboard') }}"
                        class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-lg">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Dashboard
                    </a>

                    <a href="{{ route('seller.products') }}"
                        class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-lg">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                        Products
                    </a>

                    <a href="{{ route('seller.orders.pending') }}"
                        class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-lg">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        Orders
                    </a>

                    <a href="#" class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-lg">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Finance
                    </a>

                    <div class="border-t my-4"></div>

                    {{-- Back to Store Link --}}
                    <a href="{{ route('index') }}"
                        class="flex items-center px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-lg">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Back to Store
                    </a>
                </nav>
            </aside>

            {{-- Main Content Area --}}
            <div class="flex-1">
                <main class="p-8 pb-32">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </div>
</x-layout>
