<div class="flex items-center space-x-3 group" wire:loading.class="opacity-75 pointer-events-none">
    <!-- Current Status Badge with Enhanced Animation -->

        <!-- Enhanced Visual Status Indicator -->
    <div class="hidden sm:flex items-center space-x-2 bg-white/70 backdrop-blur-sm rounded-lg px-3 py-1.5 border border-gray-100 shadow-sm">
        <div class="relative">
            <div class="w-2.5 h-2.5 rounded-full transition-all duration-300 {{ $this->currentStatus === 'Confirmed' ? 'bg-green-500 animate-pulse shadow-green-300 shadow-md' : ($this->currentStatus === 'Pending' ? 'bg-amber-500 animate-pulse shadow-amber-300 shadow-md' : ($this->currentStatus === 'Cancelled' ? 'bg-red-500 shadow-red-300 shadow-md' : 'bg-blue-500 shadow-blue-300 shadow-md')) }}"></div>
            @if($this->currentStatus === 'Confirmed' || $this->currentStatus === 'Pending')
                <div class="absolute inset-0 w-2.5 h-2.5 rounded-full {{ $this->currentStatus === 'Confirmed' ? 'bg-green-400' : 'bg-amber-400' }} animate-ping opacity-75"></div>
            @endif
        </div>
        <span class="text-xs text-gray-600 font-medium">
            {{ $this->currentStatus === 'Confirmed' ? '🎯 აქტიური' : ($this->currentStatus === 'Pending' ? '⏳ მოლოდინში' : ($this->currentStatus === 'Cancelled' ? '❌ გაუქმებული' : '✅ დასრულდა')) }}
        </span>
    </div>
    <!-- Status Change Button/Dropdown with Enhanced Design -->
    <div class="relative">
        <select 
            onchange="confirmStatusChange(this, @this)"
            @if($isUpdating) disabled @endif
            class="appearance-none text-xs font-semibold border-2 border-gray-200 rounded-xl px-4 py-2.5 pr-10 bg-gradient-to-r from-white to-gray-50 hover:from-blue-50 hover:to-indigo-50 hover:border-blue-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-300 shadow-sm hover:shadow-md active:scale-95"
        >
            <option value="" class="text-gray-500 font-normal">
                {{ $isUpdating ? '⏳ იტვირთება...' : '🔄 განახლება' }}
            </option>
            @foreach($this->availableStatuses as $status => $info)
                <option value="{{ $status }}" class="py-3 font-medium">
                    {{ $info['icon'] }} {{ $info['label'] }}
                </option>
            @endforeach
        </select>
        

        
        <!-- Magic Sparkle Effect on Hover -->
        <div class="absolute inset-0 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">
            <div class="absolute top-1 right-1 w-1 h-1 bg-blue-400 rounded-full animate-ping"></div>
            <div class="absolute bottom-1 left-1 w-1 h-1 bg-purple-400 rounded-full animate-ping delay-75"></div>
        </div>
    </div>
    

    
    <!-- Loading Overlay -->
    @if($isUpdating)
        <div class="absolute inset-0 bg-white/80 backdrop-blur-sm rounded-xl flex items-center justify-center">
            <div class="flex items-center space-x-2 text-blue-600">
                <div class="animate-spin h-4 w-4 border-2 border-blue-500 border-t-transparent rounded-full"></div>
                <span class="text-xs font-medium">განახლება...</span>
            </div>
        </div>
    @endif
</div>

