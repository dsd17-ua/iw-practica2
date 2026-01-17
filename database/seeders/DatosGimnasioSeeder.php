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
            ['nombre' => 'Sala Polivalente', 'aforo_maximo' => 25],
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
        
        // A. Webmaster / Admin
        DB::table('users')->insert([
            'nombre' => 'Admin Boss',
            'email' => 'admin@admin.com',
            'password' => Hash::make('1234'),
            'direccion' => 'Avenida Central 100',
            'ciudad' => 'Madrid',
            'codigo_postal' => '28013',
            'rol' => 'webmaster',
            'estado' => 'activo',
            'created_at' => now(), 'updated_at' => now()
        ]);

        // B. Monitores
        $monitorAnaId = DB::table('users')->insertGetId([
            'nombre' => 'Ana (Monitora)', 'email' => 'ana@monitor.com', 'password' => Hash::make('1234'),
            'direccion' => 'Calle del Rio 22',
            'ciudad' => 'Sevilla',
            'codigo_postal' => '41001',
            'rol' => 'monitor', 'estado' => 'activo', 'created_at' => now(), 'updated_at' => now()
        ]);
        
        $monitorCarlosId = DB::table('users')->insertGetId([
            'nombre' => 'Carlos (Monitor)', 'email' => 'carlos@monitor.com', 'password' => Hash::make('1234'),
            'direccion' => 'Plaza Norte 7',
            'ciudad' => 'Valencia',
            'codigo_postal' => '46002',
            'rol' => 'monitor', 'estado' => 'activo', 'created_at' => now(), 'updated_at' => now()
        ]);

        // C. Socios
        $sociosIds = [];

        // Pepe
        $sociosIds[] = DB::table('users')->insertGetId([
            'nombre' => 'Pepe Socio', 'email' => 'pepe@socio.com', 'dni' => '12345678X',
            'password' => Hash::make('1234'), 'rol' => 'socio', 'estado' => 'activo',
            'direccion' => 'Calle Sol 15',
            'ciudad' => 'Granada',
            'codigo_postal' => '18002',
            'numero_socio' => 'FZG-' . substr(hash('sha256', 'pepe@socio.com'), 0, 20),
            'proxima_renovacion' => now()->addMonth(),
            'plan_id' => 1, 'created_at' => now(), 'updated_at' => now()
        ]);

        // 10 socios aleatorios
        $nombres = ['Lucía', 'Marcos', 'Elena', 'Javier', 'Sofía', 'Daniel', 'Paula', 'Diego', 'Carmen', 'Roberto'];
        $direcciones = [
            ['direccion' => 'Calle Luna 3', 'ciudad' => 'Bilbao', 'codigo_postal' => '48001'],
            ['direccion' => 'Avenida Mar 44', 'ciudad' => 'Malaga', 'codigo_postal' => '29001'],
            ['direccion' => 'Calle Norte 18', 'ciudad' => 'Zaragoza', 'codigo_postal' => '50001'],
            ['direccion' => 'Calle Prado 9', 'ciudad' => 'Toledo', 'codigo_postal' => '45001'],
            ['direccion' => 'Avenida Sur 27', 'ciudad' => 'Murcia', 'codigo_postal' => '30001'],
            ['direccion' => 'Calle Olivo 52', 'ciudad' => 'Valladolid', 'codigo_postal' => '47001'],
            ['direccion' => 'Calle Sierra 6', 'ciudad' => 'Santander', 'codigo_postal' => '39001'],
            ['direccion' => 'Plaza Mayor 1', 'ciudad' => 'Salamanca', 'codigo_postal' => '37001'],
            ['direccion' => 'Avenida Lago 31', 'ciudad' => 'Alicante', 'codigo_postal' => '03001'],
            ['direccion' => 'Calle Jardines 12', 'ciudad' => 'Cordoba', 'codigo_postal' => '14001'],
        ];
        foreach ($nombres as $index => $nombre) {
            $sociosIds[] = DB::table('users')->insertGetId([
                'nombre' => $nombre . ' García',
                'email' => strtolower($nombre) . $index . '@mail.com',
                'dni' => '000000' . $index . 'X',
                'password' => Hash::make('1234'),
                'direccion' => $direcciones[$index]['direccion'],
                'ciudad' => $direcciones[$index]['ciudad'],
                'codigo_postal' => $direcciones[$index]['codigo_postal'],
                'rol' => 'socio',
                'estado' => 'activo',
                'plan_id' => rand(1, 2),
                'numero_socio' => 'FZG-' . substr(hash('sha256', strtolower($nombre) . $index . '@mail.com'), 0, 20),
                'proxima_renovacion' => now()->addMonth(),
                'created_at' => now(), 'updated_at' => now()
            ]);
        }

        // Un socio que tiene que renovar (para comprobar pagina de error)
        $sociosIds[] = DB::table('users')->insertGetId([
            'nombre' => 'Laura Vencida', 'email' => 'renovar@mail.com', 'dni' => '87654321Y',
            'password' => Hash::make('1234'), 'rol' => 'socio', 'estado' => 'activo',
            'direccion' => 'Calle Reloj 8',
            'ciudad' => 'Oviedo',
            'codigo_postal' => '33001',
            'numero_socio' => 'FZG-' . substr(hash('sha256', 'renovar@mail.com'), 0, 20),
            'proxima_renovacion' => now()->subDay(),
            'plan_id' => 1, 'created_at' => now(), 'updated_at' => now()
        ]);

        // Un socio bloqueado
        $sociosIds[] = DB::table('users')->insertGetId([
            'nombre' => 'Luis Bloqueado', 'email' => 'bloqueado@mail.com', 'dni' => '12345678Z',
            'password' => Hash::make('1234'), 'rol' => 'socio', 'estado' => 'bloqueado',
            'direccion' => 'Avenida Niebla 5',
            'ciudad' => 'Burgos',
            'codigo_postal' => '09001',
            'numero_socio' => 'FZG-' . substr(hash('sha256', 'bloqueado@mail.com'), 0, 20),
            'proxima_renovacion' => now()->addMonth(),
            'plan_id' => 1, 'created_at' => now(), 'updated_at' => now()
        ]);

        // Un socio pendiente
        $sociosIds[] = DB::table('users')->insertGetId([
            'nombre' => 'Marta Pendiente', 'email' => 'pendiente@mail.com', 'dni' => '23456789A',
            'password' => Hash::make('1234'), 'rol' => 'socio', 'estado' => 'pendiente',
            'direccion' => 'Calle Primavera 10',
            'ciudad' => 'Sevilla',
            'codigo_postal' => '41001',
            'numero_socio' => 'FZG-' . substr(hash('sha256', 'pendiente@mail.com'), 0, 20),
            'proxima_renovacion' => now()->addMonth(),
            'plan_id' => 1, 'created_at' => now(), 'updated_at' => now()
        ]);

        // ==========================================
        // 4. GENERACIÓN DE CLASES (Horario)
        // ==========================================
        
        // Helper para crear clases rápido
        $crearClase = function($actId, $salaId, $monitorId, $fechaInicio, $sociosDisponibles) {
            $fechaFin = (clone $fechaInicio)->addHour();
            $estado = $fechaInicio->isPast() ? 'finalizada' : 'programada';

            $maximoAforo = DB::table('salas')->where('id', $salaId)->value('aforo_maximo');

            $claseId = DB::table('clases')->insertGetId([
                'actividad_id' => $actId,
                'sala_id' => $salaId,
                'monitor_id' => $monitorId,
                'fecha_inicio' => $fechaInicio,
                'fecha_fin' => $fechaFin,
                'plazas_totales' => $maximoAforo,
                'coste_extra' => rand(0, 5) * 1.0,
                'asistencia_actual' => 0,
                'estado' => $estado,
                'created_at' => now(), 'updated_at' => now()
            ]);

            // Crear reservas aleatorias
            $numAsistentes = rand(3, $maximoAforo - 1);
            $asistentes = collect($sociosDisponibles)->random(min($numAsistentes, count($sociosDisponibles)));

            foreach ($asistentes as $socioId) {
                DB::table('reservas')->insert([
                    'user_id' => $socioId,
                    'clase_id' => $claseId,
                    'fecha_reserva' => now(),
                    'estado' => 'confirmada',
                    'created_at' => now(), 'updated_at' => now()
                ]);

                DB::table('clases')
                    ->where('id', $claseId)
                    ->increment('asistencia_actual');
            }
        };

        // --- A. Clases del PASADO (Histórico) ---
        $crearClase($actIds['Spinning'], $salaIds['Sala Spinning'], $monitorAnaId, Carbon::now()->subDays(2)->setHour(10), $sociosIds);
        $crearClase($actIds['Yoga'], $salaIds['Sala Yoga/Pilates'], $monitorAnaId, Carbon::now()->subDays(2)->setHour(18), $sociosIds);
        $crearClase($actIds['Crossfit'], $salaIds['Sala Polivalente'], $monitorCarlosId, Carbon::now()->subDays(1)->setHour(19), $sociosIds);

        // --- B. Clases de HOY ---
        $crearClase($actIds['Pilates'], $salaIds['Sala Yoga/Pilates'], $monitorAnaId, Carbon::now()->startOfDay()->setHour(9), $sociosIds); // Mañana
        $crearClase($actIds['Spinning'], $salaIds['Sala Spinning'], $monitorAnaId, Carbon::now()->addMinutes(30), $sociosIds); // Inminente
        $crearClase($actIds['Zumba'], $salaIds['Sala Polivalente'], $monitorAnaId, Carbon::now()->startOfDay()->setHour(20), $sociosIds); // Tarde

        // --- C. Clases Mañana y Pasado (Cercanas) ---
        $crearClase($actIds['Musculación'], $salaIds['Sala Musculación'], $monitorCarlosId, Carbon::now()->addDay()->setHour(10), $sociosIds);
        $crearClase($actIds['Yoga'], $salaIds['Sala Yoga/Pilates'], $monitorAnaId, Carbon::now()->addDay()->setHour(17), $sociosIds);
        $crearClase($actIds['Spinning'], $salaIds['Sala Spinning'], $monitorAnaId, Carbon::now()->addDays(2)->setHour(18), $sociosIds);
        $crearClase($actIds['Crossfit'], $salaIds['Sala Polivalente'], $monitorCarlosId, Carbon::now()->addDays(2)->setHour(19), $sociosIds);

        // --- D. RUTINA SEMANAL (PRÓXIMAS 4 SEMANAS) ---
        // Generamos clases automáticas para rellenar el calendario futuro
        $fechaBase = Carbon::now()->startOfWeek(); // Empezamos a contar desde el lunes de esta semana

        // Repetimos la rutina durante 4 semanas hacia adelante
        for ($semana = 1; $semana <= 4; $semana++) {
            
            // Calculamos el lunes de la semana "N"
            $lunesSemana = (clone $fechaBase)->addWeeks($semana);

            // LUNES: Spinning (18:00) - Ana
            $crearClase($actIds['Spinning'], $salaIds['Sala Spinning'], $monitorAnaId, 
                (clone $lunesSemana)->setHour(18)->setMinute(0), $sociosIds);

            // MARTES: Pilates (09:00) - Ana y Crossfit (19:00) - Carlos
            $crearClase($actIds['Pilates'], $salaIds['Sala Yoga/Pilates'], $monitorAnaId, 
                (clone $lunesSemana)->addDays(1)->setHour(9)->setMinute(0), $sociosIds);
            
            $crearClase($actIds['Crossfit'], $salaIds['Sala Polivalente'], $monitorCarlosId, 
                (clone $lunesSemana)->addDays(1)->setHour(19)->setMinute(0), $sociosIds);

            // MIÉRCOLES: Yoga (10:00) - Ana
            $crearClase($actIds['Yoga'], $salaIds['Sala Yoga/Pilates'], $monitorAnaId, 
                (clone $lunesSemana)->addDays(2)->setHour(10)->setMinute(0), $sociosIds);

            // JUEVES: Musculación Dirigida (11:00) - Carlos
            $crearClase($actIds['Musculación'], $salaIds['Sala Musculación'], $monitorCarlosId, 
                (clone $lunesSemana)->addDays(3)->setHour(11)->setMinute(0), $sociosIds);

            // VIERNES: Zumba Party (17:00) - Ana
            $crearClase($actIds['Zumba'], $salaIds['Sala Polivalente'], $monitorAnaId, 
                (clone $lunesSemana)->addDays(4)->setHour(17)->setMinute(0), $sociosIds);
            
            // SÁBADO: Crossfit Matinal (10:00) - Carlos
            $crearClase($actIds['Crossfit'], $salaIds['Sala Polivalente'], $monitorCarlosId, 
                (clone $lunesSemana)->addDays(5)->setHour(10)->setMinute(0), $sociosIds);
        }
    }
}








