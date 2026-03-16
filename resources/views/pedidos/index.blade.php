<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Gerenciamento de Pedido - Confecção') }}
            </h2>
            <a href="{{ route('pedidos.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
                + Novo Pedido
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-blue-500">
                        <tr>
                            <th class="px-9 py-3 text-left text-xs font-medium text-gray-100 uppercase tracking-wider">ID do pedido</th>
                            <th class="px-9 py-3 text-left text-xs font-medium text-gray-100 uppercase tracking-wider">Produto</th>
                            <th class="px-9 py-3 text-left text-xs font-medium text-gray-100 uppercase tracking-wider">Email</th>
                            <th class="px-9 py-3 text-left text-xs font-medium text-gray-100 uppercase tracking-wider">Tamanho</th>
                            <th class="px-9 py-3 text-left text-xs font-medium text-gray-100 uppercase tracking-wider">Valor da Compra</th>
                            <th class="px-9 py-3 text-right text-xs font-medium text-gray-100 uppercase tracking-wider">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($pedidos as $pedidos)
                            <tr class="hover:bg-indigo-50 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-semibold text-gray-900">{{ $pedidos->nome }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-600">{{ $pedidos->produto }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        {{ $pedidos->email }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{ route('clientes.edit', $pedidos->id) }}" class="text-indigo-600 hover:text-indigo-400 mr-3">Editar</a>
                                    <form id="delete-form-{{ $pedidos->id }}" action="{{ route('clientes.destroy', $pedidos->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="confirmDelete({{ $pedidos->id }})" class="text-red-600 hover:text-red-400 cursor-pointer">Excluir</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(pedidosId) {
            if (confirm('Tem certeza que deseja deletar este pedido?')) {
                document.getElementById('delete-form-' + pedidosId).submit();
            }
        }
    </script>
</x-app-layout>