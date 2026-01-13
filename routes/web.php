<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    return view('inicio');
});

Route::get('/actividades', function () {
    $actividades = DB::table('actividades')->orderBy('nombre')->get();
    return view('actividades', compact('actividades'));
});

Route::get('/tarifas', function () {
    $planes = DB::table('planes')->orderBy('precio_mensual')->get();
    return view('tarifas', compact('planes'));
});

Route::get('/contacto', function () {
    return view('contacto');
});
