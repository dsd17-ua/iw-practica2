@extends('layouts.app')

@section('title', 'Mi Calendario - Monitor')

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

    <div class="mx-auto max-w-full px-4 mt-6 flex gap-6"> <aside class="w-64 flex-shrink-0 space-y-2 hidden md:block">
            <a href="{{ route('monitor.dashboard') }}" class="block rounded-lg bg-green-100 px-4 py-3 font-semibold text-green-800 border-l-4 border-green-600">
                📅 Mi Calendario
            </a>
            <a href="{{ route('monitor.actividades') }}" class="block rounded-lg bg-white px-4 py-3 font-medium text-gray-600 hover:bg-gray-50 hover:text-green-600 shadow-sm">
                💪 Mis Actividades
            </a>
            <a href="{{ route('monitor.historico') }}" class="block rounded-lg bg-white px-4 py-3 font-medium text-gray-600 hover:bg-gray-50 hover:text-green-600 shadow-sm">
                📜 Histórico
            </a>
        </aside>

        <main class="flex-1 bg-white rounded-xl shadow-sm p-6 border border-gray-200">
            
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center gap-2">
                    <a href="{{ route('monitor.dashboard', ['semana' => 0]) }}" class="px-3 py-1 text-sm border rounded hover:bg-gray-50">Hoy</a>
                    <div class="flex items-center rounded border border-gray-300">
                        <a href="{{ route('monitor.dashboard', ['semana' => $offset - 1]) }}" class="px-3 py-1 hover:bg-gray-100 border-r">‹</a>
                        <a href="{{ route('monitor.dashboard', ['semana' => $offset + 1]) }}" class="px-3 py-1 hover:bg-gray-100">›</a>
                    </div>
                </div>
                <h2 class="text-xl font-semibold text-gray-800">
                    {{ $inicioSemana->translatedFormat('d F') }} – {{ $finSemana->translatedFormat('d F Y') }}
                </h2>
                <div class="text-sm text-gray-500"></div>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full border-collapse table-fixed">
                    <thead>
                        <tr>
                            <th class="w-16 border-b border-r border-gray-200 bg-white sticky left-0 z-10"></th>
                            
                            @foreach ($diasSemana as $dia)
                                <th class="p-2 border-b border-r border-gray-200 min-w-[120px] {{ $dia['es_hoy'] ? 'bg-blue-50' : 'bg-white' }}">
                                    <div class="text-center">
                                        <div class="text-xs font-semibold text-gray-500 uppercase">{{ $dia['nombre'] }}</div>
                                        <div class="text-xl font-bold {{ $dia['es_hoy'] ? 'text-blue-600 rounded-full bg-blue-100 w-8 h-8 flex items-center justify-center mx-auto' : 'text-gray-800' }}">
                                            {{ $dia['fecha'] }}
                                        </div>
                                    </div>
                                </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @for ($hora = 7; $hora <= 21; $hora++)
                            <tr class="h-20"> <td class="text-right pr-2 text-xs text-gray-400 border-b border-r border-gray-100 align-top pt-2 relative">
                                    <span class="-mt-3 block">{{ sprintf('%02d:00', $hora) }}</span>
                                </td>
                                
                                @for ($dia = 1; $dia <= 7; $dia++)
                                    <td class="border-b border-r border-gray-100 relative p-1 transition hover:bg-gray-50">
                                        @if (isset($calendario[$hora][$dia]))
                                            @php $clase = $calendario[$hora][$dia]; @endphp
                                            
                                            <button
                                                onclick="abrirModal('{{ $clase->actividad_nombre }}', '{{ \Carbon\Carbon::parse($clase->fecha_inicio)->format('H:i') }} - {{ \Carbon\Carbon::parse($clase->fecha_fin)->format('H:i') }}', '{{ $clase->sala_nombre }}', '{{ $clase->inscritos_count }}', '{{ $clase->plazas_totales }}', '{{ $clase->id }}')"
                                                class="w-full h-full text-left rounded-md p-2 shadow-sm hover:shadow-md transition group overflow-hidden relative bg-indigo-600 hover:bg-indigo-700"
                                            >
                                                {{-- Título en blanco puro --}}
                                                <div class="text-xs font-bold text-white truncate">
                                                    {{ $clase->actividad_nombre }}
                                                </div>
                                                {{-- Sala en blanco con un poco de transparencia --}}
                                                <div class="text-xs text-indigo-100 mt-0.5 truncate">
                                                    {{ $clase->sala_nombre }}
                                                </div>
                                                {{-- Hora en blanco con más transparencia --}}
                                                <div class="text-[10px] text-indigo-200 mt-1 font-medium">
                                                    {{ \Carbon\Carbon::parse($clase->fecha_inicio)->format('H:i') }} - {{ \Carbon\Carbon::parse($clase->fecha_fin)->format('H:i') }}
                                                </div>
                                            </button>
                                        @endif
                                    </td>
                                @endfor
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>

<div id="modalDetalle" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" onclick="cerrarModal()"></div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">
                        <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-titulo">
                            Detalles de la Clase
                        </h3>
                        <div class="mt-4 space-y-3">
                            <div class="flex justify-between border-b pb-2">
                                <span class="text-gray-500">Actividad:</span>
                                <span class="font-semibold text-gray-800" id="modal-nombre">--</span>
                            </div>
                            <div class="flex justify-between border-b pb-2">
                                <span class="text-gray-500">Horario:</span>
                                <span class="font-semibold text-gray-800" id="modal-hora">--</span>
                            </div>
                            <div class="flex justify-between border-b pb-2">
                                <span class="text-gray-500">Sala:</span>
                                <span class="font-semibold text-gray-800" id="modal-sala">--</span>
                            </div>
                            <div class="flex justify-between pt-2">
                                <span class="text-gray-500">Ocupación:</span>
                                <span class="font-semibold text-blue-600" id="modal-aforo">--</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" onclick="cerrarModal()">
                    Cerrar
                </button>
                <a id="btn-participantes" href="{{ route('monitor.actividades') }}" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm">
                    Ver Participantes
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    // Añadimos 'id' como último parámetro
    function abrirModal(nombre, hora, sala, inscritos, total, id) {
        // 1. Rellenar textos
        document.getElementById('modal-nombre').innerText = nombre;
        document.getElementById('modal-hora').innerText = hora;
        document.getElementById('modal-sala').innerText = sala;
        document.getElementById('modal-aforo').innerText = inscritos + ' / ' + total + ' personas';
        
        // 2. Actualizar el enlace del botón "Ver Participantes"
        // Cogemos la ruta base (ej: /monitor/actividades) y le pegamos el ?clase_id=5
        let rutaBase = "{{ route('monitor.actividades') }}";
        document.getElementById('btn-participantes').href = rutaBase + '?clase_id=' + id;

        // 3. Mostrar el modal
        document.getElementById('modalDetalle').classList.remove('hidden');
    }

    function cerrarModal() {
        document.getElementById('modalDetalle').classList.add('hidden');
    }
</script>

@endsection