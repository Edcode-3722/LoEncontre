<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    // Definir la constante a nivel de clase
    const ELEMENTS_BY_PAGE = 20;

    public function __construct()
    {
        // Para proteger la ruta y el controlador
        $this->middleware('auth')->except(['show', 'index']);
    }

    public function index(User $user)
    {
        $posts = Post::where('user_id', $user->id)->latest()->paginate(self::ELEMENTS_BY_PAGE);

        // Informamos la url previa para poder volver a ella fácilmente incluso tras interacturar en la publicación
        session(['previous_url' => url()->current()]);

        return view('dashboard', [
            'user' => $user,
            'posts' => $posts
        ]);
    }

    // Método que renderiza vista del formulario (GET)
    public function create()
    {
        return view('posts.create');
    }

    // Método que almacena en db
    public function store(Request $request)
    {
        $this->validate($request, [
            'titulo' => 'required|max:255',
            'descripcion' => 'required',
            'imagen' => 'required'
        ]);

        Post::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id
        ]);

        // Otra forma 1
        /*  $post = new Post;;
        $post->titulo = $request->titulo;
        $post->descripcion = $request->descripcion;
        $post->imagen = $request->imagen;
        $post->user_id = auth()->user()->id;
        $post->save(); */

        // Otra forma 2
        /*  $request->user()->posts()->create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => $request->user_id
        ]); */


        return redirect(route('posts.index', auth()->user()->username));
    }

    public function  show(User $user, Post $post)
    {
        return view('posts.show', [
            'post' => $post,
            'user' => $user
        ]);
    }

    public function destroy(Post $post)
    {
        // Comprueba mediante el método delete del Policy
        $this->authorize('delete', $post);
        $post->delete();

        // Eliminar la imagen
        $imagenPath = public_path('uploads/' . $post->imagen);
        if (File::exists($imagenPath)) {
            unlink($imagenPath);
        }

        return redirect()->route('posts.index', auth()->user()->username);
    }
}
