@extends('layouts.app')

@section('header')
    @include('partials.public-header')
@endsection

@section('content')
    <section class="mx-auto w-full max-w-7xl px-6 py-12" style="padding-top: 100px;">
        <h1 class="mb-4 text-3xl font-semibold text-gray-900">Contacto</h1>
        <p class="mb-12 text-lg text-gray-600">
            Tienes alguna pregunta? Estamos aqui para ayudarte.
        </p>

        <div class="grid gap-12 md:grid-cols-2">
            <div>
                <h3 class="mb-6 text-lg font-semibold">Informacion de contacto</h3>
                <div class="space-y-6">
                    <div class="flex items-start gap-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-blue-100">
                            <svg class="h-6 w-6 text-blue-600" viewBox="0 0 24 24" fill="none" aria-hidden="true" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 21s7-6.1 7-11a7 7 0 1 0-14 0c0 4.9 7 11 7 11z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <circle cx="12" cy="10" r="2.5" stroke="currentColor" stroke-width="2"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="mb-1 text-sm font-semibold">Direccion</h4>
                            <p class="text-sm text-gray-600">Calle Principal 123<br>28001 Madrid, Espana</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-blue-100">
                            <svg class="h-6 w-6 text-blue-600" viewBox="0 0 24 24" fill="none" aria-hidden="true" xmlns="http://www.w3.org/2000/svg">
                                <path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6 19.8 19.8 0 0 1-3.1-8.6A2 2 0 0 1 4 2h3a2 2 0 0 1 2 1.7c.1.9.3 1.8.6 2.7a2 2 0 0 1-.5 2.1l-1.3 1.3a16 16 0 0 0 6 6l1.3-1.3a2 2 0 0 1 2.1-.5c.9.3 1.8.5 2.7.6A2 2 0 0 1 22 16.9z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="mb-1 text-sm font-semibold">Telefono</h4>
                            <p class="text-sm text-gray-600">+34 900 123 456<br>+34 900 123 457</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-blue-100">
                            <svg class="h-6 w-6 text-blue-600" viewBox="0 0 24 24" fill="none" aria-hidden="true" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4 5h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="m22 7-10 7L2 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="mb-1 text-sm font-semibold">Email</h4>
                            <p class="text-sm text-gray-600">info@fitzone.com<br>soporte@fitzone.com</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-blue-100">
                            <svg class="h-6 w-6 text-blue-600" viewBox="0 0 24 24" fill="none" aria-hidden="true" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="2"/>
                                <path d="M12 7v5l3 2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="mb-1 text-sm font-semibold">Horario</h4>
                            <p class="text-sm text-gray-600">
                                Lun - Vie: 6:00 - 23:00<br>
                                Sab: 8:00 - 21:00<br>
                                Dom: 9:00 - 15:00
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <h3 class="mb-6 text-lg font-semibold">Envianos un mensaje</h3>
                @if (session('status'))
                    <div class="rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800">
                        {{ session('status') }}
                    </div>
                @endif
                <form class="space-y-4" action="/contacto" method="post">
                    @csrf
                    <div>
                        <label class="mb-2 block text-sm font-medium text-gray-700" for="nombre">Nombre</label>
                        <input class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-600 focus:ring-2 focus:ring-blue-600" id="nombre" name="nombre" type="text" required>
                    </div>
                    <div>
                        <label class="mb-2 block text-sm font-medium text-gray-700" for="email">Email</label>
                        <input class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-600 focus:ring-2 focus:ring-blue-600" id="email" name="email" type="email" required>
                    </div>
                    <div>
                        <label class="mb-2 block text-sm font-medium text-gray-700" for="telefono">Telefono</label>
                        <input class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-600 focus:ring-2 focus:ring-blue-600" id="telefono" name="telefono" type="tel">
                    </div>
                    <div>
                        <label class="mb-2 block text-sm font-medium text-gray-700" for="mensaje">Mensaje</label>
                        <textarea class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-600 focus:ring-2 focus:ring-blue-600" id="mensaje" name="mensaje" rows="5" required></textarea>
                    </div>
                    <button class="w-full rounded-lg bg-blue-600 py-3 font-semibold text-white transition hover:bg-blue-700" type="submit">
                        Enviar mensaje
                    </button>
                </form>
            </div>
        </div>
    </section>
@endsection

@section('footer')
    @include('partials.public-footer')
@endsection
