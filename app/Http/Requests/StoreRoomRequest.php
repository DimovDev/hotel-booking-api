<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoomRequest extends FormRequest
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
            'number' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'pricePerNight' => 'required|numeric|min:0',
            'status' => 'required|in:available,unavailable',
        ];
    }

    public function messages()
    {
        return [
            'number.required' => 'The number field is required.',
            'number.string' => 'The number must be a string.',
            'number.max' => 'The number may not be greater than 255 characters.',
            'type.required' => 'The type field is required.',
            'type.string' => 'The type must be a string.',
            'type.max' => 'The type may not be greater than 255 characters.',
            'pricePerNight.required' => 'The price per night field is required.',
            'pricePerNight.numeric' => 'The price per night must be a number.',
            'pricePerNight.min' => 'The price per night must be at least 0.',
            'status.required' => 'The status field is required.',
            'status.in' => 'The status must be available or unavailable.',
        ];
    }
}
