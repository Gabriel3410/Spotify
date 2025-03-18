<x-app-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Cadastrar Novo Artista</h1>

        @if ($errors->any())
            <div class="mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li class="text-red-500">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('manager.store_artist') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-gray-700">Nome:</label>
                <input type="text" name="name" id="name" class="w-full border border-gray-300 p-2 rounded"
                    required>
            </div>

            <div class="mb-4">
                <label for="bio" class="block text-gray-700">Biografia:</label>
                <textarea name="bio" id="bio" class="w-full border border-gray-300 p-2 rounded"></textarea>
            </div>

            <div class="mb-4">
                <label for="genre_id" class="block text-gray-700">Gênero Musical:</label>
                <select name="genre_id" id="genre_id" class="w-full border border-gray-300 p-2 rounded" required>
                    <option value="">Selecione um gênero</option>
                    @foreach ($genres as $genre)
                        <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="image" class="block text-gray-700">Imagem:</label>
                <input type="file" name="image" id="image" class="w-full">
            </div>

            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Salvar Artista
            </button>
        </form>
    </div>
</x-app-layout>
