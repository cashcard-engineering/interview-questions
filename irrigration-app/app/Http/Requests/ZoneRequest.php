<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ZoneRequest extends FormRequest
{
  
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'sometimes|required|string|max:40',
            'area' => 'sometimes|required|string|max:50',
            'watering_status' => 'sometimes|required|in:started,stopped',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name must be a string.',
            'name.max' => 'The name may not be greater than 255 characters.',
            'area.required' => 'The area field is required.',
            'area.string' => 'The area must be a string.',
            'area.max' => 'The area may not be greater than 255 characters.',
            'watering_status.in' => 'The watering status must be either started or stopped.',
        ];
    }
}
