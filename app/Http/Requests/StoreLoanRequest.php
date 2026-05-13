<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLoanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->role === 'user';
    }

    public function rules(): array
    {
        return [
            'loan_amount' => ['required', 'numeric', 'min:1000', 'max:1000000'],
            'loan_term' => ['required', 'integer', 'min:3', 'max:60'],
        ];
    }

    public function messages(): array
    {
        return [
            'loan_amount.required' => 'Loan amount is required.',
            'loan_amount.numeric' => 'Loan amount must be a number.',
            'loan_amount.min' => 'Loan amount must be at least ₱1,000.',
            'loan_amount.max' => 'Loan amount cannot exceed ₱1,000,000.',
            'loan_term.required' => 'Loan term is required.',
            'loan_term.integer' => 'Loan term must be a whole number.',
            'loan_term.min' => 'Loan term must be at least 3 months.',
            'loan_term.max' => 'Loan term cannot exceed 60 months.',
        ];
    }
}
