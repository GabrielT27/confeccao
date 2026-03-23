<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Remove o campo preco_unitario da tabela pedidos (está no lugar errado)
        if (Schema::hasColumn('pedidos', 'preco_unitario')) {
            Schema::table('pedidos', function (Blueprint $table) {
                $table->dropColumn('preco_unitario');
            });
        }
        
        // 2. Adiciona os campos corretos na tabela item_pedidos
        Schema::table('item_pedidos', function (Blueprint $table) {
            // Adiciona preco_unitario se não existir
            if (!Schema::hasColumn('item_pedidos', 'preco_unitario')) {
                $table->decimal('preco_unitario', 10, 2)->nullable()->after('quantidade');
            }
            
            // Adiciona subtotal se não existir
            if (!Schema::hasColumn('item_pedidos', 'subtotal')) {
                $table->decimal('subtotal', 10, 2)->nullable()->after('preco_unitario');
            }
        });
    }

    public function down(): void
    {
        // Reverte as alterações
        Schema::table('pedidos', function (Blueprint $table) {
            $table->string('preco_unitario')->default('')->after('status');
        });
        
        Schema::table('item_pedidos', function (Blueprint $table) {
            $table->dropColumn(['preco_unitario', 'subtotal']);
        });
    }
};