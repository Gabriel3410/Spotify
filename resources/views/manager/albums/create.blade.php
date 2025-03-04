<x-app-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Criar Novo Álbum</h1>

        @if($errors->any())
            <div class="mb-4">
                <ul>
                    @foreach($errors->all() as $error)
                        <li class="text-red-500">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('manager.store_album') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="artist_id" class="block text-gray-700">Artista:</label>
                <select name="artist_id" id="artist_id" class="w-full border border-gray-300 p-2 rounded" required>
                    <option value="">Selecione um artista</option>
                    @foreach($artists as $artist)
                        <option value="{{ $artist->id }}">{{ $artist->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="title" class="block text-gray-700">Título do Álbum:</label>
                <input type="text" name="title" id="title" class="w-full border border-gray-300 p-2 rounded" required>
            </div>

            <div class="mb-4">
                <label for="cover_image" class="block text-gray-700">Imagem de Capa:</label>
                <input type="file" name="cover_image" id="cover_image" class="w-full">
            </div>

            <div class="mb-4">
                <label for="realese_date" class="block text-gray-700">Data de Lançamento:</label>
                <input type="date" name="realese_date" id="realese_date" class="w-full border border-gray-300 p-2 rounded">
            </div>

            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                Criar Álbum
            </button>
        </form>
    </div>
</x-app-layout>
