{{--
 * [POR CONFIRMAR] - resources/views/webmaster/informes/instalaciones.blade.php
--}}
@extends('layouts.app')
@section('header')
    @include('partials.private-header')
@endsection

@section('content')
<div class="min-h-screen bg-gray-50" style="padding-top: 3rem;">
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
                <a href="{{ route('webmaster.solicitudes') }}" class="flex w-full items-center gap-3 rounded-lg px-3 py-2 hover:bg-gray-100">
                    <span class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-gray-100 text-gray-700">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none"><path d="M9 12h6M9 16h6M17 21H7a2 2 0 01-2-2V5a2 2 0 012-2h10a2 2 0 012 2v14a2 2 0 01-2 2z" stroke="currentColor" stroke-width="2"/></svg>
                    </span>
                    Solicitudes
                </a>
                <a href="{{ route('webmaster.socios') }}" class="flex w-full items-center gap-3 rounded-lg px-3 py-2 hover:bg-gray-100">
                    <span class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-gray-100 text-gray-700">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none"><circle cx="8" cy="8" r="3" stroke="currentColor" stroke-width="2"/><path d="M2 20a6 6 0 0112 0M17 11a2 2 0 100-4 2 2 0 000 4zM15 20a4 4 0 017 0" stroke="currentColor" stroke-width="2"/></svg>
                    </span>
                    Socios
                </a>
                <a href="{{ route('webmaster.actividades') }}" class="flex w-full items-center gap-3 rounded-lg px-3 py-2 hover:bg-gray-100">
                    <span class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-gray-100 text-gray-700">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none"><path d="M13 2L3 14h8l-1 8 10-12h-8l1-8z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/></svg>
                    </span>
                    Actividades
                </a>
                <a href="{{ route('webmaster.clases') }}" class="flex w-full items-center gap-3 rounded-lg px-3 py-2 hover:bg-gray-100">
                    <span class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-gray-100 text-gray-700">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none"><rect x="3" y="4" width="18" height="17" rx="2" stroke="currentColor" stroke-width="2"/><path d="M8 2v4M16 2v4M3 10h18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                    </span>
                    Clases
                </a>
                <a href="{{ route('webmaster.informes.instalaciones') }}" class="flex w-full items-center gap-3 rounded-lg bg-blue-50 px-3 py-2 text-blue-700">
                    <span class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-blue-100 text-blue-700">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none"><path d="M3 3v16a2 2 0 002 2h16" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><path d="M7 16l4-8 4 4 4-12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                    </span>
                    Informes
                </a>
            </nav>
        </aside>

        <!-- Contenido -->
        <div class="flex-1 space-y-6" style="padding-top: 1rem;">
            <div>
                <h1 class="text-2xl font-semibold text-gray-900">Informe de Uso de Instalaciones</h1>
                <p class="mt-2 text-sm text-gray-600">Estadísticas sobre el uso de salas del gimnasio</p>
            </div>

            <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                <!-- Clases por Sala -->
                <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
                    <h3 class="text-base font-semibold text-gray-900">Clases por Sala</h3>
                    <div class="mt-6 space-y-4">
                        @forelse($clasesPorSala as $sala)
                            <div>
                                <div class="flex items-center justify-between text-sm">
                                    <span class="font-medium text-gray-900">{{ $sala->nombre }}</span>
                                    <span class="text-gray-700">{{ $sala->total_clases }} clases</span>
                                </div>
                                <div class="mt-2 h-2 rounded-full bg-gray-200">
                                    <div class="h-2 rounded-full bg-blue-600" style="width: {{ ($sala->total_clases / $clasesPorSala->max('total_clases')) * 100 }}%"></div>
                                </div>
                            </div>
                        @empty
                            <p class="text-sm text-gray-500">No hay datos disponibles</p>
                        @endforelse
                    </div>
                </div>

                <!-- Ocupación Promedio -->
                <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
                    <h3 class="text-base font-semibold text-gray-900">Tasa de Ocupación Promedio</h3>
                    <div class="mt-6 space-y-4">
                        @forelse($ocupacionPorSala as $sala)
                            <div>
                                <div class="flex items-center justify-between text-sm">
                                    <span class="font-medium text-gray-900">{{ $sala->nombre }}</span>
                                    <span class="text-gray-700">{{ number_format($sala->ocupacion_promedio, 1) }}%</span>
                                </div>
                                <div class="mt-2 h-2 rounded-full bg-gray-200">
                                    <div class="h-2 rounded-full {{ $sala->ocupacion_promedio > 80 ? 'bg-red-600' : ($sala->ocupacion_promedio > 50 ? 'bg-yellow-600' : 'bg-green-600') }}" style="width: {{ min($sala->ocupacion_promedio, 100) }}%"></div>
                                </div>
                            </div>
                        @empty
                            <p class="text-sm text-gray-500">No hay datos disponibles</p>
                        @endforelse
                    </div>
                </div>
            </div>
            
            <!-- Actividades Más Populares -->
            <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
                <h3 class="text-base font-semibold text-gray-900">Actividades Más Populares</h3>
                <div class="mt-6 space-y-3">
                    @forelse($actividadesPopulares as $index => $actividad)
                        <div class="flex items-center gap-4">
                            <div class="flex h-8 w-8 items-center justify-center rounded-full {{ $index < 3 ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700' }} text-sm font-semibold">
                                {{ $index + 1 }}
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center justify-between text-sm">
                                    <span class="font-medium text-gray-900">{{ $actividad->nombre }}</span>
                                    <span class="text-gray-700">{{ $actividad->total_reservas }} reservas</span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500">No hay datos disponibles</p>
                    @endforelse
                </div>
            </div>

            <!-- Socios Más Activos -->
            <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
                <h3 class="text-base font-semibold text-gray-900">Socios Más Activos</h3>
                <div class="mt-6 overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="border-b border-gray-200">
                            <tr>
                                <th class="pb-3 text-left font-medium text-gray-700">Posición</th>
                                <th class="pb-3 text-left font-medium text-gray-700">Nº Socio</th>
                                <th class="pb-3 text-left font-medium text-gray-700">Nombre</th>
                                <th class="pb-3 text-right font-medium text-gray-700">Reservas</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($sociosActivos as $index => $socio)
                                <tr>
                                    <td class="py-3">
                                        <span class="inline-flex h-6 w-6 items-center justify-center rounded-full {{ $index < 3 ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700' }} text-xs font-semibold">
                                            {{ $index + 1 }}
                                        </span>
                                    </td>
                                    <td class="py-3 font-medium text-gray-900">{{ $socio->numero_socio }}</td>
                                    <td class="py-3 text-gray-700">{{ $socio->nombre }} {{ $socio->apellidos }}</td>
                                    <td class="py-3 text-right font-semibold text-gray-900">{{ $socio->total_reservas }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-6 text-center text-sm text-gray-500">No hay datos disponibles</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Ingresos por Actividad -->
            <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
                <h3 class="text-base font-semibold text-gray-900">Ingresos por Actividades (Coste Extra)</h3>
                <div class="mt-6 space-y-3">
                    @forelse($ingresosPorActividad as $actividad)
                        <div class="flex items-center justify-between text-sm">
                            <span class="font-medium text-gray-900">{{ $actividad->nombre }}</span>
                            <span class="font-semibold text-green-700">{{ number_format($actividad->total_ingresos, 2) }}€</span>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500">No hay datos disponibles</p>
                    @endforelse
                    @if($ingresosPorActividad->count() > 0)
                        <div class="mt-4 border-t border-gray-200 pt-3">
                            <div class="flex items-center justify-between text-sm font-semibold">
                                <span class="text-gray-900">Total Ingresos</span>
                                <span class="text-green-700">{{ number_format($ingresosPorActividad->sum('total_ingresos'), 2) }}€</span>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
