<?php

namespace App\Filament\Resources\Clientes;

use App\Filament\Resources\Clientes\Pages\CreateCliente;
use App\Filament\Resources\Clientes\Pages\EditCliente;
use App\Filament\Resources\Clientes\Pages\ListClientes;
use App\Filament\Resources\Clientes\Pages\ViewCliente;
use App\Filament\Resources\Clientes\Schemas\ClienteForm;
use App\Filament\Resources\Clientes\Schemas\ClienteInfolist;
use App\Filament\Resources\Clientes\Tables\ClientesTable;
use App\Models\Cliente;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;

class ClienteResource extends Resource
{
    protected static ?string $model = Cliente::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Cliente';

    public static function form(Schema $schema): Schema
    {
        // return ClienteForm::configure($schema);
        return $schema
            ->schema([
                TextInput::make('nome')
                    ->label('Nome')
                    ->required()
                    ->maxLength(100),
                TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->maxLength(100),
                TextInput::make('telefone')
                    ->label('Telefone')
                    ->maxLength(100),
                TextInput::make('documento')
                    ->label('Documento')
                    ->maxLength(100),
            ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ClienteInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        // return ClientesTable::configure($table);
        return $table->columns([
            TextColumn::make('nome')->label('Nome')->searchable()->sortable(),
            TextColumn::make('email')->label('Email')->searchable()->sortable(),
            TextColumn::make('telefone')->label('Telefone')->searchable()->sortable(),
            TextColumn::make('documento')->label('Documento')->searchable()->sortable(),
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
            'index' => ListClientes::route('/'),
            'create' => CreateCliente::route('/create'),
            'view' => ViewCliente::route('/{record}'),
            'edit' => EditCliente::route('/{record}/edit'),
        ];
    }
}
