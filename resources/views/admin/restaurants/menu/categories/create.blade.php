<x-layouts.app :title="'Create Menu Category - ' . $restaurant->name"> 
    
    <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100">Create Menu Category - {{ $restaurant->name }}</h1>
        <a href="{{ route('admin.restaurants.menu.categories.index', ['restaurant' => request()->route('restaurant')]) }}"
           class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-gray-200 border border-transparent rounded-lg font-semibold text-sm transition ease-in-out duration-150">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to list
        </a>
    </div>

  
    @if ($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-md shadow-sm dark:bg-red-900 dark:text-red-200 dark:border-red-700" role="alert">
            <div class="flex">
                <div class="py-1">
                    <svg class="h-6 w-6 text-red-500 dark:text-red-300 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <p class="font-bold text-red-800 dark:text-red-100">There were some problems with your input:</p>
                    <ul class="mt-2 list-disc list-inside text-sm text-red-700 dark:text-red-200">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <livewire:admin.menu-category-form :restaurant="$restaurant" />

</x-layouts.app>