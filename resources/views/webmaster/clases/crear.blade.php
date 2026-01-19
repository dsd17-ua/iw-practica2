{{--
 * [POR CONFIRMAR] - resources/views/webmaster/clases/crear.blade.php
--}}
@extends('layouts.app')
@section('header')
    @include('partials.private-header')
@endsection

@section('content')
<div class="min-h-screen bg-gray-50" style="padding-top: 3rem;">
    @if($errors->any())
        <script>alert("{{ $errors->first() }}");</script>
    @endif

    <div class="mx-auto flex w-full max-w-full gap-6 px-1 py-6 md:px-2">
        <!-- Sidebar -->
        <aside class="w-full max-w-xs rounded-xl border border-gray-200 bg-white p-4 shadow-sm">
            <nav class="space-y-2 text-sm text-gray-700">
                <a href="{{ route('webmaster.dashboard') }}" class="flex w-full items-center gap-3 rounded-lg px-3 py-2 hover:bg-gray-100">
                    <span class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-gray-100 text-gray-700">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none"><rect x="3" y="3" width="7" height="7" rx="1" stroke="currentColor" stroke-width="2"/><rect x="14" y="3" width="7" height="7" rx="1" stroke="currentColor" stroke-width="2"/><rect x="3" y="14" width="7" height="7" rx="1" stroke="currentColor" stroke-width="2"/><rect x="14" y="14" width="7" height="7" rx="1" stroke="currentColor" stroke-width="2"/></svg>
                    </span>
                    Dashboard
                </a>
                <a href="{{ route('webmaster.clases') }}" class="flex w-full items-center gap-3 rounded-lg bg-blue-50 px-3 py-2 text-blue-700">
                    <span class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-blue-100 text-blue-700">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none"><rect x="3" y="4" width="18" height="17" rx="2" stroke="currentColor" stroke-width="2"/><path d="M8 2v4M16 2v4M3 10h18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                    </span>
                    Clases
                </a>
            </nav>
        </aside>

        <!-- Contenido -->
        <div class="flex-1" style="padding-top: 1rem;">
            <div class="mb-6">
                <h1 class="text-2xl font-semibold text-gray-900">Nueva Clase</h1>
                <p class="mt-2 text-sm text-gray-600">Programa una nueva clase para el gimnasio</p>
            </div>

            <div class="max-w-3xl rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
                <form method="POST" action="{{ route('webmaster.clases.guardar') }}" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Actividad</label>
                            <select name="actividad_id" required class="mt-2 w-full rounded-lg border border-gray-300 px-4 py-2 text-sm text-gray-700 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                                <option value="">Seleccionar actividad</option>
                                @foreach($actividades as $act)
                                    <option value="{{ $act->id }}">{{ $act->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Sala</label>
                            <select name="sala_id" required class="mt-2 w-full rounded-lg border border-gray-300 px-4 py-2 text-sm text-gray-700 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                                <option value="">Seleccionar sala</option>
                                @foreach($salas as $sala)
                                    <option value="{{ $sala->id }}">{{ $sala->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Monitor</label>
                            <select name="monitor_id" required class="mt-2 w-full rounded-lg border border-gray-300 px-4 py-2 text-sm text-gray-700 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                                <option value="">Seleccionar monitor</option>
                                @foreach($monitores as $mon)
                                    <option value="{{ $mon->id }}">{{ $mon->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Plazas Totales</label>
                            <input type="number" name="plazas_totales" min="1" required class="mt-2 w-full rounded-lg border border-gray-300 px-4 py-2 text-sm text-gray-700 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Fecha y Hora de Inicio</label>
                            <input type="datetime-local" name="fecha_inicio" required class="mt-2 w-full rounded-lg border border-gray-300 px-4 py-2 text-sm text-gray-700 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Fecha y Hora de Fin</label>
                            <input type="datetime-local" name="fecha_fin" required class="mt-2 w-full rounded-lg border border-gray-300 px-4 py-2 text-sm text-gray-700 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Coste Extra (€)</label>
                            <input type="number" name="coste_extra" min="0" step="0.01" value="0" required class="mt-2 w-full rounded-lg border border-gray-300 px-4 py-2 text-sm text-gray-700 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tipo de Programación</label>
                            <select name="tipo_programacion" id="tipo_programacion" required class="mt-2 w-full rounded-lg border border-gray-300 px-4 py-2 text-sm text-gray-700 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                                <option value="puntual">Puntual (una sola clase)</option>
                                <option value="periodica">Periódica (repetir clase)</option>
                            </select>
                        </div>
                    </div>

                    <div id="periodica_options" style="display: none;" class="space-y-4 rounded-lg border border-blue-200 bg-blue-50 p-4">
                        <p class="text-sm font-medium text-blue-900">Opciones de Clase Periódica</p>
                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Frecuencia</label>
                                <select name="frecuencia" class="mt-2 w-full rounded-lg border border-gray-300 px-4 py-2 text-sm text-gray-700 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                                    <option value="diaria">Diaria</option>
                                    <option value="semanal">Semanal</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Número de Repeticiones</label>
                                <input type="number" name="repeticiones" min="1" max="52" value="4" class="mt-2 w-full rounded-lg border border-gray-300 px-4 py-2 text-sm text-gray-700 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                            </div>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <button type="submit" class="rounded-lg bg-blue-600 px-6 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-700">
                            Crear Clase
                        </button>
                        <a href="{{ route('webmaster.clases') }}" class="rounded-lg border border-gray-300 px-6 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('tipo_programacion').addEventListener('change', function() {
    const periodicaOptions = document.getElementById('periodica_options');
    if (this.value === 'periodica') {
        periodicaOptions.style.display = 'block';
    } else {
        periodicaOptions.style.display = 'none';
    }
});
</script>
@endsection
