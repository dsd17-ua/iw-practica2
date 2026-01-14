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
        // ==========================================
        // 1. SALAS
        // ==========================================
        $salas = [
            ['nombre' => 'Sala Spinning', 'aforo_maximo' => 20],
            ['nombre' => 'Sala Musculación', 'aforo_maximo' => 30],
            ['nombre' => 'Sala Yoga/Pilates', 'aforo_maximo' => 15],
            ['nombre' => 'Sala Polivalente', 'aforo_maximo' => 25], // Nueva
        ];

        $salaIds = [];
        foreach ($salas as $sala) {
            $salaIds[$sala['nombre']] = DB::table('salas')->insertGetId(array_merge($sala, [
                'created_at' => now(), 'updated_at' => now()
            ]));
        }

        // ==========================================
        // 2. ACTIVIDADES
        // ==========================================
        $actividades = [
            ['nombre' => 'Spinning', 'img' => 'https://images.unsplash.com/photo-1625594755684-a73285a64f66?auto=format&fit=crop&w=1200&q=80', 'desc' => 'Cardio intenso en bicicleta.'],
            ['nombre' => 'Musculación', 'img' => 'https://images.unsplash.com/photo-1632077804406-188472f1a810?auto=format&fit=crop&w=1200&q=80', 'desc' => 'Entrenamiento de fuerza.'],
            ['nombre' => 'Crossfit', 'img' => 'https://images.unsplash.com/photo-1639504031765-ca21aecb7252?auto=format&fit=crop&w=1200&q=80', 'desc' => 'Alta intensidad funcional.'],
            ['nombre' => 'Yoga', 'img' => 'https://images.unsplash.com/photo-1616940779493-6958fbd615fe?auto=format&fit=crop&w=1200&q=80', 'desc' => 'Equilibrio y flexibilidad.'],
            ['nombre' => 'Pilates', 'img' => 'https://images.unsplash.com/photo-1518611012118-696072aa579a?auto=format&fit=crop&w=1200&q=80', 'desc' => 'Control postural y fuerza.'],
            ['nombre' => 'Zumba', 'img' => 'https://images.unsplash.com/photo-1524594152303-9fd13543fe6e?auto=format&fit=crop&w=1200&q=80', 'desc' => 'Baile y cardio divertido.'],
        ];

        $actIds = [];
        foreach ($actividades as $act) {
            $actIds[$act['nombre']] = DB::table('actividades')->insertGetId([
                'nombre' => $act['nombre'],
                'descripcion' => $act['desc'],
                'imagen_url' => $act['img'],
                'created_at' => now(), 'updated_at' => now()
            ]);
        }

        // ==========================================
        // 3. USUARIOS (Staff y Socios)
        // ==========================================
        
        // A. Webmaster (en rol usaremos admin)
        DB::table('users')->insert([
            'nombre' => 'Admin Boss',
            'email' => 'admin@admin.com',
            'password' => Hash::make('1234'),
            'rol' => 'admin',
            'estado' => 'activo',
            'created_at' => now(), 'updated_at' => now()
        ]);

        // B. Monitores (Creamos 3 perfiles distintos)
        $monitorAnaId = DB::table('users')->insertGetId([
            'nombre' => 'Ana (Monitora)', 'email' => 'ana@monitor.com', 'password' => Hash::make('1234'),
            'rol' => 'monitor', 'estado' => 'activo', 'created_at' => now(), 'updated_at' => now()
        ]);
        
        $monitorCarlosId = DB::table('users')->insertGetId([
            'nombre' => 'Carlos (Monitor)', 'email' => 'carlos@monitor.com', 'password' => Hash::make('1234'),
            'rol' => 'monitor', 'estado' => 'activo', 'created_at' => now(), 'updated_at' => now()
        ]);

        // C. Socios (Pepe y un grupo de relleno)
        $sociosIds = [];

        // Pepe (Nuestro socio de pruebas)
        $sociosIds[] = DB::table('users')->insertGetId([
            'nombre' => 'Pepe Socio', 'email' => 'pepe@socio.com', 'dni' => '12345678X',
            'password' => Hash::make('1234'), 'rol' => 'socio', 'estado' => 'activo',
            'plan_id' => 1, 'created_at' => now(), 'updated_at' => now()
        ]);

        // Generar 10 socios aleatorios para rellenar las clases
        $nombres = ['Lucía', 'Marcos', 'Elena', 'Javier', 'Sofía', 'Daniel', 'Paula', 'Diego', 'Carmen', 'Roberto'];
        foreach ($nombres as $index => $nombre) {
            $sociosIds[] = DB::table('users')->insertGetId([
                'nombre' => $nombre . ' García',
                'email' => strtolower($nombre) . $index . '@mail.com',
                'dni' => '000000' . $index . 'X',
                'password' => Hash::make('1234'),
                'rol' => 'socio',
                'estado' => 'activo',
                'plan_id' => rand(1, 2), // Asignar planes al azar
                'created_at' => now(), 'updated_at' => now()
            ]);
        }

        // ==========================================
        // 4. GENERACIÓN DE CLASES (Horario)
        // ==========================================
        
        // Helper para crear clases rápido
        $crearClase = function($actId, $salaId, $monitorId, $fechaInicio, $sociosDisponibles) {
            $fechaFin = (clone $fechaInicio)->addHour();
            
            // Si la fecha ya pasó, estado 'finalizada', si no 'programada'
            $estado = $fechaInicio->isPast() ? 'finalizada' : 'programada';

            $claseId = DB::table('clases')->insertGetId([
                'actividad_id' => $actId,
                'sala_id' => $salaId,
                'monitor_id' => $monitorId,
                'fecha_inicio' => $fechaInicio,
                'fecha_fin' => $fechaFin,
                'plazas_totales' => 20,
                'estado' => $estado,
                'created_at' => now(), 'updated_at' => now()
            ]);

            // Crear reservas aleatorias (entre 5 y 15 personas)
            $numAsistentes = rand(5, 15);
            $asistentes = collect($sociosDisponibles)->random(min($numAsistentes, count($sociosDisponibles)));

            foreach ($asistentes as $socioId) {
                DB::table('reservas')->insert([
                    'user_id' => $socioId,
                    'clase_id' => $claseId,
                    'fecha_reserva' => now(),
                    'estado' => 'confirmada',
                    'created_at' => now(), 'updated_at' => now()
                ]);
            }
        };

        // --- A. Clases del PASADO (Histórico) ---
        // Hace 2 días
        $crearClase($actIds['Spinning'], $salaIds['Sala Spinning'], $monitorAnaId, Carbon::now()->subDays(2)->setHour(10), $sociosIds);
        $crearClase($actIds['Yoga'], $salaIds['Sala Yoga/Pilates'], $monitorAnaId, Carbon::now()->subDays(2)->setHour(18), $sociosIds);
        // Ayer
        $crearClase($actIds['Crossfit'], $salaIds['Sala Polivalente'], $monitorCarlosId, Carbon::now()->subDays(1)->setHour(19), $sociosIds);

        // --- B. Clases de HOY ---
        // Una por la mañana (ya pasó, pero es hoy)
        $crearClase($actIds['Pilates'], $salaIds['Sala Yoga/Pilates'], $monitorAnaId, Carbon::now()->startOfDay()->setHour(9), $sociosIds);
        
        // Una AHORA MISMO (o casi)
        $crearClase($actIds['Spinning'], $salaIds['Sala Spinning'], $monitorAnaId, Carbon::now()->addMinutes(30), $sociosIds);
        
        // Una por la tarde/noche (Futura hoy)
        $crearClase($actIds['Zumba'], $salaIds['Sala Polivalente'], $monitorAnaId, Carbon::now()->startOfDay()->setHour(20), $sociosIds);

        // --- C. Clases del FUTURO (Calendario) ---
        // Mañana
        $crearClase($actIds['Musculación'], $salaIds['Sala Musculación'], $monitorCarlosId, Carbon::now()->addDay()->setHour(10), $sociosIds);
        $crearClase($actIds['Yoga'], $salaIds['Sala Yoga/Pilates'], $monitorAnaId, Carbon::now()->addDay()->setHour(17), $sociosIds);
        
        // Pasado mañana
        $crearClase($actIds['Spinning'], $salaIds['Sala Spinning'], $monitorAnaId, Carbon::now()->addDays(2)->setHour(18), $sociosIds);
        $crearClase($actIds['Crossfit'], $salaIds['Sala Polivalente'], $monitorCarlosId, Carbon::now()->addDays(2)->setHour(19), $sociosIds);
    }
}