# Dokumentasi Sistem Aplikasi SPK Kepuasan Pelayanan Lab dan Mata Kuliah Praktikum Menggunakan Metode Fuzzy Tsukamoto


## Screenshots

![App Screenshot](https://github.com/Ryandinulfatah12/spk-kepuasan-layanan-laboratorium/blob/main/public/img/screenshoot/thumbnail-skppl.png?raw=true)

![Alur App](https://private-user-images.githubusercontent.com/46431723/318879126-d0df447e-fa94-42a0-98d3-463f56c3a396.png?jwt=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJnaXRodWIuY29tIiwiYXVkIjoicmF3LmdpdGh1YnVzZXJjb250ZW50LmNvbSIsImtleSI6ImtleTUiLCJleHAiOjE3MTIwNzYyMjksIm5iZiI6MTcxMjA3NTkyOSwicGF0aCI6Ii80NjQzMTcyMy8zMTg4NzkxMjYtZDBkZjQ0N2UtZmE5NC00MmEwLTk4ZDMtNDYzZjU2YzNhMzk2LnBuZz9YLUFtei1BbGdvcml0aG09QVdTNC1ITUFDLVNIQTI1NiZYLUFtei1DcmVkZW50aWFsPUFLSUFWQ09EWUxTQTUzUFFLNFpBJTJGMjAyNDA0MDIlMkZ1cy1lYXN0LTElMkZzMyUyRmF3czRfcmVxdWVzdCZYLUFtei1EYXRlPTIwMjQwNDAyVDE2Mzg0OVomWC1BbXotRXhwaXJlcz0zMDAmWC1BbXotU2lnbmF0dXJlPWE1MGIxMzZjNDYzMmRkZjRkY2IzOTkzNjZlYWMwZGM5YjkwMDFlMGM0ZmE1NjQ4NWI2ZGZkMmM3YjU1OThlMzgmWC1BbXotU2lnbmVkSGVhZGVycz1ob3N0JmFjdG9yX2lkPTAma2V5X2lkPTAmcmVwb19pZD0wIn0.5fMxwxXBJH2ABzTNJYxhwdN7KBuHUJ6y8-JViLlNeKM)

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
php artisan serve
```

## Account Login

| email             | password | role  |
| :---------------- | :------- | :---- |
| admin@mail.com    | password | admin |
| lecturer@mail.com | password | dosen |
| other@mail.com    | password | other |

other bisa disebut mahasiswa, atau orang yang mengisi survey.
