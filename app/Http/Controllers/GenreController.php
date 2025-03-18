<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::all();
        return view('admin.genres.index', compact('genres'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:genres,name',
        ]);

        Genre::create([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.genres.index')->with('success', 'Gênero cadastrado com sucesso!');
    }

    public function destroy(Genre $genre)
    {
        $genre->delete();
        return redirect()->route('admin.genres.index')->with('success', 'Gênero excluído com sucesso!');
    }
}
