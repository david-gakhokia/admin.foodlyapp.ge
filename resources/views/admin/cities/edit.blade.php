<x-layouts.app title="Edit City">
    <div class="max-w-4xl mx-auto px-4 py-8">
        <form action="{{ route('admin.cities.update', $city) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.cities.form', [
                'city' => $city,
                'locales' => $locales ?? config('translatable.locales'),
            ])
        </form>
        @if (isset($city) && !empty($city->image))
            <form action="{{ route('admin.cities.image.delete', $city) }}" method="POST" class="mt-1">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Are you sure you want to delete the image?')"
                    class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-xl font-medium hover:bg-red-700 transition-all duration-200">
                    Delete Image
                </button>
            </form>
        @endif
    </div>
</x-layouts.app>
