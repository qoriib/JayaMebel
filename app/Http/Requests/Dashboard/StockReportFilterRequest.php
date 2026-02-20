<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StockReportFilterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'search' => ['nullable', 'string', 'max:100'],
            'stok_status' => ['nullable', Rule::in(['tersedia', 'tidak'])],
            'stok_min' => [
                'nullable',
                'integer',
                'min:0',
                Rule::when($this->filled('stok_max'), 'lte:stok_max'),
            ],
            'stok_max' => [
                'nullable',
                'integer',
                'min:0',
                Rule::when($this->filled('stok_min'), 'gte:stok_min'),
            ],
        ];
    }
}
