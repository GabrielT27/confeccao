<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\ItemPedido;

class Produto extends Model
{
    protected $guard = [];

    public function itemPedidos()
    {
        return $this->hasMany(ItemPedido::class, 'produto_id');
    }
}
