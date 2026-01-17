@extends('layouts.app')

@section('header')
    @include('partials.private-header')
@endsection

@section('content')
<div class="min-h-screen bg-gray-50" style="padding-top: 3rem;">
    <div class="mx-auto flex w-full max-w-full gap-6 px-1 py-6 md:px-2">
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
                <a href="{{ route('socio.plan') }}" class="flex w-full items-center gap-3 rounded-lg bg-blue-50 px-3 py-2 text-blue-700">
                    <span class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-blue-100 text-blue-700">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" aria-hidden="true" xmlns="http://www.w3.org/2000/svg">
                            <path d="M3 7h18l-4 12H7L3 7z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                            <path d="M3 7l4-4h10l4 4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </span>
                    Plan
                </a>
            </nav>
        </aside>
        <main class="flex-1">
            <div class="max-w-5xl">
                <div class="mb-6">
                    <h1 class="text-2xl font-semibold text-gray-900">Plan</h1>
                    <p class="mt-1 text-sm text-gray-600">Gestiona tu plan de miembrosía</p>
                    @if (session('success'))
                        <div class="mt-4 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('status'))
                        <div class="mt-4 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
                <div class="grid gap-6 lg:grid-cols-2">
                    <div class="space-y-4">
                        <div class="overflow-hidden rounded-2xl bg-gradient-to-r from-blue-600 to-blue-700 p-6 text-white shadow-lg">
                            <div class="flex items-start justify-between gap-4">
                                <div class="space-y-2">
                                    <p class="text-sm font-medium text-white/80">Plan Actual</p>
                                    <p class="text-lg font-semibold">{{ $planActual->nombre }}</p>
                                </div>
                                <div class="text-white/80">
                                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" aria-hidden="true" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M3 5h18l-7 8v5l-4 2v-7L3 5z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="rounded-2xl border border-blue-100 bg-blue-50 p-6 shadow-sm">
                            <p class="mb-3 text-sm font-semibold text-gray-900">Información</p>
                            <ul class="space-y-2 text-sm text-gray-700">
                                <li class="flex items-center gap-2">
                                    <span class="h-1.5 w-1.5 rounded-full bg-blue-600"></span>
                                    Precio: {{ $planActual->precio_mensual }}€/mes
                                </li>
                                <li class="flex items-center gap-2">
                                    <span class="h-1.5 w-1.5 rounded-full bg-blue-600"></span>
                                    Clases gratis: {{ $planActual->clases_gratis_incluidas }}
                                </li>
                                <li class="flex items-center gap-2">
                                    <span class="h-1.5 w-1.5 rounded-full bg-blue-600"></span>
                                    Clases disponibles: {{ $clasesDisponibles }}
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-lg">
                        <p class="text-sm font-semibold text-gray-900">Cambiar Plan</p>
                        <div class="mt-4 grid gap-4 sm:grid-cols-2">
                            @foreach($planesDisponibles as $plan)
                                <form method="POST" action="{{ route('socio.plan.update', ['planId' => $plan->id]) }}" class="w-full">
                                    @csrf
                                    <button type="submit" class="w-full rounded-xl border border-gray-200 px-8 py-6 text-center shadow-sm hover:border-blue-200 hover:bg-blue-50/40 transition-colors" style="background-color: #f1f1f1;">
                                        <p class="text-sm font-semibold text-gray-900">{{ $plan->nombre }}</p>
                                        <p class="mt-1 text-base font-semibold text-gray-900">{{ $plan->precio_mensual }}€/mes</p>
                                        <p class="mt-1 text-xs text-gray-500">Clases gratis: {{ $plan->clases_gratis_incluidas }}</p>
                                    </button>
                                </form>
                            @endforeach
                        </div>
                        <div class="mt-4 flex items-center justify-between gap-3 rounded-xl border border-gray-100 bg-gray-50 px-4 py-3 text-sm text-gray-600">
                            <span>Cambio de plan seguro</span>
                            <svg class="h-4 w-4 text-gray-500" viewBox="0 0 24 24" fill="none" aria-hidden="true" xmlns="http://www.w3.org/2000/svg">
                                <path d="M3 5h18l-7 8v5l-4 2v-7L3 5z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection









