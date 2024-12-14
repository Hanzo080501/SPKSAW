<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CarResource\Pages;
use App\Filament\Resources\CarResource\RelationManagers;
use App\Http\Controllers\CarController;
use App\Models\Car;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\RawJs;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Termwind\Components\Raw;

class CarResource extends Resource
{
    protected static ?string $model = Car::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';
    protected static ?string $navigationLabel = 'Mobil';
    protected static ?string $pluralLabel = 'Mobil';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\FileUpload::make('image')
                    ->label('Gambar')
                    ->required()
                    ->image()
                    ->directory('galeryCars')
                    ->helperText('Maksimal 2MB')
                    ->imageCropAspectRatio('16:9')
                    ->imageEditor(),

                Forms\Components\TextInput::make('brand')
                    ->label('Merk')
                    ->helperText('Contoh: Toyota')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('name')
                    ->label('Model')
                    ->helperText('Contoh: Avanza')
                    ->autocapitalize('words')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('price')
                    ->label('Harga (Cost)')
                    ->helperText('Contoh: 1,000,000')
                    ->required()
                    ->mask(RawJs::make('$money($input)'))
                    ->stripCharacters(['.', ','])
                    ->maxLength(255)
                    ->numeric()
                    ->prefix('IDR'),
                Forms\Components\TextInput::make('range')
                    ->label('Jarak Tempuh (Benefit)')
                    ->helperText('Contoh: 100KM')
                    ->required()
                    ->maxLength(255)
                    ->numeric(),
                Forms\Components\Select::make('battery_type')
                    ->label('Jenis Baterai (Textual Data)')
                    ->helperText('Contoh: Lithium-Ion')
                    ->options([
                        'lithium-ion' => 'Lithium-Ion',
                        'lithium-iron' => 'Lithium-Iron',
                        'lithium-polymer' => 'Lithium-Polymer',
                        'lithium-metal' => 'Lithium-Metal',
                        'lithium-sulfur' => 'Lithium-Sulfur',
                        'lead-acid' => 'Lead-Acid',
                        'nickel-cadmium' => 'Nickel-Cadmium',
                    ])
                    ->required(),
                Forms\Components\Select::make('drive_type')
                    ->label('Jenis Penggerak (Textual Data)')
                    ->helperText('Contoh: AWD, FWD, RWD')
                    ->options([
                        'AWD' => 'All-Wheel Drive (AWD)',
                        'FWD' => 'Front-Wheel Drive (FWD)',
                        'RWD' => 'Rear-Wheel Drive (RWD)',
                    ])
                    ->required(),
                Forms\Components\Select::make('dealer_availability')
                    ->label('Dealer (Benefit)')
                    ->helperText('Contoh: Yes')
                    ->options([
                        'tersedia' => 'Tersedia',
                        'tidak tersedia' => 'Tidak Tersedia',
                    ])
                    ->required()
                    ->default('yes'),
                Forms\Components\Select::make('spare_part_availability')
                    ->label('Suku Cadang (Benefit)')
                    ->helperText('Contoh: Yes')
                    ->options([
                        'tersedia' => 'Tersedia',
                        'tidak tersedia' => 'Tidak Tersedia',
                    ])
                    ->required()
                    ->default('yes'),
                Forms\Components\TextInput::make('top_speed')
                    ->label('Kecepatan Maksimal (Benefit)')
                    ->helperText('Contoh: 200KM/H')
                    ->required()
                    ->maxLength(255)
                    ->numeric(),
                Forms\Components\TextInput::make('charging_time')
                    ->label('Speed Charging (Benefit)')
                    ->helperText('Contoh: 40 menit')
                    ->prefix('Time: ')
                    ->required()
                    ->maxLength(255)
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->circular()
                    ->stacked()
                    ->limit(1)
                    ->limitedRemainingText(),
                Tables\Columns\TextColumn::make('brand')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->label('Harga')
                    ->money('IDR', locale: 'nl'),
                Tables\Columns\TextColumn::make('range')
                    ->label('Jarak Tempuh')
                    ->suffix(' KM'),
                Tables\Columns\TextColumn::make('battery_type')
                    ->label('Baterai'),
                Tables\Columns\TextColumn::make('drive_type')
                    ->label('Penggerak'),
                Tables\Columns\TextColumn::make('dealer_availability')
                    ->label('Dealer'),
                Tables\Columns\TextColumn::make('spare_part_availability')
                    ->label('Spare Parts'),
                Tables\Columns\TextColumn::make('top_speed')
                    ->label('Top Speed')
                    ->suffix(' KM/H'),
                Tables\Columns\TextColumn::make('charging_time')
                    ->label('Charging Time')
                    ->suffix(' menit'),
                Tables\Columns\TextColumn::make('preferensi')
                    ->label('Preferensi')
                    ->sortable(),
                Tables\Columns\TextColumn::make('ranking')
                    ->label('Ranking')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('brand')
                    ->label('Merk')
                    ->options(Car::query()->distinct()->pluck('brand', 'brand')),
                SelectFilter::make('price')
                    ->label('Harga (Cost)')
                    ->options(Car::query()->distinct()->pluck('price', 'price')),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\RestoreAction::make()
                    ->requiresConfirmation()
                    ->color('warning'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCars::route('/'),
            'create' => Pages\CreateCar::route('/create'),
            'edit' => Pages\EditCar::route('/{record}/edit'),
        ];
    }
}
