<?php

namespace App\Http\Requests\Restaurant;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRestaurantRequest extends FormRequest
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
            'phone' => 'nullable|string|max:50',
            'whatsapp' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:100',
            'website' => 'nullable|url|max:255',
            'discount_rate' => 'nullable|integer|min:0|max:100',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
            'price_per_person' => 'nullable|numeric|min:0',
            'price_currency' => 'nullable|in:GEL,USD,EUR,AED,HUF,CZK',
            'timezone' => 'required|string|in:' . implode(',', array_keys(config('timezones.list'))),
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'map_embed_link' => 'nullable|string',
            'map_link' => 'nullable|string',
            'delivery_time' => 'nullable|string',
            'working_hours' => 'nullable|string',
        ];

        // ვალიდაცია ყველა ენისთვის
        foreach (config('translatable.locales', ['en', 'ka']) as $locale) {
            $rules[$locale . '.name'] = $locale === 'ka' ? 'required|string|max:255' : 'nullable|string|max:255';
            $rules[$locale . '.description'] = 'nullable|string';
            $rules[$locale . '.address'] = 'nullable|string';
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'status.required' => 'სტატუსის მითითება აუცილებელია',
            'status.in' => 'სტატუსი უნდა იყოს active ან inactive',
            'email.email' => 'გთხოვთ შეიყვანოთ სწორი ელ-ფოსტის მისამართი',
            'website.url' => 'გთხოვთ შეიყვანოთ სწორი ვებსაიტის მისამართი',
            'discount_rate.min' => 'ფასდაკლება არ შეიძლება იყოს უარყოფითი',
            'discount_rate.max' => 'ფასდაკლება არ შეიძლება იყოს 100%-ზე მეტი',
            'logo.image' => 'ლოგო უნდა იყოს სურათი',
            'logo.mimes' => 'ლოგო უნდა იყოს jpeg, png, jpg ან webp ფორმატში',
            'logo.max' => 'ლოგოს ზომა არ შეიძლება იყოს 2MB-ზე მეტი',
            'image.image' => 'სურათი უნდა იყოს სურათი',
            'image.mimes' => 'სურათი უნდა იყოს jpeg, png, jpg ან webp ფორმატში',
            'image.max' => 'სურათის ზომა არ შეიძლება იყოს 4MB-ზე მეტი',
            'ka.name.required' => 'რესტორნის დასახელება (ქართული) აუცილებელია',
            'ka.name.max' => 'რესტორნის დასახელება ძალიან გრძელია',
            'en.name.required' => 'რესტორნის დასახელება (ინგლისური) აუცილებელია',
            'en.name.max' => 'რესტორნის დასახელება ძალიან გრძელია',
        ];
    }

    public function validatedData(): array
    {
        $validated = $this->validated();

        // Clean up translation data - remove empty names
        foreach (config('translatable.locales', ['en', 'ka']) as $locale) {
            if (isset($validated[$locale])) {
                // If name is empty or null, remove the entire translation
                if (empty($validated[$locale]['name']) || trim($validated[$locale]['name']) === '') {
                    unset($validated[$locale]);
                } else {
                    // Clean up other empty fields
                    $validated[$locale] = array_filter($validated[$locale], function ($value) {
                        return $value !== '' && $value !== null;
                    });

                    // Ensure name is always set if we keep the translation
                    if (!isset($validated[$locale]['name'])) {
                        unset($validated[$locale]);
                    }
                }
            }
        }

        // Ensure price fields are present if sent as empty string
        if (array_key_exists('price_per_person', $validated) && $validated['price_per_person'] === '') {
            $validated['price_per_person'] = null;
        }
        if (array_key_exists('price_currency', $validated) && $validated['price_currency'] === '') {
            $validated['price_currency'] = null;
        }

        return $validated;
    }
}
