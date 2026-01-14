@extends('layouts.app')

@section('title', 'Histórico - Monitor')

@section('content')
<div class="min-h-screen bg-gray-50 pb-12">
    <div class="bg-green-600 px-6 py-4 text-white shadow-md">
        <div class="mx-auto flex max-w-7xl items-center justify-between">
            <h1 class="text-xl font-bold flex items-center gap-2">
                FitZone Gym - Monitor
            </h1>
            
            <div class="flex items-center gap-4">
                <span class="text-sm font-medium">Hola, {{ Auth::user()->nombre }}</span>
                
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center gap-1 text-sm bg-green-700 hover:bg-green-800 text-white px-3 py-1 rounded transition border border-green-500">
                        <span>Salir</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="mx-auto max-w-7xl px-4 mt-6 flex gap-6">
        <aside class="w-64 flex-shrink-0 space-y-2">
            <a href="{{ route('monitor.dashboard') }}" class="block rounded-lg bg-white px-4 py-3 font-medium text-gray-600 hover:bg-gray-50 hover:text-green-600 shadow-sm">
                📅 Mi Calendario
            </a>
            <a href="{{ route('monitor.actividades') }}" class="block rounded-lg bg-white px-4 py-3 font-medium text-gray-600 hover:bg-gray-50 hover:text-green-600 shadow-sm">
                💪 Mis Actividades
            </a>
            <a href="{{ route('monitor.historico') }}" class="block rounded-lg bg-green-100 px-4 py-3 font-semibold text-green-800 border-l-4 border-green-600">
                📜 Histórico
            </a>
        </aside>

        <main class="flex-1">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Histórico de Clases Impartidas</h2>

            <div class="grid gap-4 opacity-75">
                @forelse ($clases as $clase)
                    <div class="flex items-center justify-between rounded-xl bg-white p-5 shadow-sm border border-gray-100">
                        <div>
                            <h3 class="font-bold text-gray-900">{{ $clase->actividad_nombre }}</h3>
                            <div class="flex gap-4 text-sm text-gray-500 mt-1">
                                <span class="flex items-center gap-1">
                                    📅 {{ \Carbon\Carbon::parse($clase->fecha_inicio)->format('d/m/Y') }}
                                </span>
                                <span class="flex items-center gap-1">
                                    ⏰ {{ \Carbon\Carbon::parse($clase->fecha_inicio)->format('H:i') }} - {{ \Carbon\Carbon::parse($clase->fecha_fin)->format('H:i') }}
                                </span>
                                <span class="flex items-center gap-1">
                                    📍 {{ $clase->sala_nombre }}
                                </span>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="inline-block rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-500">
                                Finalizada
                            </span>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500">No hay clases en el historial.</p>
                @endforelse
            </div>
        </main>
    </div>
</div>
@endsection