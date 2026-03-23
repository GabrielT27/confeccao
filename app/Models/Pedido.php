<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pedido extends Model
{
    protected $fillable = [
        'cliente_id',
        'status',
        'valor_total',
    ];

    protected $casts = [
        'valor_total' => 'decimal:2',
    ];

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class);
    }

    public function itens(): HasMany
    {
        return $this->hasMany(ItemPedido::class);
    }

    // Calcula o valor total baseado nos itens
    public function calcularValorTotal(): float
    {
        return $this->itens->sum(function ($item) {
            return $item->quantidade * $item->preco_unitario;
        });
    }

    // Atualiza o valor total do pedido
    public function atualizarValorTotal(): void
    {
        $this->valor_total = $this->calcularValorTotal();
        $this->saveQuietly();
    }
}