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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            // Relación con planes (puede ser null si es admin o monitor)
            $table->foreignId('plan_id')->nullable()->constrained('planes')->nullOnDelete();
            
            $table->string('nombre');
            $table->string('apellidos')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            
            // Campos nuevos del diagrama
            $table->string('telefono')->nullable();
            $table->string('dni')->unique()->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->string('direccion')->nullable();
            $table->string('ciudad')->nullable();
            $table->string('codigo_postal')->nullable();
            
            // Usamos enum para restringir los valores como pedía el diagrama
            $table->enum('rol', ['socio', 'webmaster', 'monitor'])->default('socio');
            $table->enum('estado', ['pendiente', 'activo', 'bloqueado'])->default('pendiente');
            
            $table->decimal('saldo_actual', 10, 2)->default(0.00);
            
            $table->rememberToken();
            $table->timestamps(); // Esto crea 'created_at' (fecha_registro) y 'updated_at'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
