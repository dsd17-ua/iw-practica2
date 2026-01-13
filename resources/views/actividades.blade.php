@extends('layouts.app')

@section('header')
    @include('partials.header')
@endsection

@section('content')
    <section class="mx-auto w-full max-w-7xl px-6 py-12" style="padding-top: 100px;">
        <h1 class="mb-4 text-3xl font-semibold text-gray-900">Nuestras actividades</h1>
        <p class="mb-12 text-lg text-gray-600">
            Descubre todos los espacios y servicios que tenemos para ti.
        </p>

        <div class="grid gap-8 md:grid-cols-2">
            @forelse ($actividades as $actividad)
                <article class="overflow-hidden rounded-lg bg-white shadow-md">
                    <img
                        src="{{ $actividad->imagen_url ?: 'https://via.placeholder.com/1200x600?text=Sin+imagen' }}"
                        alt="{{ $actividad->nombre }}"
                        class="h-64 w-full object-cover"
                        loading="lazy"
                    />
                    <div class="p-6">
                        <h3 class="mb-2 text-lg font-semibold">
                            {{ $actividad->nombre }}
                        </h3>
                        <p class="text-sm text-gray-600">
                            {{ $actividad->descripcion }}
                        </p>
                    </div>
                </article>
            @empty
                <p class="text-gray-600">
                    Aún no hay actividades registradas.
                </p>
            @endforelse
        </div>

        <div class="mt-12 rounded-lg bg-blue-50 p-8">
            <h3 class="mb-4 text-lg font-semibold">Servicios adicionales</h3>
            <ul class="grid gap-4 md:grid-cols-2">
                <li class="flex items-center gap-2 text-sm text-gray-700">
                    <span class="h-2 w-2 rounded-full bg-blue-600"></span>
                    Vestuarios con taquillas
                </li>
                <li class="flex items-center gap-2 text-sm text-gray-700">
                    <span class="h-2 w-2 rounded-full bg-blue-600"></span>
                    Duchas y sauna
                </li>
                <li class="flex items-center gap-2 text-sm text-gray-700">
                    <span class="h-2 w-2 rounded-full bg-blue-600"></span>
                    Zona de cardio
                </li>
                <li class="flex items-center gap-2 text-sm text-gray-700">
                    <span class="h-2 w-2 rounded-full bg-blue-600"></span>
                    Parking gratuito
                </li>
                <li class="flex items-center gap-2 text-sm text-gray-700">
                    <span class="h-2 w-2 rounded-full bg-blue-600"></span>
                    Wifi en todas las actividades
                </li>
                <li class="flex items-center gap-2 text-sm text-gray-700">
                    <span class="h-2 w-2 rounded-full bg-blue-600"></span>
                    Tienda deportiva
                </li>
            </ul>
        </div>
    </section>
@endsection

@section('footer')
    @include('partials.footer')
@endsection