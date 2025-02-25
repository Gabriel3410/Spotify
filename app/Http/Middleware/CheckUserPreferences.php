<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Models\UserPreference;

class CheckUserPreferences
{

    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        $preferences = UserPreference::where('user_id', $user->id)->first();

        //verificar se usuário tem preferenmcias salvas
        if (!$preferences || empty($preferences->genres)) {
            return redirect()->route('choose.genres');
        }

        return $next($request);
    }
}
