<?php

namespace App\Filament\Resources\ItemPedidoResource\Pages;

use App\Filament\Resources\ItemPedidoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditItemPedido extends EditRecord
{
    protected static string $resource = ItemPedidoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
