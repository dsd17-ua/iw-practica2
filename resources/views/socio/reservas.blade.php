@extends('layouts.app')

@section('header')
    @include('partials.private-header')
@endsection

@section('content')
<div class="min-h-screen bg-gray-50" style="padding-top: 3rem;">
    <div class="mx-auto flex w-full max-w-[90rem] gap-6 px-2 py-6 md:px-4">
        <aside class="w-full max-w-xs rounded-xl border border-gray-200 bg-white p-4 shadow-sm">
            <nav class="space-y-2 text-sm text-gray-700">
                <a href="{{ route('socio.actividades') }}" class="flex w-full items-center gap-3 rounded-lg px-3 py-2 hover:bg-gray-100">
                    <span class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-gray-100 text-gray-700">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" aria-hidden="true" xmlns="http://www.w3.org/2000/svg">
                            <rect x="3" y="4" width="18" height="17" rx="2" stroke="currentColor" stroke-width="2"/>
                            <path d="M8 2v4M16 2v4M3 10h18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </span>
                    Actividades
                </a>
                <a href="{{ route('socio.reservas') }}" class="flex w-full items-center gap-3 rounded-lg bg-blue-50 px-3 py-2 text-blue-700">
                    <span class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-blue-100 text-blue-700">
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
                <h1 class="text-2xl font-semibold text-gray-900">Mis Reservas</h1>
                <p class="mt-2 text-sm text-gray-500">Gestiona tus actividades reservadas</p>
            </div>

            <div class="mt-6 space-y-6">
                @forelse ($reservas->groupBy(function ($reserva) {
                    return \Carbon\Carbon::parse($reserva->fecha_clase ?? $reserva->fecha_reserva)->toDateString();
                }) as $fechaGrupo => $reservasDia)
                    @php
                        $fechaGrupoCarbon = \Carbon\Carbon::parse($fechaGrupo);
                    @endphp
                    <div class="rounded-xl border border-gray-100 bg-white px-5 py-3 text-sm font-semibold text-gray-700 shadow-sm">
                        {{ ucfirst($fechaGrupoCarbon->locale('es')->translatedFormat('l d F Y')) }}
                    </div>
                    <div class="space-y-4">
                        @foreach ($reservasDia as $reserva)
                            @php
                                $fechaReserva = \Carbon\Carbon::parse($reserva->fecha_reserva);
                                $estadoClasses = [
                                    'confirmada' => 'bg-blue-50 text-blue-700',
                                    'cancelada' => 'bg-red-50 text-red-600',
                                    'asistida' => 'bg-green-50 text-green-700',
                                ];
                                $estadoLabel = ucfirst($reserva->estado);
                                $fechaClase = \Carbon\Carbon::parse($reserva->fecha_clase ?? $reserva->fecha_reserva);
                                $fechaFin = \Carbon\Carbon::parse($reserva->fecha_fin ?? $reserva->fecha_reserva);
                                $diaSemana = ucfirst($fechaClase->locale('es')->translatedFormat('l'));
                                $fechaCompleta = $fechaClase->format('d/m/Y');
                                $esFutura = $fechaClase->isFuture();
                                $horaRango = $fechaClase->format('H:i');
                                if (!empty($reserva->fecha_fin)) {
                                    $horaRango .= ' - ' . $fechaFin->format('H:i');
                                }
                                $actividadNombre = $reserva->actividad_nombre ?? 'Clase reservada';
                                $salaNombre = $reserva->sala_nombre ?? 'Sala por confirmar';
                                $monitorNombre = trim($reserva->monitor_nombre ?? '') ?: 'Monitor por asignar';
                            @endphp
                            <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-sm">
                                <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                                    <div class="space-y-3">
                                        <div>
                                            <h3 class="text-base font-semibold text-gray-900">{{ $actividadNombre }}</h3>
                                        </div>
                                        <div class="flex flex-wrap gap-4 text-sm text-gray-600">
                                            <div class="flex items-center gap-2">
                                                <span class="text-gray-400">
                                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" aria-hidden="true" xmlns="http://www.w3.org/2000/svg">
                                                        <rect x="3" y="4" width="18" height="17" rx="2" stroke="currentColor" stroke-width="2"/>
                                                        <path d="M8 2v4M16 2v4M3 10h18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                                    </svg>
                                                </span>
                                                {{ $diaSemana }} · {{ $fechaCompleta }}
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
                                    </div>

                                    <div class="flex flex-col items-start gap-3 text-sm text-gray-600 lg:items-end">
                                        <div class="flex items-center gap-3">
                                            @if ($reserva->uso_clase_gratuita)
                                                <span class="rounded-full bg-amber-50 px-3 py-1 text-xs font-semibold text-amber-700">Clase gratuita</span>
                                            @else
                                                <span class="text-sm font-semibold text-gray-900">{{ number_format($reserva->precio_pagado, 2, ',', '.') }} EUR</span>
                                            @endif
                                            <span class="rounded-full px-3 py-1 text-xs font-semibold {{ $estadoClasses[$reserva->estado] ?? 'bg-gray-100 text-gray-600' }}">
                                                {{ $estadoLabel }}
                                            </span>
                                        </div>
                                        @if ($esFutura && $reserva->estado !== 'cancelada')
                                            <button type="button" data-reserva-id="{{ $reserva->id }}" class="js-cancelar-reserva rounded-xl bg-red-50 px-4 py-2 font-semibold text-red-600 hover:bg-red-100" style="background-color: #ffb8b8;">
                                                Cancelar
                                            </button>
                                        @elseif (!$esFutura && $reserva->estado === 'confirmada')
                                            <div class="rounded-xl bg-red-50 px-4 py-2 font-semibold text-green-600 hover:bg-green-100" style="background-color: #b8ffb8;">
                                                Asistida
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @empty
                    <div class="rounded-2xl border border-dashed border-gray-200 bg-white p-8 text-center shadow-sm">
                        <h2 class="text-lg font-semibold text-gray-900">Aun no tienes reservas</h2>
                        <p class="mt-2 text-sm text-gray-500">Explora las actividades disponibles para reservar tu primera clase.</p>
                        <a href="{{ route('socio.actividades') }}" class="mt-4 inline-flex items-center justify-center rounded-xl bg-blue-600 px-5 py-2 text-sm font-semibold text-white hover:bg-blue-700">
                            Ver actividades
                        </a>
                    </div>
                @endforelse
            </div>
        </section>
    </div>
</div>

<script>
    function cancelarReserva(reservaId) {
        if (!confirm('¿Estás seguro de que deseas cancelar esta reserva?')) {
            return;
        }
        fetch(`/socio/reservas/${reservaId}/cancelar`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        }).then(response => {
            if (response.ok) {
                alert('Reserva cancelada correctamente, se devolverá el importe correspondiente.');
                location.reload();
            } else {
                alert('Error al cancelar la reserva. Por favor, inténtalo de nuevo.');
            }
        }).catch(error => {
            alert('Error al cancelar la reserva. Por favor, inténtalo de nuevo.');
        });
        return;
    }

    document.addEventListener('click', function (event) {
        var target = event.target;
        if (!target.classList.contains('js-cancelar-reserva')) {
            return;
        }

        var reservaId = target.getAttribute('data-reserva-id');
        cancelarReserva(reservaId);
    });
</script>
@endsection

