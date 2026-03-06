public function index() {
    // Busca os pedidos e já traz o nome do cliente junto (Eager Loading)
    $pedidos = \App\Models\Pedido::with('cliente')->get(); 
    
    // Envia para a tela de pedidos
    return view('pedidos.index', compact('pedidos'));
}