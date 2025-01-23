<x-sellerLayout>
    <div class="p-6 bg-white rounded-lg shadow">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">Completed Orders</h2>
            <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-medium">8 Orders</span>
        </div>

        <!-- Static Completed Orders Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order
                            ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Customer</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date
                            Completed</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Amount</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">#ORD-003</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Mike Johnson</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">2024-01-18</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">₱2,500.00</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Completed
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-sellerLayout>
