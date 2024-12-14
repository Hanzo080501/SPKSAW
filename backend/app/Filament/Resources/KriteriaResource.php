<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KriteriaResource\Pages;
use App\Filament\Resources\KriteriaResource\RelationManagers;
use App\Models\Kriteria;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KriteriaResource extends Resource
{
    protected static ?string $model = Kriteria::class;

    protected static ?string $navigationIcon = 'heroicon-o-list-bullet';
    protected static ?string $navigationLabel = 'Kriteria';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('kode_kriteria')
                    ->label('Kode Kriteria')
                    ->required()
                    ->maxLength(3),
                Forms\Components\TextInput::make('nama_kriteria')
                    ->label('Nama Kriteria')
                    ->required(),
                Forms\Components\Select::make('type')
                    ->label('Tipe Kriteria')
                    ->options([
                        'benefit' => 'Benefit',
                        'cost' => 'Cost',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('bobot')
                    ->label('Bobot (%)')
                    ->numeric()
                    ->step(0.1)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kode_kriteria')
                    ->label('Kode Kriteria')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_kriteria')
                    ->label('Nama Kriteria')
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->label('Tipe Kriteria'),
                Tables\Columns\TextColumn::make('bobot')
                    ->label('Bobot (%)')
                    ->numeric(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListKriterias::route('/'),
            'create' => Pages\CreateKriteria::route('/create'),
            'edit' => Pages\EditKriteria::route('/{record}/edit'),
        ];
    }
}
