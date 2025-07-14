<?php

namespace App\Http\Requests\Slot;

use Illuminate\Foundation\Http\FormRequest;

class ReservationSlotRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'day_of_week' => 'required|string|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
            'time_from' => 'required|date_format:H:i',
            'time_to'   => 'required|date_format:H:i|after:time_from',
            'slot_interval_minutes' => 'required|integer|min:15|max:120',
            'available'  => 'required|in:0,1',
        ];
    }

    public function messages(): array
    {
        return [
            'day_of_week.required' => 'კვირის დღე სავალდებულოა.',
            'day_of_week.in' => 'კვირის დღე უნდა იყოს ვალიდური.',
            'time_from.required' => 'დაწყების დრო სავალდებულოა.',
            'time_from.date_format' => 'დაწყების დრო უნდა იყოს HH:MM ფორმატში.',
            'time_to.required'   => 'დასრულების დრო სავალდებულოა.',
            'time_to.date_format' => 'დასრულების დრო უნდა იყოს HH:MM ფორმატში.',
            'time_to.after'      => 'დასრულების დრო უნდა იყოს დაწყების დროზე მეტი.',
            'slot_interval_minutes.required' => 'Slot ინტერვალი სავალდებულოა.',
            'slot_interval_minutes.min' => 'Slot ინტერვალი უნდა იყოს მინიმუმ 15 წუთი.',
            'slot_interval_minutes.max' => 'Slot ინტერვალი არ შეიძლება იყოს 120 წუთზე მეტი.',
            'available.required'  => 'ხელმისაწვდომობა სავალდებულოა.',
        ];
    }
}
