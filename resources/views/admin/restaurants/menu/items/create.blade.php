<x-layouts.app :title="'ახალი მენიუს ელემენტი - ' . ($category->name ?? 'კატეგორია') . ' - ' . $restaurant->name">
    <!-- Page Header -->
    <div class="bg-gradient-to-r from-indigo-50 via-purple-50 to-pink-50 rounded-2xl p-8 mb-8 border border-gray-100 shadow-sm">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <div class="p-3 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl shadow-lg">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </div>
                <div>
                    <h1 class="text-3xl font-bold bg-gradient-to-r from-gray-900 to-gray-600 bg-clip-text text-transparent">
                        ახალი მენიუს ელემენტი
                    </h1>
                    <p class="text-gray-600 mt-1 text-sm">{{ $category->name ?? 'კატეგორია' }} - {{ $restaurant->name }}</p>
                </div>
            </div>
            
            <a href="{{ route('admin.restaurants.menu.categories.show', [$restaurant, $category]) }}"
                class="group inline-flex items-center px-4 py-2.5 text-sm font-semibold text-gray-700 bg-white/70 backdrop-blur-sm border border-gray-200 rounded-xl hover:bg-white hover:border-gray-300 transition-all duration-300 ease-in-out transform hover:-translate-y-0.5 hover:shadow-lg">
                <svg class="w-4 h-4 mr-2 transition-transform duration-200 group-hover:-translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                <span class="relative">
                    Back to Menu Items
                    <span class="absolute inset-x-0 -bottom-px h-px bg-gradient-to-r from-transparent via-gray-400 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                </span>
            </a>
        </div>
    </div>

    <!-- Form Container -->
    <div class="relative">
        <!-- Background decoration -->
        <div class="absolute inset-0 bg-gradient-to-br from-blue-50/30 via-indigo-50/20 to-purple-50/30 rounded-3xl"></div>
        
        <form action="{{ route('admin.restaurants.menu.categories.items.store', [$restaurant, $category]) }}" method="POST" enctype="multipart/form-data"
            class="relative bg-white/80 backdrop-blur-sm rounded-3xl shadow-xl border border-gray-100 overflow-hidden">
            
            <!-- Form header with pattern -->
            <div class="relative bg-gradient-to-r from-indigo-500/5 via-purple-500/5 to-pink-500/5 px-8 py-6 border-b border-gray-100">
                <div class="absolute inset-0 bg-white/50"></div>
                <div class="relative flex items-center space-x-3">
                    <div class="p-2 bg-gradient-to-br from-indigo-100 to-purple-100 rounded-lg">
                        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-semibold text-gray-900">Menu Item Details</h2>
                        <p class="text-sm text-gray-600">Fill in the information below to create a new menu item</p>
                    </div>
                </div>
            </div>

            <!-- Form content -->
            <div class="relative p-8">
                @csrf
                @include('admin.restaurants.menu.items.form')
            </div>
        </form>
    </div>

    <!-- Decorative elements -->
    <div class="fixed top-1/4 -left-10 w-20 h-20 bg-gradient-to-br from-indigo-400/20 to-purple-400/20 rounded-full blur-xl"></div>
    <div class="fixed bottom-1/4 -right-10 w-32 h-32 bg-gradient-to-br from-purple-400/20 to-pink-400/20 rounded-full blur-xl"></div>
</x-layouts.app>