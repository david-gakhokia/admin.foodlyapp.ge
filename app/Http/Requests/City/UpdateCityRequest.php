<?php

namespace App\Http\Requests\City;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCityRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'slug' => 'nullable|string|max:255|unique:cities,slug,' . $this->route('city'),
            'status' => 'required|string|in:active,inactive,maintenance',
            'rank' => 'nullable|integer|min:1',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096',
            'image_link' => 'nullable|string|max:255',
        ];

        $defaultLocale = config('app.locale');
        foreach (config('translatable.locales') as $locale) {
            if ($locale === $defaultLocale) {
                $rules["{$locale}.name"] = ['required', 'string', 'max:255'];
            } else {
                $rules["{$locale}.name"] = ['nullable', 'string', 'max:255'];
            }
            $rules["{$locale}.description"] = ['nullable', 'string'];
            $rules["{$locale}.meta_title"] = ['nullable', 'string', 'max:255'];
            $rules["{$locale}.meta_description"] = ['nullable', 'string'];
            $rules["{$locale}.meta_keywords"] = ['nullable', 'string', 'max:255'];
        }

        return $rules;
    }

    public function attributes()
    {
        $attributes = [
            'slug' => 'slug',
            'status' => 'status',
            'rank' => 'rank',
            'image_file' => 'image file',
            'image_link' => 'image link',
        ];

        foreach (config('translatable.locales') as $locale) {
            $attributes["{$locale}.name"] = "name ({$locale})";
            $attributes["{$locale}.description"] = "description ({$locale})";
            $attributes["{$locale}.meta_title"] = "meta title ({$locale})";
            $attributes["{$locale}.meta_description"] = "meta description ({$locale})";
            $attributes["{$locale}.meta_keywords"] = "meta keywords ({$locale})";
        }

        return $attributes;
    }

    public function messages()
    {
        $defaultLocale = config('app.locale');
        return [
            'slug.unique' => 'This slug is already taken.',
            "{$defaultLocale}.name.required" => "The name field is required for the default language ({$defaultLocale}).",
        ];
    }

    public function validatedData()
    {
        $data = $this->validated();
        unset($data['image_file']);
        return $data;
    }
}
