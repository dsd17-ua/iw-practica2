@extends('layouts.app')

@section('title', 'Dashboard socio')

@section('content')
<div class="flex min-h-screen items-center justify-center bg-gray-100 px-4">
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="rounded-lg bg-blue-600 px-6 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700" type="submit">
            Cerrar sesion
        </button>
    </form>
</div>
@endsection
