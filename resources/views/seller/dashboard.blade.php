<x-sellerLayout>
    {{-- Stats Overview --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 bg-blue-100 rounded-full">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-2xl font-semibold text-gray-800">{{ $totalOrders }}</h3>
                    <p class="text-gray-600">Total Orders</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 bg-green-100 rounded-full">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                        </path>
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-2xl font-semibold text-gray-800">₱{{ number_format($totalSales, 2) }}</h3>
                    <p class="text-gray-600">Total Sales</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 bg-purple-100 rounded-full">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-2xl font-semibold text-gray-800">{{ $activeTrades }}</h3>
                    <p class="text-gray-600">Active Trades</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Recent Orders Table --}}
    <div class="bg-white rounded-lg shadow">
        <div class="flex items-center justify-between p-6 border-b">
            <h2 class="text-lg font-semibold text-gray-800">Recent Orders</h2>
            <div class="flex items-center space-x-3">
                <button class="text-gray-600 hover:text-gray-900">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </button>
                <button class="text-gray-600 hover:text-gray-900">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z">
                        </path>
                    </svg>
                </button>
            </div>
        </div>
        <div class="p-6">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($recentOrders as $order)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="h-10 w-10 flex-shrink-0">
                                        <img class="h-10 w-10 rounded-full"
                                            src="{{ $order->buyer->profile_picture ? Storage::url($order->buyer->profile_picture) : '' }}"
                                            alt="">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ Str::ucfirst($order->buyer->first_name) }}
                                            {{ Str::ucfirst($order->buyer->last_name) }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $order->created_at->format('d-m-Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{ $order->status === 'Completed'
                                    ? 'bg-green-100 text-green-800'
                                    : ($order->status === 'Processing'
                                        ? 'bg-yellow-100 text-yellow-800'
                                        : 'bg-gray-100 text-gray-800') }}">
                                    {{ $order->status }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-4 text-center text-gray-500">
                                No recent orders found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Quick Actions --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
        <a href="{{ route('seller.addproduct') }}" class="bg-white p-4 rounded-lg shadow text-center hover:bg-gray-50">
            <svg class="w-8 h-8 mx-auto text-blue-500 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            <span class="text-sm font-medium">Add Product</span>
        </a>
        <a href="{{ route('seller.orders.index') }}"
            class="bg-white p-4 rounded-lg shadow text-center hover:bg-gray-50">
            <svg class="w-8 h-8 mx-auto text-green-500 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
            </svg>
            <span class="text-sm font-medium">View Orders</span>
        </a>
        <a href="#" class="bg-white p-4 rounded-lg shadow text-center hover:bg-gray-50">
            <svg class="w-8 h-8 mx-auto text-yellow-500 mb-2" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10" />
            </svg>
            <span class="text-sm font-medium">Manage Stock</span>
        </a>
        <a href="#" class="bg-white p-4 rounded-lg shadow text-center hover:bg-gray-50">
            <svg class="w-8 h-8 mx-auto text-purple-500 mb-2" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
            <span class="text-sm font-medium">Edit Profile</span>
        </a>
    </div>

    {{-- Low Stock Alert --}}
    <div class="bg-white rounded-lg shadow mb-8">
        <div class="p-6 border-b">
            <h2 class="text-lg font-semibold text-gray-800">Low Stock Items</h2>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                {{-- @forelse ($lowStockProducts as $product)
                    <div class="flex items-center justify-between p-4 bg-red-50 rounded-lg">
                        <div class="flex items-center">
                            <img src="{{ Storage::url($product->image) }}" class="w-12 h-12 rounded object-cover"
                                alt="{{ $product->name }}">
                            <div class="ml-4">
                                <h3 class="text-sm font-medium text-gray-900">{{ $product->name }}</h3>
                                <p class="text-sm text-red-600">Only {{ $product->stock }} left</p>
                            </div>
                        </div>
                        <a href="{{ route('seller.products.edit', $product) }}"
                            class="text-blue-600 hover:text-blue-800">Update</a>
                    </div>
                @empty
                    <p class="text-gray-500">No low stock items found</p>
                @endforelse --}}
            </div>
        </div>
    </div>

    {{-- Latest Reviews --}}
    <div class="bg-white rounded-lg shadow">
        <div class="p-6 border-b">
            <h2 class="text-lg font-semibold text-gray-800">Latest Reviews</h2>
        </div>
        <div class="p-6">
            {{-- @forelse ($latestReviews as $review)
                <div class="mb-4 pb-4 border-b last:border-0">
                    <div class="flex items-center mb-2">
                        <div class="flex-shrink-0">
                            <img src="{{ $review->user->profile_picture ? Storage::url($review->user->profile_picture) : '' }}"
                                class="w-8 h-8 rounded-full" alt="">
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-900">{{ $review->user->name }}</p>
                            <div class="flex items-center">
                                @for ($i = 1; $i <= 5; $i++)
                                    <svg class="w-4 h-4 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}"
                                        fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                @endfor
                            </div>
                        </div>
                    </div>
                    <p class="text-sm text-gray-600">{{ $review->comment }}</p>
                </div>
            @empty
                <p class="text-gray-500">No reviews yet</p>
            @endforelse --}}
        </div>
    </div>
</x-sellerLayout>
