<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SaleReportFilterRequest extends FormRequest
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
            'from' => [
                'nullable',
                'date',
                Rule::when($this->filled('to'), 'before_or_equal:to'),
            ],
            'to' => [
                'nullable',
                'date',
                Rule::when($this->filled('from'), 'after_or_equal:from'),
            ],
        ];
    }
}
