<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecordPaymentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && (auth()->user()->role === 'staff' || auth()->user()->role === 'admin');
    }

    public function rules(): array
    {
        return [
            'loan_id' => ['required', 'exists:loans,id'],
            'amount_paid' => ['required', 'numeric', 'min:0.01', 'max:999999.99'],
            'payment_date' => ['required', 'date', 'before_or_equal:today'],
            'payment_method' => ['required', 'in:cash,check,bank_transfer,online'],
            'reference_number' => ['nullable', 'string', 'max:100'],
            'notes' => ['nullable', 'string', 'max:500'],
        ];
    }

    public function messages(): array
    {
        return [
            'loan_id.required' => 'Loan is required.',
            'loan_id.exists' => 'Selected loan does not exist.',
            'amount_paid.required' => 'Payment amount is required.',
            'amount_paid.numeric' => 'Payment amount must be a number.',
            'amount_paid.min' => 'Payment amount must be greater than 0.',
            'payment_date.required' => 'Payment date is required.',
            'payment_date.date' => 'Payment date must be a valid date.',
            'payment_date.before_or_equal' => 'Payment date cannot be in the future.',
            'payment_method.required' => 'Payment method is required.',
            'payment_method.in' => 'Invalid payment method selected.',
        ];
    }
}
