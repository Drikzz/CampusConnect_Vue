<div class="p-6 bg-white rounded-lg shadow">
    <div class="flex items-center justify-between">
        <div>
            <p class="text-sm font-medium text-gray-600">{{ $title }}</p>
            <p class="text-2xl font-semibold text-gray-900">{{ $value }}</p>
        </div>
        <div @class([
            'p-3 rounded-full',
            'bg-blue-100' => $color === 'blue',
            'bg-yellow-100' => $color === 'yellow',
            'bg-green-100' => $color === 'green',
            'bg-red-100' => $color === 'red',
        ])>
            <x-dynamic-component :component="'heroicon-o-' . $icon" @class([
                'w-6 h-6',
                'text-blue-600' => $color === 'blue',
                'text-yellow-600' => $color === 'yellow',
                'text-green-600' => $color === 'green',
                'text-red-600' => $color === 'red',
            ]) />
        </div>
    </div>
</div>
