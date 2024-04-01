<?php

namespace Database\Seeders;

use App\Models\Lab;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LabSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Lab::create([
            'name' => 'Laboratorium 01 - Teknik Informatika',
            'location' => 'Ruangan 01 - Gedung A',
            'capacity' => 50
        ]);

        Lab::create([
            'name' => 'Laboratorium 02 - Sains',
            'location' => 'Ruangan 02 - Gedung A',
            'capacity' => 50
        ]);
    }
}
