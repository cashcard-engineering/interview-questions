<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScheduleRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'start_time' => 'required|date_format:H:i:s', 
            'duration' => 'required|integer|min:1', 
            'days_of_week' => 'required|array', 
            'days_of_week.*' => 'required|string|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday', 
        ];
    }

    public function messages()
    {
        return [
            'start_time.required' => 'Start time is required.',
            'start_time.date_format' => 'Start time must be in the format HH:MM:SS.',
            'duration.required' => 'Duration is required.',
            'duration.integer' => 'Duration must be an integer.',
            'duration.min' => 'Duration must be at least 1 minute.',
            'days_of_week.required' => 'Days of the week are required.',
            'days_of_week.array' => 'Days of the week must be an array.',
            'days_of_week.*.required' => 'Each day of the week is required.',
            'days_of_week.*.string' => 'Each day of the week must be a string.',
            'days_of_week.*.in' => 'Each day of the week must be a valid day name.',
        ];
    }
}
