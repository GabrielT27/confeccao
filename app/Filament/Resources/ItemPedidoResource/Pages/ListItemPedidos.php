<?php

namespace App\Filament\Resources\ItemPedidoResource\Pages;

use App\Filament\Resources\ItemPedidoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListItemPedidos extends ListRecords
{
    protected static string $resource = ItemPedidoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
