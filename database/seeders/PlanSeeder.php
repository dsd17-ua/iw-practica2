<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlanSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('planes')->insert([
            [
                'nombre' => 'Plan Basico',
                'precio_mensual' => 30.00,
                'clases_gratis_incluidas' => 2,
                'descripcion' => 'Acceso a las instalaciones del gimnasio.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Plan Premium',
                'precio_mensual' => 45.00,
                'clases_gratis_incluidas' => 6,
                'descripcion' => 'Acceso total a las instalaciones del gimnasio.',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}