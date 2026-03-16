<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FornecedoresController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fornecedores = \App\Models\Fornecedores::all(); // Busca todos os fornecedores do banco
        return view('fornecedores.index', compact('fornecedores')); // Envia para a tela
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('fornecedores.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => 'required|string|max:14|unique:fornecedores,cpf',
            'email' => 'required|email|max:255|unique:fornecedores,email',
            'telefone' => 'required|string|max:20',
            'endereco' => 'required|string',
        ]);

        \App\Models\Fornecedores::create($request->only(['nome', 'cpf', 'email', 'telefone', 'endereco']));

        return redirect()->route('fornecedores.index')->with('success', 'Cliente criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $fornecedores = \App\Models\Fornecedores::findOrFail($id);
        return view('fornecedores.edit', compact('fornecedores'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => 'required|string|max:14|unique:fornecedores,cpf,' . $id,
            'email' => 'required|email|max:255|unique:fornecedores,email,' . $id,
            'telefone' => 'required|string|max:20',
            'endereco' => 'required|string',
        ]);

        $cliente = \App\Models\Cliente::findOrFail($id);
        $cliente->update($request->only(['nome', 'cpf', 'email', 'telefone', 'endereco']));

        return redirect()->route('fornecedores.index')->with('success', 'Cliente atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cliente = \App\Models\Cliente::findOrFail($id);
        $cliente->delete();
        return redirect()->route('fornecedores.index')->with('success', 'Cliente deletado com sucesso!');
    }
    
}
