<x-layouts.app title="მენიუს ელემენტის რედაქტირება">
    <!-- Page Header -->
    <div class="bg-gradient-to-r from-orange-50 via-amber-50 to-yellow-50 rounded-2xl p-8 mb-8 border border-gray-100 shadow-sm">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <div class="p-3 bg-gradient-to-br from-orange-500 to-amber-600 rounded-xl shadow-lg">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                </div>
                <div>
                    <h1 class="text-3xl font-bold bg-gradient-to-r from-gray-900 to-gray-600 bg-clip-text text-transparent">
                        მენიუს ელემენტის რედაქტირება
                    </h1>
                    <p class="text-gray-600 mt-1 text-sm">მენიუს ელემენტის რედაქტირება</p>
                </div>
            </div>
            
            <a href="{{ route('admin.restaurants.menu.categories.show', [$item->restaurant, $item->menuCategory]) }}"
                class="group inline-flex items-center px-4 py-2.5 text-sm font-semibold text-gray-700 bg-white/70 backdrop-blur-sm border border-gray-200 rounded-xl hover:bg-white hover:border-gray-300 transition-all duration-300 ease-in-out transform hover:-translate-y-0.5 hover:shadow-lg">
                <svg class="w-4 h-4 mr-2 transition-transform duration-200 group-hover:-translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                <span class="relative">
                    კატეგორიაზე დაბრუნება
                    <span class="absolute inset-x-0 -bottom-px h-px bg-gradient-to-r from-transparent via-gray-400 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                </span>
            </a>
        </div>
    </div>

    <!-- Form Container -->
    <div class="relative">
        <!-- Background decoration -->
        <div class="absolute inset-0 bg-gradient-to-br from-orange-50/30 via-amber-50/20 to-yellow-50/30 rounded-3xl"></div>
        
        <form action="{{ route('admin.restaurants.menu.categories.items.update', [$item->restaurant, $item->menuCategory, $item]) }}" method="POST" enctype="multipart/form-data"
            class="relative bg-white/80 backdrop-blur-sm rounded-3xl shadow-xl border border-gray-100 overflow-hidden">
            
            <!-- Form header with pattern -->
            <div class="relative bg-gradient-to-r from-orange-500/5 via-amber-500/5 to-yellow-500/5 px-8 py-6 border-b border-gray-100">
                <div class="absolute inset-0 bg-white/50"></div>
                <div class="relative flex items-center space-x-3">
                    <div class="p-2 bg-gradient-to-br from-orange-100 to-amber-100 rounded-lg">
                        <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-semibold text-gray-900">მენიუს ელემენტის დეტალები</h2>
                        <p class="text-sm text-gray-600">განაახლეთ ინფორმაცია ქვემოთ მოცემულ ველებში</p>
                    </div>
                </div>
            </div>

            <!-- Form content -->
            <div class="relative p-8">
                @csrf
                @method('PUT')
                @include('admin.restaurants.menu.items.form', ['menuItem' => $item])
            </div>
        </form>
    </div>

    <!-- Decorative elements -->
    <div class="fixed top-1/4 -left-10 w-20 h-20 bg-gradient-to-br from-orange-400/20 to-amber-400/20 rounded-full blur-xl"></div>
    <div class="fixed bottom-1/4 -right-10 w-32 h-32 bg-gradient-to-br from-amber-400/20 to-yellow-400/20 rounded-full blur-xl"></div>
</x-layouts.app>