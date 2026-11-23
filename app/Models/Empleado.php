<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    //
    protected $table = 'empleados';

    protected $fillable = [
        'identidad',
        'nombre',
        'apellido',
        'cargo',
        'salario',
        'codigo_empleado',
        'fecha_ingreso',
    ];
}
