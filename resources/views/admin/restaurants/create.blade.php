<x-layouts.app :title="'ახალი რესტორნის დამატება'">
    <!-- Header with enhanced styling -->
    <div class="mb-8">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div class="flex items-start space-x-4">
                <!-- Icon Badge -->
                <div class="flex items-center justify-center w-14 h-14 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl shadow-lg">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">ახალი რესტორნის დამატება</h1>
                    <p class="text-gray-600 text-lg">შეავსეთ ყველა საჭირო ველი ახალი რესტორნის შესაქმნელად</p>
                    <!-- Progress indicator -->
                    <div class="mt-3 flex items-center space-x-2">
                        <div class="flex items-center text-sm text-gray-500">
                            <svg class="w-4 h-4 mr-1 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            ნაბიჯი 1/1: ძირითადი ინფორმაცია
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('admin.restaurants.index') }}"
                   class="inline-flex items-center px-4 py-2.5 bg-white hover:bg-gray-50 text-gray-700 border border-gray-300 rounded-lg font-medium text-sm transition-all duration-200 shadow-sm hover:shadow-md">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    დაბრუნება
                </a>
            </div>
        </div>
    </div>

    <!-- Enhanced Form Card with gradient and animations -->
    <div class="bg-white shadow-xl border border-gray-200 rounded-2xl overflow-hidden transform transition-all duration-300 hover:shadow-2xl">
        <!-- Card Header with gradient -->
        <div class="px-6 py-5 bg-gradient-to-r from-green-50 to-emerald-50 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="flex items-center justify-center w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl shadow-lg mr-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900">რესტორნის ინფორმაცია</h3>
                        <p class="text-sm text-gray-600 mt-1">შეავსეთ ყველა საჭირო ველი ქვემოთ</p>
                    </div>
                </div>
                <!-- Form progress indicator -->
                <div class="hidden sm:flex items-center space-x-2">
                    <div class="flex items-center text-xs text-gray-500">
                        <div class="w-2 h-2 bg-green-500 rounded-full mr-2"></div>
                        აქტიური
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Content with enhanced styling -->
        <div class="p-8 bg-gray-50">
            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                @include('admin.restaurants.form', ['restaurant' => null, 'buttonText' => 'დამატება'])
            </div>
        </div>
    </div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add entrance animation
    const formCard = document.querySelector('.bg-white.shadow-xl');
    if (formCard) {
        formCard.style.opacity = '0';
        formCard.style.transform = 'translateY(20px)';
        setTimeout(() => {
            formCard.style.transition = 'all 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
            formCard.style.opacity = '1';
            formCard.style.transform = 'translateY(0)';
        }, 100);
    }
});
</script>
@endpush
</x-layouts.app>
