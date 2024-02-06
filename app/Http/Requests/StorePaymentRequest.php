<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;

class StorePaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->tokenCan('create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
           'booking_id' => 'required|exists:bookings,id',
            'amount' => 'required|numeric',
            'payment_date' => 'required|date',
            'status' => 'required|in:pending,succeed,failed'
        ];
    }

    /**
     * Return an array of validation messages for the given fields.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'booking_id.required' => 'The booking field is required.',
            'booking_id.exists' => 'The booking field is invalid.',
            'amount.required' => 'The amount field is required.',
            'amount.numeric' => 'The amount field must be a number.',
            'amount.min' => 'The amount field must be at least 0.',
            'payment_date.required' => 'The payment date field is required.',
            'payment_date.date' => 'The payment date field must be a date.',
            'status.required' => 'The status field is required.',
            'status.in' => 'The status field must be one of the following: pending, succeed, failed.',
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
