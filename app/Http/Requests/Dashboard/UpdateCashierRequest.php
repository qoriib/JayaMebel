<?php

namespace App\Http\Requests\Dashboard;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCashierRequest extends FormRequest
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
        $cashier = $this->route('cashier');
        $cashierId = $cashier instanceof User ? $cashier->getKey() : $cashier;

        return [
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', sprintf('unique:users,email,%s', $cashierId)],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ];
    }
}
