<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PlaceRequest extends FormRequest
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
        return [
            'restaurant_id' => 'required|exists:restaurants,id',
            'status' => 'required|boolean',
            'rank' => 'nullable|integer|min:0',
            'image_link' => 'nullable|url',
            'image_file' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
            // Translation fields
            'ka.name' => 'required|string|max:255',
            'ka.description' => 'nullable|string|max:1000',
            'en.name' => 'nullable|string|max:255',
            'en.description' => 'nullable|string|max:1000',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'restaurant_id' => 'რესტორანი',
            'status' => 'სტატუსი',
            'rank' => 'რანგი',
            'image_link' => 'სურათის ლინკი',
            'image_file' => 'სურათის ფაილი',
            'ka.name' => 'დასახელება (ქართული)',
            'ka.description' => 'აღწერა (ქართული)',
            'en.name' => 'დასახელება (ინგლისური)',
            'en.description' => 'აღწერა (ინგლისური)',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'restaurant_id.required' => 'რესტორნის არჩევა სავალდებულოა',
            'restaurant_id.exists' => 'არჩეული რესტორანი არ არსებობს',
            'status.required' => 'სტატუსის მითითება სავალდებულოა',
            'ka.name.required' => 'ქართული დასახელება სავალდებულოა',
            'ka.name.max' => 'ქართული დასახელება არ უნდა აღემატებოდეს 255 სიმბოლოს',
            'ka.description.max' => 'ქართული აღწერა არ უნდა აღემატებოდეს 1000 სიმბოლოს',
            'en.name.max' => 'ინგლისური დასახელება არ უნდა აღემატებოდეს 255 სიმბოლოს',
            'en.description.max' => 'ინგლისური აღწერა არ უნდა აღემატებოდეს 1000 სიმბოლოს',
            'rank.integer' => 'რანგი უნდა იყოს მთელი რიცხვი',
            'rank.min' => 'რანგი არ უნდა იყოს უარყოფითი',
            'image_link.url' => 'სურათის ლინკი უნდა იყოს სწორი URL',
            'image_file.image' => 'ფაილი უნდა იყოს სურათი',
            'image_file.mimes' => 'სურათი უნდა იყოს JPEG, JPG, PNG ან WEBP ფორმატის',
            'image_file.max' => 'სურათის ზომა არ უნდა აღემატებოდეს 2MB-ს',
        ];
    }
}
