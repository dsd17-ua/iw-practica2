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

Route::get('/register', function (Request $request) {
    $planes = DB::table('planes')->orderBy('id')->get();

    return view('public.register', compact('planes'));
})->name('register');

Route::post('/register', function (Request $request) {
    $credentials = $request->validate([
        'nombre' => ['required', 'string', 'max:100'],
        'apellidos' => ['required', 'string', 'max:150'],
        'email' => ['required', 'email', 'max:255', 'unique:users,email'],
        'telefono' => ['required', 'string', 'max:30'],
        'dni' => ['required', 'string', 'max:20', 'unique:users,dni'],
        'fecha_nacimiento' => ['required', 'date'],
        'direccion' => ['required', 'string', 'max:255'],
        'ciudad' => ['required', 'string', 'max:100'],
        'codigo_postal' => ['required', 'string', 'max:20'],
        'plan_id' => ['required', 'exists:planes,id'],
    ]);
    
    DB::table('users')->insert([
        'nombre' => $credentials['nombre'],
        'apellidos' => $credentials['apellidos'],
        'email' => $credentials['email'],
        'telefono' => $credentials['telefono'],
        'dni' => $credentials['dni'],
        'fecha_nacimiento' => $credentials['fecha_nacimiento'],
        'direccion' => $credentials['direccion'],
        'ciudad' => $credentials['ciudad'],
        'codigo_postal' => $credentials['codigo_postal'],
        'password' => bcrypt('1234'),
        'rol' => 'socio',
        'estado' => 'pendiente',
        'plan_id' => $credentials['plan_id'],
        'saldo_actual' => 0.00,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return back()->with('status', 'Hemos recibido tu solicitud para hacerte socio de FitZone Gym. Un administrador revisará tu solicitud y te contactaremos en breve. Recibirás un email de confirmación cuando tu solicitud sea procesada.');
})->name('register.attempt');

// --------------------------------------------------------------------------
// RUTAS PRIVADAS
// --------------------------------------------------------------------------

// Rutas del socio
Route::get('/socio/dashboard', function () {
    return view('socio.dashboard');
})->name('socio.dashboard')->middleware(['auth', 'role:socio']);

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