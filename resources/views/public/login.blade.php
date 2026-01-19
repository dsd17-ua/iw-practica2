@extends('layouts.app')

@section('title', 'Iniciar sesion')

@section('content')
<div class="flex min-h-screen items-center justify-center bg-gradient-to-br from-blue-900 to-blue-700 p-4" style="background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 100%);">
    <div class="w-full max-w-xl rounded-lg bg-white p-8 shadow-2xl">
        <div class="mb-8 flex items-center justify-center">
            <span class="inline-flex h-9 w-9 items-center justify-center rounded-full bg-blue-600/10 text-blue-600">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6 10h12M4 10v4M20 10v4M8 14h8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </span>
            <h1 class="text-xl font-semibold text-gray-900">FitZone Gym</h1>
        </div>

        <h2 class="mb-2 text-center text-lg font-semibold text-gray-900">Inicio de Sesion</h2>
        <p class="mb-8 text-center text-gray-600">Accede a tu area personal</p>

        <form class="space-y-6" method="POST" action="{{ route('login.attempt') }}">
            @csrf
            <div>
                <label class="mb-2 block text-gray-700" for="email">Email</label>
                <input
                    class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:border-transparent focus:ring-2 focus:ring-blue-600"
                    id="email"
                    name="email"
                    type="email"
                    value="{{ old('email') }}"
                    placeholder="tu@email.com"
                    required
                    autocomplete="email"
                    autofocus
                >
                @error('email')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="mb-2 block text-gray-700" for="password">Contrasena</label>
                <input
                    class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:border-transparent focus:ring-2 focus:ring-blue-600"
                    id="password"
                    name="password"
                    type="password"
                    placeholder="••••••••"
                    required
                    autocomplete="current-password"
                >
                @error('password')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <button class="w-full rounded-lg bg-blue-600 px-4 py-3 text-white transition-colors hover:bg-blue-700" type="submit">
                Iniciar sesion
            </button>

            <!-- <div class="text-center">
                <button class="text-sm text-blue-600 hover:text-blue-700" type="button">
                    Has olvidado tu contrasena?
                </button>
            </div> -->
        </form>

        <div class="mt-6 border-t border-gray-200 pt-6">
            <a class="block w-full text-center text-sm text-gray-600 hover:text-gray-800" href="{{ route('inicio') }}">
                &#8592; Volver al inicio
            </a>
        </div>
    </div>
</div>
@endsection
