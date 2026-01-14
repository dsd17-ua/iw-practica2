@extends('layouts.app')

@section('title', 'Histórico - Monitor')

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
            <a href="{{ route('monitor.actividades') }}" class="block rounded-lg bg-white px-4 py-3 font-medium text-gray-600 hover:bg-gray-50 hover:text-green-600 shadow-sm">
                💪 Mis Actividades
            </a>
            <a href="{{ route('monitor.historico') }}" class="block rounded-lg bg-green-100 px-4 py-3 font-semibold text-green-800 border-l-4 border-green-600">
                📜 Histórico
            </a>
        </aside>

        <main class="flex-1">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Histórico de Clases Impartidas</h2>

            <div class="grid gap-4">
                @forelse ($clases as $clase)
                    <button 
                        onclick="abrirModal(
                            '{{ $clase->actividad_nombre }}', 
                            '{{ \Carbon\Carbon::parse($clase->fecha_inicio)->translatedFormat('l d F Y') }}',
                            '{{ \Carbon\Carbon::parse($clase->fecha_inicio)->format('H:i') }} - {{ \Carbon\Carbon::parse($clase->fecha_fin)->format('H:i') }}', 
                            '{{ $clase->sala_nombre }}',
                            {{ json_encode($clase->participantes) }} 
                        )"
                        class="w-full text-left flex items-center justify-between rounded-xl bg-white p-5 shadow-sm border border-gray-100 hover:shadow-md hover:border-green-300 transition group"
                    >
                        <div>
                            <h3 class="font-bold text-gray-900 group-hover:text-green-700 transition">{{ $clase->actividad_nombre }}</h3>
                            <div class="flex gap-6 text-sm text-gray-500 mt-1">
                                <span class="flex items-center gap-1">
                                    📅 {{ \Carbon\Carbon::parse($clase->fecha_inicio)->translatedFormat('d F Y') }}
                                </span>
                                <span class="flex items-center gap-1">
                                    ⏰ {{ \Carbon\Carbon::parse($clase->fecha_inicio)->format('H:i') }} - {{ \Carbon\Carbon::parse($clase->fecha_fin)->format('H:i') }}
                                </span>
                            </div>
                        </div>
                        <div class="text-right flex items-center gap-4">
                            <span class="text-xs text-gray-400 font-medium">
                                {{ count($clase->participantes) }} Asistentes
                            </span>
                            <span class="inline-block rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-500 border border-gray-200 group-hover:bg-green-50 group-hover:text-green-600 transition">
                                Ver Detalles &rarr;
                            </span>
                        </div>
                    </button>
                @empty
                    <div class="p-8 text-center bg-white rounded-xl shadow-sm border border-gray-200">
                        <p class="text-gray-500">No hay clases en el historial.</p>
                    </div>
                @endforelse
            </div>
        </main>
    </div>
</div>

<div id="modalHistorico" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" onclick="cerrarModal()"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-blue-100 sm:mx-0 sm:h-10 sm:w-10">
                        <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-titulo">
                            Resumen de la Clase
                        </h3>
                        
                        <div class="mt-4 bg-gray-50 p-3 rounded-lg border border-gray-100">
                            <p class="text-lg font-bold text-gray-800" id="modal-actividad">--</p>
                            <p class="text-sm text-gray-600" id="modal-fecha-hora">--</p>
                            <p class="text-sm text-gray-500" id="modal-sala">--</p>
                        </div>

                        <h4 class="mt-4 font-bold text-sm text-gray-500 uppercase tracking-wide">Lista de Asistentes</h4>
                        <div class="mt-2 max-h-48 overflow-y-auto border-t border-gray-100 pt-2" id="lista-participantes">
                            </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" class="w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm" onclick="cerrarModal()">
                    Cerrar
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function abrirModal(actividad, fecha, hora, sala, participantes) {
        // 1. Rellenar datos básicos
        document.getElementById('modal-actividad').innerText = actividad;
        document.getElementById('modal-fecha-hora').innerText = fecha + ' | ' + hora;
        document.getElementById('modal-sala').innerText = sala;
        
        // 2. Generar lista de participantes
        const listaDiv = document.getElementById('lista-participantes');
        
        if (participantes.length > 0) {
            let html = '<ul class="divide-y divide-gray-100">';
            participantes.forEach(user => {
                html += `
                    <li class="py-2 flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="bg-green-100 text-green-700 h-6 w-6 rounded-full flex items-center justify-center text-xs font-bold mr-2">
                                ${user.nombre.charAt(0)}
                            </div>
                            <span class="text-sm font-medium text-gray-700">${user.nombre}</span>
                        </div>
                        <span class="text-xs text-gray-400">${user.email}</span>
                    </li>
                `;
            });
            html += '</ul>';
            listaDiv.innerHTML = html;
        } else {
            listaDiv.innerHTML = '<p class="text-sm text-gray-400 italic py-2">No hubo asistentes en esta clase.</p>';
        }

        // 3. Mostrar modal
        document.getElementById('modalHistorico').classList.remove('hidden');
    }

    function cerrarModal() {
        document.getElementById('modalHistorico').classList.add('hidden');
    }
</script>
@endsection