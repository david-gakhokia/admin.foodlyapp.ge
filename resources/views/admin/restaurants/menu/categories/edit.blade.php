<x-layouts.app :title="'Edit Menu Category - ' . $restaurant->name">
    <div class="flex flex-col sm:flex-row justify-content-between align-items-center mb-6 gap-4">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100">Edit Menu Category - {{ $restaurant->name }}</h1>
        <a href="{{ route('admin.restaurants.menu.categories.index', $restaurant) }}" 
           class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-gray-200 border border-transparent rounded-lg font-semibold text-sm transition ease-in-out duration-150">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to list
        </a>
    </div>

    <livewire:admin.menu-category-form :category="$menuCategory" :restaurant="$restaurant" />
</x-layouts.app>
