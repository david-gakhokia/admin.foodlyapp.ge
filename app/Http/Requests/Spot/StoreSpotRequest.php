<?php

namespace App\Http\Requests\Spot;

use Illuminate\Foundation\Http\FormRequest;

class StoreSpotRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'status' => 'required|in:active,inactive',
            'rank' => 'nullable|integer|min:0',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240', // 10MB max
            'image_link' => 'nullable|string|url',
        ];

        // Add validation for all locales
        $defaultLocale = config('app.locale');
        foreach (config('translatable.locales') as $locale) {
            if ($locale === $defaultLocale) {
                // Default locale is required
                $rules["{$locale}.name"] = 'required|string|max:255';
            } else {
                // Other locales are optional
                $rules["{$locale}.name"] = 'nullable|string|max:255';
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
            if (!empty($data[$locale]['name'])) {
                $translations[$locale] = $data[$locale];
            }
            // Remove locale data from main array
            unset($data[$locale]);
        }

        // Add translations to data
        $data['translations'] = $translations;

        return $data;
    }
}
