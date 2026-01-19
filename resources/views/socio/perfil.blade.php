@extends('layouts.app')

@section('header')
    @include('partials.private-header')
@endsection

@section('content')
<div class="min-h-screen bg-gray-50" style="padding-top: 3rem;">
    @php
        $alertMessage = session('success');
        if (!$alertMessage && $errors->any()) {
            $alertMessage = $errors->first();
        }
    @endphp
    @if ($alertMessage)
        <script>
            alert("{{ addslashes($alertMessage) }}");
        </script>
    @endif
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
                <a href="{{ route('socio.perfil') }}" class="flex w-full items-center gap-3 rounded-lg bg-blue-50 px-3 py-2 text-blue-700">
                    <span class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-blue-100 text-blue-700">
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
        <div class="flex-1 space-y-6" style="padding-top: 1rem;">
            <div>
                <h1 class="text-2xl font-semibold text-gray-900">Mi Perfil</h1>
                <p class="mt-2 text-sm text-gray-600">Informacion de tu cuenta de socio</p>
            </div>

            <div class="flex flex-col gap-8 md:flex-row md:items-start">
                <div class="flex-1 space-y-6">
                    <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
                        <h3 class="text-base font-semibold text-gray-900">Datos Personales</h3>

                        <form method="POST" action="{{ route('socio.perfil.update') }}" class="mt-6 space-y-4">
                            @csrf
                            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Nombre</label>
                                    <input type="text" name="nombre" value="{{ old('nombre', $usuario->nombre) }}" class="mt-2 w-full rounded-lg border border-gray-300 px-4 py-2 text-sm text-gray-700 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Apellidos</label>
                                    <input type="text" name="apellidos" value="{{ old('apellidos', $usuario->apellidos ?? '') }}" class="mt-2 w-full rounded-lg border border-gray-300 px-4 py-2 text-sm text-gray-700 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Email</label>
                                    <input type="email" name="email" value="{{ old('email', $usuario->email) }}" class="mt-2 w-full rounded-lg border border-gray-300 px-4 py-2 text-sm text-gray-700 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Telefono</label>
                                    <input type="tel" name="telefono" value="{{ old('telefono', $usuario->telefono ?? '') }}" class="mt-2 w-full rounded-lg border border-gray-300 px-4 py-2 text-sm text-gray-700 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">DNI</label>
                                    <input type="text" value="{{ $usuario->dni ?? '' }}" class="mt-2 w-full rounded-lg border border-gray-300 px-4 py-2 text-sm text-gray-500" disabled>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Direccion</label>
                                    <input type="text" name="direccion" value="{{ old('direccion', $usuario->direccion ?? '') }}" class="mt-2 w-full rounded-lg border border-gray-300 px-4 py-2 text-sm text-gray-700 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                                </div>
                            </div>

                            <button type="submit" class="rounded-lg bg-blue-600 px-6 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-700">Guardar Cambios</button>
                        </form>
                    </div>

                    <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
                        <h3 class="text-base font-semibold text-gray-900">Cambiar Contrasena</h3>

                        <form method="POST" action="{{ route('socio.perfil.password') }}" class="mt-6 space-y-4">
                            @csrf
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Contrasena Actual</label>
                                <input type="password" name="current_password" autocomplete="current-password" class="mt-2 w-full rounded-lg border border-gray-300 px-4 py-2 text-sm text-gray-700 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Nueva Contrasena</label>
                                <input type="password" name="password" autocomplete="new-password" class="mt-2 w-full rounded-lg border border-gray-300 px-4 py-2 text-sm text-gray-700 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Confirmar Nueva Contrasena</label>
                                <input type="password" name="password_confirmation" autocomplete="new-password" class="mt-2 w-full rounded-lg border border-gray-300 px-4 py-2 text-sm text-gray-700 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                            </div>

                            <button type="submit" class="rounded-lg bg-blue-600 px-6 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-700">Actualizar Contrasena</button>
                        </form>
                    </div>
                </div>

                <div class="md:ml-auto md:w-72">
                    @php
                        $estadoClase = $usuario->estado === 'activo'
                            ? 'bg-green-100 text-green-700'
                            : ($usuario->estado === 'bloqueado' ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-700');
                    @endphp
                    <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
                        <h3 class="text-base font-semibold text-gray-900">Mi Membresia</h3>
                        <div class="mt-4 space-y-3 text-sm text-gray-700">
                            <div>
                                <div class="text-xs font-medium text-gray-500">Numero de Socio</div>
                                <div class="text-gray-900">{{ $usuario->numero_socio ?? 'Pendiente' }}</div>
                            </div>
                            <div>
                                <div class="text-xs font-medium text-gray-500">Fecha de Alta</div>
                                <div class="text-gray-900">{{ $usuario->created_at ? $usuario->created_at->format('d M Y') : '-' }}</div>
                            </div>
                            <div>
                                <div class="text-xs font-medium text-gray-500">Proximo Cobro</div>
                                <div class="text-gray-900">{{ $usuario->proxima_renovacion ? \Carbon\Carbon::parse($usuario->proxima_renovacion)->format('d M Y') : '-' }}</div>
                            </div>
                            <div>
                                <div class="text-xs font-medium text-gray-500">Estado</div>
                                <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $estadoClase }}">
                                    {{ ucfirst($usuario->estado ?? 'pendiente') }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
