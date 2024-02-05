<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

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
            'number' => 'required|string|max:255|unique:rooms',
            'type' => 'required|string|max:255',
            'price_per_night' => 'required|numeric|min:0',
            'status' => 'required|in:available,unavailable',
        ];
    }

    /**
     * Return the validation messages for the fields.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'number.required' => 'The number field is required.',
            'number.string' => 'The number must be a string.',
            'number.max' => 'The number may not be greater than 255 characters.',
            "number.unique" => 'The number has already been taken.',
            'type.required' => 'The type field is required.',
            'type.string' => 'The type must be a string.',
            'type.max' => 'The type may not be greater than 255 characters.',
            'price_per_night.required' => 'The price per night field is required.',
            'price_per_night.numeric' => 'The price per night must be a number.',
            'price_per_night.min' => 'The price per night must be at least 0.',
            'status.required' => 'The status field is required.',
            'status.in' => 'The status must be available or unavailable.',
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param Validator $validator
     * @throws HttpResponseException description of exception
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }

}
