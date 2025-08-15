<x-layouts.app :title="'რესტორნის რედაქტირება'">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">რესტორნის რედაქტირება</h1>
                <p class="mt-2 text-gray-600">განაახლეთ რესტორნის ინფორმაცია ქვემოთ მოცემულ ფორმაში</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('admin.restaurants.show', $restaurant) }}"
                   class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white border border-transparent rounded-lg font-medium text-sm transition-colors duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    ნახვა
                </a>
                <a href="{{ route('admin.restaurants.index') }}"
                   class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white border border-transparent rounded-lg font-medium text-sm transition-colors duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    დაბრუნება
                </a>
            </div>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white shadow-sm border border-gray-200 rounded-xl overflow-hidden">
        <!-- Card Header -->
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
            <div class="flex items-center">
                <div class="flex items-center justify-center w-10 h-10 bg-yellow-100 rounded-lg">
                    <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-gray-900">რესტორნის ინფორმაცია</h3>
                    <p class="text-sm text-gray-600">შეავსეთ ყველა საჭiro ველი</p>
                </div>
            </div>
        </div>

        <!-- Form Content -->
        <div class="p-6">
            @include('admin.restaurants.form', ['restaurant' => $restaurant])
        </div>
    </div>
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-generate slug from English name
    const enNameInput = document.getElementById('en_name');
    const slugInput = document.getElementById('slug');
    
    if (enNameInput && slugInput) {
        enNameInput.addEventListener('input', function() {
            const name = this.value;
            const slug = name.toLowerCase()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-')
                .replace(/^-+|-+$/g, '');
            slugInput.value = slug;
        });
    }

    // Enhanced form validation with better UX
    const form = document.getElementById('restaurant-form');
    const submitButton = form.querySelector('button[type="submit"]');
    
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Show loading state
        submitButton.disabled = true;
        submitButton.innerHTML = `
            <svg class="animate-spin w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            ინახება...
        `;
        
        let valid = true;
        const errors = [];
        
        // Validate required fields
        const requiredFields = [
            { id: 'en_name', name: 'რესტორნის დასახელება (ინგლისურად)' },
            { id: 'ka_name', name: 'რესტორნის დასახელება (ქართულად)' },
            { id: 'slug', name: 'Slug' }
        ];
        
        requiredFields.forEach(field => {
            const input = document.getElementById(field.id);
            if (input && !input.value.trim()) {
                errors.push(`გთხოვთ შეავსოთ: ${field.name}`);
                input.classList.add('border-red-500', 'focus:border-red-500', 'focus:ring-red-500');
                valid = false;
            } else if (input) {
                input.classList.remove('border-red-500', 'focus:border-red-500', 'focus:ring-red-500');
            }
        });
        
        // Validate email format if provided
        const emailInput = document.getElementById('email');
        if (emailInput && emailInput.value.trim()) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(emailInput.value.trim())) {
                errors.push('გთხოვთ შეიყვანოთ სწორი ელ-ფოსტის მისამართი');
                emailInput.classList.add('border-red-500', 'focus:border-red-500', 'focus:ring-red-500');
                valid = false;
            } else {
                emailInput.classList.remove('border-red-500', 'focus:border-red-500', 'focus:ring-red-500');
            }
        }
        
        if (!valid) {
            // Show errors
            const errorHtml = `
                <div class="mb-6 px-4 py-3 rounded-lg bg-red-50 border border-red-200">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-red-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div>
                            <h4 class="text-red-800 font-medium">გთხოვთ გაასწოროთ შემდეგი შეცდომები:</h4>
                            <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                                ${errors.map(error => `<li>${error}</li>`).join('')}
                            </ul>
                        </div>
                    </div>
                </div>
            `;
            
            // Remove existing error messages
            const existingError = form.querySelector('.error-message');
            if (existingError) {
                existingError.remove();
            }
            
            // Add error message at the top of the form
            const errorDiv = document.createElement('div');
            errorDiv.className = 'error-message';
            errorDiv.innerHTML = errorHtml;
            form.insertBefore(errorDiv, form.firstChild);
            
            // Scroll to top of form
            form.scrollIntoView({ behavior: 'smooth', block: 'start' });
            
            // Reset button state
            submitButton.disabled = false;
            submitButton.innerHTML = `
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                განახლება
            `;
            
            return;
        }
        
        // If validation passes, submit the form
        form.submit();
    });
    
    // Real-time validation feedback
    const inputs = form.querySelectorAll('input, textarea, select');
    inputs.forEach(input => {
        input.addEventListener('input', function() {
            // Remove error styling when user starts typing
            this.classList.remove('border-red-500', 'focus:border-red-500', 'focus:ring-red-500');
            
            // Remove error message if it exists
            const errorMessage = form.querySelector('.error-message');
            if (errorMessage && this.value.trim()) {
                errorMessage.remove();
            }
        });
    });
});
</script>
@endpush
</x-layouts.app>
