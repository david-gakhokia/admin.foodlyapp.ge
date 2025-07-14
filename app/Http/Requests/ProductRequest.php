<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {

        $rules =
            [
                'ka.name' => 'required',
                'image' => 'nullable|string',
                'price' => '',
                'status' => 'required|boolean',
            ];

        foreach (config('translatable.locales') as $locale) {
            $rules[$locale . '.name'] = 'string';
            $rules[$locale . '.description'] = 'string';
        }

        return $rules;
    }


    public function messages()
    {
        $messages = [];

        foreach (config('translatable.locales') as $locale) {
            $messages["$locale.name.required"] = __('validation.required', ['attribute' => "$locale.name"]);
            $messages["$locale.name.string"] = __('validation.string', ['attribute' => "$locale.name"]);
            $messages["$locale.name.max"] = __('validation.max.string', ['attribute' => "$locale.name", 'max' => 255]);
            $messages["$locale.description.string"] = __('validation.string', ['attribute' => "$locale.description"]);
        }

        return $messages;
    }
}
