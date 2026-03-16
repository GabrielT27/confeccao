<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = \App\Models\Cliente::all(); // Busca todos os clientes do banco
        return view('cliente.index', compact('clientes')); // Envia para a tela
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cliente.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => 'required|string|max:14|unique:clientes,cpf',
            'email' => 'required|email|max:255|unique:clientes,email',
            'telefone' => 'required|string|max:20',
            'endereco' => 'required|string',
        ]);

        \App\Models\Cliente::create($request->only(['nome', 'cpf', 'email', 'telefone', 'endereco']));

        return redirect()->route('clientes.index')->with('success', 'Cliente criado com sucesso!');
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
        $cliente = \App\Models\Cliente::findOrFail($id);
        return view('cliente.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => 'required|string|max:14|unique:clientes,cpf,' . $id,
            'email' => 'required|email|max:255|unique:clientes,email,' . $id,
            'telefone' => 'required|string|max:20',
            'endereco' => 'required|string',
        ]);

        $cliente = \App\Models\Cliente::findOrFail($id);
        $cliente->update($request->only(['nome', 'cpf', 'email', 'telefone', 'endereco']));

        return redirect()->route('clientes.index')->with('success', 'Cliente atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cliente = \App\Models\Cliente::findOrFail($id);
        $cliente->delete();
        return redirect()->route('clientes.index')->with('success', 'Cliente deletado com sucesso!');
    }
    
}
