<?php

namespace App\Http\Requests\Cuisine;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCuisineRequest extends FormRequest
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
            'image' => 'nullable|image|max:2048',
            'slug' => 'nullable|string|max:255',
        ];

        // Add validation rules for each locale
        foreach (config('translatable.locales') as $locale) {
            $rules['name.' . $locale] = $locale === 'ka' ? 'required|string|max:255' : 'nullable|string|max:255';
            $rules['description.' . $locale] = 'nullable|string';
            $rules['meta_title.' . $locale] = 'nullable|string|max:255';
            $rules['meta_desc.' . $locale] = 'nullable|string';
        }

        return $rules;
    }

    public function validatedData(): array
    {
        return $this->validated();
    }
}
