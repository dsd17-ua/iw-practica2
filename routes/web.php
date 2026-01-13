<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

Route::get('/', function () {
    if (Auth::check()) {
        $user = Auth::user();
        if ($user->rol === 'socio') {
            return redirect()->route('socio.dashboard');
        } elseif ($user->rol === 'webmaster') {
            return redirect()->route('webmaster.dashboard');
        } elseif ($user->rol === 'monitor') {
            return redirect()->route('monitor.dashboard');
        }
    }
    return view('public.inicio');
})->name('inicio');

Route::get('/actividades', function () {
    $actividades = DB::table('actividades')->orderBy('nombre')->get();
    return view('public.actividades', compact('actividades'));
})->name('actividades');

Route::get('/tarifas', function () {
    $planes = DB::table('planes')->orderBy('precio_mensual')->get();
    return view('public.tarifas', compact('planes'));
})->name('tarifas');

Route::get('/contacto', function () {
    return view('public.contacto');
})->name('contacto');

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
})->name('contacto.submit');

Route::get('/login', function () {
    return view('public.login');
})->name('login');

Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        return redirect()->intended('/');
    }

    return back()
        ->withErrors(['email' => 'Credenciales incorrectas.'])
        ->onlyInput('email');
})->name('login.attempt');

Route::post('/logout', function (Request $request) {
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/');
})->name('logout');

// Rutas del socio
Route::get('/socio/dashboard', function () {
    return view('socio.dashboard');
})->name('socio.dashboard')->middleware('auth', 'role:socio');