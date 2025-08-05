<x-layouts.app title="Create New City">
    <div class="max-w-4xl mx-auto px-4 py-8">
        <form action="{{ route('admin.cities.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('admin.cities.form', ['city' => null, 'locales' => $locales ?? config('translatable.locales')])
        </form>
    </div>
</x-layouts.app>