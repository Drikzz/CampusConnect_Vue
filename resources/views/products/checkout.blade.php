{{-- checkout.blade.php --}}
<x-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            
            {{-- Item Details --}}
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-2xl font-bold mb-4">Item Details</h2>
                <div class="flex items-start gap-4">
                    <img src="" class="w-32 h-32 object-cover rounded">
                    <div>
                        <h3 class="font-semibold text-lg"></h3>
                        <p class="text-gray-600">₱</p>
                        <p class="text-sm text-gray-500"></p>
                    </div>
                </div>
            </div>

            {{-- Checkout Form --}}
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-2xl font-bold mb-4">Checkout Information</h2>
                
                <form action="" method="POST">
                    @csrf
                    <input type="hidden" name="item_id" value="">

                    {{-- Shipping Info --}}
                    <div class="mb-6">
                        <label class="block mb-2">Delivery Address</label>
                        <textarea name="address" rows="3" class="w-full border rounded p-2" required></textarea>
                    </div>

                    {{-- Payment Method --}}
                    <div class="mb-6">
                        <label class="block mb-2">Payment Method</label>
                        <select name="payment_method" class="w-full border rounded p-2" required>
                            <option value="cod">Cash on Delivery</option>
                            <option value="gcash">GCash</option>
                        </select>
                    </div>

                    {{-- Total --}}
                    <div class="flex justify-between items-center mb-6">
                        <span class="font-semibold">Total:</span>
                        <span class="text-xl font-bold">₱</span>
                    </div>

                    {{-- Submit Button --}}
                    <button type="submit" class="w-full bg-primary-color text-white py-3 rounded-lg">
                        Place Order
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-layout>