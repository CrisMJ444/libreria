<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * MODELO (M del patrón MVC).
 * Entidad principal mapeada por Eloquent (ORM) a la tabla "libros".
 */
class Libro extends Model
{
    protected $table = 'libros';

    protected $fillable = [
        'titulo',
        'editorial',
        'autor',
        'idioma',
        'coleccion',
    ];
}
