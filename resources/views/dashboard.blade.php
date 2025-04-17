<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @if (!$hasContent)
        <div class="alert alert-info text-center my-4 p-4 bg-blue-100 border border-blue-300 rounded">
            Nenhum artista ou música disponível nesse estilo ainda, mas em breve será adicionado. 🎶
        </div>
    @endif

    <h1 style="margin:100px 0 0 100px; color:white; font-size:30px">Dashboard - Artistas e Músicas</h1>

    @foreach ($artists as $artist)
        <div style="margin: 0 0 0 100px; color:white">
            <h2>{{ $artist->name }}</h2>
            <p>{{ $artist->bio }}</p>
            @if ($artist->image)
                <img src="{{ asset('storage/' . $artist->image) }}" alt="{{ $artist->name }}" width="150">
            @endif

            <h4>Músicas:</h4>
            <ul>
                @foreach ($artist->songs as $song)
                    <li>
                        {{ $song->title }} ({{ $song->duration }})
                        @if ($song->file_url)
                            <audio controls style="margin-left: 10px;">
                                <source src="{{ asset('storage/' . $song->file_url) }}" type="audio/mpeg">
                                Seu navegador não suporta áudio.
                            </audio>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    @endforeach
</x-app-layout>
