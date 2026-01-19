{{--
 * ============================================================================
 * resources/views/webmaster/dashboard.blade.php
 * ============================================================================
 * Vista principal del dashboard del webmaster con estadísticas y accesos rápidos
 * ============================================================================
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
                <a href="{{ route('webmaster.dashboard') }}" class="flex w-full items-center gap-3 rounded-lg bg-blue-50 px-3 py-2 text-blue-700">
                    <span class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-blue-100 text-blue-700">
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
                    @if($solicitudesPendientes > 0)
                        <span class="ml-auto rounded-full bg-red-500 px-2 py-1 text-xs font-semibold text-white">{{ $solicitudesPendientes }}</span>
                    @endif
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
                <a href="{{ route('webmaster.informes.instalaciones') }}" class="flex w-full items-center gap-3 rounded-lg px-3 py-2 hover:bg-gray-100">
                    <span class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-gray-100 text-gray-700">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M13 2L3 14h8l-1 8 10-12h-8l1-8z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                        </svg>
                    </span>
                    Informes
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

        <!-- Contenido Principal -->
        <div class="flex-1 space-y-6" style="padding-top: 1rem;">
            <div>
                <h1 class="text-2xl font-semibold text-gray-900">Panel de Administración</h1>
                <p class="mt-2 text-sm text-gray-600">Resumen general del gimnasio</p>
            </div>

            <!-- Tarjetas de Estadísticas -->
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
                <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Solicitudes Pendientes</p>
                            <p class="mt-2 text-3xl font-semibold text-gray-900">{{ $solicitudesPendientes }}</p>
                        </div>
                        <div class="rounded-full bg-yellow-100 p-3">
                            <svg class="h-6 w-6 text-yellow-600" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                        </div>
                    </div>
                    @if($solicitudesPendientes > 0)
                        <a href="{{ route('webmaster.solicitudes') }}" class="mt-4 inline-block text-sm font-medium text-blue-600 hover:text-blue-700">
                            Ver solicitudes →
                        </a>
                    @endif
                </div>

                <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Socios Activos</p>
                            <p class="mt-2 text-3xl font-semibold text-gray-900">{{ $sociosActivos }}</p>
                        </div>
                        <div class="rounded-full bg-green-100 p-3">
                            <svg class="h-6 w-6 text-green-600" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5 13l4 4L19 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Socios Bloqueados</p>
                            <p class="mt-2 text-3xl font-semibold text-gray-900">{{ $sociosBloqueados }}</p>
                        </div>
                        <div class="rounded-full bg-red-100 p-3">
                            <svg class="h-6 w-6 text-red-600" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"/>
                                <path d="M15 9l-6 6M9 9l6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Clases Hoy</p>
                            <p class="mt-2 text-3xl font-semibold text-gray-900">{{ $clasesHoy }}</p>
                        </div>
                        <div class="rounded-full bg-blue-100 p-3">
                            <svg class="h-6 w-6 text-blue-600" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="3" y="4" width="18" height="17" rx="2" stroke="currentColor" stroke-width="2"/>
                                <path d="M8 2v4M16 2v4M3 10h18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Próximas Clases -->
            <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <h3 class="text-base font-semibold text-gray-900">Próximas Clases</h3>
                    <a href="{{ route('webmaster.clases') }}" class="text-sm font-medium text-blue-600 hover:text-blue-700">
                        Ver todas →
                    </a>
                </div>

                @if($proximasClases->count() > 0)
                    <div class="mt-6 space-y-4">
                        @foreach($proximasClases as $clase)
                            <div class="flex items-center justify-between border-b border-gray-100 pb-4 last:border-0">
                                <div class="flex-1">
                                    <p class="font-medium text-gray-900">{{ $clase->actividad->nombre }}</p>
                                    <p class="text-sm text-gray-600">
                                        {{ \Carbon\Carbon::parse($clase->fecha_inicio)->format('d/m/Y H:i') }} - 
                                        Sala: {{ $clase->sala->nombre }} - 
                                        Monitor: {{ $clase->monitor->nombre }}
                                    </p>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm font-medium text-gray-900">
                                        {{ $clase->asistencia_actual }}/{{ $clase->plazas_totales }}
                                    </p>
                                    <p class="text-xs text-gray-500">plazas</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="mt-6 text-center text-sm text-gray-500">No hay clases programadas próximamente</p>
                @endif
            </div>

            <!-- Accesos Rápidos -->
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                <a href="{{ route('webmaster.clases.crear') }}" class="rounded-2xl border-2 border-dashed border-gray-300 bg-white p-6 text-center hover:border-blue-500 hover:bg-blue-50">
                    <svg class="mx-auto h-8 w-8 text-gray-400" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                    <p class="mt-2 text-sm font-medium text-gray-900">Crear Clase</p>
                </a>

                <a href="{{ route('webmaster.actividades.crear') }}" class="rounded-2xl border-2 border-dashed border-gray-300 bg-white p-6 text-center hover:border-blue-500 hover:bg-blue-50">
                    <svg class="mx-auto h-8 w-8 text-gray-400" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                    <p class="mt-2 text-sm font-medium text-gray-900">Nueva Actividad</p>
                </a>

                <a href="{{ route('webmaster.informes.instalaciones') }}" class="rounded-2xl border-2 border-dashed border-gray-300 bg-white p-6 text-center hover:border-blue-500 hover:bg-blue-50">
                    <svg class="mx-auto h-8 w-8 text-gray-400" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3 3v16a2 2 0 002 2h16" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        <path d="M7 16l4-8 4 4 4-12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                    <p class="mt-2 text-sm font-medium text-gray-900">Ver Informes</p>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
