{{--
 * [POR CONFIRMAR] - resources/views/webmaster/actividades/index.blade.php
--}}
@extends('layouts.app')
@section('header')
    @include('partials.private-header')
@endsection

@section('content')
<div class="min-h-screen bg-gray-50" style="padding-top: 3rem;">
    @if(session('success'))
        <script>alert("{{ session('success') }}");</script>
    @endif
    @if(session('error'))
        <script>alert("{{ session('error') }}");</script>
    @endif

    <div class="mx-auto flex w-full max-w-full gap-6 px-1 py-6 md:px-2">
        <!-- Sidebar -->
        <aside class="w-full max-w-xs rounded-xl border border-gray-200 bg-white p-4 shadow-sm">
            <nav class="space-y-2 text-sm text-gray-700">
                <a href="{{ route('webmaster.dashboard') }}" class="flex w-full items-center gap-3 rounded-lg px-3 py-2 hover:bg-gray-100">
                    <span class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-gray-100 text-gray-700">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="3" y="3" width="7" height="7" rx="1" stroke="currentColor" stroke-width="2"/>
                            <rect x="14" y="3" width="7" height="7" rx="1" stroke="currentColor" stroke-width="2"/>
                            <rect x="3" y="14" width="7" height="7" rx="1" stroke="currentColor" stroke-width="2"/>
                            <rect x="14" y="14" width="7" height="7" rx="1" stroke="currentColor" stroke-width="2"/>
                        </svg>
                    </span>
                    Dashboard
                </a>
                <a href="{{ route('webmaster.solicitudes') }}" class="flex w-full items-center gap-3 rounded-lg px-3 py-2 hover:bg-gray-100">
                    <span class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-gray-100 text-gray-700">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 12h6M9 16h6M17 21H7a2 2 0 01-2-2V5a2 2 0 012-2h10a2 2 0 012 2v14a2 2 0 01-2 2z" stroke="currentColor" stroke-width="2"/>
                        </svg>
                    </span>
                    Solicitudes
                </a>
                <a href="{{ route('webmaster.socios') }}" class="flex w-full items-center gap-3 rounded-lg px-3 py-2 hover:bg-gray-100">
                    <span class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-gray-100 text-gray-700">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="8" cy="8" r="3" stroke="currentColor" stroke-width="2"/>
                            <path d="M2 20a6 6 0 0112 0M17 11a2 2 0 100-4 2 2 0 000 4zM15 20a4 4 0 017 0" stroke="currentColor" stroke-width="2"/>
                        </svg>
                    </span>
                    Socios
                </a>
                <a href="{{ route('webmaster.actividades') }}" class="flex w-full items-center gap-3 rounded-lg bg-blue-50 px-3 py-2 text-blue-700">
                    <span class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-blue-100 text-blue-700">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M13 2L3 14h8l-1 8 10-12h-8l1-8z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                        </svg>
                    </span>
                    Actividades
                </a>
                <a href="{{ route('webmaster.clases') }}" class="flex w-full items-center gap-3 rounded-lg px-3 py-2 hover:bg-gray-100">
                    <span class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-gray-100 text-gray-700">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="3" y="4" width="18" height="17" rx="2" stroke="currentColor" stroke-width="2"/>
                            <path d="M8 2v4M16 2v4M3 10h18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </span>
                    Clases
                </a>
                <a href="{{ route('webmaster.informes.instalaciones') }}" class="flex w-full items-center gap-3 rounded-lg px-3 py-2 hover:bg-gray-100">
                    <span class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-gray-100 text-gray-700">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M3 3v16a2 2 0 002 2h16" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            <path d="M7 16l4-8 4 4 4-12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </span>
                    Informes
                </a>
            </nav>
        </aside>

        <!-- Contenido -->
        <div class="flex-1 space-y-6" style="padding-top: 1rem;">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900">Gestión de Actividades</h1>
                    <p class="mt-2 text-sm text-gray-600">Administra las actividades del gimnasio</p>
                </div>
                <a href="{{ route('webmaster.actividades.crear') }}" class="rounded-lg bg-blue-600 px-6 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-700">
                    Nueva Actividad
                </a>
            </div>

            @if($actividades->count() > 0)
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                    @foreach($actividades as $actividad)
                        <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
                            @if($actividad->imagen_url)
                                <img src="{{ $actividad->imagen_url }}" alt="{{ $actividad->nombre }}" class="h-40 w-full rounded-lg object-cover mb-4">
                            @else
                                <div class="h-40 w-full rounded-lg bg-gray-200 mb-4 flex items-center justify-center">
                                    <svg class="h-12 w-12 text-gray-400" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M13 2L3 14h8l-1 8 10-12h-8l1-8z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                            @endif
                            <h3 class="text-lg font-semibold text-gray-900">{{ $actividad->nombre }}</h3>
                            <p class="mt-2 text-sm text-gray-600 line-clamp-2">{{ $actividad->descripcion ?? 'Sin descripción' }}</p>
                            <div class="mt-4 flex gap-2">
                                <a href="{{ route('webmaster.actividades.editar', $actividad->id) }}" class="flex-1 rounded-lg border border-gray-300 px-4 py-2 text-center text-sm font-semibold text-gray-700 hover:bg-gray-50">
                                    Editar
                                </a>
                                <form method="POST" action="{{ route('webmaster.actividades.eliminar', $actividad->id) }}" class="flex-1">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('¿Eliminar esta actividad?')" class="w-full rounded-lg bg-red-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-700">
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-6">
                    {{ $actividades->links() }}
                </div>
            @else
                <div class="rounded-2xl border border-gray-200 bg-white p-12 text-center shadow-sm">
                    <svg class="mx-auto h-12 w-12 text-gray-400" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M13 2L3 14h8l-1 8 10-12h-8l1-8z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                    </svg>
                    <p class="mt-4 text-sm font-medium text-gray-900">No hay actividades registradas</p>
                    <a href="{{ route('webmaster.actividades.crear') }}" class="mt-4 inline-block text-sm font-medium text-blue-600 hover:text-blue-700">
                        Crear primera actividad →
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
