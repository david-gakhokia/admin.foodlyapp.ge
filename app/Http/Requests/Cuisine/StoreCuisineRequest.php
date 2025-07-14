<?php

namespace App\Http\Requests\Cuisine;

use Illuminate\Foundation\Http\FormRequest;

class StoreCuisineRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'status' => 'required|in:active,inactive',
            'image' => 'nullable|image|max:2048',
            'rank' => 'nullable|integer|min:0',
            'slug' => 'nullable|string|max:255',
        ];
        
        // Add validation rules for each locale
        foreach (config('translatable.locales') as $locale) {
            $rules['name.' . $locale] = $locale === 'ka' ? 'required|string|max:255' : 'nullable|string|max:255';
            $rules['description.' . $locale] = 'nullable|string';
        }
        
        return $rules;
    }

    public function validatedData(): array
    {
        return $this->validated();
    }
}
