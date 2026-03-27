<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany; // Importante
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Produto extends Model
{
    protected $guarded = [];

    /**
     * Se um produto for composto por vários insumos
     */
    public function insumos(): HasMany
    {
        return $this->hasMany(Insumo::class);
    }
}