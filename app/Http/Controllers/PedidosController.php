<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedidos;
use App\Models\Cliente;

class PedidosController extends Controller
{
    public function index()
    {
        $pedidos = Pedidos::with('cliente')->get();
        return view('pedidos.index', compact('pedidos'));
    }

    public function create()
    {
        $clientes = Cliente::all();
        return view('pedidos.create', compact('clientes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'status' => 'required|in:pendente,pago,cancelado',
            'valor_total' => 'required|numeric|min:0',
        ]);

        Pedidos::create($request->only(['cliente_id', 'status', 'valor_total']));

        return redirect()->route('pedidos.index')->with('success', 'Pedido criado com sucesso!');
    }

    public function edit(string $id)
    {
        $pedido = Pedidos::findOrFail($id);
        $clientes = Cliente::all();
        return view('pedidos.edit', compact('pedido', 'clientes'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'status' => 'required|in:pendente,pago,cancelado',
            'valor_total' => 'required|numeric|min:0',
        ]);

        $pedido = Pedidos::findOrFail($id);
        $pedido->update($request->only(['cliente_id', 'status', 'valor_total']));

        return redirect()->route('pedidos.index')->with('success', 'Pedido atualizado com sucesso!');
    }

    public function destroy(string $id)
    {
        $pedido = Pedidos::findOrFail($id);
        $pedido->delete();

        return redirect()->route('pedidos.index')->with('success', 'Pedido deletado com sucesso!');
    }
}
