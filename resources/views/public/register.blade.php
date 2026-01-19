@extends('layouts.app')

@section('header')
    @include('partials.public-header')
@endsection

@section('content')
    <section class="min-h-screen bg-gray-50" style="padding-top: 110px; padding-bottom: 110px;">
        <div class="mx-auto w-full max-w-4xl px-6 pb-16">
            <div class="mb-8">
                <p class="mt-2 text-3xl font-semibold text-gray-900">Hazte socio</p>
                <p class="text-sm mt-2 font-semibold text-gray-900">Completa el formulario y nos pondremos en contacto contigo</p>
            </div>

            @if (session('status'))
                <div class="mb-4 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-900">
                    {!! nl2br(e(session('status'))) !!}
                </div>
            @endif

            <div class="rounded-2xl border border-gray-100 bg-white p-8 shadow-sm">
                <form class="space-y-6" method="POST" action="{{ route('register.attempt') }}">
                    @csrf
                    <div class="grid gap-6 md:grid-cols-2">
                        <div>
                            <label class="mb-2 block text-sm font-medium text-gray-700" for="nombre">Nombre *</label>
                            <input class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-600 focus:ring-2 focus:ring-blue-600" id="nombre" name="nombre" type="text" value="{{ old('nombre') }}" required>
                            @error('nombre')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="mb-2 block text-sm font-medium text-gray-700" for="apellidos">Apellidos *</label>
                            <input class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-600 focus:ring-2 focus:ring-blue-600" id="apellidos" name="apellidos" type="text" value="{{ old('apellidos') }}" required>
                            @error('apellidos')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="mb-2 block text-sm font-medium text-gray-700" for="email">Email *</label>
                            <input class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-600 focus:ring-2 focus:ring-blue-600" id="email" name="email" type="email" value="{{ old('email') }}" required>
                            @error('email')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="mb-2 block text-sm font-medium text-gray-700" for="password">Contrasena *</label>
                            <input class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-600 focus:ring-2 focus:ring-blue-600" id="password" name="password" type="password" required>
                            @error('password')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="mb-2 block text-sm font-medium text-gray-700" for="telefono">Telefono *</label>
                            <input class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-600 focus:ring-2 focus:ring-blue-600" id="telefono" name="telefono" type="tel" value="{{ old('telefono') }}" required>
                            @error('telefono')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="mb-2 block text-sm font-medium text-gray-700" for="password_confirmation">Confirmar contrasena *</label>
                            <input class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-600 focus:ring-2 focus:ring-blue-600" id="password_confirmation" name="password_confirmation" type="password" required>
                            @error('password_confirmation')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="mb-2 block text-sm font-medium text-gray-700" for="dni">DNI/NIE *</label>
                            <input class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-600 focus:ring-2 focus:ring-blue-600" id="dni" name="dni" type="text" value="{{ old('dni') }}" required>
                            @error('dni')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="mb-2 block text-sm font-medium text-gray-700" for="fecha_nacimiento">Fecha de nacimiento *</label>
                            <input class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-600 focus:ring-2 focus:ring-blue-600" id="fecha_nacimiento" name="fecha_nacimiento" type="date" value="{{ old('fecha_nacimiento') }}" required>
                            @error('fecha_nacimiento')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-medium text-gray-700" for="direccion">Direccion *</label>
                        <input class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-600 focus:ring-2 focus:ring-blue-600" id="direccion" name="direccion" type="text" value="{{ old('direccion') }}" required>
                        @error('direccion')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid gap-6 md:grid-cols-2">
                        <div>
                            <label class="mb-2 block text-sm font-medium text-gray-700" for="ciudad">Ciudad *</label>
                            <input class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-600 focus:ring-2 focus:ring-blue-600" id="ciudad" name="ciudad" type="text" value="{{ old('ciudad') }}" required>
                            @error('ciudad')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="mb-2 block text-sm font-medium text-gray-700" for="codigo_postal">Codigo postal *</label>
                            <input class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-600 focus:ring-2 focus:ring-blue-600" id="codigo_postal" name="codigo_postal" type="text" value="{{ old('codigo_postal') }}" required>
                            @error('codigo_postal')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-medium text-gray-700" for="plan_id">Plan *</label>
                        <select class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-600 focus:ring-2 focus:ring-blue-600" id="plan_id" name="plan_id" required>
                            <option value="" disabled {{ old('plan_id') ? '' : 'selected' }}>Selecciona un plan</option>
                            @foreach ($planes as $plan)
                                <option value="{{ $plan->id }}" {{ old('plan_id') == $plan->id ? 'selected' : '' }}>
                                    {{ $plan->nombre }} - {{ number_format($plan->precio_mensual, 2) }} EUR/mes
                                </option>
                            @endforeach
                        </select>
                        @error('plan_id')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="rounded-xl border border-blue-200 bg-blue-50 px-4 py-3 text-sm text-blue-900">
                        Tu solicitud sera revisada por nuestro equipo. Te contactaremos por email en un plazo maximo de 48 horas para confirmar tu alta como socio.
                    </div>

                    <button class="w-full rounded-xl bg-blue-600 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700" type="submit">
                        Enviar solicitud
                    </button>
                </form>
            </div>
        </div>
    </section>
@endsection
