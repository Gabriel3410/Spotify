<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $totalUsuarios = User::count();

        return view('admin.dashboard', compact('totalUsuarios'));
    }

    public function tornarAdmin($id)
    {
        $user = User::findOrFail($id);
        $user->is_admin = !$user->is_admin; // Alterna entre admin e não admin
        $user->save();

        return redirect()->route('admin.dashboard')->with('success', 'Status de administrador atualizado!');
    }
}
