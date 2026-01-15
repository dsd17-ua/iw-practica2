@extends('layouts.app')

@section('header')
    @include('partials.private-header')
@endsection

@section('content')
<div class="min-h-screen bg-gray-50" style="padding-top: 3rem;">
    <div class="mx-auto flex w-full max-w-7xl gap-6 px-4 py-6">
        <aside class="w-full max-w-xs rounded-xl border border-gray-200 bg-white p-4 shadow-sm">
            <nav class="space-y-2 text-sm text-gray-700">
                <a href="{{ route('socio.actividades') }}" class="flex w-full items-center gap-3 rounded-lg bg-blue-50 px-3 py-2 text-blue-700">
                    <span class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-blue-100 text-blue-700">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" aria-hidden="true" xmlns="http://www.w3.org/2000/svg">
                            <rect x="3" y="4" width="18" height="17" rx="2" stroke="currentColor" stroke-width="2"/>
                            <path d="M8 2v4M16 2v4M3 10h18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </span>
                    Actividades
                </a>
                <a href="{{ route('socio.reservas') }}" class="flex w-full items-center gap-3 rounded-lg px-3 py-2 hover:bg-gray-100">
                    <span class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-gray-100 text-gray-700">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" aria-hidden="true" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="8" cy="8" r="3" stroke="currentColor" stroke-width="2"/>
                            <path d="M2 20a6 6 0 0 1 12 0" stroke="currentColor" stroke-width="2"/>
                            <circle cx="17" cy="11" r="2" stroke="currentColor" stroke-width="2"/>
                            <path d="M15 20a4 4 0 0 1 7 0" stroke="currentColor" stroke-width="2"/>
                        </svg>
                    </span>
                    Mis Reservas
                </a>
                <a href="{{ route('socio.saldo') }}" class="flex w-full items-center gap-3 rounded-lg px-3 py-2 hover:bg-gray-100">
                    <span class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-gray-100 text-gray-700">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" aria-hidden="true" xmlns="http://www.w3.org/2000/svg">
                            <rect x="3" y="5" width="18" height="14" rx="2" stroke="currentColor" stroke-width="2"/>
                            <path d="M3 9h18" stroke="currentColor" stroke-width="2"/>
                        </svg>
                    </span>
                    Gestion de Saldo
                </a>
                <a href="{{ route('socio.perfil') }}" class="flex w-full items-center gap-3 rounded-lg px-3 py-2 hover:bg-gray-100">
                    <span class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-gray-100 text-gray-700">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" aria-hidden="true" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="12" cy="7" r="4" stroke="currentColor" stroke-width="2"/>
                            <path d="M4 21a8 8 0 0 1 16 0" stroke="currentColor" stroke-width="2"/>
                        </svg>
                    </span>
                    Mi Perfil
                </a>
                <a href="{{ route('socio.tienda') }}" class="flex w-full items-center gap-3 rounded-lg px-3 py-2 hover:bg-gray-100">
                    <span class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-gray-100 text-gray-700">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" aria-hidden="true" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6 7h12l-1 12H7L6 7z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                            <path d="M9 7V5a3 3 0 0 1 6 0v2" stroke="currentColor" stroke-width="2"/>
                        </svg>
                    </span>
                    Tienda
                </a>
                <a href="{{ route('socio.plan') }}" class="flex w-full items-center gap-3 rounded-lg px-3 py-2 hover:bg-gray-100">
                    <span class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-gray-100 text-gray-700">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" aria-hidden="true" xmlns="http://www.w3.org/2000/svg">
                            <path d="M3 7h18l-4 12H7L3 7z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                            <path d="M3 7l4-4h10l4 4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </span>
                    Plan
                </a>
            </nav>
        </aside>

        <section class="flex-1">
            <div class="rounded-xl bg-white p-6 shadow-sm">
                <h1 class="text-2xl font-semibold text-gray-900">Actividades Disponibles</h1>
                <p class="mt-2 text-sm text-gray-500">Reserva tus clases con monitor</p>

                @if (session('error'))
                    <div class="mt-4 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                        <p class="font-semibold">{{ session('error') }}</p>
                        <a href="{{ route('socio.saldo') }}" class="mt-3 inline-flex items-center justify-center rounded-lg bg-red-600 px-4 py-2 text-sm font-semibold text-white hover:bg-red-700">
                            Recargar saldo
                        </a>
                    </div>
                @endif

                <div class="mt-5 flex flex-wrap gap-3 text-sm">
                    <button type="button" data-filtro="todas" class="js-filtro-actividad rounded-xl bg-blue-50 px-4 py-2 font-semibold text-blue-700 hover:bg-blue-100">Todas</button>
                    @forelse ($actividadesDisponibles as $actividad)
                        <button type="button" data-filtro="{{ $actividad->nombre }}" class="js-filtro-actividad rounded-lg bg-gray-100 px-4 py-2 text-gray-700 hover:bg-gray-200">{{ $actividad->nombre }}</button>
                    @empty
                        <p class="text-gray-600">
                            Aún no hay actividades registradas.
                        </p>
                    @endforelse
                </div>
            </div>

            <div class="mt-6 grid grid-cols-1 gap-6 lg:grid-cols-3">
                @forelse ($listadoActividades as $clase)
                    @php
                        $fechaInicio = \Carbon\Carbon::parse($clase->fecha_inicio);
                        $fechaFin = \Carbon\Carbon::parse($clase->fecha_fin);
                        $diaSemana = ucfirst($fechaInicio->locale('es')->translatedFormat('l'));
                        $fechaCompleta = $fechaInicio->format('d/m/Y');
                        $horaRango = $fechaInicio->format('H:i') . ' - ' . $fechaFin->format('H:i');
                        $monitorNombre = trim($clase->monitor_nombre ?? '') ?: 'Monitor por asignar';
                        $salaNombre = $clase->sala_nombre ?? 'Sala por confirmar';
                        $plazasDisponibles = max(0, ($clase->plazas_totales ?? 0) - ($clase->asistencia_actual ?? 0));
                        $precioClase = $clase->clase_precio ?? 0;
                        $yaReservado = \App\Models\Reserva::where('user_id', auth()->id())
                            ->where('clase_id', $clase->id)
                            ->where('estado', 'confirmada')
                            ->exists();
                    @endphp
                    <article data-actividad="{{ $clase->actividad_nombre }}" class="actividad-card flex h-full flex-col rounded-2xl border border-gray-100 bg-white p-5 shadow-sm">
                        <div class="space-y-2">
                            <h3 class="text-lg font-semibold text-gray-900">{{ $clase->actividad_nombre }}</h3>
                        </div>

                        <div class="mt-4 space-y-3 text-sm text-gray-600">
                            <div class="flex items-center gap-2">
                                <span class="text-gray-400">
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" aria-hidden="true" xmlns="http://www.w3.org/2000/svg">
                                        <rect x="3" y="4" width="18" height="17" rx="2" stroke="currentColor" stroke-width="2"/>
                                        <path d="M8 2v4M16 2v4M3 10h18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                    </svg>
                                </span>
                                {{ $diaSemana }} - {{ $fechaCompleta }}
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-gray-400">
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" aria-hidden="true" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="2"/>
                                        <path d="M12 7v5l3 3" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                    </svg>
                                </span>
                                {{ $horaRango }}
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-gray-400">
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" aria-hidden="true" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 22s7-6.1 7-11a7 7 0 1 0-14 0c0 4.9 7 11 7 11z" stroke="currentColor" stroke-width="2"/>
                                        <circle cx="12" cy="10" r="2.5" stroke="currentColor" stroke-width="2"/>
                                    </svg>
                                </span>
                                {{ $salaNombre }}
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-gray-400">
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" aria-hidden="true" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="12" cy="7" r="4" stroke="currentColor" stroke-width="2"/>
                                        <path d="M4 21a8 8 0 0 1 16 0" stroke="currentColor" stroke-width="2"/>
                                    </svg>
                                </span>
                                {{ $monitorNombre }}
                            </div>
                        </div>

                        <div class="mt-4 flex flex-wrap items-center justify-between gap-3 text-sm">
                            <span class="rounded-full px-3 py-1 font-semibold {{ $yaReservado ? 'text-green-700 bg-green-50' : 'text-blue-700 bg-blue-50' }}">
                                {{ $plazasDisponibles }} plazas disponibles
                            </span>
                            <span class="text-sm font-semibold text-gray-900">
                                {{ number_format($precioClase, 2, ',', '.') }} EUR
                            </span>
                        </div>
                        <div class="mt-6">
                            @if ($yaReservado)
                                <button type="button" disabled class="w-full rounded-lg bg-gray-200 px-4 py-2 font-semibold text-gray-500 cursor-not-allowed">
                                    Ya reservado
                                </button>
                            @else
                                <form action="{{ route('socio.reservas.reservar', ['claseId' => $clase->id]) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full rounded-lg bg-blue-600 px-4 py-2 font-semibold text-white hover:bg-blue-700">
                                        Reservar Clase
                                    </button>
                                </form>                            
                            @endif
                        </div>
                    </article>
                @empty
                    <div class="rounded-2xl border border-dashed border-gray-200 bg-white p-8 text-center shadow-sm lg:col-span-3">
                        <h2 class="text-lg font-semibold text-gray-900">Aun no hay actividades disponibles</h2>
                        <p class="mt-2 text-sm text-gray-500">Vuelve mas tarde para reservar nuevas clases.</p>
                    </div>
                @endforelse
            </div>
        </section>
    </div>
</div>
<script>
    (function () {
        var botones = document.querySelectorAll('.js-filtro-actividad');
        var tarjetas = document.querySelectorAll('.actividad-card');

        function aplicarFiltro(nombreActividad) {
            tarjetas.forEach(function (tarjeta) {
                var actividad = tarjeta.getAttribute('data-actividad');
                var mostrar = nombreActividad === 'todas' || actividad === nombreActividad;
                tarjeta.style.display = mostrar ? '' : 'none';
            });
        }

        botones.forEach(function (boton) {
            boton.addEventListener('click', function () {
                var filtro = boton.getAttribute('data-filtro');
                aplicarFiltro(filtro);
            });
        });
    })();
</script>
@endsection
