<?php

namespace App\Http\Requests\Slot;

use Illuminate\Foundation\Http\FormRequest;

class PlaceReservationSlotRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'day_of_week' => 'required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
            'time_from' => 'required|date_format:H:i',
            'time_to' => 'required|date_format:H:i|after:time_from',
            'slot_interval_minutes' => 'required|integer|min:15|max:120',
            'available' => 'required|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'day_of_week.required' => 'კვირის დღე აუცილებელია',
            'day_of_week.in' => 'გთხოვთ აირჩიოთ სწორი კვირის დღე',
            'time_from.required' => 'დაწყების დრო აუცილებელია',
            'time_from.date_format' => 'დაწყების დრო უნდა იყოს HH:MM ფორმატში',
            'time_to.required' => 'დასრულების დრო აუცილებელია',
            'time_to.date_format' => 'დასრულების დრო უნდა იყოს HH:MM ფორმატში',
            'time_to.after' => 'დასრულების დრო უნდა იყოს დაწყების დროზე გვიან',
            'slot_interval_minutes.required' => 'სლოტის ინტერვალი აუცილებელია',
            'slot_interval_minutes.integer' => 'სლოტის ინტერვალი უნდა იყოს რიცხვი',
            'slot_interval_minutes.min' => 'სლოტის ინტერვალი მინიმუმ 15 წუთი უნდა იყოს',
            'slot_interval_minutes.max' => 'სლოტის ინტერვალი მაქსიმუმ 120 წუთი უნდა იყოს',
            'available.required' => 'ხელმისაწვდომობის სტატუსი აუცილებელია',
            'available.boolean' => 'ხელმისაწვდომობის სტატუსი უნდა იყოს true ან false',
        ];
    }
}
