@extends('layouts.app')

@section('title', 'Iniciar sesion')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-blue-900 via-blue-700 to-blue-600 px-4 py-12">
    <div class="mx-auto flex min-h-screen max-w-md items-center justify-center">
        <div class="w-full rounded-2xl bg-white px-8 py-10 shadow-xl">
            <div class="flex flex-col items-center text-center">
                <span class="mb-4 inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-100 text-blue-600">
                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" aria-hidden="true" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6 10h12M4 10v4M20 10v4M8 14h8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span>
                <p class="text-sm font-semibold text-gray-900">FitZone Gym</p>
                <h1 class="mt-3 text-base font-semibold text-gray-900">Inicio de sesion</h1>
                <p class="text-sm text-gray-500">Accede a tu area de socio</p>
            </div>

            <form class="mt-6 space-y-5" method="POST" action="{{ route('login.attempt') }}">
                @csrf
                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-700" for="email">Email</label>
                    <div class="relative">
                        <input class="w-full rounded-lg border border-gray-300 px-4 py-2 pr-10 text-sm focus:border-blue-600 focus:ring-2 focus:ring-blue-600" id="email" name="email" type="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        <span class="pointer-events-none absolute inset-y-1 right-2 flex items-center justify-center rounded-md bg-indigo-600 px-2 text-xs font-semibold text-white">t</span>
                    </div>
                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-700" for="password">Contrasena</label>
                    <input class="w-full rounded-lg border border-gray-300 px-4 py-2 text-sm focus:border-blue-600 focus:ring-2 focus:ring-blue-600" id="password" name="password" type="password" required autocomplete="current-password">
                    @error('password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <button class="w-full rounded-lg bg-blue-600 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700" type="submit">
                    Iniciar sesion
                </button>
            </form>

            <div class="mt-4 text-center text-sm">
                <a class="font-medium text-blue-600 transition hover:text-blue-700" href="#">Has olvidado tu contrasena?</a>
            </div>

            <div class="mt-6 border-t border-gray-200 pt-4 text-center text-xs text-gray-500">
                <a class="text-gray-500 transition hover:text-gray-700" href="/">&#8592; Volver a seleccion de perfiles</a>
                <p class="mt-2">Demo: pepe@socio.com / 1234</p>
            </div>
        </div>
    </div>
</div>
@endsection
