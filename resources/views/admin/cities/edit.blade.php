<x-layouts.app title="Edit City">
    <div class="max-w-4xl mx-auto px-4 py-8">
        <form action="{{ route('admin.cities.update', $city) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.cities.form', ['city' => $city, 'locales' => $locales ?? config('translatable.locales')])
        </form>
    </div>
</x-layouts.app>