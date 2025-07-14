
<x-layouts.app :title="'Cuisine Details'">
    <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-2xl font-semibold mb-6">Cuisine Details</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach ($locales as $locale)
                    <div>
                        <h3 class="text-lg font-medium text-gray-700">Name ({{ strtoupper($locale) }})</h3>
                        <p class="text-gray-900">{{ $cuisine->translate($locale)->name ?? '—' }}</p>
                    </div>
                @endforeach

                <div class="col-span-2">
                    <h3 class="text-lg font-medium text-gray-700 mb-2">Image</h3>
                    @if ($cuisine->image_url)
                        <img src="{{ $cuisine->image_url }}" alt="Cuisine Image" class="w-48 h-48 object-cover rounded">
                    @else
                        <p class="text-gray-500">No image uploaded.</p>
                    @endif
                </div>
            </div>

            <div class="mt-6">
                <a href="{{ route('admin.cuisines.edit', $cuisine->id) }}" class="inline-block px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">Edit</a>
                <a href="{{ route('admin.cuisines.index') }}" class="inline-block ml-2 px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">Back</a>
            </div>
        </div>
    </div>
</x-layouts.app>
