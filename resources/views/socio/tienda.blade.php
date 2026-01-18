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
                <a href="{{ route('socio.saldo') }}" class="flex w-full items-center gap-3 rounded-lg px-3 py-2 hover:bg-gray-100">
                    <span class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-gray-100 text-gray-700">
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
                <a href="{{ route('socio.tienda') }}" class="flex w-full items-center gap-3 rounded-lg bg-blue-50 px-3 py-2 text-blue-700">
                    <span class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-blue-100 text-blue-700">
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

        <section class="flex-1">
            <div class="rounded-xl bg-white p-6 shadow-sm">
                <div class="flex flex-col gap-2">
                    <h1 class="text-2xl font-semibold text-gray-900">Tienda FitZone</h1>
                    <p class="text-sm text-gray-500">Productos y accesorios para mejorar tu entrenamiento</p>
                </div>

                @if (!empty($tiendaError))
                    <div class="mt-4 rounded-xl border border-amber-200 bg-amber-50 px-4 py-3 text-sm text-amber-700">
                        {{ $tiendaError }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="mt-4 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                        {{ session('error') }}
                    </div>
                @endif
                @if (session('success'))
                    <div class="mt-4 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="mt-6 rounded-2xl border border-gray-100 bg-white p-4 shadow-sm">
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div>
                            <label for="producto-busqueda" class="text-sm font-semibold text-gray-700">Buscar productos</label>
                            <div class="mt-2 flex items-center gap-2 rounded-xl border border-gray-200 bg-white px-3 py-2">
                                <svg class="h-4 w-4 text-gray-400" viewBox="0 0 24 24" fill="none" aria-hidden="true" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="11" cy="11" r="7" stroke="currentColor" stroke-width="2"/>
                                    <path d="M20 20l-3.5-3.5" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                </svg>
                                <input id="producto-busqueda" type="text" class="w-full bg-transparent text-sm text-gray-700 placeholder:text-gray-400 focus:outline-none" placeholder="Buscar por nombre...">
                            </div>
                        </div>
                        <div>
                            <label for="producto-categoria" class="text-sm font-semibold text-gray-700">Categoria</label>
                            <div class="mt-2 flex items-center gap-2 rounded-xl border border-gray-200 bg-white px-3 py-2">
                                <svg class="h-4 w-4 text-gray-400" viewBox="0 0 24 24" fill="none" aria-hidden="true" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4 6h16l-6 7v5l-4-2v-3l-6-7z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                                </svg>
                                <select id="producto-categoria" class="w-full bg-transparent text-sm text-gray-700 focus:outline-none">
                                    <option value="todas">Todas</option>
                                    @forelse ($categorias as $categoria)
                                        @php
                                            $categoriaNombre = data_get($categoria, 'nombre') ?? data_get($categoria, 'name') ?? 'Categoria';
                                            $subcategorias = data_get($categoria, 'subcategorias', []);
                                        @endphp
                                        <option value="{{ $categoriaNombre }}">{{ $categoriaNombre }}</option>
                                        @foreach ($subcategorias as $subcategoria)
                                            @php
                                                $subNombre = data_get($subcategoria, 'nombre') ?? data_get($subcategoria, 'name');
                                            @endphp
                                            @if ($subNombre)
                                                <option value="{{ $subNombre }}">- {{ $subNombre }}</option>
                                            @endif
                                        @endforeach
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-5 text-sm text-gray-600">
                    <span id="productos-count">Mostrando {{ is_countable($productos) ? count($productos) : 0 }} productos</span>
                </div>

                <div id="productos-grid" class="mt-4 grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-3">
                    @forelse ($productos as $producto)
                        @php
                            $nombre = data_get($producto, 'nombre') ?? data_get($producto, 'name') ?? 'Producto';
                            $descripcion = data_get($producto, 'descripcionCorta')
                                ?? data_get($producto, 'descripcionLarga')
                                ?? data_get($producto, 'descripcion')
                                ?? '';
                            $marca = data_get($producto, 'marca') ?? data_get($producto, 'brand') ?? 'Sin marca';
                            $precio = data_get($producto, 'precio');
                            $precioOferta = data_get($producto, 'precioOferta');
                            $genero = data_get($producto, 'genero') ?? data_get($producto, 'gender');
                            $media = data_get($producto, 'media', []);
                            $principal = collect($media)->firstWhere('esPrincipal', true);
                            $imagen = data_get($principal, 'url')
                                ?? data_get($media[0] ?? null, 'url')
                                ?? data_get($producto, 'imagen')
                                ?? data_get($producto, 'imagen_url')
                                ?? data_get($producto, 'image')
                                ?? data_get($producto, 'image_url');
                            $categoriasLista = collect(data_get($producto, 'categorias', []))
                                ->pluck('nombre')
                                ->filter()
                                ->values()
                                ->all();
                            if (empty($categoriasLista)) {
                                $categoriasLista = array_filter([
                                    data_get($producto, 'categoria'),
                                    data_get($producto, 'categoria_nombre'),
                                    data_get($producto, 'categoriaNombre'),
                                    data_get($producto, 'subcategoria'),
                                    data_get($producto, 'subcategoria_nombre'),
                                    data_get($producto, 'subcategoriaNombre'),
                                ]);
                            }
                            $categoriaLabel = $categoriasLista[0] ?? 'General';
                            $categoriaFiltro = count($categoriasLista)
                                ? implode(' / ', array_unique($categoriasLista))
                                : $categoriaLabel;
                        @endphp
                        <article class="producto-card flex h-full flex-col overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm"
                            data-name="{{ $nombre }}"
                            data-description="{{ $descripcion }}"
                            data-category="{{ $categoriaFiltro }}">
                            <div class="relative h-40 w-full overflow-hidden bg-gray-100">
                                @if ($imagen)
                                    <img src="{{ $imagen }}" alt="{{ $nombre }}" class="h-full w-full object-cover">
                                @else
                                    <div class="flex h-full w-full items-center justify-center bg-gradient-to-br from-gray-100 via-gray-200 to-gray-300">
                                        <svg class="h-10 w-10 text-gray-400" viewBox="0 0 24 24" fill="none" aria-hidden="true" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M6 7h12l-1 12H7L6 7z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                                            <path d="M9 7V5a3 3 0 0 1 6 0v2" stroke="currentColor" stroke-width="2"/>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <div class="flex h-full flex-col p-4">
                                <span class="text-xs font-semibold uppercase tracking-wide text-blue-600">{{ $categoriaLabel }}</span>
                                <h3 class="mt-2 text-lg font-semibold text-gray-900">{{ $nombre }}</h3>
                                <p class="mt-2 text-sm text-gray-500">{{ $descripcion ?: 'Sin descripcion disponible.' }}</p>
                                <div class="mt-4 flex flex-wrap items-center justify-between gap-2 text-sm text-gray-600">
                                    <span>Marca: {{ $marca }}</span>
                                </div>
                                <div class="mt-4 flex flex-wrap items-center justify-between gap-2">
                                    @if ($precioOferta !== null && $precio !== null)
                                        <div class="flex items-baseline gap-2">
                                            <span class="text-sm text-gray-400 line-through">
                                                {{ number_format((float) $precio, 2, ',', '.') }} EUR
                                            </span>
                                            <span class="text-lg font-semibold text-gray-900">
                                                {{ number_format((float) $precioOferta, 2, ',', '.') }} EUR
                                            </span>
                                        </div>
                                    @elseif ($precio !== null)
                                        <span class="text-lg font-semibold text-gray-900">
                                            {{ number_format((float) $precio, 2, ',', '.') }} EUR
                                        </span>
                                    @else
                                        <span class="text-sm text-gray-500">Precio no disponible</span>
                                    @endif
                                    @if ($genero)
                                        <span class="text-xs text-gray-500">Genero: {{ $genero }}</span>
                                    @endif
                                </div>
                                @if (data_get($producto, 'id'))
                                    <form action="{{ route('socio.tienda.comprar') }}" method="POST" class="mt-4">
                                        @csrf
                                        <input type="hidden" name="producto_id" value="{{ data_get($producto, 'id') }}">
                                        <button type="submit" class="w-full rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700">
                                            Comprar
                                        </button>
                                    </form>
                                @else
                                    <button type="button" disabled class="mt-4 w-full cursor-not-allowed rounded-lg bg-gray-200 px-4 py-2 text-sm font-semibold text-gray-500">
                                        Comprar
                                    </button>
                                @endif
                            </div>
                        </article>
                    @empty
                        <div class="rounded-2xl border border-dashed border-gray-200 bg-white p-8 text-center shadow-sm md:col-span-2 xl:col-span-3">
                            <h2 class="text-lg font-semibold text-gray-900">No hay productos disponibles</h2>
                            <p class="mt-2 text-sm text-gray-500">Vuelve mas tarde para ver el catalogo.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>
    </div>
</div>
<script>
    (function () {
        var buscador = document.getElementById('producto-busqueda');
        var categoria = document.getElementById('producto-categoria');
        var tarjetas = document.querySelectorAll('.producto-card');
        var contador = document.getElementById('productos-count');

        function normalizar(valor) {
            return (valor || '').toString().toLowerCase();
        }

        function aplicarFiltro() {
            var texto = normalizar(buscador.value);
            var categoriaSeleccionada = normalizar(categoria.value);
            var visibles = 0;

            tarjetas.forEach(function (tarjeta) {
                var nombre = normalizar(tarjeta.getAttribute('data-name'));
                var descripcion = normalizar(tarjeta.getAttribute('data-description'));
                var categorias = normalizar(tarjeta.getAttribute('data-category'));
                var coincideTexto = !texto || nombre.includes(texto) || descripcion.includes(texto);
                var coincideCategoria = !categoriaSeleccionada || categoriaSeleccionada === 'todas' || categorias.includes(categoriaSeleccionada);
                var mostrar = coincideTexto && coincideCategoria;

                tarjeta.style.display = mostrar ? '' : 'none';
                if (mostrar) {
                    visibles += 1;
                }
            });

            if (contador) {
                contador.textContent = 'Mostrando ' + visibles + ' productos';
            }
        }

        if (buscador) {
            buscador.addEventListener('input', aplicarFiltro);
        }
        if (categoria) {
            categoria.addEventListener('change', aplicarFiltro);
        }

        aplicarFiltro();
    })();
</script>
@endsection
