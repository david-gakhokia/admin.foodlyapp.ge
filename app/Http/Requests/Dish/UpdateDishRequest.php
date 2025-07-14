<?php

namespace App\Http\Requests\Dish;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDishRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'image_file' => 'nullable|image|max:2048',
            'rank' => 'nullable|integer|min:0',
            'status' => 'required|in:active,inactive',
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
            'rank' => $data['rank'] ?? null,
            'status' => $data['status'],
            'translations' => $translations
        ];
    }
}
