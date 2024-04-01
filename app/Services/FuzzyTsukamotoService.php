<?php

namespace App\Services;

class FuzzyTsukamotoService
{
    public function calculateSatisfaction($rating)
    {
        // Fuzzifikasi
        $poor = $this->poorService($rating);
        $average = $this->averageService($rating);
        $excellent = $this->excellentService($rating);

        // Rule Evaluation
        $satisfactionPoor = $this->satisfactionPoor($poor);
        $satisfactionAverage = $this->satisfactionAverage($average);
        $satisfactionExcellent = $this->satisfactionExcellent($excellent);

        // Defuzzifikasi (Mamdani)
        $totalMembership = $poor + $average + $excellent;

        // Pastikan totalMembership tidak nol sebelum melakukan pembagian
        if ($totalMembership != 0) {
            $satisfaction = ($satisfactionPoor + $satisfactionAverage + $satisfactionExcellent) / $totalMembership;
        } else {
            // Aturan default jika totalMembership nol
            $satisfaction = 0; // atau nilai default lainnya
        }

        return $satisfaction;
    }

    public function calculateSatisfactionArray(array $ratings)
    {
        // Inisialisasi variabel untuk totalMembership
        $totalMembership = 0;

        // Inisialisasi variabel untuk menyimpan total kepuasan
        $totalSatisfaction = 0;

        // Iterasi melalui setiap rating
        foreach ($ratings as $rating) {
            // Fuzzifikasi
            $poor = $this->poorService($rating);
            $average = $this->averageService($rating);
            $excellent = $this->excellentService($rating);

            // Rule Evaluation
            $satisfactionPoor = $this->satisfactionPoor($poor);
            $satisfactionAverage = $this->satisfactionAverage($average);
            $satisfactionExcellent = $this->satisfactionExcellent($excellent);

            // Defuzzifikasi (Mamdani)
            $totalMembership += $poor + $average + $excellent;

            // Hitung total kepuasan
            $totalSatisfaction += $satisfactionPoor + $satisfactionAverage + $satisfactionExcellent;
        }

        // Pastikan totalMembership tidak nol sebelum melakukan pembagian
        if ($totalMembership != 0) {
            $satisfaction = $totalSatisfaction / $totalMembership;
        } else {
            // Aturan default jika totalMembership nol
            $satisfaction = 0; // atau nilai default lainnya
        }

        // Bulatkan hasil kepuasan
        $roundedSatisfaction = round($satisfaction, 2); // Menggunakan 2 digit desimal

        return $roundedSatisfaction;
    }



    public function satisfactionLevel($satisfaction)
    {
        if ($satisfaction < 0.4) {
            return 'Poor';
        } elseif ($satisfaction < 0.7) {
            return 'Average';
        } else {
            return 'Excellent';
        }
    }

    private function poorService($rating)
    {
        if ($rating < 1) {
            return 1; // Jika rating kurang dari 1, keanggotaan "Poor" adalah 1
        } elseif ($rating >= 1 && $rating < 2) {
            // Jika rating antara 1 dan 2, keanggotaan "Poor" menurun secara linear dari 1 menjadi 0.2
            return max(1 - ($rating - 1) * 0.8, 0.2); // Minimum adalah 0.2
        } elseif ($rating >= 2 && $rating < 3) {
            return 0.2; // Jika rating antara 2 dan 3, keanggotaan "Poor" adalah tetap 0.2
        } else {
            return 0; // Jika rating lebih besar atau sama dengan 3, keanggotaan "Poor" adalah 0
        }
    }

    private function averageService($rating)
    {
        // Service function untuk kategori "Average"
        // Misalnya, jika rating antara 2 dan 4, maka keanggotaan pada kategori "Average" adalah (rating - 2) / (4 - 2)
        return ($rating >= 2 && $rating <= 4) ? ($rating - 2) / 2 : 0;
    }

    private function excellentService($rating)
    {
        // Service function untuk kategori "Excellent"
        // Misalnya, jika rating lebih dari 4, maka keanggotaan pada kategori "Excellent" adalah 1
        return $rating > 4 ? 1 : 0;
    }


    private function satisfactionPoor($poor)
    {
        // Aturan Fuzzy: Jika rating berada pada kategori "Poor", kepuasan = rendah
        return $poor * 0.2; // Contoh bobot kepuasan untuk kategori "Poor"
    }

    private function satisfactionAverage($average)
    {
        // Aturan Fuzzy: Jika rating berada pada kategori "Average", kepuasan = sedang
        return $average * 0.5; // Contoh bobot kepuasan untuk kategori "Average"
    }

    private function satisfactionExcellent($excellent)
    {
        // Aturan Fuzzy: Jika rating berada pada kategori "Excellent", kepuasan = tinggi
        return $excellent * 0.8; // Contoh bobot kepuasan untuk kategori "Excellent"
    }
}
