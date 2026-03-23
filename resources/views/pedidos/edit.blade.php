<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Editar Pedido') }}</h2>
            <a href="{{ route('pedidos.index') }}" class="text-indigo-600 hover:text-indigo-400">Voltar</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow rounded-lg">
                @if ($errors->any())
                    <div class="mb-4">
                        <ul class="list-disc pl-5 text-red-600">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('pedidos.update', $pedido->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="cliente_id" class="block font-medium text-sm text-gray-700">Cliente</label>
                        <select name="cliente_id" id="cliente_id" class="mt-1 block w-full border-gray-300 rounded-md">
                            @foreach ($clientes as $cliente)
                                <option value="{{ $cliente->id }}" {{ $pedido->cliente_id == $cliente->id ? 'selected' : '' }}>{{ $cliente->nome }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="status" class="block font-medium text-sm text-gray-700">Status</label>
                        <select name="status" id="status" class="mt-1 block w-full border-gray-300 rounded-md">
                            <option value="pendente" {{ $pedido->status == 'pendente' ? 'selected' : '' }}>Pendente</option>
                            <option value="pago" {{ $pedido->status == 'pago' ? 'selected' : '' }}>Pago</option>
                            <option value="cancelado" {{ $pedido->status == 'cancelado' ? 'selected' : '' }}>Cancelado</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="valor_total" class="block font-medium text-sm text-gray-700">Valor Total</label>
                        <input id="valor_total" name="valor_total" type="number" step="0.01" min="0" value="{{ old('valor_total', $pedido->valor_total) }}" class="mt-1 block w-full border-gray-300 rounded-md" />
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">Atualizar Pedido</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>