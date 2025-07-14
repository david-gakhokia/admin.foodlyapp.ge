<?php

namespace App\Http\Requests\Place;

use Illuminate\Foundation\Http\FormRequest;

class StorePlaceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'restaurant_id' => 'required|exists:restaurants,id',
            'status' => 'required|in:active,inactive',
            'rank' => 'nullable|integer',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_link' => 'nullable|string|url',
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
            'status' => $data['status'],
            'rank' => $data['rank'] ?? null,
            'slug' => '', // Will be generated in controller
            'image_link' => $data['image_link'] ?? null,
            'translations' => $translations
        ];
    }
}
