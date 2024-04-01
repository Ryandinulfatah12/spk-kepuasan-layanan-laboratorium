<?php

namespace App\Tables\Columns;

use Filament\Tables\Columns\Column;
use App\Services\FuzzyTsukamotoService;

class fuzzyTsukamoto extends Column
{
    protected string $view = 'tables.columns.fuzzy-tsukamoto';

    // $rating = $request->input('rating');

    //     $fuzzyService = new FuzzyTsukamotoService();
    //     $satisfaction = $fuzzyService->calculateSatisfaction($rating);
}
