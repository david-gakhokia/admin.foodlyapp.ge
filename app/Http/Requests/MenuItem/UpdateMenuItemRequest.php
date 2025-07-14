<?php

namespace App\Http\Requests\MenuItem;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMenuItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'restaurant_id' => 'required|integer|exists:restaurants,id',
            'image' => 'nullable|image|max:2048',
            'unit' => 'nullable|string|max:50',
            'quantity' => 'nullable|integer|min:0',
            'price' => 'required|numeric|min:0',
            'discounted_price' => 'nullable|numeric|min:0',
            'is_vegan' => 'nullable|boolean',
            'is_gluten_free' => 'nullable|boolean',
            'calories' => 'nullable|integer|min:0',
            'preparation_time' => 'nullable|integer|min:0',
            'rank' => 'nullable|integer|min:0',
            'status' => 'required|in:active,inactive',
            'available' => 'required|boolean',
        ];

        $defaultLocale = config('app.locale');
        $rules["translations.{$defaultLocale}.name"] = 'required|string|max:255';

        foreach (config('translatable.locales') as $locale) {
            $rules["translations.{$locale}.name"] = 'nullable|string|max:255';
            $rules["translations.{$locale}.description"] = 'nullable|string';
            $rules["translations.{$locale}.ingredients"] = 'nullable|string';
            $rules["translations.{$locale}.allergens"] = 'nullable|string';
        }

        return $rules;
    }

    public function validatedData(): array
    {
        return $this->validated();
    }
}
