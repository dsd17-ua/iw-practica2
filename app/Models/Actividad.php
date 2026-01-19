<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Actividad extends Model
{
    use HasFactory;
    protected $table = 'actividades';
    protected $fillable = ['nombre', 'descripcion', 'imagen_url'];
}
