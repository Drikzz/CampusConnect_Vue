<div class="max-w-5xl mx-auto py-6">
    <div class="bg-white rounded-lg shadow-md p-6">
        <nav class="flex space-x-8 border-b border-gray-200 mb-6" aria-label="Orders">
            <button onclick="switchOrderTab('pending')"
                class="border-b-2 border-transparent hover:border-gray-300 text-gray-500 hover:text-gray-700 py-4 px-1 text-sm font-medium order-tab"
                data-tab="pending">
                Pending
            </button>
            <button onclick="switchOrderTab('to-pay')"
                class="border-b-2 border-transparent hover:border-gray-300 text-gray-500 hover:text-gray-700 py-4 px-1 text-sm font-medium order-tab"
                data-tab="to-pay">
                To Pay
            </button>
            <button onclick="switchOrderTab('completed')"
                class="border-b-2 border-primary-color text-primary-color py-4 px-1 text-sm font-medium order-tab"
                data-tab="completed">
                Completed
            </button>
        </nav>

        {{-- Static Completed Content --}}
        <div class="text-center py-12">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">No completed orders</h3>
            <p class="mt-1 text-sm text-gray-500">You don't have any completed orders yet.</p>
            <div class="mt-6">
                <a href="{{ route('products') }}"
                    class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-color hover:bg-primary-color/90">
                    Start Shopping
                </a>
            </div>
        </div>
    </div>
</div>
