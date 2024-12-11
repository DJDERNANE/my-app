<?php

namespace App\Filament\Widgets;

use App\Models\Inscription;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class InscriptionChart extends ChartWidget
{
    protected static ?string $heading = 'Chart';
    protected static ?int $sort = 2;
    protected function getData(): array
    {
        
            $data = Trend::model(Inscription::class)
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->count();
     
        return [
            'datasets' => [
                [
                    'label' => 'Inscriptions',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
