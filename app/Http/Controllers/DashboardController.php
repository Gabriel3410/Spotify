<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\Song;
use App\Models\UserPreference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $preferences = UserPreference::where('user_id', $user->id)->first();

        if (!$preferences || !$preferences->genres) {
            return redirect()->route('choose.genres')->with('error', 'Por favor, selecione seus gêneros musicais primeiro.');
        }

        // Decodifica as preferências do usuário (nomes dos gêneros)
        $preferredGenres = json_decode($preferences->genres);

        // Busca artistas com gêneros que batem com as preferências do usuário
        $artists = Artist::with(['songs', 'genre'])
            ->whereHas('genre', function ($query) use ($preferredGenres) {
                $query->whereIn('name', $preferredGenres);
            })->get();

        // Verifica se veio algum artista com músicas
        $hasContent = $artists->isNotEmpty() && $artists->some(fn($artist) => $artist->songs->isNotEmpty());

        return view('dashboard', compact('artists', 'hasContent'));
    }
}
