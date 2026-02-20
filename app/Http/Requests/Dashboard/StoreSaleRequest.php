<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class StoreSaleRequest extends FormRequest
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
            'tanggal_penjualan' => ['required', 'date'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.product_id' => ['required', 'integer', 'distinct', 'exists:products,id'],
            'items.*.jumlah' => ['required', 'integer', 'min:1'],
        ];
    }

    protected function prepareForValidation(): void
    {
        if (! is_array($this->items)) {
            return;
        }

        $filtered = collect($this->items)
            ->filter(fn ($item) => filled($item['product_id'] ?? null) && filled($item['jumlah'] ?? null))
            ->values()
            ->all();

        $this->merge(['items' => $filtered]);
    }
}
