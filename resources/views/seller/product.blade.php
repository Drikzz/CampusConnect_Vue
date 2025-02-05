<x-sellerLayout>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Main container with min-height -->
    <div class="flex flex-col px-4 pb-20"> <!-- Modified this line -->
        <!-- Header section -->
        <div class="mb-8 flex justify-between items-center">
            <div>
                <h2 class="text-3xl font-semibold text-gray-800 dark:text-white">{{ Auth::user()->first_name }}'s
                    Products</h2>
                <p class="text-gray-600 dark:text-gray-400">{{ $products->total() }} products listed</p>
            </div>
            <button data-modal-target="add-product-modal" data-modal-toggle="add-product-modal"
                class="px-4 py-2 bg-primary-color text-white rounded-lg hover:bg-primary-color/90 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Add Product
            </button>
        </div>

        <!-- Products table container -->
        <div class="w-full h-full"> <!-- Added flex-grow -->
            <div class="relative shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="p-4">
                                <div class="flex items-center">
                                    <input id="checkbox-all-search" type="checkbox"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                                    <label for="checkbox-all-search" class="sr-only">checkbox</label>
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3">Product Image</th>
                            <th scope="col" class="px-6 py-3">Product name</th>
                            <th scope="col" class="px-6 py-3">Category</th>
                            <th scope="col" class="px-6 py-3">Price</th>
                            <th scope="col" class="px-6 py-3">Quantity</th>
                            <th scope="col" class="px-6 py-3">Status</th>
                            <th scope="col" class="px-6 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="w-4 p-4">
                                    <div class="flex items-center">
                                        <input id="checkbox-table-{{ $product->id }}" type="checkbox"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                                        <label for="checkbox-table-{{ $product->id }}" class="sr-only">checkbox</label>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    @if ($product->images && count($product->images) > 0)
                                        <img src="{{ asset('storage/' . $product->images[0]) }}"
                                            alt="{{ $product->name }}" class="w-16 h-16 object-cover rounded-lg">
                                    @else
                                        <span class="text-gray-400">No image</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $product->name }}
                                </td>
                                <td class="px-6 py-4">{{ $product->category->name }}</td>
                                <td class="px-6 py-4">₱{{ number_format($product->price, 2) }}</td>
                                <td class="px-6 py-4">{{ $product->stock }}</td>
                                <td class="px-6 py-4">
                                    <span
                                        class="px-2 py-1 rounded-full text-xs {{ $product->status === 'Active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $product->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-4">
                                        <button onclick="ProductManager.edit({{ $product->id }})"
                                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</button>
                                        <form
                                            action="{{ route('seller.products.delete', ['product' => $product->id]) }}"
                                            method="POST" class="inline"
                                            onsubmit="return confirm('Are you sure you want to delete this product? This action cannot be undone.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="font-medium text-red-600 dark:text-red-500 hover:underline">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-4 text-center">No products found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="my-6">
                {{ $products->links() }}
            </div>
        </div>
    </div>

    <!-- Edit Product Modal -->
    <div id="edit-modal" data-modal-target="edit-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
        class="hidden fixed inset-0 flex justify-center items-center z-50 bg-gray-900 bg-opacity-50 overflow-y-auto">
        <div class="relative p-4 w-full max-w-3xl my-6">
            <div class="relative bg-white rounded-lg shadow max-h-[90vh] overflow-y-auto">
                <!-- Modal header - Make it sticky -->
                <div class="flex items-center justify-between p-4 border-b sticky top-0 bg-white z-10">
                    <h3 class="text-xl font-semibold text-gray-900">Edit Product</h3>
                    <button id="closeEditModal" type="button"
                        class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>

                <!-- Modal body -->
                <div class="p-4">
                    <form id="editProductForm" method="POST" enctype="multipart/form-data" class="p-4">
                        @csrf
                        <input type="hidden" id="editProductId" name="product_id">
                        <input type="hidden" id="currentImages" name="current_images">

                        <div class="grid gap-6 mb-6">
                            <!-- Basic Info Section -->
                            <div class="grid gap-4">
                                <!-- Product Name Row -->
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label for="edit_name"
                                            class="block mb-2 text-sm font-medium text-gray-900">Product Name</label>
                                        <input type="text" id="edit_name" name="name"
                                            class="bg-gray-50 border @error('name') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                                    </div>
                                    <!-- Trade Availability (moved here and made smaller) -->
                                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                                        <h4 class="text-sm font-medium text-gray-900 mb-3">Trade Method</h4>
                                        <div class="space-y-2">
                                            <div class="flex items-center">
                                                <input type="radio" id="trade_buy" name="trade_availability"
                                                    value="buy"
                                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
                                                <label for="trade_buy" class="ml-2 text-sm font-medium text-gray-900">
                                                    For Purchase Only
                                                </label>
                                            </div>
                                            <div class="flex items-center">
                                                <input type="radio" id="trade_trade" name="trade_availability"
                                                    value="trade"
                                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
                                                <label for="trade_trade"
                                                    class="ml-2 text-sm font-medium text-gray-900">
                                                    For Trade Only
                                                </label>
                                            </div>
                                            <div class="flex items-center">
                                                <input type="radio" id="trade_both" name="trade_availability"
                                                    value="both"
                                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
                                                <label for="trade_both"
                                                    class="ml-2 text-sm font-medium text-gray-900">
                                                    Both Purchase and Trade
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Description (full width) -->
                                <div>
                                    <label for="edit_description"
                                        class="block mb-2 text-sm font-medium text-gray-900">Description</label>
                                    <textarea id="edit_description" name="description" rows="6"
                                        class="bg-gray-50 border @error('description') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"></textarea>
                                </div>
                            </div>

                            <!-- Category and Trade Method -->
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="edit_category"
                                        class="block mb-2 text-sm font-medium text-gray-900">Category</label>
                                    <select id="edit_category" name="category"
                                        class="bg-gray-50 border @error('category') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- Removed trade method select -->
                            </div>

                            <!-- Price, Discount, and Quantity -->
                            <div class="grid grid-cols-3 gap-4">
                                <div>
                                    <label for="edit_price" class="block mb-2 text-sm font-medium text-gray-900">Price
                                        (₱)</label>
                                    <input type="number" id="edit_price" name="price" min="0"
                                        class="bg-gray-50 border @error('price') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                                </div>

                                <div>
                                    <label for="edit_discount"
                                        class="block mb-2 text-sm font-medium text-gray-900">Discount (%)</label>
                                    <input type="number" id="edit_discount" name="discount" min="0"
                                        max="100"
                                        class="bg-gray-50 border @error('discount') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                                </div>

                                <div>
                                    <label for="edit_quantity"
                                        class="block mb-2 text-sm font-medium text-gray-900">Quantity</label>
                                    <input type="number" id="edit_quantity" name="quantity" min="1"
                                        class="bg-gray-50 border @error('quantity') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                                </div>
                            </div>

                            <!-- Status Selection -->
                            <div>
                                <label for="edit_status"
                                    class="block mb-2 text-sm font-medium text-gray-900">Status</label>
                                <select id="edit_status" name="status"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                            </div>
                        </div>

                        <div class="space-y-4 mb-6">
                            <h2 class="text-xl font-semibold text-gray-900">Update Images</h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Main Image -->
                                <div>
                                    <div class="text-sm font-medium text-gray-900 mb-4">Main Image</div>
                                    <div class="relative group aspect-[4/3]">
                                        <input type="file" id="edit_main_image" name="main_image" class="hidden"
                                            accept="image/*">
                                        <label for="edit_main_image" class="cursor-pointer block h-full">
                                            <div class="relative h-full">
                                                <img id="current-main-img"
                                                    class="w-full h-full object-cover rounded-lg" src=""
                                                    alt="Main Image">
                                                <div
                                                    class="absolute inset-0 bg-black bg-opacity-40 opacity-0 group-hover:opacity-100 flex items-center justify-center text-white transition-opacity rounded-lg">
                                                    <span>Change Image</span>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                </div>

                                <!-- Additional Images -->
                                <div>
                                    <div class="text-sm font-medium text-gray-900 mb-4">Additional Images</div>
                                    <div class="grid grid-cols-2 gap-4">
                                        @for ($i = 1; $i <= 4; $i++)
                                            <div class="relative group aspect-square">
                                                <input type="file" id="edit_image{{ $i }}"
                                                    name="additional_image_{{ $i }}" class="hidden"
                                                    accept="image/*">
                                                <label for="edit_image{{ $i }}"
                                                    class="cursor-pointer block h-full">
                                                    <div class="relative h-full">
                                                        <img id="current-img-{{ $i }}"
                                                            class="w-full h-full object-cover rounded-lg"
                                                            src=""
                                                            alt="Additional Image {{ $i }}">
                                                        <div
                                                            class="absolute inset-0 bg-black bg-opacity-40 opacity-0 group-hover:opacity-100 flex items-center justify-center text-white transition-opacity rounded-lg">
                                                            <span>Change Image</span>
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Modal footer - Make it sticky -->
                <div class="flex justify-end gap-4 p-4 border-t sticky bottom-0 bg-white z-10">
                    <button type="button" id="closeEditModalBtn"
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200">Cancel</button>
                    <button type="submit" form="editProductForm"
                        class="px-4 py-2 text-sm font-medium text-white bg-primary-color rounded-lg hover:bg-primary-color/90">Update
                        Product</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Product Modal -->
    <div id="add-product-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
        class="hidden fixed inset-0 z-50 items-center justify-center overflow-y-auto overflow-x-hidden">
        <div class="relative w-auto my-6 mx-auto max-w-4xl">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 max-h-[90vh] overflow-y-auto">
                <!-- Modal header -->
                <div
                    class="sticky top-0 flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 bg-white z-10">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Add New Product
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="add-product-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>

                <!-- Modal body -->
                <div class="p-4 md:p-5">
                    <form action="{{ route('seller.addproduct') }}" method="POST" enctype="multipart/form-data">
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

                            <!-- Footer -->
                            <div class="bg-white py-4 px-6 border-t border-gray-200">
                                <div class="flex justify-end gap-4">
                                    <button type="reset"
                                        class="px-6 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-all">
                                        Reset Form
                                    </button>
                                    <button type="submit"
                                        class="px-6 py-2 text-sm font-medium text-white bg-primary-color rounded-lg hover:bg-primary-color/90 transition-all">
                                        Add Product
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add jQuery and modal script -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Main image preview
            const mainImageInput = document.getElementById('mainImage');
            const mainPreview = document.getElementById('mainPreview');
            const mainPlaceholder = document.getElementById('mainImagePlaceholder');

            mainImageInput.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        mainPreview.querySelector('img').src = e.target.result;
                        mainPreview.classList.remove('hidden');
                        mainPlaceholder.classList.add('hidden');
                    }
                    reader.readAsDataURL(file);
                }
            });

            // Additional images preview
            for (let i = 1; i <= 4; i++) {
                const input = document.getElementById(`image${i}`);
                const preview = document.getElementById(`preview${i}`);
                const placeholder = document.getElementById(`placeholder${i}`);

                input.addEventListener('change', function() {
                    const file = this.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            preview.querySelector('img').src = e.target.result;
                            preview.classList.remove('hidden');
                            placeholder.classList.add('hidden');
                        }
                        reader.readAsDataURL(file);
                    }
                });
            }

            // Add form submit handler
            document.querySelector('form').addEventListener('submit', function(e) {
                const formData = new FormData(this);
                const tradeAvailability = document.querySelector('input[name="trade_availability"]:checked')
                    .value;

                // Set is_buyable and is_tradable based on trade_availability selection
                if (tradeAvailability === 'buy') {
                    formData.append('is_buyable', '1');
                    formData.append('is_tradable', '0');
                } else if (tradeAvailability === 'trade') {
                    formData.append('is_buyable', '0');
                    formData.append('is_tradable', '1');
                } else if (tradeAvailability === 'both') {
                    formData.append('is_buyable', '1');
                    formData.append('is_tradable', '1');
                }

                // Submit the form
                this.submit();
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // Add Flowbite modal initialization
            const modal = new Modal(document.getElementById('edit-modal'), {
                placement: 'center',
                backdrop: 'static',
                closable: true,
            });

            // ProductManager object
            window.ProductManager = {
                edit: function(productId) {
                    const product = {!! $products->toJson() !!}.data.find(p => p.id === productId);

                    if (product) {
                        // Set basic form values
                        $('#editProductId').val(product.id);
                        $('#edit_name').val(product.name);
                        $('#edit_description').val(product.description);
                        $('#edit_category').val(product.category_id);
                        $('#edit_price').val(product.price);
                        $('#edit_discount').val(product.discount || 0);
                        $('#edit_quantity').val(product.stock);
                        $('#edit_status').val(product.status); // Add this line

                        // Map trade_method_id back to the select value
                        const tradeMethodMap = {
                            1: 'sell', // Sell Only
                            2: 'trade', // Trade Only
                            3: 'both' // Both
                        };

                        // Get the trade method value from the relationship
                        const tradeMethodId = product.trade_method ? product.trade_method.id : 1;
                        $('#edit_trade_method').val(tradeMethodMap[tradeMethodId]);

                        // Set trade availability radio button
                        const tradeAvailability = product.is_buyable && product.is_tradable ? 'both' :
                            product.is_buyable ? 'buy' :
                            product.is_tradable ? 'trade' : 'buy';
                        $(`input[name="trade_availability"][value="${tradeAvailability}"]`).prop('checked',
                            true);

                        // Set current images
                        if (product.images && product.images.length > 0) {
                            // Set main image (index 0)
                            $('#current-main-img').attr('src', product.images[0]);

                            // Set additional images (indices 1-4)
                            product.images.slice(1).forEach((image, index) => {
                                if (index < 4) {
                                    $(`#current-img-${index + 1}`).attr('src', image);
                                }
                            });
                        }

                        // Set status
                        $('#edit_status').val(product.status);

                        modal.show();
                    }
                }
            };

            // Close modal handlers
            $('#closeEditModal, #closeEditModalBtn').on('click', function() {
                modal.hide();
            });

            // Handle file inputs
            $('.hidden[type="file"]').on('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    const inputId = $(this).attr('id');
                    const isMainImage = inputId === 'edit_main_image';
                    const index = isMainImage ? 'main' : inputId.replace('edit_image', '');

                    reader.onload = function(e) {
                        if (isMainImage) {
                            $('#current-main-img').attr('src', e.target.result);
                        } else {
                            $(`#current-img-${index}`).attr('src', e.target.result);
                        }
                    };

                    reader.readAsDataURL(file);
                }
            });

            // Handle form submission
            $('#editProductForm').on('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                const tradeAvailability = $('input[name="trade_availability"]:checked').val();

                // Set is_buyable and is_tradable based on trade_availability selection
                if (tradeAvailability === 'buy') {
                    formData.append('is_buyable', '1');
                    formData.append('is_tradable', '0');
                } else if (tradeAvailability === 'trade') {
                    formData.append('is_buyable', '0');
                    formData.append('is_tradable', '1');
                } else if (tradeAvailability === 'both') {
                    formData.append('is_buyable', '1');
                    formData.append('is_tradable', '1');
                }

                const productId = $('#editProductId').val();

                $.ajax({
                    url: `/seller/products/${productId}/update`,
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            // Refresh the page to show updated images
                            window.location.reload();
                        } else {
                            alert(response.message || 'Error updating product');
                        }
                    },
                    error: function(xhr) {
                        console.error('Update error:', xhr);
                        alert('Error updating product: ' + xhr.responseJSON?.message || xhr
                            .statusText);
                    }
                });
            });
        });
    </script>
</x-sellerLayout>
