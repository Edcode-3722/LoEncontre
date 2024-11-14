@extends('layouts.app')

@section('titulo')
    Regístrate en LoEncontre
@endsection

@section('contenido')
    <div class="md:flex md:justify-center md:gap-10 md:items-center">
        <div class="md:w-6/12 bg-white p-3 rounded-md shadow-md">
            <img class="rounded-sm" src="https://www.veracruz.tecnm.mx/templates/g5_hydrogen/custom/images/Imagenes/A2020/web2020/LOGO%20TECNM%20CON%20R.png" alt="Imagen login usuarios" />
        </div>

        <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-xl">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                @if ($errors->has('login'))
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{ $errors->first('login') }}
                    </p>
                @endif
                <div class="mb-5">
                    <input id="email" name="email" type="email" placeholder="Email"
                        class="border p-3 w-full rounded-lg @if ($errors->has('login') || $errors->has('email')) border-red-500 @endif"
                        value="{{ old('email') }}" />
                    @if ($errors->has('email'))
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{ $errors->first('email') }}
                        </p>
                    @endif
                </div>
                <div class="mb-5">
                    <input id="password" name="password" type="password" placeholder="Contraseña"
                        class="border p-3 w-full rounded-lg @if ($errors->has('login') || $errors->has('password')) border-red-500 @endif" />
                    @if ($errors->has('password'))
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{ $errors->first('password') }}
                        </p>
                    @endif
                </div>

                <div class="mb-5">
                    <input type="checkbox" id="remember" name="remember"><label for="remember"
                        class="text-gray-500 text-sm">
                        Mantener mi sesión abierta
                    </label>
                </div>

                <input type="submit" value="Iniciar sesión"
                    class="bg-sky-600 hover:bg-sky-700 cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg" />
            </form>
        </div>
    </div>
@endsection
