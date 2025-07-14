<?php

namespace App\Http\Requests\Space;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Space;

class UpdateSpaceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $space = $this->route('space');
        $spaceId = $space ? $space->id : null;

        $rules = [
            'slug' => ['sometimes', 'string', 'max:255', Rule::unique('spaces', 'slug')->ignore($spaceId)],
            'status' => ['sometimes', 'string', 'in:' . implode(',', array_keys(Space::getStatuses()))],
            'rank' => ['nullable', 'integer', 'min:0'],
            'image_file' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:10240'], // 10MB
            'image_link' => ['nullable', 'url', 'max:500'],
        ];

        // Add validation for translations
        $defaultLocale = config('app.locale');
        foreach (config('translatable.locales') as $locale) {
            // Name is required only for default locale
            if ($locale === $defaultLocale) {
                $rules["{$locale}.name"] = ['required', 'string', 'max:255'];
            } else {
                $rules["{$locale}.name"] = ['nullable', 'string', 'max:255'];
            }
            // Description is always optional
            $rules["{$locale}.description"] = ['nullable', 'string', 'max:1000'];
        }

        return $rules;
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        $attributes = [
            'slug' => 'slug',
            'status' => 'status',
            'rank' => 'display order',
            'image_file' => 'image file',
            'image_link' => 'image link',
        ];

        // Add translation attributes
        foreach (config('translatable.locales') as $locale) {
            $attributes["{$locale}.name"] = "name ({$locale})";
            $attributes["{$locale}.description"] = "description ({$locale})";
        }

        return $attributes;
    }

    /**
     * Get custom validation messages.
     */
    public function messages(): array
    {
        $defaultLocale = config('app.locale');
        
        return [
            'slug.unique' => 'This slug is already taken. Please choose a different one.',
            'status.in' => 'Please select a valid status.',
            'image_file.image' => 'The uploaded file must be an image.',
            'image_file.max' => 'The image file size must not exceed 10MB.',
            "{$defaultLocale}.name.required" => "The name field is required for the default language ({$defaultLocale}).",
        ];
    }

    /**
     * Get validated data in the format expected by the service
     */
    public function validatedData(): array
    {
        $data = $this->validated();
        
        // Remove image_file from the main data as it's handled separately
        unset($data['image_file']);
        
        return $data;
    }
}
