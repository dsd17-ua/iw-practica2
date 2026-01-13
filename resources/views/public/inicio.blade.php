@extends('layouts.app')

@section('header')
    @include('partials.public-header')
@endsection

@section('content')
<section class="relative h-[520px] bg-gradient-to-r from-blue-900 to-blue-700 flex items-center">
        <div class="absolute inset-0 opacity-20">
            <img
                src="https://images.unsplash.com/photo-1632077804406-188472f1a810?auto=format&fit=crop&w=1400&q=80"
                alt="Gym equipment"
                class="h-full w-full object-cover"
            />
        </div>
        <div class="relative z-10 mx-auto w-full max-w-7xl px-6 flex items-center justify-center h-full">
            <div class="max-w-2xl text-white text-left">
                <h1 class="mb-6 text-4xl font-semibold md:text-5xl">
                    Transforma tu vida en FitZone
                </h1>
                <p class="mb-8 text-lg md:text-xl text-white/90">
                    El gimnasio mas completo con instalaciones de ultima generacion y los mejores profesionales.
                </p>
                <a href="#" class="inline-flex items-center rounded-lg bg-white px-8 py-3 font-semibold text-blue-700 transition hover:bg-gray-100">
                    Reserva tu clase gratuita
                </a>
            </div>
        </div>
    </section>

    <section class="mx-auto w-full max-w-7xl px-6 py-16">
        <div class="grid gap-8 md:grid-cols-3">
            <div class="rounded-lg bg-white p-8 text-center shadow-md">
                <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-blue-100">
                    <svg class="h-8 w-8 text-blue-600" viewBox="0 0 24 24" fill="none" aria-hidden="true" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9 12l2 2 4-4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M7 4h10l1 7-6 9-6-9 1-7z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <h3 class="mb-3 text-lg font-semibold">Instalaciones premium</h3>
                <p class="text-sm text-gray-600">
                    Equipamiento de ultima generacion y espacios amplios para tu entrenamiento.
                </p>
            </div>

            <div class="rounded-lg bg-white p-8 text-center shadow-md">
                <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-blue-100">
                    <svg class="h-8 w-8 text-blue-600" viewBox="0 0 24 24" fill="none" aria-hidden="true" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <circle cx="9" cy="7" r="4" stroke="currentColor" stroke-width="2"/>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <h3 class="mb-3 text-lg font-semibold">Entrenadores certificados</h3>
                <p class="text-sm text-gray-600">
                    Profesionales cualificados que te ayudan a alcanzar tus objetivos.
                </p>
            </div>

            <div class="rounded-lg bg-white p-8 text-center shadow-md">
                <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-blue-100">
                    <svg class="h-8 w-8 text-blue-600" viewBox="0 0 24 24" fill="none" aria-hidden="true" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="2"/>
                        <path d="M12 7v5l3 2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <h3 class="mb-3 text-lg font-semibold">Horario flexible</h3>
                <p class="text-sm text-gray-600">
                    Abierto desde las 6:00 para adaptarnos a tu rutina diaria.
                </p>
            </div>
        </div>
    </section>

    <section class="bg-blue-600 py-16">
        <div class="mx-auto w-full max-w-4xl px-6 text-center text-white">
            <h2 class="mb-4 text-3xl font-semibold">Listo para empezar?</h2>
            <p class="mb-8 text-lg text-white/90">
                Unete a nuestra comunidad y comienza tu transformacion hoy mismo.
            </p>
            <a href="#" class="inline-flex items-center rounded-lg bg-white px-8 py-3 font-semibold text-blue-700 transition hover:bg-gray-100">
                Hazte socio ahora
            </a>
        </div>
    </section>
@endsection

@section('footer')
    @include('partials.public-footer')
@endsection