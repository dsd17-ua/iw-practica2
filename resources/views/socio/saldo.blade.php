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
                <a href="{{ route('socio.saldo') }}" class="flex w-full items-center gap-3 rounded-lg bg-blue-50 px-3 py-2 text-blue-700">
                    <span class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-blue-100 text-blue-700">
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
        <div class="flex-1 space-y-6" style="padding-top: 1rem;">
            <div>
                <h1 class="text-2xl font-semibold text-gray-900">Gestión de Saldo</h1>
                <p class="mt-2 text-sm text-gray-600">Recarga tu saldo para reservar actividades</p>
                @if (session('error'))
                    <div class="mt-4 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                        {{ session('error') }}
                    </div>
                @endif
            </div>

            <div class="flex flex-col gap-6 lg:flex-row">
                <div class="w-full flex-1 space-y-6">
                    <div class="rounded-2xl bg-gradient-to-r from-blue-600 to-blue-500 p-6 text-white shadow-sm" style="background-color: blue;">
                        <div class="flex items-start justify-between bg-blue-700 rounded-2xl p-6">
                            <div>
                                <p class="text-sm text-blue-100">Saldo Disponible</p>
                                <p class="mt-6 text-2xl font-semibold">{{ $saldo }}€</p>
                            </div>
                            <span class="inline-flex h-8 w-10 items-center justify-center rounded-lg bg-white/10">
                                <svg class="h-4 w-6" viewBox="0 0 24 16" fill="none" aria-hidden="true" xmlns="http://www.w3.org/2000/svg">
                                    <rect x="1" y="2" width="22" height="13" rx="2" stroke="currentColor" stroke-width="1.5"/>
                                    <path d="M1 6h22" stroke="currentColor" stroke-width="1.5"/>
                                </svg>
                            </span>
                        </div>
                    </div>

                    <div class="rounded-2xl border border-blue-200 bg-blue-50/70 p-6" style="background-color: #e3f5ff;">
                        <p class="text-sm font-semibold text-gray-900">Información</p>
                        <ul class="mt-3 space-y-2 text-sm text-gray-700">
                            <li class="flex gap-2">
                                <span class="mt-2 inline-block h-1.5 w-1.5 rounded-full bg-blue-400"></span>
                                El saldo se descuenta automáticamente al reservar actividades
                            </li>
                            <li class="flex gap-2">
                                <span class="mt-2 inline-block h-1.5 w-1.5 rounded-full bg-blue-400"></span>
                                Si cancelas una reserva, el saldo se reembolsa
                            </li>
                            <li class="flex gap-2">
                                <span class="mt-2 inline-block h-1.5 w-1.5 rounded-full bg-blue-400"></span>
                                Las recargas se procesan mediante TPVV seguro
                            </li>
                            <li class="flex gap-2">
                                <span class="mt-2 inline-block h-1.5 w-1.5 rounded-full bg-blue-400"></span>
                                El saldo no tiene fecha de caducidad
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="w-full flex-1 rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
                    <h2 class="text-base font-semibold text-gray-900">Recargar Saldo</h2>
                    <form method="POST" action="{{ route('socio.saldo.recargar') }}" class="mt-4 grid grid-cols-2 gap-4">
                        @csrf
                        <button type="submit" name="monto" value="10" class="rounded-xl border border-gray-200 px-12 py-6 text-center shadow-sm hover:border-blue-200 hover:bg-blue-50/40" style="background-color: #f1f1f1;">
                            <p class="text-base font-semibold text-gray-900">10€</p>
                            <p class="mt-1 text-xs text-gray-500">Recarga rápida</p>
                        </button>
                        <button type="submit" name="monto" value="20" class="rounded-xl border border-gray-200 px-12 py-6 text-center shadow-sm hover:border-blue-200 hover:bg-blue-50/40" style="background-color: #f1f1f1;">
                            <p class="text-base font-semibold text-gray-900">20€</p>
                            <p class="mt-1 text-xs text-gray-500">Recarga rápida</p>
                        </button>
                        <button type="submit" name="monto" value="50" class="rounded-xl border border-gray-200 px-12 py-6 text-center shadow-sm hover:border-blue-200 hover:bg-blue-50/40" style="background-color: #f1f1f1;">
                            <p class="text-base font-semibold text-gray-900">50€</p>
                            <p class="mt-1 text-xs text-gray-500">Recarga rápida</p>
                        </button>
                        <button type="submit" name="monto" value="100" class="rounded-xl border border-gray-200 px-12 py-6 text-center shadow-sm hover:border-blue-200 hover:bg-blue-50/40" style="background-color: #f1f1f1;">
                            <p class="text-base font-semibold text-gray-900">100€</p>
                            <p class="mt-1 text-xs text-gray-500">Recarga rápida</p>
                        </button>
                    </form>

                    <div class="mt-6 border-t border-gray-200 pt-5">
                        <p class="text-sm font-medium text-gray-700">Cantidad personalizada</p>
                        <form method="POST" action="{{ route('socio.saldo.recargar') }}" class="mt-3 flex items-center gap-3">
                            @csrf
                            <input type="number" name="monto" min="1" step="1" inputmode="numeric" placeholder="Cantidad en €" class="h-12 w-full rounded-lg border border-gray-300 px-8 text-sm text-gray-700 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                            <button type="submit" class="h-12 rounded-lg bg-blue-600 px-10 text-sm font-semibold text-white shadow-sm hover:bg-blue-700" style="padding-left: 0.5rem; padding-right: 0.5rem;">Recargar</button>
                        </form>
                        @error('monto')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-5 rounded-xl bg-gray-50 px-4 py-3">
                        <div class="flex items-center gap-3 text-sm text-gray-700">
                            <svg class="h-4 w-5 text-gray-500" viewBox="0 0 24 16" fill="none" aria-hidden="true" xmlns="http://www.w3.org/2000/svg">
                                <rect x="1" y="2" width="22" height="13" rx="2" stroke="currentColor" stroke-width="1.5"/>
                                <path d="M1 6h22" stroke="currentColor" stroke-width="1.5"/>
                            </svg>
                            Pago seguro mediante TPVV
                        </div>
                    </div>
                </div>
            </div>

            <section class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <h2 class="text-base font-semibold text-gray-900">Historial de transacciones</h2>
                </div>
                <div class="mt-4 overflow-x-auto">
                    <table class="w-full text-left text-sm text-gray-700">
                        <thead class="text-xs uppercase text-gray-500">
                            <tr class="border-b border-gray-200">
                                <th class="py-3 pr-4 font-semibold">Fecha</th>
                                <th class="py-3 pr-4 font-semibold">Tipo</th>
                                <th class="py-3 pr-4 font-semibold">Concepto</th>
                                <th class="py-3 text-right font-semibold">Monto</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($transacciones as $transaccion)
                                <tr class="hover:bg-gray-50/60">
                                    <td class="py-3 pr-4">{{ \Carbon\Carbon::parse($transaccion->fecha)->format('H:i:s d/m/Y') }}</td>
                                    <td class="py-3 pr-4">{{ $transaccion->tipo }}</td>
                                    <td class="py-3 pr-4">{{ $transaccion->concepto ?? '-' }}</td>
                                    <td class="py-3 text-right font-semibold {{ $transaccion->monto < 0 ? 'text-red-600' : 'text-green-600' }}">
                                        {{ number_format($transaccion->monto, 2, '.', '') }}€
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-6 text-center text-sm text-gray-500">Sin transacciones registradas.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection


