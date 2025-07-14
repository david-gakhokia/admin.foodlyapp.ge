@props([
    'entity' => null,
    'fields' => [
        'name' => ['label' => 'დასახელება', 'required' => true, 'type' => 'input'],
        'description' => ['label' => 'აღწერა', 'required' => false, 'type' => 'textarea'],
        'address' => ['label' => 'მისამართი', 'required' => false, 'type' => 'textarea']
    ],
    'title' => 'თარგმანები'
])

<div class="bg-gradient-to-r from-indigo-50 to-purple-50 rounded-xl p-6 border border-indigo-200">
    <div class="flex items-center mb-6">
        <div class="flex items-center justify-center w-10 h-10 bg-indigo-600 rounded-lg mr-3">
            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 716.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129" />
            </svg>
        </div>
        <h3 class="text-lg font-semibold text-gray-900">{{ $title }}</h3>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        @foreach (config('translatable.locales') as $locale)
            <div class="bg-white rounded-lg border border-gray-200 p-4">
                <h4 class="font-medium text-gray-900 mb-4 flex items-center">
                    @if($locale === 'ka')
                        🇬🇪 ქართული
                    @elseif($locale === 'en')
                        🇺🇸 English
                    @else
                        {{ strtoupper($locale) }}
                    @endif
                </h4>

                <div class="space-y-4">
                    @foreach($fields as $fieldName => $fieldConfig)
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                {{ $fieldConfig['label'] }}
                                @if($fieldConfig['required'])
                                    <span class="text-red-500">*</span>
                                @endif
                            </label>
                            
                            @if($fieldConfig['type'] === 'textarea')
                                <textarea name="{{ $locale }}[{{ $fieldName }}]" rows="3"
                                    class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 text-sm"
                                    @if($fieldConfig['required']) required @endif>{{ old($locale . '.' . $fieldName, isset($entity) ? $entity->translate($locale)?->{$fieldName} : '') }}</textarea>
                            @else
                                <input type="text" name="{{ $locale }}[{{ $fieldName }}]"
                                    value="{{ old($locale . '.' . $fieldName, isset($entity) ? $entity->translate($locale)?->{$fieldName} : '') }}"
                                    class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 text-sm"
                                    @if($fieldConfig['required']) required @endif>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</div>
