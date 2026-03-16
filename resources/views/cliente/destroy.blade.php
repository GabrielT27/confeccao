<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Deletar Cliente') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="border-l-4 border-red-500 bg-red-50 p-4 mb-6">
                    <p class="text-red-700 font-semibold text-lg">Atenção!</p>
                    <p class="text-red-600 mt-2">Você está prestes a deletar um cliente. Esta ação é irreversível.</p>
                </div>

                <div class="bg-gray-50 p-4 rounded-lg mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Dados do cliente a ser deletado:</h3>
                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Nome:</span>
                            <span class="font-semibold text-gray-900">{{ $cliente->nome }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">CPF:</span>
                            <span class="font-semibold text-gray-900">{{ $cliente->cpf }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Email:</span>
                            <span class="font-semibold text-gray-900">{{ $cliente->email }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Telefone:</span>
                            <span class="font-semibold text-gray-900">{{ $cliente->telefone }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Endereço:</span>
                            <span class="font-semibold text-gray-900">{{ $cliente->endereco }}</span>
                        </div>
                    </div>
                </div>

                <p class="text-red-600 font-semibold mb-6">Tem certeza que deseja continuar?</p>

                <div class="flex items-center justify-between">
                    <a href="{{ route('clientes.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-6 rounded-lg transition duration-300">
                        Cancelar
                    </a>
                    
                    <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-6 rounded-lg transition duration-300">
                            Sim, Deletar Cliente
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
