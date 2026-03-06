<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       Schema::create('pedidos', function (Blueprint $table) {
        $table->id();
        // ESTA LINHA É A MAIS IMPORTANTE:
        $table->foreignId('cliente_id')->constrained('clientes')->onDelete('cascade');
        
        $table->string('produto');
        $table->string('tamanho');
        $table->decimal('valor_total', 10, 2);
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
