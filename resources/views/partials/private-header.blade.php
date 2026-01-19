<header class="bg-white/95 shadow-sm backdrop-blur" style="position: fixed; top: 0; left: 0; right: 0; z-index: 9999; background-color: #ffffff;">
    <div class="mx-auto flex w-full max-w-7xl flex-wrap items-center gap-6 px-6 py-4">
        <div class="flex items-center">
            <a href="/" class="flex items-center gap-2">
                <span class="inline-flex h-9 w-9 items-center justify-center rounded-full bg-blue-600/10 text-blue-600">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6 10h12M4 10v4M20 10v4M8 14h8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span>
                <span class="text-base font-semibold text-black">FitZone Gym - {{ ucfirst(Auth::user()->rol) }}</span>
            </a>
        </div>

        <nav class="flex flex-1 justify-center">
        </nav>

        <div class="flex items-center justify-end gap-3">
            @if(Auth::user()->rol === 'socio')
                <span class="text-sm font-medium text-gray-600">Saldo: {{ Auth::user()->saldo_actual }} €</span>
            @endif
            <span class="inline-flex items-center gap-1 rounded-full bg-gray-100/50 px-3 py-1 text-sm font-medium text-gray-700">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" aria-hidden="true" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" fill="currentColor"/>
                </svg>
                {{ Auth::user()->nombre }}
            </span>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="rounded-full bg-gray-100 px-4 py-2 text-sm font-semibold text-gray-700 transition hover:bg-gray-200">Cerrar sesión</button>
            </form>
        </div>
    </div>
</header>
