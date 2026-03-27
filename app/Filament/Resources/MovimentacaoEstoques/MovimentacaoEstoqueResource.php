<?php

namespace App\Filament\Resources\MovimentacaoEstoques;

use App\Filament\Resources\MovimentacaoEstoques\Pages\CreateMovimentacaoEstoque;
use App\Filament\Resources\MovimentacaoEstoques\Pages\EditMovimentacaoEstoque;
use App\Filament\Resources\MovimentacaoEstoques\Pages\ListMovimentacaoEstoques;
use App\Filament\Resources\MovimentacaoEstoques\Pages\ViewMovimentacaoEstoque;
use App\Filament\Resources\MovimentacaoEstoques\Schemas\MovimentacaoEstoqueForm;
use App\Filament\Resources\MovimentacaoEstoques\Schemas\MovimentacaoEstoqueInfolist;
use App\Filament\Resources\MovimentacaoEstoques\Tables\MovimentacaoEstoquesTable;
use App\Models\MovimentacaoEstoque;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class MovimentacaoEstoqueResource extends Resource
{
    protected static ?string $model = MovimentacaoEstoque::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'MovimentacaoEstoque';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                \Filament\Forms\Components\Select::make('produto_id')
                    ->relationship('produto', 'nome') // Busca o nome do produto automaticamente
                    ->label('Produto')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->columnSpanFull(),

                \Filament\Forms\Components\Select::make('tipo')
                    ->label('Tipo de Movimentação')
                    ->options([
                        'entrada' => 'Entrada (Adicionar ao Estoque)',
                        'saida' => 'Saída (Retirar do Estoque)',
                    ])
                    ->required()
                    ->native(false),

                \Filament\Forms\Components\TextInput::make('quantidade')
                    ->label('Quantidade')
                    ->numeric()
                    ->required()
                    ->minValue(1)
                    ->helperText('Apenas números inteiros positivos (ex: 10).'),

                \Filament\Forms\Components\TextInput::make('observacao')
                    ->label('Observação / Motivo')
                    ->maxLength(255)
                    ->placeholder('Ex: Compra do fornecedor, devolução, ajuste manual...')
                    ->columnSpanFull(),
            ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return MovimentacaoEstoqueInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        // return MovimentacaoEstoquesTable::configure($table);
        return $table
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('created_at')
                    ->label('Data')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),

                \Filament\Tables\Columns\TextColumn::make('produto.nome')
                    ->label('Produto')
                    ->searchable()
                    ->sortable(),

                \Filament\Tables\Columns\TextColumn::make('tipo')
                    ->label('Tipo')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'entrada' => 'success', // Verde para entrada
                        'saida' => 'danger',    // Vermelho para saída
                    }),

                \Filament\Tables\Columns\TextColumn::make('quantidade')
                    ->label('Qtd')
                    ->numeric()
                    ->sortable(),

                \Filament\Tables\Columns\TextColumn::make('observacao')
                    ->label('Observação')
                    ->searchable(),
            ])
            ->defaultSort('created_at', 'desc') // Mostra sempre os mais recentes primeiro
            ->filters([
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
            'index' => ListMovimentacaoEstoques::route('/'),
            'create' => CreateMovimentacaoEstoque::route('/create'),
            'view' => ViewMovimentacaoEstoque::route('/{record}'),
            'edit' => EditMovimentacaoEstoque::route('/{record}/edit'),
        ];
    }
}
