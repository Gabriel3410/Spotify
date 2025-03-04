<x-app-layout>
 <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Upload de Música</h1>

        @if ($errors->any())
            <div class="mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li class="text-red-500">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('manager.store_song') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="artist_id" class="block text-gray-700">Artista:</label>
                <select name="artist_id" id="artist_id" class="w-full border border-gray-300 p-2 rounded" required>
                    <option value="">Selecione um artista</option>
                    @foreach ($artists as $artist)
                        <option value="{{ $artist->id }}">{{ $artist->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="album_id" class="block text-gray-700">Álbum (Opcional):</label>
                <select name="album_id" id="album_id" class="w-full border border-gray-300 p-2 rounded">
                    <option value="">Selecione um álbum</option>
                    @foreach ($albums as $album)
                        <option value="{{ $album->id }}">{{ $album->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="title" class="block text-gray-700">Título da Música:</label>
                <input type="text" name="title" id="title" class="w-full border border-gray-300 p-2 rounded"
                    required>
            </div>
            
            <div class="mb-4">
                <label for="genre" class="block text-gray-700">Gênero:</label>
                <input type="text" name="genre" id="genre" class="w-full border border-gray-300 p-2 rounded"
                    required>
            </div>

            <div class="mb-4">
                <label for="cover_image" class="block text-gray-700">Imagem:</label>
                <input type="file" name="cover_image" id="cover_image" class="w-full">
            </div>

            <div class="mb-4">
                <label for="duration" class="block text-gray-700">Duração (ex: 03:45):</label>
                <input type="text" name="duration" id="duration" class="w-full border border-gray-300 p-2 rounded"
                    required>
            </div>

            <div class="mb-4">
                <label for="song_file" class="block text-gray-700">Arquivo da Música:</label>
                <input type="file" name="song_file" id="song_file" class="w-full" required>
            </div>

            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                Enviar Música
            </button>
        </form>
    </div>
</x-app-layout>
