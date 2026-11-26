<?php

namespace App\Services;

use App\Models\Libro;
use Illuminate\Database\Eloquent\Collection;

/**
 * CAPA DE SERVICIO: lógica de negocio y acceso a datos.
 * Toda interacción con la BD se hace mediante Eloquent (ORM), sin SQL nativo.
 * Los controladores solo orquestan; no contienen lógica de datos.
 */
class LibroService
{
    public function listar(): Collection
    {
        return Libro::orderBy('id')->get();
    }

    /** Lanza ModelNotFoundException (-> 404) si no existe. */
    public function obtener(int $id): Libro
    {
        return Libro::findOrFail($id);
    }

    public function crear(array $datos): Libro
    {
        return Libro::create($datos);
    }

    public function actualizar(int $id, array $datos): Libro
    {
        $libro = $this->obtener($id);
        $libro->update($datos);

        return $libro->refresh();
    }

    public function eliminar(int $id): void
    {
        $this->obtener($id)->delete();
    }
}
