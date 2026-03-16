<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory; // Importe isso

use Illuminate\Database\Eloquent\Model;

class Fornecedores extends Model
{
    // Isso permite que o Laravel salve esses campos de uma vez só
    use HasFactory; 
    protected $fillable = ['nome', 'cpf', 'email', 'telefone', 'endereco'];
}
