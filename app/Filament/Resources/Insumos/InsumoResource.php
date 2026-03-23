<?php

namespace App\Filament\Resources\Insumos;

use App\Filament\Resources\Insumos\Pages\CreateInsumo;
use App\Filament\Resources\Insumos\Pages\EditInsumo;
use App\Filament\Resources\Insumos\Pages\ListInsumos;
use App\Filament\Resources\Insumos\Pages\ViewInsumo;
use App\Filament\Resources\Insumos\Schemas\InsumoForm;
use App\Filament\Resources\Insumos\Schemas\InsumoInfolist;
use App\Filament\Resources\Insumos\Tables\InsumosTable;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use App\Models\Insumo;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class InsumoResource extends Resource
{
    protected static ?string $model = Insumo::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Insumo';

    public static function form(Schema $schema): Schema
    {
        // return InsumoForm::configure($schema);
        return $schema
            ->schema([
                TextInput::make('nome')
                    ->label('Nome')
                    ->required()
                    ->maxLength(100),
                TextInput::make('unidade_medida')
                    ->label('Unidade de Medida')
                    ->required()
                    ->maxLength(50),
                TextInput::make('preco_unitario')
                    ->label('Preço Unitário')
                    ->numeric()
                    ->prefix('R$ ')
                    ->columnSpan(2)
                    ->minValue(0),
                TextInput::make('estoque')
                    ->label('Estoque')
                    ->numeric()
                    ->suffix(' unidades')
                    ->minValue(0),
            ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return InsumoInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        // return InsumosTable::configure($table);
        return $table->columns([
            TextColumn::make('nome')->label('Nome')->searchable()->sortable(),
            TextColumn::make('unidade_medida')->label('Unidade de Medida')->searchable()->sortable(),
            TextColumn::make('preco_unitario')->label('Preço Unitário')->money('BRL', true)->sortable(),
            TextColumn::make('estoque')->label('Estoque')->sortable(),
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
            'index' => ListInsumos::route('/'),
            'create' => CreateInsumo::route('/create'),
            'view' => ViewInsumo::route('/{record}'),
            'edit' => EditInsumo::route('/{record}/edit'),
        ];
    }
}
