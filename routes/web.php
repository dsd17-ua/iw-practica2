<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\MonitorController;

Route::get('/', function () {
    if (Auth::check()) {
        $user = Auth::user();
        if ($user->rol === 'socio') {
            return redirect()->route('socio.actividades');
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

// --------------------------------------------------------------------------
// RUTAS PRIVADAS
// --------------------------------------------------------------------------

// Rutas del socio

Route::middleware(['auth', 'role:socio'])->group(function () {
    // 1. Actividades
    Route::get('/socio/actividades', [App\Http\Controllers\SocioController::class, 'getActividades'])->name('socio.actividades');
    
    // 2. Reservas
    Route::get('/socio/reservas', [App\Http\Controllers\SocioController::class, 'getReservas'])->name('socio.reservas');
    Route::post('/socio/reservas/{claseId}/reservar', [App\Http\Controllers\SocioController::class, 'reservarActividad'])->name('socio.reservas.reservar');
    Route::post('/socio/reservas/{reservaId}/cancelar', [App\Http\Controllers\SocioController::class, 'cancelarReserva'])->name('socio.reservas.cancelar');
    
    // 3. Saldo
    Route::get('/socio/saldo', [App\Http\Controllers\SocioController::class, 'getSaldo'])->name('socio.saldo');
    
    // 4. Perfil
    Route::get('/socio/perfil', [App\Http\Controllers\SocioController::class, 'getPerfil'])->name('socio.perfil');
    
    // 5. Tienda
    Route::get('/socio/tienda', [App\Http\Controllers\SocioController::class, 'getTienda'])->name('socio.tienda');
    
    // 6. Plan
    Route::get('/socio/plan', [App\Http\Controllers\SocioController::class, 'getPlan'])->name('socio.plan');
});

// Rutas del webmaster
Route::get('/webmaster/dashboard', function () {
    return view('webmaster.dashboard');
})->name('webmaster.dashboard')->middleware(['auth', 'role:webmaster']);

// Rutas del MONITOR
// Agrupamos todas las rutas del monitor para aplicar el middleware de golpe
Route::middleware(['auth', 'role:monitor'])->group(function () {
    // 1. Calendario (Dashboard)
    Route::get('/monitor/dashboard', [MonitorController::class, 'dashboard'])
        ->name('monitor.dashboard');
    
    // 2. Mis Actividades (Próximas + Detalles)
    Route::get('/monitor/actividades', [MonitorController::class, 'misActividades'])
        ->name('monitor.actividades');
    
    // 3. Histórico (Clases pasadas)
    Route::get('/monitor/historico', [MonitorController::class, 'historico'])
        ->name('monitor.historico');
});