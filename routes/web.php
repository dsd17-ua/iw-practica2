<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

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

Route::post('/contacto', function (Request $request) {
    $data = $request->validate([
        'nombre' => ['required', 'string', 'max:100'],
        'email' => ['required', 'email', 'max:255'],
        'telefono' => ['nullable', 'string', 'max:30'],
        'mensaje' => ['required', 'string', 'max:1000'],
    ]);

    $body = "\tHola {$data['nombre']}, Hemos recibido tu mensaje:\n\n"
        . "\t\t\"{$data['mensaje']}\"\n\n"
        . "\tActualmente este servicio esta deshabilitado. Cuando se habilite se te contactara. Gracias.";

    Mail::raw($body, function ($message) use ($data) {
        $message->to($data['email'])
            ->subject('Confirmacion de contacto');
    });

    return back()->with('status', 'Hemos recibido el mensaje, en breve nos pondremos en contacto contigo.');
});
