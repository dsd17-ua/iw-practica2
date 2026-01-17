@extends('layouts.app')

@section('header')
    @include('partials.private-header')
@endsection

@section('content')
<div class="min-h-screen bg-gray-50" style="padding-top: 3rem;">
    <div class="mx-auto w-full max-w-3xl px-4 py-10">
        <div class="rounded-2xl border border-yellow-200 bg-white p-8 shadow-sm">
            <h1 class="text-2xl font-semibold text-gray-900">Solicitud pendiente</h1>
            <p class="mt-2 text-sm text-gray-600">
                Tu solicitud esta pendiente de revision. Para mas informacion, contacta con un administrador.
            </p>
            <div class="mt-6 flex flex-wrap gap-3">
                <a href="{{ route('contacto') }}" class="rounded-xl bg-yellow-500 px-5 py-2 text-sm font-semibold text-white shadow-sm hover:bg-yellow-600">
                    Contactar con administracion
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="rounded-xl border border-gray-200 px-5 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">
                        Cerrar sesion
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
