<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Artist;
use App\Models\Song;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    public function index()
    {
        // Aqui você pode exibir um resumo ou menu com as ações disponíveis
        return view('manager.dashboard');
    }

    /**
     * Exibe o formulário para cadastrar um novo artista.
     */
    public function createArtist()
    {
        return view('manager.artists.create');
    }

    /**
     * Processa o cadastro de um novo artista.
     */
    public function storeArtist(Request $request)
    {
        // Validação dos dados
        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'bio'   => 'nullable|string',
            'image' => 'nullable|image|max:2048', // imagem opcional com no máximo 2MB
            'genre' => 'nullable|string|max:255',
        ]);

        // Se houver imagem, faz o upload e armazena o caminho
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('artists', 'public');
            $validated['image'] = $path;
        }

        // Cria o artista
        Artist::create($validated);

        return redirect()->route('manager.dashboard')
            ->with('success', 'Artista cadastrado com sucesso!');
    }

    /**
     * Exibe o formulário para fazer upload de uma nova música.
     */
    public function createSong()
    {
        // Recupera artistas e álbuns para seleção no formulário
        $artists = Artist::all();
        $albums = Album::all(); // Se desejar associar a música a um álbum (opcional)

        return view('manager.songs.create', compact('artists', 'albums'));
    }

    /**
     * Processa o upload da nova música.
     */
    public function storeSong(Request $request)
    {
        // Validação dos dados da música
        $validated = $request->validate([
            'artist_id' => 'required|exists:artists,id',
            'album_id'  => 'nullable|exists:albums,id',
            'title'     => 'required|string|max:255',
            'genre'    => 'required|string|max:255',
            'cover_image' => 'nullable|image|max:2048',
            'duration'  => 'required|string|max:10', // duração da música, ex: "03:45"
            'song_file' => 'required|file|mimes:mp3,wav,ogg|max:10240', // arquivo de até 10MB
        ]);


        // Faz o upload do arquivo de música
        if ($request->hasFile('song_file')) {
            $path = $request->file('song_file')->store('songs', 'public');
            $validated['file_url'] = $path;
        }

        // Cria a música
        Song::create($validated);

        return redirect()->route('manager.dashboard')
            ->with('success', 'Música enviada com sucesso!');
    }

    public function createAlbum()
    {
        // Recupera os artistas para que o usuário selecione a qual artista pertence o álbum
        $artists = Artist::all();

        return view('manager.albums.create', compact('artists'));
    }

    public function storeAlbum(Request $request)
    {
        // Validação dos dados para criação do álbum
        $validated = $request->validate([
            'artist_id'    => 'required|exists:artists,id',
            'title'        => 'required|string|max:255',
            'cover_image'  => 'nullable|image|max:2048',
            'realese_date' => 'nullable|date',
        ]);

        // Se houver imagem de capa, realiza o upload
        if ($request->hasFile('cover_image')) {
            $path = $request->file('cover_image')->store('albums', 'public');
            $validated['cover_image'] = $path;
        }

        // Cria o álbum
        Album::create($validated);

        return redirect()->route('manager.dashboard')
            ->with('success', 'Álbum criado com sucesso!');
    }
}

