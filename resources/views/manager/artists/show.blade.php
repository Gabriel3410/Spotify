<x-app-layout>
    <div class="container">
        <h1>{{ $artist->name }}</h1>
        <p>{{ $artist->bio }}</p>

        <img src="{{ asset('storage/' . $artist->image) }}" alt="{{ $artist->name }}" width="200">

        <h2>Músicas</h2>
        <ul>
            @foreach ($artist->songs as $song)
                <li style="margin-bottom: 10px;">
                    {{ $song->title }} ({{ $song->duration }} min)
                    <audio controls style="vertical-align: middle;">
                        <source src="{{ asset('storage/' . $song->file_url) }}" type="audio/mpeg">
                        Seu navegador não suporta o player de áudio.
                    </audio>
                </li>
            @endforeach
        </ul>
    </div>
</x-app-layout>
