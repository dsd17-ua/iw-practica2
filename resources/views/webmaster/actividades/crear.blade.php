{{--
 * [POR CONFIRMAR] - resources/views/webmaster/actividades/crear.blade.php
--}}
@extends('layouts.app')
@section('header')
    @include('partials.private-header')
@endsection

@section('content')
<div class="min-h-screen bg-gray-50" style="padding-top: 3rem;">
    @if($errors->any())
        <script>alert("{{ $errors->first() }}");</script>
    @endif

    <div class="mx-auto flex w-full max-w-full gap-6 px-1 py-6 md:px-2">
        <!-- Sidebar -->
        <aside class="w-full max-w-xs rounded-xl border border-gray-200 bg-white p-4 shadow-sm">
            <nav class="space-y-2 text-sm text-gray-700">
                <a href="{{ route('webmaster.dashboard') }}" class="flex w-full items-center gap-3 rounded-lg px-3 py-2 hover:bg-gray-100">
                    <span class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-gray-100 text-gray-700">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none"><rect x="3" y="3" width="7" height="7" rx="1" stroke="currentColor" stroke-width="2"/><rect x="14" y="3" width="7" height="7" rx="1" stroke="currentColor" stroke-width="2"/><rect x="3" y="14" width="7" height="7" rx="1" stroke="currentColor" stroke-width="2"/><rect x="14" y="14" width="7" height="7" rx="1" stroke="currentColor" stroke-width="2"/></svg>
                    </span>
                    Dashboard
                </a>
                <a href="{{ route('webmaster.actividades') }}" class="flex w-full items-center gap-3 rounded-lg bg-blue-50 px-3 py-2 text-blue-700">
                    <span class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-blue-100 text-blue-700">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none"><path d="M13 2L3 14h8l-1 8 10-12h-8l1-8z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/></svg>
                    </span>
                    Actividades
                </a>
            </nav>
        </aside>

        <!-- Contenido -->
        <div class="flex-1" style="padding-top: 1rem;">
            <div class="mb-6">
                <h1 class="text-2xl font-semibold text-gray-900">Nueva Actividad</h1>
                <p class="mt-2 text-sm text-gray-600">Crea una nueva actividad para el gimnasio</p>
            </div>

            <div class="max-w-2xl rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
                <form method="POST" action="{{ route('webmaster.actividades.guardar') }}" class="space-y-6">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nombre de la Actividad</label>
                        <input type="text" name="nombre" value="{{ old('nombre') }}" required class="mt-2 w-full rounded-lg border border-gray-300 px-4 py-2 text-sm text-gray-700 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                        @error('nombre')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Descripción</label>
                        <textarea name="descripcion" rows="4" class="mt-2 w-full rounded-lg border border-gray-300 px-4 py-2 text-sm text-gray-700 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">{{ old('descripcion') }}</textarea>
                        @error('descripcion')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">URL de Imagen (opcional)</label>
                        <input type="url" name="imagen_url" value="{{ old('imagen_url') }}" placeholder="https://ejemplo.com/imagen.jpg" class="mt-2 w-full rounded-lg border border-gray-300 px-4 py-2 text-sm text-gray-700 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                        @error('imagen_url')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex gap-4">
                        <button type="submit" class="rounded-lg bg-blue-600 px-6 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-700">
                            Crear Actividad
                        </button>
                        <a href="{{ route('webmaster.actividades') }}" class="rounded-lg border border-gray-300 px-6 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
