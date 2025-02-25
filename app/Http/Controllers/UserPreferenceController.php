<?php

namespace App\Http\Controllers;

use App\Models\UserPreference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserPreferenceController extends Controller
{
    public function index()
    {
        return view('choose-genres');
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        // Valida os gêneros enviados pelo formulário
        $request->validate([
            'genres' => 'required|array',
            'genres.*' => 'string|max:255'
        ]);

        // Salva as preferências do usuário no banco
        UserPreference::updateOrCreate(
            ['user_id' => $user->id],
            ['genres' => json_encode($request->input('genres'))]
        );

        // Redireciona para o dashboard após salvar
        return redirect()->route('dashboard')->with('success', 'Preferências salvas com sucesso!');
    }
}
