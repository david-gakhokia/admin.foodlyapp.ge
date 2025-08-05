<?php

namespace App\Http\Requests\MenuCategory;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\MenuCategory;

class UpdateMenuCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        $menuCategory = request()->route('menuCategory') ?? request()->route('menu_category');
        $id = $menuCategory?->id ?? null;

        $rules = [
            'slug'     => ['nullable', 'string', 'max:250', Rule::unique('menu_categories', 'slug')->ignore($id)], 
            'status'   => 'required|in:active,inactive',
            'image'    => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'icon'     => 'nullable|image|mimes:svg,png,jpg,webp|max:2048',
            'rank'     => 'nullable|integer|min:0',
            'restaurant_id' => 'required|exists:restaurants,id',
            'parent_id' => [
                'nullable',
                'exists:menu_categories,id',
                function ($attribute, $value, $fail) {
                    $restaurantId = request('restaurant_id');
                    if ($value && $restaurantId) {
                        $parentCategory = MenuCategory::find($value);
                        if ($parentCategory && $parentCategory->restaurant_id != $restaurantId) {
                            $fail('The selected parent category must belong to the same restaurant.');
                        }
                    }
                },
            ],
        ];

        foreach (config('translatable.locales') as $locale) {
            // All locales are optional for update
            $rules[$locale . '.name'] = 'nullable|string|max:255';
            $rules[$locale . '.description'] = 'nullable|string';
        }

        return $rules;
    }

    /**
     * Get validated data with translations: only include locales with non-empty name (Spot style)
     */
    public function validatedData(): array
    {
        $data = $this->validated();
        $translations = [];

        foreach (config('translatable.locales') as $locale) {
            if (!empty($data[$locale]['name'])) {
                $translations[$locale] = $data[$locale];
            }
            unset($data[$locale]);
        }

        $data['translations'] = $translations;
        return $data;
    }

    public function messages(): array
    {
        return [
            'slug.required' => 'Slug ველი აუცილებელია.',
            'slug.unique'   => 'ასეთი Slug უკვე არსებობს.',
            'restaurant_id.required' => 'რესტორნის არჩევა აუცილებელია.',
            'status.in'     => 'სტატუსი უნდა იყოს active ან inactive.',
            'image.image'   => 'სურათი უნდა იყოს გამოსახულების ტიპი.',
            'parent_id'     => 'მშობელი კატეგორია უნდა ეკუთვნოდეს იმავე რესტორანს.',
        ];
    }
}
