@extends('layouts.app')

@section('title', 'Mis Actividades - Monitor')

@section('content')
<div class="min-h-screen bg-gray-50 pb-12">
    
    <div class="bg-green-600 shadow-md">
        <div class="flex w-full items-center justify-between px-6 py-4 text-white">
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

    <div class="flex w-full gap-6 px-6 mt-6">
        
        <aside class="w-64 flex-shrink-0 space-y-2 hidden md:block">
            <a href="{{ route('monitor.dashboard') }}" class="block rounded-lg bg-white px-4 py-3 font-medium text-gray-600 hover:bg-gray-50 hover:text-green-600 shadow-sm">
                📅 Mi Calendario
            </a>
            <a href="{{ route('monitor.actividades') }}" class="block rounded-lg bg-green-100 px-4 py-3 font-semibold text-green-800 border-l-4 border-green-600">
                💪 Mis Actividades
            </a>
            <a href="{{ route('monitor.historico') }}" class="block rounded-lg bg-white px-4 py-3 font-medium text-gray-600 hover:bg-gray-50 hover:text-green-600 shadow-sm">
                📜 Histórico
            </a>
        </aside>

        @php
            $esClasePasada = false;
            if($claseSeleccionada) {
                $esClasePasada = \Carbon\Carbon::parse($claseSeleccionada->fecha_fin)->isPast();
            }
        @endphp

        <main class="flex-1 flex gap-6">
            
            <div class="flex-1 space-y-4 transition-opacity duration-300 {{ $esClasePasada ? 'opacity-40 grayscale pointer-events-none' : '' }}">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-2xl font-bold text-gray-800">Próximas Clases</h2>
                    @if($esClasePasada)
                        <span class="text-xs font-bold text-orange-600 bg-orange-100 px-2 py-1 rounded">Viendo Histórico</span>
                    @endif
                </div>
                
                @forelse ($clases as $clase)
                    <a href="{{ route('monitor.actividades', ['clase_id' => $clase->id]) }}" 
                       class="block rounded-xl border border-gray-200 bg-white p-5 shadow-sm transition hover:border-green-400 hover:shadow-md 
                       {{ (request('clase_id') == $clase->id) ? 'ring-2 ring-green-500 border-green-500' : '' }}">
                        
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <h3 class="font-bold text-gray-900">{{ $clase->actividad_nombre }}</h3>
                                <p class="text-sm text-green-600 font-medium">{{ $clase->sala_nombre }}</p>
                            </div>
                            <span class="text-xs font-bold bg-gray-100 text-gray-600 px-2 py-1 rounded capitalize">
                                {{ \Carbon\Carbon::parse($clase->fecha_inicio)->translatedFormat('d M - H:i') }}
                            </span>
                        </div>

                        <div class="mt-4">
                            <div class="flex justify-between text-xs text-gray-500 mb-1">
                                <span>Ocupación</span>
                                <span>{{ $clase->inscritos }}/{{ $clase->plazas_totales }}</span>
                            </div>
                            <div class="h-2 w-full rounded-full bg-gray-100">
                                <div class="h-2 rounded-full bg-green-500" style="width: {{ $clase->porcentaje }}%"></div>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="p-8 text-center bg-white rounded-xl shadow-sm border border-gray-200">
                        <p class="text-gray-500">No tienes clases futuras asignadas.</p>
                    </div>
                @endforelse
                
                @if($esClasePasada)
                    <div class="text-center mt-4">
                        <a href="{{ route('monitor.actividades') }}" class="text-sm text-blue-600 underline pointer-events-auto cursor-pointer font-bold">
                            Volver a la lista actual
                        </a>
                    </div>
                @endif
            </div>

            <div class="w-96">
                @if ($claseSeleccionada)
                    <div class="rounded-xl bg-white p-6 shadow-sm sticky top-6 border {{ $esClasePasada ? 'border-orange-300 ring-4 ring-orange-50' : 'border-gray-200' }}">
                        
                        @if ($esClasePasada)
                            <div class="mb-5 bg-orange-50 border-l-4 border-orange-500 p-3 rounded-r-md">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm text-orange-700 font-bold">
                                            Clase Finalizada
                                        </p>
                                        <p class="text-xs text-orange-600 mt-1">
                                            Estás visualizando datos históricos.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <h3 class="text-lg font-bold text-gray-900 mb-4 border-b pb-2 flex items-center justify-between">
                            Detalles de la Clase
                            @if(!$esClasePasada)
                                <span class="bg-green-100 text-green-800 text-xs px-2 py-0.5 rounded-full">Activa</span>
                            @endif
                        </h3>
                        
                        <div class="space-y-3 mb-6">
                            <div>
                                <span class="block text-xs text-gray-500">Actividad</span>
                                <span class="font-medium text-gray-800 text-lg">{{ $claseSeleccionada->actividad_nombre }}</span>
                            </div>
                            <div>
                                <span class="block text-xs text-gray-500">Horario</span>
                                <span class="font-medium text-gray-800 capitalize">
                                    {{ \Carbon\Carbon::parse($claseSeleccionada->fecha_inicio)->translatedFormat('l d F, H:i') }}
                                </span>
                            </div>
                            <div>
                                <span class="block text-xs text-gray-500">Sala</span>
                                <span class="font-medium text-gray-800">{{ $claseSeleccionada->sala_nombre }}</span>
                            </div>
                        </div>

                        <div class="flex justify-between items-center mb-3">
                            <h4 class="font-semibold text-gray-900 text-sm">Participantes Inscritos</h4>
                            <span class="bg-gray-100 text-gray-600 text-xs font-bold px-2 py-1 rounded-full">
                                {{ count($participantes) }} Total
                            </span>
                        </div>

                        <div class="space-y-2 max-h-96 overflow-y-auto pr-1 custom-scrollbar">
                            @forelse ($participantes as $participante)
                                <div class="flex items-center gap-3 p-2 rounded {{ $esClasePasada ? 'bg-orange-50 border-orange-100' : 'bg-gray-50 border-gray-100' }} border">
                                    <div class="h-8 w-8 rounded-full {{ $esClasePasada ? 'bg-orange-200 text-orange-700' : 'bg-green-100 text-green-700' }} flex items-center justify-center font-bold text-xs">
                                        {{ substr($participante->nombre, 0, 1) }}
                                    </div>
                                    <div class="text-sm">
                                        <div class="font-medium text-gray-900">{{ $participante->nombre }}</div>
                                        <div class="text-xs text-gray-500">{{ $participante->email }}</div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-4 bg-gray-50 rounded-lg border border-dashed border-gray-300">
                                    <p class="text-sm text-gray-500 italic">No hubo asistentes registrados.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                @else
                    <div class="rounded-xl bg-gray-50 border-2 border-dashed border-gray-200 p-12 text-center h-full flex flex-col items-center justify-center text-gray-400 sticky top-6">
                        <svg class="w-12 h-12 mb-2 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                        <p class="text-sm">Selecciona una clase para ver los detalles.</p>
                    </div>
                @endif
            </div>

        </main>
    </div>
</div>
@endsection