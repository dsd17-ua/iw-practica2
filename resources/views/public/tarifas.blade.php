@extends('layouts.app')

@section('header')
    @include('partials.public-header')
@endsection

@section('content')
    <section class="mx-auto w-full max-w-7xl px-6 py-12" style="padding-top: 100px;">
        <h1 class="mb-4 text-center text-3xl font-semibold text-gray-900">Tarifas y precios</h1>
        <p class="mb-12 text-center text-lg text-gray-600">
            Elige el plan que mejor se adapte a ti.
        </p>

        <div class="grid gap-8 lg:grid-cols-2">
            @forelse ($planes as $plan)
                @php
                    // Estilos según el nombre (puedes cambiar la lógica cuando quieras)
                    $isPremium = str_contains(strtolower($plan->nombre), 'premium');

                    $ring = $isPremium ? 'ring-yellow-500' : 'ring-blue-600';
                    $barBg = $isPremium ? 'bg-yellow-500' : 'bg-blue-600';
                    $tituloAcceso = $isPremium ? 'Acceso total' : 'Acceso general';

                    $bulletClases = "Incluye {$plan->clases_gratis_incluidas} clases grupales gratuitas al mes";
                @endphp

                <div class="rounded-lg bg-white p-8 shadow-lg ring-2 {{ $ring }}">
                    <div class="-mx-8 -mt-8 mb-6 rounded-t-lg {{ $barBg }} py-2 text-center text-sm font-semibold text-white">
                        {{ $plan->nombre }}
                    </div>

                    <h3 class="mb-4 text-center text-lg font-semibold">{{ $tituloAcceso }}</h3>

                    <div class="mb-6 text-center">
                        <span class="text-3xl font-semibold text-gray-900">
                            {{ number_format($plan->precio_mensual, 0) }} EUR
                        </span>
                        <span class="text-sm text-gray-600">/mes</span>
                    </div>

                    <ul class="space-y-3 text-sm text-gray-700">
                        <li class="flex items-start gap-2">
                            <span class="mt-1 flex h-5 w-5 items-center justify-center rounded-full bg-green-100">
                                <span class="h-2 w-2 rounded-full bg-green-600"></span>
                            </span>
                            {{ $plan->descripcion }}
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="mt-1 flex h-5 w-5 items-center justify-center rounded-full bg-green-100">
                                <span class="h-2 w-2 rounded-full bg-green-600"></span>
                            </span>
                            {{ $bulletClases }}
                        </li>
                    </ul>
                </div>
            @empty
                <p class="text-center text-gray-600">Aún no hay planes disponibles.</p>
            @endforelse
        </div>

        <div class="mt-12 rounded-lg bg-gray-100 p-8">
            <h3 class="mb-4 text-lg font-semibold">Informacion adicional</h3>
            <div class="grid gap-6 md:grid-cols-2">
                <div>
                    <h4 class="mb-2 text-sm font-semibold text-gray-800">Actividades con coste extra</h4>
                    <ul class="space-y-2 text-sm text-gray-700">
                        <li class="flex justify-between">
                            <span>Spinning (por clase)</span>
                            <span>5.00 EUR</span>
                        </li>
                        <li class="flex justify-between">
                            <span>CrossFit (por clase)</span>
                            <span>8.00 EUR</span>
                        </li>
                        <li class="flex justify-between">
                            <span>Yoga (por clase)</span>
                            <span>6.00 EUR</span>
                        </li>
                    </ul>
                </div>
                <div>
                    <h4 class="mb-2 text-sm font-semibold text-gray-800">Condiciones</h4>
                    <ul class="space-y-2 text-sm text-gray-700">
                        <li>Sin permanencia</li>
                        <li>Matricula gratuita</li>
                        <li>Cancelacion hasta 24h antes</li>
                        <li>Saldo recargable para actividades</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('footer')
    @include('partials.public-footer')
@endsection