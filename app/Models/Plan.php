<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    // AÑADE ESTA LÍNEA para corregir el error:
    protected $table = 'planes'; 
}