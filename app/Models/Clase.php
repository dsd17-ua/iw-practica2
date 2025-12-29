<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Clase extends Model
{
    use HasFactory;
    protected $table = 'clases'; // Laravel buscaría 'clase'

    // Relación: Una clase pertenece a una Actividad
    public function actividad()
    {
        return $this->belongsTo(Actividad::class, 'actividad_id');
    }

    // Relación: Una clase ocurre en una Sala
    public function sala()
    {
        return $this->belongsTo(Sala::class, 'sala_id');
    }

    // Relación: Una clase la imparte un Monitor (Usuario)
    public function monitor()
    {
        return $this->belongsTo(User::class, 'monitor_id');
    }

    public function reservas()
    {
        return $this->hasMany(Reserva::class, 'clase_id');
    }
}
