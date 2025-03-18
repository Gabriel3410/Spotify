<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Artist;
use App\Models\Genre;
use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $artists = Artist::with('genre')->get();
        $genres = Genre::all();
        return view('manager.artists.create', compact('artists', 'genres'));
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
            'genre_id' => 'nullable|string|max:255',
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
     * Processo de edição de um artista artista.
     */
    public function editArtist(Artist $artist)
    {
        $genres = Genre::all();
        return view('admin.artists.edit', compact('artist', 'genres'));
    }

    /**
     *Procecsso para salvar as informações alteradas do artista.
     */
    public function updateArtist(Request $request, Artist $artist)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'genre_id' => 'required|exists:genres,id',
        ]);

        $artist->update($request->all());

        return redirect()->route('admin.artists.index')->with('success', 'Artista atualizado com sucesso!');
    }

    // /**
    //  *Processo de deltar o artista
    // * /
    public function destroyArtist(Artist $artist)
    {
        $artist->delete();

        return redirect()->route('admin.artists.index')->with('success', 'Artista removido com sucesso!');
    }

    /**
     * Exibe o formulário para fazer upload de uma nova música.
     */
    public function createSong()
    {
        // Recupera artistas e álbuns para seleção no formulário
        $artists = Artist::all();
        $albums = Album::all(); // Se desejar associar a música a um álbum (opcional)
        $genres = Genre::all();
        return view('manager.songs.create_song', compact('artists', 'albums', 'genres'));
    }

    /**
     * Processa o upload da nova música.
     */
    public function storeSong(Request $request)
    {
        // Validação dos dados da música
        $validated = $request->validate([
            'artist_id'     => 'required|exists:artists,id',
            'album_id'      => 'nullable|exists:albums,id',
            'title'         => 'required|string|max:255',
            'genre_id'      => 'required|exists:genres,id', // Validação para garantir que o genre_id seja válido,
            'cover_image'   => 'nullable|image|max:2048',
            'duration'      => 'required|string|max:10', // duração da música, ex: "03:45"
            'song_file'     => 'required|file|mimes:mp3,wav,ogg|max:10240', // arquivo de até 10MB
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

    // Método para exibir o formulário de edição
    public function editSong(Song $song)
    {
        // Recupera todos os artistas, álbuns e gêneros
        $artists = Artist::all();
        $albums = Album::all();
        $genres = Genre::all();

        // Retorna a view de edição com os dados da música e as opções
        return view('admin.songs.edit', compact('song', 'artists', 'albums', 'genres'));
    }

    // Método para atualizar a música
    public function updateSong(Request $request, Song $song)
    {
        // Valida os dados do formulário
        $request->validate([
            'title' => 'required|string|max:255',
            'artist_id' => 'required|exists:artists,id',
            'album_id' => 'nullable|exists:albums,id',
            'genre_id' => 'required|string|max:255',
            'duration' => 'nullable|date_format:H:i:s',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'file_url' => 'nullable|file|mimes:mp3,ogg,wav|max:20480',
        ]);

        // Manipula o upload da nova capa, caso tenha sido enviada
        if ($request->hasFile('cover_image')) {
            // Apaga a capa anterior, se existir
            if ($song->cover_image) {
                Storage::delete($song->cover_image);
            }
            $song->cover_image = $request->file('cover_image')->store('public/song_covers');
        }

        // Manipula o upload do novo arquivo de música, caso tenha sido enviado
        if ($request->hasFile('file_url')) {
            // Apaga o arquivo anterior, se existir
            Storage::delete($song->file_url);
            $song->file_url = $request->file('file_url')->store('public/songs');
        }

        // Atualiza os dados da música no banco de dados
        $song->update([
            'title' => $request->title,
            'artist_id' => $request->artist_id,
            'album_id' => $request->album_id,
            'genre_id' => $request->genre,
            'duration' => $request->duration,
        ]);

        // Redireciona para a lista de músicas com uma mensagem de sucesso
        return redirect()->route('admin.songs.index')->with('success', 'Música atualizada com sucesso!');
    }

    // Método para excluir uma música
    public function destroySong(Song $song)
    {
        // Apaga a capa e o arquivo da música do storage, se existirem
        if ($song->cover_image) {
            Storage::delete($song->cover_image);
        }
        Storage::delete($song->file_url);

        // Deleta a música do banco de dados
        $song->delete();

        // Redireciona para a lista de músicas com uma mensagem de sucesso
        return redirect()->route('admin.songs.index')->with('success', 'Música excluída com sucesso!');
    }



    // Views Albums
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
