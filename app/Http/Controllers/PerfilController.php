<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    public function __construct()
    {
        // Protegiendo ruta editar-perfil. Redireccionamos a usuarios no autenticados
        $this->middleware('auth');
    }

    public function index()
    {
        return view('perfil.index');
    }

    public function store(Request $request)
    {
        // Modificar el request
        $request->request->add(['username' => Str::slug($request->username)]);

        $rules = [
            'username' => [
                'required', 'unique:users,username,' . auth()->user()->id, 'min:3', 'max:20',
                'not_in:twitter,editar-perfil'
            ],
            'email' => [
                'required', 'email', 'max:60',
                'unique:users,email,' . auth()->user()->id,
            ]
        ];

        // Agregar reglas para la contraseña si se proporciona una nueva
        if ($request->filled('password')) {
            $rules['password'] = ['required', 'min:8', 'confirmed'];
        }

        $this->validate($request, $rules);

        if ($request->imagen) {
            $imagen = $request->file('imagen');
            $nombreImagen = Str::uuid() . "." . $imagen->extension();
            $imagenServidor = Image::make($imagen);
            $imagenServidor->fit(1000, 1000);
            $imagenPath = public_path('perfiles') . '/' . $nombreImagen;
            $imagenServidor->save($imagenPath);
        }

        // Guardar cambios
        $usuario = User::find(auth()->user()->id);
        $usuario->username = $request->username;
        $usuario->email = $request->email;

        // Actualizar la contraseña solo si se proporciona una nueva
        if ($request->filled('password')) {
            $usuario->password = bcrypt($request->password);
        }

        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? null;
        $usuario->save();

        // Redireccionar
        return redirect()->route('posts.index', $usuario->username);
    }
}
