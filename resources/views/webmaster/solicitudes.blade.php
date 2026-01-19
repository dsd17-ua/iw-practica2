{{--
 * resources/views/webmaster/solicitudes.blade.php
--}}
@extends('layouts.app')
@section('header')
    @include('partials.private-header')
@endsection

@section('content')
<div class="min-h-screen bg-gray-50" style="padding-top: 3rem;">
    @if(session('success'))
        <script>alert("{{ session('success') }}");</script>
    @endif
    @if(session('error'))
        <script>alert("{{ session('error') }}");</script>
    @endif

    <div class="mx-auto flex w-full max-w-full gap-6 px-1 py-6 md:px-2">
        <!-- Sidebar (igual que dashboard) -->
        <aside class="w-full max-w-xs rounded-xl border border-gray-200 bg-white p-4 shadow-sm">
            <nav class="space-y-2 text-sm text-gray-700">
                <a href="{{ route('webmaster.dashboard') }}" class="flex w-full items-center gap-3 rounded-lg px-3 py-2 hover:bg-gray-100">
                    <span class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-gray-100 text-gray-700">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none"><rect x="3" y="3" width="7" height="7" rx="1" stroke="currentColor" stroke-width="2"/><rect x="14" y="3" width="7" height="7" rx="1" stroke="currentColor" stroke-width="2"/><rect x="3" y="14" width="7" height="7" rx="1" stroke="currentColor" stroke-width="2"/><rect x="14" y="14" width="7" height="7" rx="1" stroke="currentColor" stroke-width="2"/></svg>
                    </span>
                    Dashboard
                </a>
                <a href="{{ route('webmaster.solicitudes') }}" class="flex w-full items-center gap-3 rounded-lg bg-blue-50 px-3 py-2 text-blue-700">
                    <span class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-blue-100 text-blue-700">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none"><path d="M9 12h6M9 16h6M17 21H7a2 2 0 01-2-2V5a2 2 0 012-2h10a2 2 0 012 2v14a2 2 0 01-2 2z" stroke="currentColor" stroke-width="2"/></svg>
                    </span>
                    Solicitudes
                </a>
                <a href="{{ route('webmaster.socios') }}" class="flex w-full items-center gap-3 rounded-lg px-3 py-2 hover:bg-gray-100">
                    <span class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-gray-100 text-gray-700">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none"><circle cx="8" cy="8" r="3" stroke="currentColor" stroke-width="2"/><path d="M2 20a6 6 0 0112 0M17 11a2 2 0 100-4 2 2 0 000 4zM15 20a4 4 0 017 0" stroke="currentColor" stroke-width="2"/></svg>
                    </span>
                    Socios
                </a>
                <a href="{{ route('webmaster.actividades') }}" class="flex w-full items-center gap-3 rounded-lg px-3 py-2 hover:bg-gray-100">
                    <span class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-gray-100 text-gray-700">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none"><path d="M13 2L3 14h8l-1 8 10-12h-8l1-8z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/></svg>
                    </span>
                    Actividades
                </a>
                <a href="{{ route('webmaster.clases') }}" class="flex w-full items-center gap-3 rounded-lg px-3 py-2 hover:bg-gray-100">
                    <span class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-gray-100 text-gray-700">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none"><rect x="3" y="4" width="18" height="17" rx="2" stroke="currentColor" stroke-width="2"/><path d="M8 2v4M16 2v4M3 10h18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                    </span>
                    Clases
                </a>
                <a href="{{ route('webmaster.informes.instalaciones') }}" class="flex w-full items-center gap-3 rounded-lg px-3 py-2 hover:bg-gray-100">
                    <span class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-gray-100 text-gray-700">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none"><path d="M3 3v16a2 2 0 002 2h16" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><path d="M7 16l4-8 4 4 4-12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                    </span>
                    Informes
                </a>
            </nav>
        </aside>

        <!-- Contenido -->
        <div class="flex-1 space-y-6" style="padding-top: 1rem;">
            <div>
                <h1 class="text-2xl font-semibold text-gray-900">Solicitudes de Socio</h1>
                <p class="mt-2 text-sm text-gray-600">Gestiona las solicitudes pendientes de aprobación</p>
            </div>

            @if($solicitudes->count() > 0)
                <div class="rounded-2xl border border-gray-200 bg-white shadow-sm overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead class="bg-gray-50 border-b border-gray-200">
                                <tr>
                                    <th class="px-6 py-3 text-left font-medium text-gray-700">Nombre</th>
                                    <th class="px-6 py-3 text-left font-medium text-gray-700">Email</th>
                                    <th class="px-6 py-3 text-left font-medium text-gray-700">Teléfono</th>
                                    <th class="px-6 py-3 text-left font-medium text-gray-700">Plan</th>
                                    <th class="px-6 py-3 text-left font-medium text-gray-700">Fecha</th>
                                    <th class="px-6 py-3 text-right font-medium text-gray-700">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach($solicitudes as $solicitud)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4">
                                            <p class="font-medium text-gray-900">{{ $solicitud->nombre }} {{ $solicitud->apellidos }}</p>
                                            <p class="text-xs text-gray-500">DNI: {{ $solicitud->dni }}</p>
                                        </td>
                                        <td class="px-6 py-4 text-gray-700">{{ $solicitud->email }}</td>
                                        <td class="px-6 py-4 text-gray-700">{{ $solicitud->telefono }}</td>
                                        <td class="px-6 py-4">
                                            <span class="inline-flex rounded-full bg-blue-100 px-3 py-1 text-xs font-medium text-blue-700">
                                                {{ $solicitud->plan->nombre ?? 'N/A' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-gray-700">{{ $solicitud->created_at->format('d/m/Y') }}</td>
                                        <td class="px-6 py-4 text-right">
                                            <div class="flex justify-end gap-2">
                                                <form method="POST" action="{{ route('webmaster.solicitudes.aprobar', $solicitud->id) }}" class="inline">
                                                    @csrf
                                                    <button type="submit" onclick="return confirm('¿Aprobar esta solicitud?')" class="rounded-lg bg-green-600 px-3 py-1.5 text-xs font-semibold text-white hover:bg-green-700">
                                                        Aprobar
                                                    </button>
                                                </form>
                                                <form method="POST" action="{{ route('webmaster.solicitudes.rechazar', $solicitud->id) }}" class="inline">
                                                    @csrf
                                                    <button type="submit" onclick="return confirm('¿Rechazar esta solicitud?')" class="rounded-lg bg-red-600 px-3 py-1.5 text-xs font-semibold text-white hover:bg-red-700">
                                                        Rechazar
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="border-t border-gray-200 px-6 py-4">
                        {{ $solicitudes->links() }}
                    </div>
                </div>
            @else
                <div class="rounded-2xl border border-gray-200 bg-white p-12 text-center shadow-sm">
                    <svg class="mx-auto h-12 w-12 text-gray-400" viewBox="0 0 24 24" fill="none">
                        <path d="M9 12h6M9 16h6M17 21H7a2 2 0 01-2-2V5a2 2 0 012-2h10a2 2 0 012 2v14a2 2 0 01-2 2z" stroke="currentColor" stroke-width="2"/>
                    </svg>
                    <p class="mt-4 text-sm font-medium text-gray-900">No hay solicitudes pendientes</p>
                    <p class="mt-1 text-sm text-gray-500">Todas las solicitudes han sido procesadas</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
