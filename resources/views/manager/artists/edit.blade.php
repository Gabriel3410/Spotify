<x-app-layout>
    <div class="container">
        <h2 class="mb-4">Editar Artista</h2>

        <form action="{{ route('admin.artists.update', $artist->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Nome do Artista</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $artist->name }}" required>
            </div>

            <div class="mb-3">
                <label for="genre_id" class="form-label">Gênero Musical</label>
                <select class="form-control" id="genre_id" name="genre_id" required>
                    @foreach ($genres as $genre)
                        <option value="{{ $genre->id }}" {{ $artist->genre_id == $genre->id ? 'selected' : '' }}>
                            {{ $genre->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-success">Atualizar</button>
            <a href="{{ route('admin.artists.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</x-app-layout>
