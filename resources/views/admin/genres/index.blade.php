<x-app-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Gerenciar Gêneros Musicais</h1>

        <!-- Exibir erros de validação -->
        @if ($errors->any())
            <div class="mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li class="text-red-500">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulário de cadastro de gênero -->
        <form action="{{ route('admin.genres.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-gray-700">Nome do Gênero:</label>
                <input type="text" name="name" id="name" class="w-full border border-gray-300 p-2 rounded" required>
            </div>

            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Adicionar Gênero
            </button>
        </form>

        <!-- Listagem dos gêneros cadastrados -->
        <h2 class="text-xl font-bold mt-6">Gêneros Cadastrados</h2>
        <ul class="mt-2">
            @foreach ($genres as $genre)
                <li class="flex justify-between items-center bg-gray-100 p-2 rounded mt-2">
                    {{ $genre->name }}
                    <form action="{{ route('admin.genres.destroy', $genre->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este gênero?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white px-2 py-1 rounded">Excluir</button>
                    </form>
                </li>
            @endforeach
        </ul>
    </div>
</x-app-layout>
