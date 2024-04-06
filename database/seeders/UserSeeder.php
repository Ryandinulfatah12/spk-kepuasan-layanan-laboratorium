<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tambahkan pengguna admin
        User::create([
            'email' => 'admin@mail.com',
            'name' => 'Belerick Admin',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Tambahkan pengguna dosen
        User::create([
            'email' => 'lecturer@mail.com',
            'name' => 'Aldous Dosen',
            'password' => Hash::make('password'),
            'role' => 'dosen',
        ]);

        // Tambahkan pengguna lain
        User::create([
            'email' => 'other@mail.com',
            'name' => 'Badang  Mahasiswa',
            'password' => Hash::make('password'),
            'role' => 'other',
        ]);
    }
}
