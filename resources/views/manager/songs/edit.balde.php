<x-app-layout>
    <div class="container">
        <h2 class="mb-4">Editar Música</h2>

        <form action="{{ route('admin.songs.update', $song->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">Título da Música</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $song->title }}" required>
            </div>

            <div class="mb-3">
                <label for="artist_id" class="form-label">Artista</label>
                <select class="form-control" id="artist_id" name="artist_id" required>
                    @foreach ($artists as $artist)
                        <option value="{{ $artist->id }}" {{ $song->artist_id == $artist->id ? 'selected' : '' }}>
                            {{ $artist->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="album_id" class="form-label">Álbum</label>
                <select class="form-control" id="album_id" name="album_id">
                    <option value="">Sem álbum</option>
                    @foreach ($albums as $album)
                        <option value="{{ $album->id }}" {{ $song->album_id == $album->id ? 'selected' : '' }}>
                            {{ $album->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="genre" class="form-label">Gênero Musical</label>
                <select class="form-control" id="genre" name="genre" required>
                    @foreach ($genres as $genre)
                        <option value="{{ $genre->name }}" {{ $song->genre == $genre->name ? 'selected' : '' }}>
                            {{ $genre->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="duration" class="form-label">Duração</label>
                <input type="time" class="form-control" id="duration" name="duration" value="{{ $song->duration }}">
            </div>

            <div class="mb-3">
                <label for="cover_image" class="form-label">Imagem da Capa</label>
                <input type="file" class="form-control" id="cover_image" name="cover_image" accept="image/*">
            </div>

            <button type="submit" class="btn btn-primary">Atualizar Música</button>
        </form>
    </div>
</x-app-layout>
