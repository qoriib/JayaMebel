<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCashierRequest;
use App\Http\Requests\Admin\UpdateCashierRequest;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

class CashierController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }

    public function index(): View
    {
        $cashiers = User::query()
            ->where('role', 'kasir')
            ->latest()
            ->paginate(10);

        return view('admin.cashiers.index', compact('cashiers'));
    }

    public function store(StoreCashierRequest $request): RedirectResponse
    {
        $data = $request->validated();

        User::query()->create([
            'nama' => $data['nama'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'kasir',
        ]);

        return back()->with('success', 'Kasir baru berhasil ditambahkan.');
    }

    public function update(UpdateCashierRequest $request, User $cashier): RedirectResponse
    {
        $this->abortIfNotCashier($cashier);

        $data = $request->validated();
        $payload = [
            'nama' => $data['nama'],
            'email' => $data['email'],
        ];

        if (! empty($data['password'])) {
            $payload['password'] = Hash::make($data['password']);
        }

        $cashier->update($payload);

        return back()->with('success', 'Data kasir berhasil diperbarui.');
    }

    public function destroy(User $cashier): RedirectResponse
    {
        $this->abortIfNotCashier($cashier);

        $cashier->delete();

        return back()->with('success', 'Kasir berhasil dihapus.');
    }

    private function abortIfNotCashier(User $cashier): void
    {
        if ($cashier->role !== 'kasir') {
            abort(404);
        }
    }
}
