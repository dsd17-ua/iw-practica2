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
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete(); // El socio
            $table->foreignId('clase_id')->constrained('clases')->cascadeOnDelete();
            
            $table->dateTime('fecha_reserva');
            $table->boolean('uso_clase_gratuita')->default(false); // Check para el plan
            $table->decimal('precio_pagado', 8, 2)->default(0.00);
            $table->enum('estado', ['confirmada', 'cancelada', 'asistida', 'pendiente'])->default('confirmada');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};
