<?php

namespace App\Filament\Resources\Fornecedors;

use App\Filament\Resources\Fornecedors\Pages\CreateFornecedor;
use App\Filament\Resources\Fornecedors\Pages\EditFornecedor;
use App\Filament\Resources\Fornecedors\Pages\ListFornecedors;
use App\Filament\Resources\Fornecedors\Pages\ViewFornecedor;
use App\Filament\Resources\Fornecedors\Schemas\FornecedorForm;
use App\Filament\Resources\Fornecedors\Schemas\FornecedorInfolist;
use App\Filament\Resources\Fornecedors\Tables\FornecedorsTable;
use App\Models\Fornecedor;
use App\Models\Fornecedores;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;

class FornecedorResource extends Resource
{
    protected static ?string $model = Fornecedores::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Fornecedor';

    public static function form(Schema $schema): Schema
    {
        // return FornecedorForm::configure($schema);
        return $schema
            ->schema([
                TextInput::make('nomefantasia')
                    ->label('Nome Fantasia')
                    ->maxLength(100),
                TextInput::make('cnpj')
                    ->label('CNPJ')
                    ->maxLength(100),
                TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->maxLength(100),
                TextInput::make('telefone')
                    ->label('Telefone')
                    ->maxLength(100),
            ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return FornecedorInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        // return FornecedorsTable::configure($table);
        return $table->columns([
            TextColumn::make('nomefantasia')->label('Nome Fantasia')->searchable()->sortable(),
            TextColumn::make('cnpj')->label('CNPJ')->searchable()->sortable(),
            TextColumn::make('email')->label('Email')->searchable()->sortable(),
            TextColumn::make('telefone')->label('Telefone')->searchable()->sortable(),
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
            'index' => ListFornecedors::route('/'),
            'create' => CreateFornecedor::route('/create'),
            'view' => ViewFornecedor::route('/{record}'),
            'edit' => EditFornecedor::route('/{record}/edit'),
        ];
    }
}
