<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PedidosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pedidos = \App\Models\Pedidos::all(); // Busca todos os pedidos do banco
        return view('pedidos.index', compact('pedidos')); // Envia para a tela
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pedidos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'ID do pedido' => 'required|string|max:255',
            'produto' => 'required|string|max:14|unique:produto,cpf',
            'email' => 'required|email|max:255|unique:pedidos,email',
            'tamanho' => 'required|string|max:2',
            'valor de compra' => 'required|decimal(10,2)',
        ]);

        \App\Models\Pedidos::create($request->only(['ID do pedido', 'produto', 'email', 'tamanho', 'valor da compra']));

        return redirect()->route('pedidos.index')->with('success', 'Pedido criado com sucesso!');
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
        $cliente = \App\Models\Pedidos::findOrFail($id);
        return view('pedidos.edit', compact('pedidos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'ID do pedido' => 'required|string|max:255|unique:pedidos, ID do pedido,' . $id,
            'email' => 'required|email|max:255|unique:pedidos,email,' . $id,
            'tamanho' => 'required|string|max:1|unique:pedidos,tamanho,' . $id,
            'valor de compra' => 'required|decimal(10,2)|max:20',
        ]);

        $pedidos = \App\Models\Pedidos::findOrFail($id);
        $pedidos->update($request->only(['ID do pedido', 'email', 'tamanho', 'valor de compra',]));

        return redirect()->route('pedidos.index')->with('success', 'Pedido atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pedidos = \App\Models\Pedidos::findOrFail($id);
        $pedidos->delete();
        return redirect()->route('pedidos.index')->with('success', 'Pedidos deletado com sucesso!');
    }
    
}