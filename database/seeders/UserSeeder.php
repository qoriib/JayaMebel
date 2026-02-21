<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Seed pengguna aplikasi: 1 admin dan 3 kasir dengan nama realistis.
     */
    public function run(): void
    {
        User::create([
            'nama' => 'Budi Santoso',
            'email' => 'admin@jayamebel.id',
            'role' => 'admin',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        $cashiers = [
            ['nama' => 'Dewi Rahayu', 'email' => 'dewi@jayamebel.id'],
            ['nama' => 'Ahmad Fauzi', 'email' => 'ahmad@jayamebel.id'],
            ['nama' => 'Siti Nurhaliza', 'email' => 'siti@jayamebel.id'],
        ];

        foreach ($cashiers as $cashier) {
            User::create([
                'nama' => $cashier['nama'],
                'email' => $cashier['email'],
                'role' => 'kasir',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]);
        }
    }
}
