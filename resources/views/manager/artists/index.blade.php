<x-app-layout>
    <div class="container">
        <h2 class="mb-4">Gerenciar Artistas</h2>

        <a href="{{ route('admin.artists.create') }}" class="btn btn-primary mb-3">Adicionar Novo Artista</a>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Gênero</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($artists as $artist)
                    <tr>
                        <td>{{ $artist->name }}</td>
                        <td>{{ $artist->genre->name ?? 'Sem gênero' }}</td>
                        <td>
                            <a href="{{ route('admin.artists.edit', $artist->id) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('admin.artists.destroy', $artist->id) }}" method="POST" style="display:inline;">
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
