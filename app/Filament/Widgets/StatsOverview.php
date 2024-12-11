<?php

namespace App\Filament\Widgets;

use App\Models\Contact;
use App\Models\Inscription;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;
    protected function getStats(): array
    {
        return [
            Stat::make('Contacts', Contact::count()),
            Stat::make('Iscriptions', Inscription::count()),
            Stat::make('Average time on page', '3:12'),
        ];
    }
}
