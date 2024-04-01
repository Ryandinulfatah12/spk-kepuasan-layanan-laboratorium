<?php

namespace App\Filament\Widgets;

use App\Models\Feedback;
use Filament\Widgets\ChartWidget;

class FeedbackChart extends ChartWidget
{
    protected static ?string $heading = 'Feedback tahun ini';
    protected static ?string $pollingInterval = '10s';

    protected function getData(): array
    {
        // Mendapatkan data feedback dalam satu tahun
        if (auth()->user()->role !== 'admin') {
            $feedbackData = Feedback::where('user_id', auth()->user()->id)
                                    ->whereYear('created_at', date('Y'))->get();
        } else {
            $feedbackData = Feedback::whereYear('created_at', date('Y'))->get();
        }

        // Inisialisasi array untuk menyimpan jumlah feedback setiap bulan
        $feedbackCount = [
            'Jan' => 0,
            'Feb' => 0,
            'Mar' => 0,
            'Apr' => 0,
            'May' => 0,
            'Jun' => 0,
            'Jul' => 0,
            'Aug' => 0,
            'Sep' => 0,
            'Oct' => 0,
            'Nov' => 0,
            'Dec' => 0,
        ];

        // Menghitung jumlah feedback untuk setiap bulan
        foreach ($feedbackData as $feedback) {
            $month = date('M', strtotime($feedback->created_at));
            $feedbackCount[$month]++;
        }
        return [
            'datasets' => [
                [
                    'label' => 'Feedback diterima',
                    'data' => array_values($feedbackCount),
                ],
            ],
            'labels' => array_keys($feedbackCount),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
