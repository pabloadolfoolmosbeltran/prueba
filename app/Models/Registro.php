<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{
    use HasFactory;

    protected $table = 'registros';

    protected $fillable = [
        'temperatura',
        'estado_ventilador',
        'estado_agitador',
        'tiempo_operacion',
        'fase',
        'fecha_hora',
        'observaciones',
    ];

    protected $casts = [
        'estado_ventilador' => 'boolean',
        'estado_agitador' => 'boolean',
        'fecha_hora' => 'datetime',
    ];
}