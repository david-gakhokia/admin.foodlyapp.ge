<?php

namespace App\Http\Requests\MenuCategory;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\MenuCategory;

class MenuCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        $id = $this->route('menu_category')?->id ?? null;

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
                    if ($value && $this->input('restaurant_id')) {
                        $parentCategory = MenuCategory::find($value);
                        if ($parentCategory && $parentCategory->restaurant_id != $this->input('restaurant_id')) {
                            $fail('The selected parent category must belong to the same restaurant.');
                        }
                    }
                },
            ],
        ];

        foreach (config('translatable.locales') as $locale) {
            $rules[$locale . '.name'] = 'required|string|max:255';
            $rules[$locale . '.description'] = 'nullable|string';
        }

        return $rules;
    }

    public function translationData(): array
    {
        $data = $this->validated();
        $translations = [];

        foreach (config('translatable.locales') as $locale) {
            $translations[$locale] = [
                'name'        => $data[$locale]['name']        ?? '',
                'description' => $data[$locale]['description'] ?? '',
            ];
        }

        return $translations;
    }

    /**
     * Get validated data with translations in the same format as DishRequest
     */
    public function validatedData(): array
    {
        $data = $this->validated();
        $translations = [];

        // Extract translations into the nested format
        foreach (config('translatable.locales') as $locale) {
            if (isset($data[$locale])) {
                $translations[$locale] = $data[$locale];
                unset($data[$locale]); // Remove from main data
            }
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
