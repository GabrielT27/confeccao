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
        Schema::create('clientes', function (Blueprint $table) {
        $table->id();
        $table->string('nome'); // Nome do cliente
        $table->string('cpf')->unique(); // CPF único para não repetir
        $table->string('email')->unique(); // Útil para contato
        $table->string('telefone')->nullable(); // Campo opcional
        $table->text('endereco')->nullable(); // Local para entrega das peças
        $table->timestamps();
    });
}
        

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
