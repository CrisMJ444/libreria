<?php

namespace App\Http\Controllers;

use App\Services\LibroService;
use Illuminate\Contracts\View\View;

/**
 * CONTROLADOR de la página web: pide los datos al servicio (ORM)
 * y los entrega a la vista Blade resources/views/libros/index.blade.php.
 */
class LibroWebController extends Controller
{
    public function __construct(private readonly LibroService $libros)
    {
    }

    public function index(): View
    {
        $libros = $this->libros->listar();

        return view('libros.index', [
            'libros' => $libros,
            'totalAutores' => $libros->pluck('autor')->unique()->count(),
            'totalColecciones' => $libros->pluck('coleccion')->filter()->unique()->count(),
            'idiomas' => $libros->pluck('idioma')->unique()->sort()->values(),
        ]);
    }
}
