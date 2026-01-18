@extends('layouts.app')

@section('header')
    @include('partials.private-header')
@endsection

@section('content')
<div class="min-h-screen bg-gray-50" style="padding-top: 3rem;">
    <div class="mx-auto w-full max-w-3xl px-4 py-10">
        <div class="rounded-2xl border border-red-200 bg-white p-8 shadow-sm">
            <h1 class="text-2xl font-semibold text-gray-900">Renovacion pendiente</h1>
            <p class="mt-2 text-sm text-gray-600">
                Tu fecha de renovacion ha pasado. Para continuar usando el servicio, recarga tu saldo y renueva tu plan. Son {{ $planActual->precio_mensual }}€.
            </p>
            <div class="mt-6 flex flex-wrap gap-3">
                <a href="{{ route('socio.saldo') }}" class="rounded-xl bg-blue-600 px-5 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-700">
                    Ir a gestion de saldo
                </a>
                <a href="{{ route('socio.perfil') }}" class="rounded-xl border border-gray-200 px-5 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">
                    Ver perfil
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
