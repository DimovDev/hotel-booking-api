<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreBookingRequest extends FormRequest
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
            'room_id' => 'required', 'exists:rooms,id',
            'customer_id' => 'required|exists:customers,id',
            'check_in_date' => 'required|date|after_or_equal:today',
            'check_out_date' => 'required|date|after:checkInDate'
        ];
    }
    public function messages()
    {
        return [
            'room_id.required' => 'The room field is required.',
            'room_id.exists' => 'The room does not exist.',
            'customer_id.required' => 'The customer field is required.',
            'customer_id.exists' => 'The customer does not exist.',
            'check_in_date.required' => 'The check in date field is required.',
            'check_in_date.after_or_equal' => 'The check in date must be at least today.',
            'check_out_date.required' => 'The check out date field is required.',
            'check_out_date.after' => 'The check out date must be after the check in date.'
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
