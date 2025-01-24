<x-sellerLayout>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="mb-8">
        <h2 class="text-3xl font-semibold text-gray-800 dark:text-white">{{ Auth::user()->first_name }}'s Products
        </h2>
        <p class="text-gray-600 dark:text-gray-400">{{ $products->total() }} products listed</p>
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
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
                                @if (Str::startsWith($product->images[0], 'http'))
                                    <img src="{{ $product->images[0] }}" alt="{{ $product->name }}"
                                        class="w-16 h-16 object-cover rounded-lg">
                                @else
                                    <img src="{{ $product->images[0] }}" alt="{{ $product->name }}"
                                        class="w-16 h-16 object-cover rounded-lg">
                                @endif
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
                                <form action="{{ route('seller.products.delete', ['product' => $product->id]) }}"
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
    <div class="mt-6">
        {{ $products->links() }}
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

    <!-- Add jQuery and modal script -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
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
