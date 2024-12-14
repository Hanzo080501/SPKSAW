<?php

namespace App\Filament\Resources\ProsesPerhitunganResource\Pages;

use App\Filament\Resources\ProsesPerhitunganResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProsesPerhitungan extends EditRecord
{
    protected static string $resource = ProsesPerhitunganResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
