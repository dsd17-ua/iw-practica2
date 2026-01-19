{{--
 * [POR CONFIRMAR] - resources/views/webmaster/clases/editar.blade.php
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
                <h1 class="text-2xl font-semibold text-gray-900">Editar Clase</h1>
                <p class="mt-2 text-sm text-gray-600">Modifica los datos de la clase</p>
            </div>

            <div class="max-w-3xl rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
                <form method="POST" action="{{ route('webmaster.clases.actualizar', $clase->id) }}" class="space-y-6">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Actividad</label>
                            <select name="actividad_id" required class="mt-2 w-full rounded-lg border border-gray-300 px-4 py-2 text-sm text-gray-700 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                                @foreach($actividades as $act)
                                    <option value="{{ $act->id }}" {{ $clase->actividad_id == $act->id ? 'selected' : '' }}>{{ $act->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Sala</label>
                            <select name="sala_id" required class="mt-2 w-full rounded-lg border border-gray-300 px-4 py-2 text-sm text-gray-700 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                                @foreach($salas as $sala)
                                    <option value="{{ $sala->id }}" {{ $clase->sala_id == $sala->id ? 'selected' : '' }}>{{ $sala->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Monitor</label>
                            <select name="monitor_id" required class="mt-2 w-full rounded-lg border border-gray-300 px-4 py-2 text-sm text-gray-700 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                                @foreach($monitores as $mon)
                                    <option value="{{ $mon->id }}" {{ $clase->monitor_id == $mon->id ? 'selected' : '' }}>{{ $mon->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Plazas Totales</label>
                            <input type="number" name="plazas_totales" min="1" value="{{ $clase->plazas_totales }}" required class="mt-2 w-full rounded-lg border border-gray-300 px-4 py-2 text-sm text-gray-700 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Fecha y Hora de Inicio</label>
                            <input type="datetime-local" name="fecha_inicio" value="{{ \Carbon\Carbon::parse($clase->fecha_inicio)->format('Y-m-d\TH:i') }}" required class="mt-2 w-full rounded-lg border border-gray-300 px-4 py-2 text-sm text-gray-700 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Fecha y Hora de Fin</label>
                            <input type="datetime-local" name="fecha_fin" value="{{ \Carbon\Carbon::parse($clase->fecha_fin)->format('Y-m-d\TH:i') }}" required class="mt-2 w-full rounded-lg border border-gray-300 px-4 py-2 text-sm text-gray-700 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Coste Extra (€)</label>
                            <input type="number" name="coste_extra" min="0" step="0.01" value="{{ $clase->coste_extra }}" required class="mt-2 w-full rounded-lg border border-gray-300 px-4 py-2 text-sm text-gray-700 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Estado</label>
                            <select name="estado" required class="mt-2 w-full rounded-lg border border-gray-300 px-4 py-2 text-sm text-gray-700 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                                <option value="programada" {{ $clase->estado === 'programada' ? 'selected' : '' }}>Programada</option>
                                <option value="finalizada" {{ $clase->estado === 'finalizada' ? 'selected' : '' }}>Finalizada</option>
                                <option value="cancelada" {{ $clase->estado === 'cancelada' ? 'selected' : '' }}>Cancelada</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <button type="submit" class="rounded-lg bg-blue-600 px-6 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-700">
                            Guardar Cambios
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
@endsection
