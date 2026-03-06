<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // Importe isso
use Illuminate\Database\Eloquent\Model;

class Pedidos extends Model
{
    //
        use HasFactory;
     protected $fillable = ['ID do Pedido', 'Produto', 'email', 'Tamanho', 'Valor da Compra'];
}
