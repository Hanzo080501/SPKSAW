<?php

namespace App\Filament\Resources\PenilaianAlternatifResource\Pages;

use App\Filament\Resources\PenilaianAlternatifResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPenilaianAlternatif extends EditRecord
{
    protected static string $resource = PenilaianAlternatifResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
