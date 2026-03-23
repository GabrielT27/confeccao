<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ItemPedidoResource\Pages;
use App\Filament\Resources\ItemPedidoResource\RelationManagers;
use App\Models\ItemPedido;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ItemPedidoResource extends Resource
{
    protected static ?string $model = ItemPedido::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('pedido_id')
                    ->label('Pedido')
                    ->relationship('pedido', 'id')
                    ->searchable()
                    ->required(),
                Forms\Components\Select::make('produto_id')
                    ->label('Produto')
                    ->relationship('produto', 'nome')
                    ->searchable()
                    ->required(),
                Forms\Components\TextInput::make('quantidade')
                    ->required()
                    ->numeric()
                    ->default(1),
                Forms\Components\TextInput::make('preco_unitario')
                    ->label('Preço Unitário')
                    ->required()
                    ->numeric()
                    ->prefix('R$'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('pedido.id')
                    ->label('Pedido')
                    ->sortable(),
                Tables\Columns\TextColumn::make('produto.nome')
                    ->label('Produto')
                    ->sortable(),
                Tables\Columns\TextColumn::make('quantidade')
                    ->sortable(),
                Tables\Columns\TextColumn::make('preco_unitario')
                    ->label('Preço Unitário')
                    ->money('BRL', true)
                    ->sortable(),
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
            'index' => Pages\ListItemPedidos::route('/'),
            'create' => Pages\CreateItemPedido::route('/create'),
            'edit' => Pages\EditItemPedido::route('/{record}/edit'),
        ];
    }
}
