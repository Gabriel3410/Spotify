<x-app-layout>
    <div class="container">
        <h2 class="mb-4">Gerenciar Músicas</h2>

        <a href="{{ route('admin.songs.create') }}" class="btn btn-primary mb-3">Adicionar Nova Música</a>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Artista</th>
                    <th>Álbum</th>
                    <th>Gênero</th>
                    <th>Duração</th>
                    <th>Capa</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($songs as $song)
                    <tr>
                        <td>{{ $song->title }}</td>
                        <td>{{ $song->artist->name }}</td>
                        <td>{{ $song->album ? $song->album->name : 'N/A' }}</td>
                        <td>{{ $song->genre }}</td>
                        <td>{{ $song->duration }}</td>
                        <td>
                            @if ($song->cover_image)
                                <img src="{{ asset('storage/' . $song->cover_image) }}" alt="Capa" width="50">
                            @else
                                N/A
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.songs.edit', $song->id) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('admin.songs.destroy', $song->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
