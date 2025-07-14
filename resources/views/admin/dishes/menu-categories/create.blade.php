<x-layouts.app :title="'Add Menu Categories - ' . $dish->name">
    <div class="min-h-screen bg-gradient-to-br from-purple-50 via-indigo-50 to-blue-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            
            <!-- Header Section -->
            <div class="mb-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="p-3 bg-gradient-to-br from-purple-500 to-indigo-600 rounded-xl text-white shadow-lg">
                        <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-4xl font-bold text-gray-900">Add Menu Categories to "{{ $dish->name }}"</h1>
                        <p class="text-gray-600 text-lg">აირჩიეთ menu categories რომლებიც დაუკავშირდება ამ dish-ს</p>
                    </div>
                </div>
                
                <!-- Breadcrumb -->
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="{{ route('admin.dishes.index') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                                Dishes
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="w-3 h-3 text-gray-400 mx-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <a href="{{ route('admin.dishes.menu-categories.index', $dish) }}" class="text-sm font-medium text-gray-700 hover:text-blue-600">
                                    {{ $dish->name }} Menu Categories
                                </a>
                            </div>
                        </li>
                        <li aria-current="page">
                            <div class="flex items-center">
                                <svg class="w-3 h-3 text-gray-400 mx-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Add Menu Categories</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>

            <!-- Main Form -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100">
                    <h3 class="text-lg font-medium text-gray-900">Available Menu Categories</h3>
                    <p class="text-sm text-gray-600 mt-1">Select menu categories to associate with "{{ $dish->name }}"</p>
                </div>

                @if($errors->any())
                    <div class="mx-6 mt-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.dishes.menu-categories.store', $dish) }}" method="POST">
                    @csrf
                    
                    <div class="p-6">
                        @if($availableMenuCategories->count() > 0)
                            <!-- Select All / Deselect All -->
                            <div class="mb-6 flex items-center gap-4">
                                <button type="button" onclick="selectAll()" class="text-purple-600 hover:text-purple-700 text-sm font-medium">
                                    Select All
                                </button>
                                <button type="button" onclick="deselectAll()" class="text-gray-600 hover:text-gray-700 text-sm font-medium">
                                    Deselect All
                                </button>
                            </div>

                            <!-- Categories by Restaurant -->
                            @foreach($availableMenuCategories as $restaurantId => $categories)
                                @php
                                    $restaurant = $restaurants[$restaurantId] ?? null;
                                    $restaurantName = $restaurant ? $restaurant->name : 'Unknown Restaurant';
                                @endphp
                                
                                <div class="mb-8 border border-gray-200 rounded-lg overflow-hidden">
                                    <div class="bg-gray-50 px-4 py-3 border-b border-gray-200">
                                        <div class="flex items-center justify-between">
                                            <h4 class="text-lg font-medium text-gray-900">{{ $restaurantName }}</h4>
                                            <span class="text-sm text-gray-500">{{ $categories->count() }} categories</span>
                                        </div>
                                    </div>
                                    
                                    <div class="p-4">
                                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                            @foreach($categories as $category)
                                                <label class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer">
                                                    <input type="checkbox" 
                                                           name="menu_category_ids[]" 
                                                           value="{{ $category->id }}"
                                                           class="category-checkbox h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                                                    
                                                    @if($category->image_link)
                                                        <img class="h-8 w-8 rounded-lg object-cover ml-3" 
                                                             src="{{ $category->image_link }}" 
                                                             alt="{{ $category->name }}">
                                                    @else
                                                        <div class="h-8 w-8 rounded-lg bg-gray-200 flex items-center justify-center ml-3">
                                                            <svg class="h-4 w-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                                <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path>
                                                            </svg>
                                                        </div>
                                                    @endif
                                                    
                                                    <div class="ml-3 flex-1">
                                                        <div class="text-sm font-medium text-gray-900">{{ $category->name }}</div>
                                                        <div class="text-xs text-gray-500">
                                                            @if($category->parent_id)
                                                                Parent: {{ $category->parent->name ?? 'Unknown' }}
                                                            @else
                                                                Main Category
                                                            @endif
                                                        </div>
                                                    </div>
                                                    
                                                    <span class="ml-2 inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                                        {{ $category->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                        {{ ucfirst($category->status) }}
                                                    </span>
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <!-- No available categories -->
                            <div class="text-center py-12">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                                <h3 class="mt-4 text-lg font-medium text-gray-900">No available menu categories</h3>
                                <p class="mt-2 text-gray-500">All menu categories are already assigned to dishes.</p>
                            </div>
                        @endif
                    </div>

                    @if($availableMenuCategories->count() > 0)
                        <!-- Actions -->
                        <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex items-center justify-between">
                            <a href="{{ route('admin.dishes.menu-categories.index', $dish) }}" 
                               class="px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
                                Cancel
                            </a>
                            
                            <button type="submit" 
                                    class="px-6 py-2 bg-gradient-to-r from-purple-500 to-indigo-600 hover:from-purple-600 hover:to-indigo-700 text-white rounded-lg font-medium shadow-lg hover:shadow-xl transition-all duration-200">
                                Add Selected Categories
                            </button>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>

    <script>
        function selectAll() {
            document.querySelectorAll('.category-checkbox').forEach(checkbox => {
                checkbox.checked = true;
            });
        }

        function deselectAll() {
            document.querySelectorAll('.category-checkbox').forEach(checkbox => {
                checkbox.checked = false;
            });
        }
    </script>
</x-layouts.app>
