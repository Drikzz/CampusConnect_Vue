<x-layout>
    @php
        // Set default empty object for orderCounts if not provided
        $orderCounts =
            $orderCounts ??
            (object) [
                'pendingCount' => 0,
                'processingCount' => 0,
                'completedCount' => 0,
            ];
    @endphp

    <div class="min-h-screen bg-gray-100">
        {{-- Top Navigation Bar --}}
        <nav class="bg-white shadow-sm border-b">
            <div class="px-4 mx-auto">
                <div class="flex h-20 items-center justify-between">
                    <div class="flex items-center">
                        <img src="{{ asset('assets/seller-img/campconnect.jpg') }}" class="h-8 w-8 rounded" alt="Logo">
                        <span class="ml-2 text-xl font-bold">Seller Central</span>
                    </div>

                    <div class="flex items-center gap-4">
                        <span class="text-sm text-gray-600 font-Satoshi-bold">Welcome,
                            {{ Auth::user()->first_name }}</span>
                        <form method="POST" action="{{ route('logout') }}" class="ml-4">
                            @csrf
                            <button type="submit" class="text-red-600 hover:text-red-800">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>

        <div class="flex h-[calc(100vh-5rem)]">
            {{-- Sidebar with scrollable styling --}}
            <aside class="w-64 bg-white border-r overflow-y-auto">
                <nav class="mt-8 px-4 pb-10">
                    <div class="space-y-8">
                        <div class="pb-6">
                            <span
                                class="w-full flex items-center justify-between text-sm font-semibold text-gray-400 uppercase">
                                <span>Main Menu</span>
                            </span>
                            <div class="mt-3 space-y-3 pl-4">
                                <a href="{{ route('seller.dashboard') }}"
                                    class="group flex items-center px-4 py-2 text-gray-800 hover:bg-gray-100 rounded-lg">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                        </path>
                                    </svg>
                                    Dashboard
                                </a>
                            </div>
                        </div>

                        <div class="pb-6" x-data="{ open: false }">
                            <button @click="open = !open"
                                class="w-full flex items-center justify-between text-sm font-semibold text-gray-400 uppercase">
                                <span>Products</span>
                                <svg class="w-5 h-5 transition-transform" :class="{ 'rotate-180': open }" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div x-show="open" class="mt-3 space-y-3 pl-4">
                                <a href="{{ route('seller.products') }}"
                                    class="group flex items-center px-4 py-2 text-gray-800 hover:bg-gray-100 rounded-lg">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                    </svg>
                                    All Products
                                </a>
                                <a href="{{ route('seller.addproduct') }}"
                                    class="group flex items-center px-4 py-2 text-gray-800 hover:bg-gray-100 rounded-lg">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                    Add New
                                </a>
                                {{-- Commenting out the Categories button --}}
                                {{-- <div x-data="{ categoriesOpen: false }" class="relative">
                                    <a href="{{ route('seller.categories') }}"
                                        class="w-full group flex items-center px-4 py-2 text-gray-800 hover:bg-gray-100 rounded-lg">
                                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 6h16M4 12h16m-7 6h7" />
                                        </svg>
                                        Categories
                                    </a>
                                </div> --}}
                            </div>
                        </div>

                        <div class="pb-6" x-data="{ open: false }">
                            <button @click="open = !open"
                                class="w-full flex items-center justify-between text-sm font-semibold text-gray-400 uppercase">
                                <span>Orders</span>
                                <svg class="w-5 h-5 transition-transform" :class="{ 'rotate-180': open }" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div x-show="open" class="mt-3 space-y-3 pl-4">
                                <a href="{{ route('seller.orders.pending') }}"
                                    class="group flex items-center px-4 py-2 text-gray-800 hover:bg-gray-100 rounded-lg">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Pending
                                    @if ($orderCounts->pendingCount > 0)
                                        <span
                                            class="ml-auto bg-yellow-100 text-yellow-800 text-xs font-medium px-2 py-0.5 rounded">
                                            {{ $orderCounts->pendingCount }}
                                        </span>
                                    @endif
                                </a>
                                <a href="{{ route('seller.orders.processing') }}"
                                    class="group flex items-center px-4 py-2 text-gray-800 hover:bg-gray-100 rounded-lg">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                    </svg>
                                    Processing
                                    @if ($orderCounts->processingCount > 0)
                                        <span
                                            class="ml-auto bg-blue-100 text-blue-800 text-xs font-medium px-2 py-0.5 rounded">
                                            {{ $orderCounts->processingCount }}
                                        </span>
                                    @endif
                                </a>
                                <a href="{{ route('seller.orders.completed') }}"
                                    class="group flex items-center px-4 py-2 text-gray-800 hover:bg-gray-100 rounded-lg">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Completed
                                    @if ($orderCounts->completedCount > 0)
                                        <span
                                            class="ml-auto bg-green-100 text-green-800 text-xs font-medium px-2 py-0.5 rounded">
                                            {{ $orderCounts->completedCount }}
                                        </span>
                                    @endif
                                </a>
                            </div>
                        </div>

                        <div class="pb-6" x-data="{ open: false }">
                            <button @click="open = !open"
                                class="w-full flex items-center justify-between text-sm font-semibold text-gray-400 uppercase">
                                <span>Finance</span>
                                <svg class="w-5 h-5 transition-transform" :class="{ 'rotate-180': open }"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div x-show="open" class="mt-3 space-y-3 pl-4">
                                <a href="#"
                                    class="group flex items-center px-4 py-2 text-gray-800 hover:bg-gray-100 rounded-lg">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Earnings
                                </a>
                                <a href="#"
                                    class="group flex items-center px-4 py-2 text-gray-800 hover:bg-gray-100 rounded-lg">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    Withdrawals
                                </a>
                                <a href="#"
                                    class="group flex items-center px-4 py-2 text-gray-800 hover:bg-gray-100 rounded-lg">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    Reports
                                </a>
                            </div>
                        </div>
                    </div>
                </nav>
            </aside>

            {{-- Main Content Area --}}
            <main class="flex-1 overflow-y-auto pb-16">
                <div class="max-w-7xl mx-auto p-10">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>
</x-layout>
