<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function destroy(Request $request)
    {
        $user = Auth::user();

        // Cierra la sesión antes de eliminar
        Auth::logout();

        // Elimina al usuario
        $user->delete();

        // Redirecciona con mensaje
        return redirect('/')->with('success', 'Tu cuenta ha sido eliminada.');
    }
}
