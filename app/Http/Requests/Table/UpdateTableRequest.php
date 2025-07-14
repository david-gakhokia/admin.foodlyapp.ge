<?php

namespace App\Http\Requests\Table;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTableRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'restaurant_id' => 'required|exists:restaurants,id',
            'place_id' => 'nullable|exists:places,id',
            'capacity' => 'required|integer|min:1|max:50',
            'status' => 'required|boolean',
            'rank' => 'nullable|integer',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_link' => 'nullable|string|url',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'icon' => 'nullable|string|max:100',
        ];

        // Add validation for all locales
        $defaultLocale = config('app.locale');
        foreach (config('translatable.locales') as $locale) {
            if ($locale === $defaultLocale) {
                // Default locale is required
                $rules["{$locale}.name"] = 'required|string|max:255';
                $rules["{$locale}.description"] = 'nullable|string';
            } else {
                // Other locales are optional
                $rules["{$locale}.name"] = 'nullable|string|max:255';
                $rules["{$locale}.description"] = 'nullable|string';
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
            'capacity.required' => 'ტევადობის მითითება სავალდებულოა',
            'capacity.integer' => 'ტევადობა უნდა იყოს მთელი რიცხვი',
            'capacity.min' => 'ტევადობა უნდა იყოს მინიმუმ 1',
            'capacity.max' => 'ტევადობა არ უნდა აღემატებოდეს 50-ს',
            'image_file.image' => 'ფაილი უნდა იყოს სურათი',
            'image_file.mimes' => 'სურათი უნდა იყოს jpeg, png, jpg ან gif ფორმატის',
            'image_file.max' => 'სურათის ზომა არ უნდა აღემატებოდეს 2MB-ს',
            'image_link.url' => 'სურათის ლინკი უნდა იყოს ვალიდური URL',
            '*.name.required' => 'მაგიდის სახელი სავალდებულოა',
            '*.name.max' => 'მაგიდის სახელი არ უნდა აღემატებოდეს 255 სიმბოლოს',
        ];
    }

    public function validatedData(): array
    {
        $data = $this->validated();
        $allLocales = config('translatable.locales');

        // Build translations dynamically for all locales
        $translations = [];
        foreach ($allLocales as $locale) {
            // Only add locale if name is provided and not empty
            if (isset($data[$locale]['name']) && !empty(trim($data[$locale]['name']))) {
                $description = null;
                if (isset($data[$locale]['description']) && !empty(trim($data[$locale]['description']))) {
                    $description = trim($data[$locale]['description']);
                }
                
                $translations[$locale] = [
                    'name' => trim($data[$locale]['name']),
                    'description' => $description,
                ];
            }
        }

        return [
            'restaurant_id' => $data['restaurant_id'],
            'place_id' => $data['place_id'] ?? null,
            'seats' => $data['capacity'], // Map capacity to seats field
            'capacity' => $data['capacity'],
            'status' => $data['status'],
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