@push('scripts')
<script>
    document.addEventListener('livewire:initialized', () => {
        @this.on('status-updated', (data) => {
            showToast(data.message || 'სტატუსი წარმატებით განახლდა! ✅', 'success');
        });
        
        @this.on('status-error', (data) => {
            showToast(data.message || 'შეცდომა სტატუსის განახლებისას ❌', 'error');
        });
        
        @this.on('status-info', (data) => {
            showToast(data.message || 'ინფორმაცია ℹ️', 'info');
        });
    });
    
    function confirmStatusChange(selectElement, component) {
        const newStatus = selectElement.value;
        
        if (!newStatus) {
            return;
        }
        
        // Reset select value
        selectElement.value = '';
        
        // Status confirmation messages with emojis
        const statusTexts = {
            'Pending': '🟡 მოლოდინში გადაყვანას',
            'Confirmed': '🟢 დადასტურებას',
            'Completed': '🔵 დასრულებას',
            'Cancelled': '🔴 გაუქმებას'
        };
        
        // Create custom confirmation dialog
        showConfirmationDialog(
            `დარწმუნებული ხართ რომ გსურთ ჯავშნის ${statusTexts[newStatus] || 'სტატუსის ცვლილება'}?`,
            () => {
                // Call Livewire method
                component.call('updateStatus', newStatus);
            }
        );
    }
    
    function showConfirmationDialog(message, onConfirm) {
        // Create custom modal with enhanced design
        const modal = document.createElement('div');
        modal.className = 'fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-50 animate-fade-in';
        modal.innerHTML = `
            <div class="bg-white rounded-3xl shadow-2xl max-w-md w-full mx-4 transform animate-scale-in glass-effect">
                <div class="p-8">
                    <!-- Icon -->
                    <div class="flex items-center justify-center w-16 h-16 mx-auto mb-6 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-full shadow-lg animate-float">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    
                    <!-- Title -->
                    <h3 class="text-xl font-bold text-gray-900 mb-3 text-center bg-gradient-to-r from-gray-900 to-gray-700 bg-clip-text text-transparent">
                        🔄 სტატუსის ცვლილება
                    </h3>
                    
                    <!-- Message -->
                    <p class="text-gray-600 mb-8 text-center leading-relaxed">${message}</p>
                    
                    <!-- Buttons -->
                    <div class="flex space-x-4">
                        <button 
                            onclick="this.closest('.fixed').remove()" 
                            class="flex-1 px-6 py-3 text-gray-700 bg-gradient-to-r from-gray-100 to-gray-200 hover:from-gray-200 hover:to-gray-300 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105 active:scale-95 shadow-md hover:shadow-lg"
                        >
                            🚫 გაუქმება
                        </button>
                        <button 
                            onclick="confirmAction()" 
                            class="flex-1 px-6 py-3 text-white bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105 active:scale-95 shadow-md hover:shadow-lg success-glow"
                        >
                            ✅ დადასტურება
                        </button>
                    </div>
                </div>
                
                <!-- Decorative elements -->
                <div class="absolute top-4 right-4 w-2 h-2 bg-blue-400 rounded-full animate-ping opacity-75"></div>
                <div class="absolute bottom-4 left-4 w-1 h-1 bg-purple-400 rounded-full animate-ping delay-150 opacity-75"></div>
            </div>
        `;
        
        document.body.appendChild(modal);
        
        // Add confirmation action
        window.confirmAction = function() {
            modal.classList.add('animate-fade-out');
            setTimeout(() => {
                modal.remove();
                onConfirm();
            }, 200);
        };
        
        // Close on backdrop click with animation
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                modal.classList.add('animate-fade-out');
                setTimeout(() => modal.remove(), 200);
            }
        });
        
        // Close on Escape key
        const handleEscape = (e) => {
            if (e.key === 'Escape') {
                modal.classList.add('animate-fade-out');
                setTimeout(() => modal.remove(), 200);
                document.removeEventListener('keydown', handleEscape);
            }
        };
        document.addEventListener('keydown', handleEscape);
    }
    
    function showToast(message, type = 'success') {
        // Enhanced toast design
        const toast = document.createElement('div');
        
        const typeStyles = {
            success: {
                bg: 'bg-gradient-to-r from-green-50 to-emerald-50',
                border: 'border-green-200',
                text: 'text-green-800',
                icon: '✅',
                iconBg: 'bg-green-500'
            },
            error: {
                bg: 'bg-gradient-to-r from-red-50 to-pink-50',
                border: 'border-red-200',
                text: 'text-red-800',
                icon: '❌',
                iconBg: 'bg-red-500'
            },
            info: {
                bg: 'bg-gradient-to-r from-blue-50 to-indigo-50',
                border: 'border-blue-200',
                text: 'text-blue-800',
                icon: 'ℹ️',
                iconBg: 'bg-blue-500'
            }
        };
        
        const style = typeStyles[type];
        
        toast.className = `fixed top-4 right-4 z-50 max-w-sm border-2 ${style.border} ${style.bg} rounded-xl shadow-xl transition-all duration-500 transform translate-x-full animate-slide-in`;
        toast.innerHTML = `
            <div class="p-4">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <div class="flex items-center justify-center w-8 h-8 ${style.iconBg} rounded-full">
                            <span class="text-white text-sm">${style.icon}</span>
                        </div>
                    </div>
                    <div class="ml-3 flex-1">
                        <p class="text-sm font-semibold ${style.text}">${message}</p>
                    </div>
                    <button onclick="this.closest('.fixed').remove()" class="flex-shrink-0 ml-4 ${style.text} hover:text-gray-600 transition-colors">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
            </div>
            <div class="h-1 ${style.iconBg} rounded-b-xl animate-progress"></div>
        `;
        
        document.body.appendChild(toast);
        
        // Slide in animation
        setTimeout(() => {
            toast.classList.remove('translate-x-full');
            toast.classList.add('translate-x-0');
        }, 100);
        
        // Auto remove after 4 seconds
        setTimeout(() => {
            if (toast.parentElement) {
                toast.classList.add('translate-x-full');
                setTimeout(() => toast.remove(), 300);
            }
        }, 4000);
    }
