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
                                            src="{{ $order->buyer->profile_picture ? asset('storage/' . $order->buyer->profile_picture) : 'storage/college/profile_picture/k90yQOdvf1hbfJOHjpz47yJ6403l5SG90lqBKVKt.jpg' }}"
                                            alt="">
                                        @dd($order->buyer->profile_picture);
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
    <div class="my-8">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Quick Actions</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            <button data-modal-target="add-product-modal" data-modal-toggle="add-product-modal"
                class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition-shadow duration-200">
                <div class="flex flex-col items-center space-y-2">
                    <div class="p-3 bg-blue-50 rounded-full">
                        <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                    </div>
                    <span class="text-sm font-medium text-gray-700">Add Product</span>
                </div>
            </button>

            <a href="{{ route('seller.orders.index') }}"
                class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition-shadow duration-200">
                <div class="flex flex-col items-center space-y-2">
                    <div class="p-3 bg-green-50 rounded-full">
                        <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <span class="text-sm font-medium text-gray-700">View Orders</span>
                </div>
            </a>

            <a href="#"
                class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition-shadow duration-200">
                <div class="flex flex-col items-center space-y-2">
                    <div class="p-3 bg-yellow-50 rounded-full">
                        <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10" />
                        </svg>
                    </div>
                    <span class="text-sm font-medium text-gray-700">Manage Stock</span>
                </div>
            </a>

            <a href="#"
                class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition-shadow duration-200">
                <div class="flex flex-col items-center space-y-2">
                    <div class="p-3 bg-purple-50 rounded-full">
                        <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <span class="text-sm font-medium text-gray-700">Edit Profile</span>
                </div>
            </a>
        </div>
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

    <!-- Add Product Modal -->
    <div id="add-product-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
        class="hidden fixed inset-0 flex justify-center items-center z-50 bg-gray-900 bg-opacity-50">
        <div class="relative p-4 w-full max-w-3xl my-6">
            <div class="relative bg-white rounded-lg shadow max-h-[90vh] overflow-y-auto">
                <!-- Form with integrated header and footer -->
                <form action="{{ route('seller.addproduct') }}" method="POST" enctype="multipart/form-data">
                    <!-- Modal header -->
                    <div class="sticky top-0 flex items-center justify-between p-4 border-b rounded-t bg-white z-10">
                        <h3 class="text-xl font-semibold text-gray-900">Add New Product</h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5"
                            data-modal-hide="add-product-modal">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>

                    <!-- Modal body -->
                    <div class="p-4">
                        @csrf
                        <div class="p-6 space-y-8">
                            <!-- Product Images -->
                            <div class="space-y-4">
                                <h2 class="text-xl font-semibold text-gray-900">Product Images</h2>
                                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                                    <!-- Main Image -->
                                    <div class="col-span-1 md:col-span-2">
                                        <div class="text-sm font-medium text-gray-900 mb-4">Main Image (Required)</div>
                                        <div
                                            class="relative group aspect-square bg-gray-50 border-2 border-dashed border-primary-color rounded-lg overflow-hidden">
                                            <input type="file" id="mainImage" name="main_image" class="hidden"
                                                accept="image/*">
                                            <label for="mainImage"
                                                class="absolute inset-0 flex flex-col items-center justify-center cursor-pointer hover:bg-gray-100">
                                                <div id="mainImagePlaceholder" class="text-center p-4">
                                                    <svg class="mx-auto w-12 h-12 text-gray-400" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M12 4v16m8-8H4" />
                                                    </svg>
                                                    <p class="mt-2 text-sm text-gray-600">Click to upload main image
                                                    </p>
                                                </div>
                                                <div id="mainPreview" class="hidden w-full h-full">
                                                    <img src="" alt="Preview"
                                                        class="w-full h-full object-cover">
                                                </div>
                                            </label>
                                        </div>
                                        @error('main_image')
                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Additional Images -->
                                    <div class="col-span-1 md:col-span-2">
                                        <div class="text-sm font-medium text-gray-900 mb-4">Additional Images</div>
                                        <div class="grid grid-cols-2 gap-4">
                                            @for ($i = 1; $i <= 4; $i++)
                                                <div
                                                    class="relative aspect-square bg-gray-50 border-2 border-dashed border-gray-300 rounded-lg overflow-hidden">
                                                    <input type="file" id="image{{ $i }}"
                                                        name="additional_images[]" class="hidden" accept="image/*">
                                                    <label for="image{{ $i }}"
                                                        class="absolute inset-0 flex flex-col items-center justify-center cursor-pointer hover:bg-gray-100">
                                                        <div id="placeholder{{ $i }}"
                                                            class="flex flex-col items-center">
                                                            <svg class="w-6 h-6 text-gray-400" fill="none"
                                                                stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2" d="M12 4v16m8-8H4" />
                                                            </svg>
                                                            <span class="mt-2 text-sm text-gray-500">Add Image</span>
                                                        </div>
                                                        <div id="preview{{ $i }}"
                                                            class="hidden w-full h-full">
                                                            <img src="" alt="Preview {{ $i }}"
                                                                class="w-full h-full object-cover">
                                                        </div>
                                                    </label>
                                                </div>
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Basic Information -->
                            <div class="space-y-4">
                                <h2 class="text-xl font-semibold text-gray-900">Basic Information</h2>
                                <div class="grid gap-6">
                                    <div>
                                        <label for="product-name"
                                            class="block text-sm font-medium text-gray-700">Product
                                            Name</label>
                                        <input type="text" id="product-name" name="name"
                                            class="mt-1 w-full rounded-lg @error('name') border-red-500 @else border-gray-300 @enderror focus:border-primary-color focus:ring-primary-color transition-all"
                                            placeholder="Enter product name" value="{{ old('name') }}">
                                        @error('name')
                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="description"
                                            class="block text-sm font-medium text-gray-700">Description</label>
                                        <textarea id="description" name="description" rows="4"
                                            class="mt-1 w-full rounded-lg @error('description') border-red-500 @else border-gray-300 @enderror focus:border-primary-color focus:ring-primary-color transition-all"
                                            placeholder="Describe your product">{{ old('description') }}</textarea>
                                        @error('description')
                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Product Details -->
                            <div class="space-y-4">
                                <h2 class="text-xl font-semibold text-gray-900">Product Details</h2>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="category"
                                            class="block mb-2 text-sm font-medium text-gray-900">Category</label>
                                        <select id="category" name="category"
                                            class="w-full p-3 bg-gray-50 @error('category') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                            <option value="" disabled {{ old('category') ? '' : 'selected' }}>
                                                Select a category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ old('category') == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category')
                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Replace the trade-method select with this -->
                                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                                        <h4 class="text-sm font-medium text-gray-900 mb-3">Trade Method</h4>
                                        <div class="space-y-2">
                                            <div class="flex items-center">
                                                <input type="radio" id="trade_buy" name="trade_availability"
                                                    value="buy"
                                                    {{ old('trade_availability') == 'buy' ? 'checked' : '' }}
                                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
                                                <label for="trade_buy" class="ml-2 text-sm font-medium text-gray-900">
                                                    For Purchase Only
                                                </label>
                                            </div>
                                            <div class="flex items-center">
                                                <input type="radio" id="trade_trade" name="trade_availability"
                                                    value="trade"
                                                    {{ old('trade_availability') == 'trade' ? 'checked' : '' }}
                                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
                                                <label for="trade_trade"
                                                    class="ml-2 text-sm font-medium text-gray-900">
                                                    For Trade Only
                                                </label>
                                            </div>
                                            <div class="flex items-center">
                                                <input type="radio" id="trade_both" name="trade_availability"
                                                    value="both"
                                                    {{ old('trade_availability') == 'both' ? 'checked' : '' }}
                                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
                                                <label for="trade_both"
                                                    class="ml-2 text-sm font-medium text-gray-900">
                                                    Both Purchase and Trade
                                                </label>
                                            </div>
                                        </div>
                                        @error('trade_availability')
                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="price"
                                            class="block mb-2 text-sm font-medium text-gray-900">Price
                                            (₱)</label>
                                        <input type="number" id="price" name="price" min="0"
                                            step="0.01"
                                            class="w-full p-3 bg-gray-50 @error('price') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                            placeholder="0.00" value="{{ old('price') }}">
                                        @error('price')
                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Add Discount Field -->
                                    <div>
                                        <label for="discount"
                                            class="block mb-2 text-sm font-medium text-gray-900">Discount
                                            (%)</label>
                                        <input type="number" id="discount" name="discount" min="0"
                                            max="100" step="0.01"
                                            class="w-full p-3 bg-gray-50 @error('discount') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                            placeholder="0" value="{{ old('discount', 0) }}">
                                        @error('discount')
                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="quantity"
                                            class="block mb-2 text-sm font-medium text-gray-900">Quantity</label>
                                        <input type="number" id="quantity" name="quantity" min="1"
                                            class="w-full p-3 bg-gray-50 @error('quantity') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                            placeholder="1" value="{{ old('quantity') }}">
                                        @error('quantity')
                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="status"
                                            class="block mb-2 text-sm font-medium text-gray-900">Status</label>
                                        <select id="status" name="status"
                                            class="w-full p-3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                            <option value="Active" {{ old('status') == 'Active' ? 'selected' : '' }}>
                                                Active</option>
                                            <option value="Inactive"
                                                {{ old('status') == 'Inactive' ? 'selected' : '' }}>
                                                Inactive</option>
                                        </select>
                                        @error('status')
                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="flex justify-end gap-4 p-4 border-t sticky bottom-0 bg-white z-10">
                        <button type="reset"
                            class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200">
                            Reset Form
                        </button>
                        <button type="submit"
                            class="px-4 py-2 text-sm font-medium text-white bg-primary-color rounded-lg hover:bg-primary-color/90">
                            Add Product
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Handle main image preview
        document.getElementById('mainImage').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('mainImagePlaceholder').classList.add('hidden');
                    document.getElementById('mainPreview').classList.remove('hidden');
                    document.getElementById('mainPreview').querySelector('img').src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        });

        // Handle additional images preview
        for (let i = 1; i <= 4; i++) {
            document.getElementById(`image${i}`).addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById(`placeholder${i}`).classList.add('hidden');
                        document.getElementById(`preview${i}`).classList.remove('hidden');
                        document.getElementById(`preview${i}`).querySelector('img').src = e.target.result;
                    }
                    reader.readAsDataURL(file);
                }
            });
        }
    </script>
</x-sellerLayout>
