<?php

namespace App\Filament\Resources\Produtos;

use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use App\Models\Produto;

class ProdutoResource extends Resource
{
    protected static ?string $model = Produto::class;

    

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                TextInput::make('nome')
                    ->required()
                    ->maxLength(255)
                    ->label('Nome do Produto'),
                    
                TextInput::make('referencia')
                    ->required()
                    ->maxLength(50)
                    ->label('Referência'),
                    
                TextInput::make('preco_venda')
                    ->numeric()
                    ->required()
                    ->prefix('R$ ')
                    ->label('Preço de Venda'),
                    
                TextInput::make('estoque')
                    ->numeric()
                    ->required()
                    ->default(0)
                    ->label('Estoque'),
                    
                // NÃO inclua preco_unitario aqui!
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nome')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('referencia')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('preco_venda')
                    ->money('BRL')
                    ->sortable(),
                TextColumn::make('estoque')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Resources\Produtos\Pages\ListProdutos::route('/'),
            'create' => \App\Filament\Resources\Produtos\Pages\CreateProduto::route('/create'),
            'edit' => \App\Filament\Resources\Produtos\Pages\EditProduto::route('/{record}/edit'),
        ];
    }
}