</script>
@endpush

@push('styles')
<style>
    @keyframes fade-in {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    @keyframes scale-in {
        from { transform: scale(0.9) translateY(-20px); opacity: 0; }
        to { transform: scale(1) translateY(0); opacity: 1; }
    }
    
    @keyframes slide-in {
        from { transform: translateX(100%) scale(0.9); opacity: 0; }
        to { transform: translateX(0) scale(1); opacity: 1; }
    }
    
    @keyframes progress {
        from { width: 100%; }
        to { width: 0%; }
    }
    
    @keyframes bounce-slow {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-2px); }
    }
    
    @keyframes shimmer {
        0% { background-position: -200px 0; }
        100% { background-position: calc(200px + 100%) 0; }
    }
    
    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-3px); }
    }
    
    .animate-fade-in {
        animation: fade-in 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .animate-scale-in {
        animation: scale-in 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    
    .animate-slide-in {
        animation: slide-in 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .animate-progress {
        animation: progress 4s linear;
    }
    
    .animate-bounce-slow {
        animation: bounce-slow 3s ease-in-out infinite;
    }
    
    .animate-shimmer {
        animation: shimmer 2s infinite;
        background: linear-gradient(90deg, transparent 0%, rgba(255,255,255,0.4) 50%, transparent 100%);
        background-size: 200px 100%;
    }
    
    .animate-float {
        animation: float 6s ease-in-out infinite;
    }
    
    /* Enhanced select styling */
    select::-ms-expand {
        display: none;
    }
    
    select option {
        padding: 12px 16px;
        background: white;
        border: none;
        transition: all 0.2s ease;
    }
    
    select option:hover {
        background: linear-gradient(to right, #f3f4f6, #e5e7eb);
        transform: translateX(2px);
    }
    
    select option:checked {
        background: linear-gradient(to right, #dbeafe, #bfdbfe);
        font-weight: 600;
    }
    
    /* Glassmorphism effect */
    .glass-effect {
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    /* Success glow */
    .success-glow {
        box-shadow: 0 0 20px rgba(34, 197, 94, 0.3);
    }
    
    /* Error glow */
    .error-glow {
        box-shadow: 0 0 20px rgba(239, 68, 68, 0.3);
    }
    
    /* Loading pulse */
    .loading-pulse {
        animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }
    
    /* Custom scrollbar for modals */
    .custom-scrollbar::-webkit-scrollbar {
        width: 6px;
    }
    
    .custom-scrollbar::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 10px;
    }
    
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 10px;
    }
    
    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
</style>
@endpush
