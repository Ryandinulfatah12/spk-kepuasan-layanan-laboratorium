# Dokumentasi Sistem Aplikasi SPK Kepuasan Pelayanan Lab dan Mata Kuliah Praktikum Menggunakan Metode Fuzzy Tsukamoto


## Screenshots

![App Screenshot](https://github.com/Ryandinulfatah12/spk-kepuasan-layanan-laboratorium/blob/main/public/img/screenshoot/thumbnail-skppl.png?raw=true)

## Deskripsi

Sistem aplikasi ini dirancang untuk mengukur tingkat kepuasan terhadap pelayanan laboratorium dan mata kuliah praktikum menggunakan metode Fuzzy Tsukamoto. Metode Fuzzy Tsukamoto digunakan untuk mengatasi ketidakpastian dan kompleksitas dalam mengevaluasi tingkat kepuasan berdasarkan rating yang diberikan oleh pengguna.

## Algoritma Utama

`calculateSatisfactionArray(array $ratings)`
Metode ini bertanggung jawab untuk menghitung tingkat kepuasan berdasarkan array rating yang diberikan.

Fuzzifikasi: Rating yang diberikan oleh pengguna diubah menjadi nilai keanggotaan pada setiap kategori (Poor, Average, Excellent) menggunakan fungsi-fungsi yang telah ditentukan.

Evaluasi Aturan: Menggunakan aturan fuzzy, setiap kategori keanggotaan diproses untuk menentukan tingkat kepuasan.

Defuzzifikasi (Mamdani): Total keanggotaan dari semua kategori digunakan untuk menghitung total kepuasan.

Perhitungan Total Kepuasan: Total kepuasan dibagi dengan total keanggotaan untuk mendapatkan tingkat kepuasan akhir.

Pengecekan Total Membership: Memastikan total keanggotaan tidak nol sebelum melakukan pembagian.

Pembulatan Hasil Kepuasan: Hasil kepuasan dibulatkan dengan dua digit desimal.

`satisfactionLevel($satisfaction)`
Metode ini mengembalikan tingkat kepuasan berdasarkan nilai yang diberikan.

## Fungsi Fuzzy

Fungsi-fungsi ini digunakan untuk menentukan nilai keanggotaan pada setiap kategori (Poor, Average, Excellent) berdasarkan rating yang diberikan oleh pengguna.

`poorService($rating)`: Menghitung keanggotaan pada kategori "Poor" berdasarkan rating.

`averageService($rating)`: Menghitung keanggotaan pada kategori "Average" berdasarkan rating.

`excellentService($rating)`: Menghitung keanggotaan pada kategori "Excellent" berdasarkan rating.

## Aturan Fuzzy

Aturan fuzzy digunakan untuk menentukan tingkat kepuasan berdasarkan kategori keanggotaan.

`satisfactionPoor($poor)`: Menghitung kepuasan berdasarkan keanggotaan kategori "Poor".

`satisfactionAverage($average)`: Menghitung kepuasan berdasarkan keanggotaan kategori "Average".

`satisfactionExcellent($excellent)`: Menghitung kepuasan berdasarkan keanggotaan kategori "Excellent".

Penentuan Tingkat Kepuasan
Metode satisfactionLevel digunakan untuk menentukan tingkat kepuasan berdasarkan nilai kepuasan yang diberikan.

## Requirements

**Laravel v10.48.4 (PHP v8.1.10)**

## Database 
**MySQL**
![Structure](https://github.com/Ryandinulfatah12/spk-kepuasan-layanan-laboratorium/blob/main/public/img/screenshoot/database.png?raw=true)

### Dependencies

-   php: ^8.1
-   filament/filament: ^3.0-stable
-   guzzlehttp/guzzle: ^7.2
-   laravel/framework: ^10.10
-   laravel/sanctum: ^3.3
-   laravel/tinker: ^2.8
-   livewire/livewire: ^3.4
-   mokhosh/filament-rating: ^1.1
-   yepsua/filament-rating-field: ^0.3.0

## Running Project

Clone the project & Go to directory project

```bash
cd spk-kepuasan-pelayanan-lab-matkul-praktikum
```

Install dependencies

```bash
composer update
```

Migrate table & Seed Data

```bash
php artisan migrate --seed
```

Run Project

```bash
php artisan server
```

## Account Login

| email             | password | role  |
| :---------------- | :------- | :---- |
| admin@mail.com    | password | admin |
| lecturer@mail.com | password | dosen |
| other@mail.com    | password | other |

other bisa disebut mahasiswa, atau orang yang mengisi survey.
