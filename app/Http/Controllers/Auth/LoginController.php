<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class LoginController extends Controller
{
    public function index()
    {
        if (auth()->check()) {
            return redirect()->route('posts.index', ['user' => auth()->user()->username]);
        }
        return view('auth.login');
    }

    public function store(Request $request)
    {
        // Validaciones
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (!auth()->attempt($request->only('email', 'password'), $request->remember)) {
            return back()
                ->withErrors(['login' => 'Email y/o contraseña incorrectos'])
                ->withInput();
        }

        return redirect()->route('posts.index', [
            'user' => auth()->user()->username
        ]);
    }
}
