<x-sellerLayout>
    <div class="bg-white shadow rounded-lg">
        <div class="p-6">
            <h2 class="text-2xl font-bold mb-4">Order Details</h2>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th
                                class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Order ID</th>
                            <th
                                class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Customer</th>
                            <th
                                class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Total</th>
                            <th
                                class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status</th>
                            <th
                                class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Date</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">#12345</td>
                            <td class="px-6 py-4">John Doe</td>
                            <td class="px-6 py-4">₱1,500.00</td>
                            <td class="px-6 py-4">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    Completed
                                </span>
                            </td>
                            <td class="px-6 py-4">Oct 10, 2023</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                <h3 class="text-xl font-bold mb-2">Order Items</h3>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th
                                class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Product</th>
                            <th
                                class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Quantity</th>
                            <th
                                class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Price</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            <td class="px-6 py-4">Product 1</td>
                            <td class="px-6 py-4">2</td>
                            <td class="px-6 py-4">₱500.00</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4">Product 2</td>
                            <td class="px-6 py-4">1</td>
                            <td class="px-6 py-4">₱500.00</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-sellerLayout>
