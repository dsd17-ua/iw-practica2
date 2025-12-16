<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sala extends Model
{
    use HasFactory;
    protected $table = 'salas'; // Laravel buscaría 'sala'

    public function clases()
    {
        return $this->hasMany(Clase::class, 'sala_id');
    }
}
