<?php

namespace App\Filament\Resources\SubmenuItemResource\Pages;

use App\Filament\Resources\SubmenuItemResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewSubmenuItem extends ViewRecord
{
    protected static string $resource = SubmenuItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
} 