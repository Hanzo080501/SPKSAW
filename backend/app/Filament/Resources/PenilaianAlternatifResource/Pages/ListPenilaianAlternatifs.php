<?php

namespace App\Filament\Resources\PenilaianAlternatifResource\Pages;

use App\Filament\Resources\PenilaianAlternatifResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPenilaianAlternatifs extends ListRecords
{
    protected static string $resource = PenilaianAlternatifResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
