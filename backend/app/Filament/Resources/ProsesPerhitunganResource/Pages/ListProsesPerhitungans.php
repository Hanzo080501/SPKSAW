<?php

namespace App\Filament\Resources\ProsesPerhitunganResource\Pages;

use App\Filament\Resources\ProsesPerhitunganResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProsesPerhitungans extends ListRecords
{
    protected static string $resource = ProsesPerhitunganResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
