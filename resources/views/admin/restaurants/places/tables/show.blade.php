<x-layouts.app :title="'მაგიდის დეტალები'">
    <!-- Enhanced Breadcrumb Navigation -->
    <nav class="flex mb-6" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-2 bg-white/80 backdrop-blur-sm border border-gray-200/50 rounded-xl lg:rounded-2xl px-3 sm:px-6 py-2 sm:py-3 shadow-lg">
            <li class="inline-flex items-center">
                <a href="{{ route('admin.restaurants.index') }}" class="inline-flex items-center text-sm font-semibold text-gray-600 hover:text-blue-600 transition-all duration-200 hover:scale-105">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-1.5 sm:mr-2.5 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                    </svg>
                    <span class="hidden sm:inline">რესტორნები</span>
                    <span class="sm:hidden">რესტორნები</span>
                </a>
            </li>
            @if($table->restaurant)
                <li class="inline-flex items-center">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                        <a href="{{ route('admin.restaurants.show', $table->restaurant) }}" class="ml-1 sm:ml-2 inline-flex items-center text-sm font-semibold text-gray-600 hover:text-blue-600 transition-all duration-200 hover:scale-105">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-1.5 sm:mr-2 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h1a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            <span class="hidden sm:inline">{{ $table->restaurant->translate('ka')->name ?? $table->restaurant->translate('en')->name ?? 'რესტორანი' }}</span>
                            <span class="sm:hidden">რესტორანი</span>
                        </a>
                    </div>
                </li>
            @endif
            @if($table->place)
                <li class="inline-flex items-center">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                        <a href="{{ route('admin.restaurants.places.show', [$table->restaurant, $table->place]) }}" class="ml-1 sm:ml-2 inline-flex items-center text-sm font-semibold text-gray-600 hover:text-blue-600 transition-all duration-200 hover:scale-105">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-1.5 sm:mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span class="hidden sm:inline">{{ $table->place->translate('ka')->name ?? $table->place->translate('en')->name ?? 'ადგილი' }}</span>
                            <span class="sm:hidden">ადგილი</span>
                        </a>
                    </div>
                </li>
            @endif
            <li class="inline-flex items-center">
                <div class="flex items-center">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                    <a href="{{ route('admin.restaurants.places.tables.index', [$table->restaurant, $table->place]) }}" class="ml-1 sm:ml-2 inline-flex items-center text-sm font-semibold text-gray-600 hover:text-blue-600 transition-all duration-200 hover:scale-105">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-1.5 sm:mr-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                        </svg>
                        <span class="hidden sm:inline">მაგიდები</span>
                        <span class="sm:hidden">მაგიდები</span>
                    </a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                    <span class="ml-1 sm:ml-2 text-sm font-bold text-indigo-600 bg-indigo-50 px-2 sm:px-3 py-1 rounded-lg lg:rounded-xl truncate max-w-[200px] sm:max-w-none">{{ $table->translate('ka')->name ?? $table->translate('en')->name ?? 'მაგიდის დეტალები' }}</span>
                </div>
            </li>
        </ol>
    </nav>

    <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
        <h1 class="text-3xl font-bold text-gray-800">მაგიდის დეტალები</h1>
        <div class="flex gap-2">
            <a href="{{ route('admin.restaurants.places.tables.edit', [$table->restaurant, $table->place, $table]) }}"
               class="inline-flex items-center px-4 py-2 bg-yellow-600 hover:bg-yellow-700 text-white border border-transparent rounded-lg font-semibold text-sm transition ease-in-out duration-150">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                რედაქტირება
            </a>
            <a href="{{ route('admin.restaurants.places.tables.index', [$table->restaurant, $table->place]) }}"
               class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 border border-transparent rounded-lg font-semibold text-sm transition ease-in-out duration-150">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                დაბრუნება
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Information -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Basic Info -->
            <div class="bg-white shadow-lg rounded-xl border border-gray-100">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">ძირითადი ინფორმაცია</h3>
                </div>
                <div class="p-6">
                    <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <dt class="text-sm font-medium text-gray-500 mb-1">ID</dt>
                            <dd class="text-sm text-gray-900">{{ $table->id }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 mb-1">ტევადობა</dt>
                            <dd class="text-sm text-gray-900">{{ $table->capacity ?? $table->seats ?? '—' }} ადამიანი</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 mb-1">რანგი</dt>
                            <dd class="text-sm text-gray-900">{{ $table->rank ?? 0 }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 mb-1">სტატუსი</dt>
                            <dd>
                                @if($table->status == 1 || $table->status === 'active')
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                        აქტიური
                                    </span>
                                @else
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                        არააქტიური
                                    </span>
                                @endif
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 mb-1">რესტორანი</dt>
                            <dd class="text-sm text-gray-900">
                                @if($table->restaurant)
                                    <a href="{{ route('admin.restaurants.show', $table->restaurant) }}" class="text-blue-600 hover:text-blue-800">
                                        {{ $table->restaurant->translate('ka')->name ?? $table->restaurant->translate('en')->name ?? 'Restaurant #' . $table->restaurant->id }}
                                    </a>
                                @else
                                    —
                                @endif
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 mb-1">ადგილი</dt>
                            <dd class="text-sm text-gray-900">
                                @if($table->place)
                                    <a href="{{ route('admin.restaurants.places.show', [$table->restaurant, $table->place]) }}" class="text-blue-600 hover:text-blue-800">
                                        {{ $table->place->translate('ka')->name ?? $table->place->translate('en')->name ?? 'Place #' . $table->place->id }}
                                    </a>
                                @else
                                    —
                                @endif
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>

            <!-- Multilingual Names -->
            <div class="bg-white shadow-lg rounded-xl border border-gray-100">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">დასახელებები</h3>
                </div>
                <div class="p-6">
                    <dl class="space-y-4">
                        @foreach (config('translatable.locales') as $locale)
                            <div class="border-b border-gray-100 pb-3 last:border-b-0">
                                <dt class="text-sm font-medium text-gray-500 mb-1">
                                    {{ strtoupper($locale) }}
                                </dt>
                                <dd class="text-sm text-gray-900">
                                    {{ $table->translate($locale)->name ?? '—' }}
                                </dd>
                            </div>
                        @endforeach
                    </dl>
                </div>
            </div>
            <!-- Image -->
            @if ($table->image_link || $table->image)
                <div class="bg-white shadow-lg rounded-xl border border-gray-100">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">სურათი</h3>
                    </div>
                    <div class="p-6">
                        <img src="{{ $table->image_link ?? $table->image }}" 
                             alt="{{ $table->translate('ka')->name ?? $table->translate('en')->name }}"
                             class="w-full h-48 object-cover rounded-lg border border-gray-300">
                        @if ($table->image_link)
                            <div class="mt-3">
                                <a href="{{ $table->image_link }}" target="_blank" 
                                   class="text-sm text-blue-600 hover:text-blue-800 break-all">
                                    {{ $table->image_link }}
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            @endif

            <!-- QR Code -->
            @if ($table->qr_code_image || $table->qr_code_link)
                <div class="bg-white shadow-lg rounded-xl border border-gray-100">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">QR კოდი</h3>
                    </div>
                    <div class="p-6">
                        @if ($table->qr_code_image)
                            <div class="text-center mb-4">
                                <img src="{{ $table->qr_code_image }}" alt="QR Code" class="w-48 h-48 mx-auto border border-gray-300 rounded-lg">
                            </div>
                            <div class="text-center">
                                <a href="{{ $table->qr_code_image }}" target="_blank" 
                                   class="inline-flex items-center px-3 py-2 text-sm font-medium text-blue-600 hover:text-blue-800">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                    </svg>
                                    სრულ ზომაში ნახვა
                                </a>
                            </div>
                        @endif
                        
                        @if ($table->qr_code_link)
                            <div class="mt-4 p-3 bg-gray-50 rounded-lg">
                                <p class="text-sm font-medium text-gray-700 mb-2">QR კოდის ლინკი:</p>
                                <a href="{{ $table->qr_code_link }}" target="_blank" 
                                   class="text-sm text-blue-600 hover:text-blue-800 break-all">
                                    {{ $table->qr_code_link }}
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            @endif

            <!-- Descriptions -->
            @if ($table->translations->whereNotNull('description')->count() > 0)
                <div class="bg-white shadow-lg rounded-xl border border-gray-100">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">აღწერები</h3>
                    </div>
                    <div class="p-6">
                        <dl class="space-y-4">
                            @foreach (config('translatable.locales') as $locale)
                                @if ($table->translate($locale)->description)
                                    <div class="border-b border-gray-100 pb-3 last:border-b-0">
                                        <dt class="text-sm font-medium text-gray-500 mb-1">
                                            {{ strtoupper($locale) }}
                                        </dt>
                                        <dd class="text-sm text-gray-900">
                                            {{ $table->translate($locale)->description }}
                                        </dd>
                                    </div>
                                @endif
                            @endforeach
                        </dl>
                    </div>
                </div>
            @endif

        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Table Statistics & Actions -->
            <div class="bg-white shadow-lg rounded-xl border border-gray-100">
                <div class="px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-gradient-to-br from-purple-500 to-indigo-600 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900">მაგიდის სტატისტიკა</h3>
                    </div>
                </div>
                <div class="p-6">
                    <!-- Statistics -->
                    <div class="bg-gradient-to-r from-purple-50 to-indigo-50 rounded-lg p-4 border border-purple-200 mb-6">
                        <dl class="space-y-3">
                            <div class="flex justify-between items-center">
                                <dt class="text-sm font-medium text-gray-600">ID:</dt>
                                <dd class="text-sm font-medium text-gray-900">{{ $table->id }}</dd>
                            </div>
                            <div class="flex justify-between items-center">
                                <dt class="text-sm font-medium text-gray-600">ტევადობა:</dt>
                                <dd class="text-sm font-medium text-gray-900">{{ $table->capacity ?? $table->seats ?? '—' }}</dd>
                            </div>
                            <div class="flex justify-between items-center">
                                <dt class="text-sm font-medium text-gray-600">სტატუსი:</dt>
                                <dd>
                                    @if($table->status == 1 || $table->status === 'active')
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                            აქტიური
                                        </span>
                                    @else
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                            არააქტიური
                                        </span>
                                    @endif
                                </dd>
                            </div>
                            @if($table->rank)
                                <div class="flex justify-between items-center">
                                    <dt class="text-sm font-medium text-gray-600">რანგი:</dt>
                                    <dd class="text-sm font-medium text-gray-900">{{ $table->rank }}</dd>
                                </div>
                            @endif
                            
                            <!-- Divider -->
                            <div class="border-t border-purple-200 my-3"></div>
                            
                            <div class="flex justify-between items-center">
                                <dt class="text-sm font-medium text-gray-600">შექმნის თარიღი:</dt>
                                <dd class="text-sm font-medium text-gray-900">{{ $table->created_at->format('d.m.Y H:i') }}</dd>
                            </div>
                            <div class="flex justify-between items-center">
                                <dt class="text-sm font-medium text-gray-600">განახლების თარიღი:</dt>
                                <dd class="text-sm font-medium text-gray-900">{{ $table->updated_at->format('d.m.Y H:i') }}</dd>
                            </div>
                            
                            @if($table->createdBy)
                                <div class="flex justify-between items-start">
                                    <dt class="text-sm font-medium text-gray-600">შემქმნელი:</dt>
                                    <dd class="text-right">
                                        <div class="text-sm font-medium text-gray-900">{{ $table->createdBy->name }}</div>
                                        <div class="text-xs text-gray-500">{{ $table->createdBy->email }}</div>
                                        @if($table->createdBy->roles && $table->createdBy->roles->count() > 0)
                                            <div class="text-xs text-purple-600 font-medium mt-1">
                                                {{ $table->createdBy->roles->pluck('name')->join(', ') }}
                                            </div>
                                        @else
                                            <div class="text-xs text-gray-400 mt-1">როლი არ არის მითითებული</div>
                                        @endif
                                    </dd>
                                </div>
                            @else
                                <div class="flex justify-between items-center">
                                    <dt class="text-sm font-medium text-gray-600">შემქმნელი:</dt>
                                    <dd class="text-sm text-gray-400">ინფორმაცია არ არის ხელმისაწვდომი</dd>
                                </div>
                            @endif
                            
                            @if($table->updatedBy && $table->updatedBy->id !== $table->createdBy?->id)
                                <div class="flex justify-between items-start">
                                    <dt class="text-sm font-medium text-gray-600">განამახლებელი:</dt>
                                    <dd class="text-right">
                                        <div class="text-sm font-medium text-gray-900">{{ $table->updatedBy->name }}</div>
                                        <div class="text-xs text-gray-500">{{ $table->updatedBy->email }}</div>
                                        @if($table->updatedBy->roles && $table->updatedBy->roles->count() > 0)
                                            <div class="text-xs text-purple-600 font-medium mt-1">
                                                {{ $table->updatedBy->roles->pluck('name')->join(', ') }}
                                            </div>
                                        @else
                                            <div class="text-xs text-gray-400 mt-1">როლი არ არის მითითებული</div>
                                        @endif
                                    </dd>
                                </div>
                            @elseif($table->updatedBy && $table->updatedBy->id === $table->createdBy?->id)
                                <div class="flex justify-between items-center">
                                    <dt class="text-sm font-medium text-gray-600">განამახლებელი:</dt>
                                    <dd class="text-sm text-gray-500">იგივე რაც შემქმნელი</dd>
                                </div>
                            @elseif(!$table->createdBy)
                                <div class="flex justify-between items-center">
                                    <dt class="text-sm font-medium text-gray-600">განამახლებელი:</dt>
                                    <dd class="text-sm text-gray-400">ინფორმაცია არ არის ხელმისაწვდომი</dd>
                                </div>
                            @endif
                            
                            <!-- Additional Info -->
                            <div class="border-t border-purple-200 my-3"></div>
                            
                            @if($table->restaurant)
                                <div class="flex justify-between items-start">
                                    <dt class="text-sm font-medium text-gray-600">რესტორანი:</dt>
                                    <dd class="text-right">
                                        <div class="text-sm font-medium text-gray-900">{{ $table->restaurant->translate('ka')->name ?? $table->restaurant->translate('en')->name ?? '—' }}</div>
                                        <div class="text-xs text-gray-500">ID: {{ $table->restaurant->id }}</div>
                                    </dd>
                                </div>
                            @endif
                            
                            @if($table->place)
                                <div class="flex justify-between items-start">
                                    <dt class="text-sm font-medium text-gray-600">ადგილი:</dt>
                                    <dd class="text-right">
                                        <div class="text-sm font-medium text-gray-900">{{ $table->place->translate('ka')->name ?? $table->place->translate('en')->name ?? '—' }}</div>
                                        <div class="text-xs text-gray-500">ID: {{ $table->place->id }}</div>
                                    </dd>
                                </div>
                            @endif
                            
                            @if($table->qr_code_link)
                                <div class="flex justify-between items-start">
                                    <dt class="text-sm font-medium text-gray-600">QR ლინკი:</dt>
                                    <dd class="text-right">
                                        <a href="{{ $table->qr_code_link }}" target="_blank" 
                                           class="inline-flex items-center text-sm text-blue-600 hover:text-blue-800 transition-colors">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                            </svg>
                                            გახსნა
                                        </a>
                                    </dd>
                                </div>
                            @endif
                            
                            @if ($table->slug)
                                <div class="flex justify-between items-center">
                                    <dt class="text-sm font-medium text-gray-600">Slug:</dt>
                                    <dd class="text-sm font-medium text-gray-900 font-mono">{{ $table->slug }}</dd>
                                </div>
                            @endif
                        </dl>
                    </div>
                    
                    <!-- Actions -->
                    <div class="border-t border-gray-200 pt-6">
                        <h4 class="text-sm font-semibold text-gray-700 mb-4 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4"></path>
                            </svg>
                            მოქმედებები
                        </h4>
                        <div class="space-y-3">
                            <a href="{{ route('admin.restaurants.places.tables.edit', [$table->restaurant, $table->place, $table]) }}"
                               class="w-full inline-flex items-center justify-center px-4 py-2 bg-yellow-600 hover:bg-yellow-700 text-white border border-transparent rounded-lg font-semibold text-sm transition ease-in-out duration-150">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                რედაქტირება
                            </a>

                            <form action="{{ route('admin.restaurants.places.tables.destroy', [$table->restaurant, $table->place, $table]) }}" method="POST" 
                                  onsubmit="return confirm('დარწმუნებული ხართ რომ გსურთ ამ მაგიდის წაშლა?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="w-full inline-flex items-center justify-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white border border-transparent rounded-lg font-semibold text-sm transition ease-in-out duration-150">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                    წაშლა
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TimeSlots Section -->
            <div class="bg-white shadow-lg rounded-xl border border-gray-100">
                <div class="px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            დროის ლოტები (TimeSlots)
                        </h3>
                        <div class="flex items-center space-x-4">
                            <span class="text-sm text-gray-500">
                                სულ {{ $table->reservationSlots->count() }} ლოტი
                            </span>
                            <a href="{{ route('admin.restaurants.places.tables.slots.index', [$restaurant, $place, $table]) }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-800 underline">
                                ყველა ლოტი
                            </a>
                            @if($table->reservationSlots->count() > 0)
                                <a href="{{ route('admin.restaurants.places.tables.slots.create', [$restaurant, $place, $table]) }}" 
                                   class="text-sm font-medium text-blue-600 hover:text-blue-800">
                                    + ახალი ლოტი
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    @if($table->reservationSlots->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($table->reservationSlots as $slot)
                                <div class="bg-gradient-to-br from-blue-50 to-indigo-50 border border-blue-200 rounded-lg p-4 hover:shadow-md transition-all duration-300">
                                    <div class="flex items-center justify-between mb-3">
                                        <h4 class="font-semibold text-gray-900">
                                            @switch($slot->day_of_week)
                                                @case('Monday')
                                                    ორშაბათი
                                                    @break
                                                @case('Tuesday')
                                                    სამშაბათი
                                                    @break
                                                @case('Wednesday')
                                                    ოთხშაბათი
                                                    @break
                                                @case('Thursday')
                                                    ხუთშაბათი
                                                    @break
                                                @case('Friday')
                                                    პარასკევი
                                                    @break
                                                @case('Saturday')
                                                    შაბათი
                                                    @break
                                                @case('Sunday')
                                                    კვირა
                                                    @break
                                                @default
                                                    {{ $slot->day_of_week }}
                                            @endswitch
                                        </h4>
                                        @if($slot->available)
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                                ხელმისაწვდომია
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800">
                                                არ არის ხელმისაწვდომი
                                            </span>
                                        @endif
                                    </div>
                                    
                                    <div class="space-y-2">
                                        <div class="flex items-center justify-between">
                                            <span class="text-sm font-medium text-gray-600">დრო:</span>
                                            <span class="text-sm font-semibold text-gray-900">
                                                {{ \Carbon\Carbon::parse($slot->time_from)->format('H:i') }} - 
                                                {{ \Carbon\Carbon::parse($slot->time_to)->format('H:i') }}
                                            </span>
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <span class="text-sm font-medium text-gray-600">ინტერვალი:</span>
                                            <span class="text-sm font-semibold text-gray-900">{{ $slot->slot_interval_minutes }} წუთი</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div class="w-16 h-16 bg-gradient-to-br from-blue-400 to-indigo-500 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h4 class="text-lg font-semibold text-gray-900 mb-2">დროის ლოტები არ არის</h4>
                            <p class="text-gray-600 mb-4">ამ მაგიდას ჯერ არ აქვს დამატებული რეზერვაციის დროის ლოტები.</p>
                            <a href="{{ route('admin.restaurants.places.tables.slots.create', [$restaurant, $place, $table]) }}" 
                               class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition-colors duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                დროის ლოტის დამატება
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
