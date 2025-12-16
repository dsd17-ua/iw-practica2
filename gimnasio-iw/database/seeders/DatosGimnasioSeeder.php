<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatosGimnasioSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Crear Salas
        $salaSpinning = DB::table('salas')->insertGetId([
            'nombre' => 'Sala de Spinning',
            'aforo_maximo' => 20,
            'created_at' => now(), 'updated_at' => now()
        ]);

        $salaYoga = DB::table('salas')->insertGetId([
            'nombre' => 'Sala Zen',
            'aforo_maximo' => 15,
            'created_at' => now(), 'updated_at' => now()
        ]);

        // 2. Crear Actividades
        $actSpinning = DB::table('actividades')->insertGetId([
            'nombre' => 'Spinning Intense',
            'descripcion' => 'Cardio de alta intensidad.',
            'created_at' => now(), 'updated_at' => now()
        ]);

        $actYoga = DB::table('actividades')->insertGetId([
            'nombre' => 'Yoga Relax',
            'descripcion' => 'Estiramientos y relajación.',
            'created_at' => now(), 'updated_at' => now()
        ]);

        // 3. Crear un Monitor
        $monitorId = DB::table('users')->insertGetId([
            'nombre' => 'Ana',
            'apellidos' => 'García',
            'email' => 'ana.monitor@fitzone.com',
            'password' => Hash::make('password'),
            'rol' => 'monitor',
            'estado' => 'activo',
            'created_at' => now(), 'updated_at' => now()
        ]);

        // 4. Crear Clases (Sesiones) para HOY y MAÑANA
        // Clase 1: Spinning hoy a las 10:00
        DB::table('clases')->insert([
            'actividad_id' => $actSpinning,
            'sala_id' => $salaSpinning,
            'monitor_id' => $monitorId,
            'fecha_inicio' => now()->format('Y-m-d 10:00:00'),
            'fecha_fin' => now()->format('Y-m-d 11:00:00'),
            'plazas_totales' => 20,
            'coste_extra' => 5.00,
            'estado' => 'programada',
            'created_at' => now(), 'updated_at' => now()
        ]);

        // Clase 2: Yoga mañana a las 18:00
        DB::table('clases')->insert([
            'actividad_id' => $actYoga,
            'sala_id' => $salaYoga,
            'monitor_id' => $monitorId,
            'fecha_inicio' => now()->addDay()->format('Y-m-d 18:00:00'),
            'fecha_fin' => now()->addDay()->format('Y-m-d 19:00:00'),
            'plazas_totales' => 15,
            'coste_extra' => 0.00, // Gratis
            'estado' => 'programada',
            'created_at' => now(), 'updated_at' => now()
        ]);
    }
}