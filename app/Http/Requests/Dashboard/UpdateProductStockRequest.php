<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductStockRequest extends FormRequest
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
        $stokRules = ['nullable', 'integer', 'min:0'];

        if ($this->input('stok_status') === 'tersedia') {
            $stokRules = ['required', 'integer', 'min:1'];
        }

        return [
            'stok_status' => ['required', Rule::in(['tersedia', 'tidak'])],
            'stok' => $stokRules,
        ];
    }
}
