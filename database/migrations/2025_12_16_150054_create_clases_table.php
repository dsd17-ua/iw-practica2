<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('clases', function (Blueprint $table) {
            $table->id();
            
            // Claves foráneas
            $table->foreignId('actividad_id')->constrained('actividades')->cascadeOnDelete();
            $table->foreignId('sala_id')->constrained('salas')->cascadeOnDelete();
            // El monitor es un usuario
            $table->foreignId('monitor_id')->constrained('users')->cascadeOnDelete();
            
            $table->dateTime('fecha_inicio');
            $table->dateTime('fecha_fin');
            $table->decimal('coste_extra', 8, 2)->default(0.00);
            $table->integer('plazas_totales');
            $table->enum('estado', ['programada', 'finalizada', 'cancelada'])->default('programada');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clases');
    }
};
