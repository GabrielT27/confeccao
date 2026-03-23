<?php

namespace App\Filament\Resources\Pedidos;

use App\Filament\Resources\Pedidos\Pages\CreatePedido;
use App\Filament\Resources\Pedidos\Pages\EditPedido;
use App\Filament\Resources\Pedidos\Pages\ListPedidos;
use App\Filament\Resources\Pedidos\Pages\ViewPedido;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Repeater;
use App\Models\Pedido;
use App\Models\Produto;
use BackedEnum;
use Filament\Forms\Components\Select;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PedidoResource extends Resource
{
    protected static ?string $model = Pedido::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Select::make('cliente_id')
                    ->relationship('cliente', 'nome')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->label('Cliente'),
                    
                Select::make('status')
                    ->options([
                        'pendente' => 'Pendente',
                        'em_producao' => 'Em Produção',
                        'concluido' => 'Concluído',
                        'cancelado' => 'Cancelado',
                    ])
                    ->default('pendente')
                    ->required()
                    ->label('Status'),
                    
                Repeater::make('itens')
                    ->relationship('itens')
                    ->schema([
                        Select::make('produto_id')
                            ->relationship('produto', 'nome')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                if ($state) {
                                    $produto = Produto::find($state);
                                    if ($produto) {
                                        $preco = $produto->preco_venda ?? 0;
                                        $set('preco_unitario', $preco);
                                        $quantidade = $get('quantidade') ?? 1;
                                        $set('subtotal', $preco * $quantidade);
                                    }
                                }
                            })
                            ->label('Produto'),
                            
                        TextInput::make('quantidade')
                            ->numeric()
                            ->minValue(1)
                            ->required()
                            ->default(1)
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $get, callable $set) {
                                $preco = $get('preco_unitario');
                                if ($preco && $state) {
                                    $set('subtotal', $preco * $state);
                                }
                            })
                            ->label('Quantidade'),
                            
                        TextInput::make('preco_unitario')
                            ->numeric()
                            ->required()
                            ->prefix('R$ ')
                            ->disabled()
                            ->dehydrated(true)
                            ->label('Preço Unitário'),
                            
                        TextInput::make('subtotal')
                            ->numeric()
                            ->prefix('R$ ')
                            ->disabled()
                            ->dehydrated(true)
                            ->label('Subtotal'),
                    ])
                    ->label('Itens do Pedido')
                    ->minItems(1)
                    ->required()
                    ->afterStateUpdated(function ($state, callable $set) {
                        // Calcula o valor total sempre que os itens mudam
                        $total = 0;
                        if (is_array($state)) {
                            foreach ($state as $item) {
                                if (isset($item['subtotal']) && is_numeric($item['subtotal'])) {
                                    $total += $item['subtotal'];
                                }
                            }
                        }
                        $set('valor_total', $total);
                    })
                    ->mutateRelationshipDataBeforeSaveUsing(function (array $data): array {
                        // Garante que o subtotal seja salvo
                        if (isset($data['quantidade'], $data['preco_unitario'])) {
                            $data['subtotal'] = $data['quantidade'] * $data['preco_unitario'];
                        }
                        return $data;
                    }),
                    
                TextInput::make('valor_total')
                    ->label('Valor Total do Pedido')
                    ->numeric()
                    ->prefix('R$ ')
                    ->disabled()
                    ->dehydrated(true)
                    ->columnSpan(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('cliente.nome')
                    ->label('Cliente')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pendente' => 'warning',
                        'em_producao' => 'info',
                        'concluido' => 'success',
                        'cancelado' => 'danger',
                        default => 'secondary',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pendente' => 'Pendente',
                        'em_producao' => 'Em Produção',
                        'concluido' => 'Concluído',
                        'cancelado' => 'Cancelado',
                        default => $state,
                    })
                    ->sortable(),
                TextColumn::make('valor_total')
                    ->label('Valor Total')
                    ->money('BRL')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Data do Pedido')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPedidos::route('/'),
            'create' => CreatePedido::route('/create'),
            'view' => ViewPedido::route('/{record}'),
            'edit' => EditPedido::route('/{record}/edit'),
        ];
    }
}