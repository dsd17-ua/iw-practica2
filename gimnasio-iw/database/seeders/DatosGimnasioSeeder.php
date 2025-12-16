<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatosGimnasioSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Salas
        $salaSpinning = DB::table('salas')->insertGetId([
            'nombre' => 'Sala Spinning', 'aforo_maximo' => 20, 'created_at' => now(), 'updated_at' => now()
        ]);

        // 2. Actividades
        $actSpinning = DB::table('actividades')->insertGetId([
            'nombre' => 'Spinning', 'created_at' => now(), 'updated_at' => now()
        ]);

        // 3. Usuarios: Un MONITOR y un SOCIO
        $monitorId = DB::table('users')->insertGetId([
            'nombre' => 'Ana', 'email' => 'ana@monitor.com', 'password' => Hash::make('1234'),
            'rol' => 'monitor', 'estado' => 'activo', 'created_at' => now(), 'updated_at' => now()
        ]);

        // SOCIO DE PRUEBA (Para el endpoint 4.3)
        $socioId = DB::table('users')->insertGetId([
            'nombre' => 'Pepe', 
            'email' => 'pepe@socio.com', // <--- USAREMOS ESTE EMAIL
            'dni' => '12345678X',
            'password' => Hash::make('1234'),
            'rol' => 'socio', 
            'estado' => 'activo',
            'plan_id' => 1, // Asumimos que el plan 1 existe (Plan Básico)
            'created_at' => Carbon::parse('2023-01-01'), // Antigüedad falsa
            'updated_at' => now()
        ]);

        // 4. Clases: Una para HOY AHORA MISMO (Para probar aforo)
        // Calculamos la hora actual y la siguiente
        $inicio = now(); 
        $fin = now()->addHour();

        $claseId = DB::table('clases')->insertGetId([
            'actividad_id' => $actSpinning,
            'sala_id' => $salaSpinning,
            'monitor_id' => $monitorId,
            'fecha_inicio' => $inicio,
            'fecha_fin' => $fin,
            'plazas_totales' => 20,
            'estado' => 'programada',
            'created_at' => now(), 'updated_at' => now()
        ]);

        // Creamos 15 reservas falsas para esa clase (Para que el aforo no de 0)
        for ($i = 0; $i < 15; $i++) {
            DB::table('reservas')->insert([
                'user_id' => $socioId,
                'clase_id' => $claseId,
                'fecha_reserva' => now(),
                'estado' => 'confirmada',
                'created_at' => now(), 'updated_at' => now()
            ]);
        }
    }
}