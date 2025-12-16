<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function index()
    {
        // Obtener todos los planes de la base de datos
        $planes = Plan::all();

        // Devolverlos en formato JSON
        return response()->json($planes, 200);
    }
}