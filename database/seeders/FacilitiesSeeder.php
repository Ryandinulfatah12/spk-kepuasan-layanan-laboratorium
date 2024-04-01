<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Facility;


class FacilitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $facilities = [
            [
                'name' => 'Ketersediaan Fasilitas',
                'description' => 'Evaluasi tingkat ketersediaan fasilitas seperti peralatan laboratorium, bahan-bahan praktikum, dan infrastruktur pendukung lainnya.',
            ],
            [
                'name' => 'Kualitas Pengajaran',
                'description' => 'Penilaian terhadap kualitas pengajaran yang diberikan oleh dosen atau asisten praktikum, termasuk kejelasan penjelasan, kemampuan dalam menyampaikan materi, dan respons terhadap pertanyaan.',
            ],
            [
                'name' => 'Ketersediaan Bahan Ajar',
                'description' => 'Evaluasi terhadap ketersediaan bahan ajar yang mendukung pembelajaran, seperti buku panduan, referensi, atau materi pembelajaran online.',
            ],
            [
                'name' => 'Kemudahan Akses',
                'description' => 'Penilaian terhadap kemudahan akses menuju laboratorium atau tempat praktikum, termasuk aksesibilitas transportasi, jarak tempuh, dan ketersediaan parkir.',
            ],
            [
                'name' => 'Kesesuaian Kurikulum',
                'description' => 'Penilaian terhadap kesesuaian materi praktikum dengan kurikulum mata kuliah yang terkait.',
            ],
            [
                'name' => 'Kualitas Layanan',
                'description' => 'Penilaian terhadap kualitas layanan yang diberikan oleh staf laboratorium atau pengelola praktikum, termasuk respons terhadap keluhan atau pertanyaan mahasiswa.',
            ],
            [
                'name' => 'Keselamatan',
                'description' => 'Evaluasi terhadap aspek keselamatan di laboratorium atau tempat praktikum, termasuk ketersediaan peralatan keselamatan dan penerapan prosedur keselamatan.',
            ],
            [
                'name' => 'Interaksi dengan Rekan Mahasiswa',
                'description' => 'Penilaian terhadap interaksi antar mahasiswa selama praktikum, termasuk kerjasama dalam kelompok, komunikasi, dan dukungan antar sesama.',
            ],
            [
                'name' => 'Penggunaan Teknologi',
                'description' => 'Evaluasi terhadap penggunaan teknologi dalam mendukung pembelajaran praktikum, seperti penggunaan perangkat lunak simulasi atau alat praktikum digital.',
            ],
        ];
        foreach ($facilities as $facility) {
            Facility::create($facility);
        }
    }
}
