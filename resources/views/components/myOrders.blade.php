{{-- Orders Tab Content --}}
<div class="max-w-5xl mx-auto py-6">
    <div class="bg-white rounded-lg shadow-md p-6">
        {{-- Order Status Tabs --}}
        <div class="border-b border-gray-200 mb-6">
            <nav class="flex space-x-8" aria-label="Orders">
                <button class="border-b-2 border-primary-color text-primary-color py-4 px-1 text-sm font-medium">
                    Pending
                </button>
                <button
                    class="border-b-2 border-transparent hover:border-gray-300 text-gray-500 hover:text-gray-700 py-4 px-1 text-sm font-medium">
                    To Pay
                </button>
                <button
                    class="border-b-2 border-transparent hover:border-gray-300 text-gray-500 hover:text-gray-700 py-4 px-1 text-sm font-medium">
                    Completed
                </button>
            </nav>
        </div>

        {{-- Orders List --}}
        <div class="space-y-4">
            @forelse (auth()->user()->orders as $order)
                <div class="border rounded-lg p-4 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <p class="text-sm text-gray-500">Order #{{ $order->id }}</p>
                            <p class="text-sm text-gray-500">Placed on {{ $order->created_at->format('F d, Y') }}</p>
                        </div>
                        <span
                            class="px-3 py-1 rounded-full text-xs font-medium 
                            @if ($order->status === 'pending') bg-yellow-100 text-yellow-800
                            @elseif($order->status === 'completed') bg-green-100 text-green-800
                            @else bg-gray-100 text-gray-800 @endif">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>

                    @foreach ($order->items as $item)
                        <div class="flex items-center space-x-4 mb-4">
                            <img src="{{ $item->product->image }}" alt="{{ $item->product->name }}"
                                class="w-20 h-20 object-cover rounded-md">
                            <div class="flex-1">
                                <h4 class="text-lg font-medium">{{ $item->product->name }}</h4>
                                <p class="text-sm text-gray-600">Quantity: {{ $item->quantity }}</p>
                                <p class="text-lg font-semibold text-primary-color">
                                    ₱{{ number_format($item->price, 2) }}</p>
                            </div>
                        </div>
                    @endforeach

                    <div class="flex justify-end space-x-2 border-t pt-4">
                        <button
                            class="px-4 py-2 bg-primary-color text-white rounded-lg hover:bg-primary-color/90 text-sm">
                            View Details
                        </button>
                        @if ($order->status === 'pending')
                            <button
                                class="px-4 py-2 border border-primary-color text-primary-color rounded-lg hover:bg-primary-color/10 text-sm">
                                Cancel Order
                            </button>
                        @endif
                    </div>
                </div>
            @empty
                {{-- Empty State --}}
                <div class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">No orders</h3>
                    <p class="mt-1 text-sm text-gray-500">You haven't placed any orders yet.</p>
                    <div class="mt-6">
                        <a href="{{ route('products') }}"
                            class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-color hover:bg-primary-color/90">
                            Start Shopping
                        </a>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>
