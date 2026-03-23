<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Criar Pedido') }}</h2>
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

                <form method="POST" action="{{ route('pedidos.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="cliente_id" class="block font-medium text-sm text-gray-700">Cliente</label>
                        <select name="cliente_id" id="cliente_id" class="mt-1 block w-full border-gray-300 rounded-md">
                            <option value="">Selecione</option>
                            @foreach ($clientes as $cliente)
                                <option value="{{ $cliente->id }}" {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}>{{ $cliente->nome }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="status" class="block font-medium text-sm text-gray-700">Status</label>
                        <select name="status" id="status" class="mt-1 block w-full border-gray-300 rounded-md">
                            <option value="pendente" {{ old('status') == 'pendente' ? 'selected' : '' }}>Pendente</option>
                            <option value="pago" {{ old('status') == 'pago' ? 'selected' : '' }}>Pago</option>
                            <option value="cancelado" {{ old('status') == 'cancelado' ? 'selected' : '' }}>Cancelado</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="valor_total" class="block font-medium text-sm text-gray-700">Valor Total</label>
                        <input id="valor_total" name="valor_total" type="number" step="0.01" min="0" value="{{ old('valor_total') }}" class="mt-1 block w-full border-gray-300 rounded-md" />
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">Salvar Pedido</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
                            @foreach (->all() as O arquivo C:\Users\49856178819\AppData\Local\Programs\Microsoft VS Code\07ff9d6178\resources\app\out\vs\workbench\contrib\terminal\common\scripts\shellIntegration.ps1 n�o pode ser carregado porque a execu��o de scripts foi desabilitada neste sistema. Para obter mais informa��es, consulte about_Execution_Policies em https://go.microsoft.com/fwlink/?LinkID=135170.)
                                <li>{{ O arquivo C:\Users\49856178819\AppData\Local\Programs\Microsoft VS Code\07ff9d6178\resources\app\out\vs\workbench\contrib\terminal\common\scripts\shellIntegration.ps1 n�o pode ser carregado porque a execu��o de scripts foi desabilitada neste sistema. Para obter mais informa��es, consulte about_Execution_Policies em https://go.microsoft.com/fwlink/?LinkID=135170. }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('pedidos.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="cliente_id" class="block font-medium text-sm text-gray-700">Cliente</label>
                        <select name="cliente_id" id="cliente_id" class="mt-1 block w-full border-gray-300 rounded-md">
                            <option value="">Selecione</option>
                            @foreach ( as )
                                <option value="{{ ->id }}" {{ old('cliente_id') == ->id ? 'selected' : '' }}>{{ ->nome }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="status" class="block font-medium text-sm text-gray-700">Status</label>
                        <select name="status" id="status" class="mt-1 block w-full border-gray-300 rounded-md">
                            <option value="pendente" {{ old('status') == 'pendente' ? 'selected' : '' }}>Pendente</option>
                            <option value="pago" {{ old('status') == 'pago' ? 'selected' : '' }}>Pago</option>
                            <option value="cancelado" {{ old('status') == 'cancelado' ? 'selected' : '' }}>Cancelado</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="valor_total" class="block font-medium text-sm text-gray-700">Valor Total</label>
                        <input id="valor_total" name="valor_total" type="number" step="0.01" min="0" value="{{ old('valor_total') }}" class="mt-1 block w-full border-gray-300 rounded-md" />
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">Salvar Pedido</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
