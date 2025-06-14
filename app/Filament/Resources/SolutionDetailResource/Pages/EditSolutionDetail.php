<?php

namespace App\Filament\Resources\SolutionDetailResource\Pages;

use App\Filament\Resources\SolutionDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSolutionDetail extends EditRecord
{
    protected static string $resource = SolutionDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
} 