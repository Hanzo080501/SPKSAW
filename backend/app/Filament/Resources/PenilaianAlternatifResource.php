<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PenilaianAlternatifResource\Pages;
use App\Models\Car;
use App\Models\Kriteria;
use App\Models\PenilaianAlternatif;
use Faker\Provider\ar_EG\Text;
use Filament\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class PenilaianAlternatifResource extends Resource
{
    protected static ?string $model = PenilaianAlternatif::class;

    protected static ?string $navigationIcon = 'heroicon-o-calculator';
    protected static ?string $navigationGroup = 'Admin Management';
    protected static ?string $navigationLabel = 'Penilaian Alternatif';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('car_id')
                    ->label('Mobil')
                    ->options(Car::all()->pluck('name', 'id'))
                    ->required(),

                Select::make('kriteria_id')
                    ->label('Kriteria')
                    ->options(Kriteria::all()->pluck('nama_kriteria', 'id'))
                    ->required(),
                Select::make('nilai')
                    ->label('Nilai')
                    ->options([
                        '1' => '1',
                        '2' => '2',
                        '3' => '3',
                        '4' => '4',
                        '5' => '5',
                    ])
                    ->required(),
            ])
            ->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('car.name')
                    ->label('Mobil')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kriteria.nama_kriteria')
                    ->label('Kriteria')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nilai')
                    ->label('Nilai'),
            ])
            ->filters([
                SelectFilter::make('car_id')
                    ->label('Merk')
                    ->options(Car::query()->distinct()->pluck('name', 'id')),
                SelectFilter::make('kriteria_id')
                    ->label('Kriteria')
                    ->options(Kriteria::query()->distinct()->pluck('nama_kriteria', 'id')),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    // public function saveCarPenilaian(array $data, $carId)
    // {
    //     foreach ($data['kriterias'] as $kriteria) {
    //         PenilaianAlternatif::create([
    //             'car_id' => $carId,
    //             'kriteria_id' => $kriteria['kriteria_id'],
    //             'nilai' => $kriteria['nilai'],
    //         ]);
    //     }
    // }


    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPenilaianAlternatifs::route('/'),
            'create' => Pages\CreatePenilaianAlternatif::route('/create'),
            'edit' => Pages\EditPenilaianAlternatif::route('/{record}/edit'),
        ];
    }
}
