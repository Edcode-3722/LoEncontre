<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Definir la constante de paginación
    const ELEMENTS_BY_PAGE = 20;

    public function __construct()
    {
        // Requerimos autenticación para poder ver la página principal
        $this->middleware('auth');
    }

    public function __invoke()
    {
        // Obtener todas las publicaciones en lugar de solo las de los usuarios seguidos
        $posts = Post::latest()->paginate(self::ELEMENTS_BY_PAGE);

        return view('home', [
            'posts' => $posts
        ]);
    }
}
