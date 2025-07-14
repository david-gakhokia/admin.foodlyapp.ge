<?php

namespace App\Http\Requests\Table;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class StoreTableRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            // These will be set automatically in the nested route, so not required from form
            'restaurant_id' => 'nullable|exists:restaurants,id',
            'place_id' => 'nullable|exists:places,id',
            'seats' => 'required|integer|min:1|max:50',
            'capacity' => 'nullable|integer|min:1|max:100',
            'status' => 'required|in:active,inactive',
            'rank' => 'nullable|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_link' => 'nullable|string|url',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'icon' => 'nullable|string|max:100',
        ];

        // Add validation for all locales using nested array notation
        $defaultLocale = config('app.locale');
        foreach (config('translatable.locales') as $locale) {
            if ($locale === $defaultLocale) {
                // Default locale is required
                $rules["translations.{$locale}.name"] = 'required|string|max:255';
                $rules["translations.{$locale}.description"] = 'nullable|string';
            } else {
                // Other locales are optional
                $rules["translations.{$locale}.name"] = 'nullable|string|max:255';
                $rules["translations.{$locale}.description"] = 'nullable|string';
            }
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'restaurant_id.required' => 'რესტორნის არჩევა სავალდებულოა',
            'restaurant_id.exists' => 'არჩეული რესტორანი არ არსებობს',
            'place_id.exists' => 'არჩეული ადგილი არ არსებობს',
            'seats.required' => 'ადგილების რაოდენობის მითითება სავალდებულოა',
            'seats.integer' => 'ადგილების რაოდენობა უნდა იყოს მთელი რიცხვი',
            'seats.min' => 'ადგილების რაოდენობა უნდა იყოს მინიმუმ 1',
            'seats.max' => 'ადგილების რაოდენობა არ უნდა აღემატებოდეს 50-ს',
            'capacity.integer' => 'ტევადობა უნდა იყოს მთელი რიცხვი',
            'capacity.min' => 'ტევადობა უნდა იყოს მინიმუმ 1',
            'capacity.max' => 'ტევადობა არ უნდა აღემატებოდეს 100-ს',
            'status.required' => 'სტატუსის არჩევა სავალდებულოა',
            'status.in' => 'არჩეული სტატუსი არასწორია',
            'image.image' => 'ფაილი უნდა იყოს სურათი',
            'image.mimes' => 'სურათი უნდა იყოს jpeg, png, jpg ან gif ფორმატის',
            'image.max' => 'სურათის ზომა არ უნდა აღემატებოდეს 2MB-ს',
            'image_link.url' => 'სურათის ლინკი უნდა იყოს ვალიდური URL',
            'translations.*.name.required' => 'მაგიდის სახელი სავალდებულოა',
            'translations.*.name.max' => 'მაგიდის სახელი არ უნდა აღემატებოდეს 255 სიმბოლოს',
        ];
    }

    public function validatedData(): array
    {
        $data = $this->validated();
        
        $allLocales = config('translatable.locales');

        // Build translations dynamically for all locales
        $translations = [];
        if (isset($data['translations']) && is_array($data['translations'])) {
            foreach ($allLocales as $locale) {
                if (isset($data['translations'][$locale]) && is_array($data['translations'][$locale])) {
                    $localeData = $data['translations'][$locale];
                    // Only add locale if name is provided and not empty
                    if (isset($localeData['name']) && !empty(trim($localeData['name']))) {
                        $description = null;
                        if (isset($localeData['description']) && !empty(trim($localeData['description']))) {
                            $description = trim($localeData['description']);
                        }
                        
                        $translations[$locale] = [
                            'name' => trim($localeData['name']),
                            'description' => $description,
                        ];
                    }
                }
            }
        }

        // Convert status from string to integer
        $status = 1; // default to active
        if (isset($data['status'])) {
            $status = $data['status'] === 'active' ? 1 : 0;
        }

        return [
            'restaurant_id' => $data['restaurant_id'] ?? null,
            'place_id' => $data['place_id'] ?? null,
            'seats' => $data['seats'],
            'capacity' => $data['capacity'] ?? $data['seats'], // Use seats as capacity if not provided
            'status' => $status,
            'rank' => $data['rank'] ?? null,
            'slug' => '', // Will be generated in controller
            'image_link' => $data['image_link'] ?? null,
            'latitude' => $data['latitude'] ?? null,
            'longitude' => $data['longitude'] ?? null,
            'icon' => $data['icon'] ?? null,
            'translations' => $translations
        ];
    }
}
