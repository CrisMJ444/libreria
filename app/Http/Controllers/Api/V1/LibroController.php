<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\LibroRequest;
use App\Http\Resources\LibroResource;
use App\Http\Traits\ApiResponse;
use App\Services\LibroService;
use Illuminate\Http\JsonResponse;

/**
 * CONTROLADOR (C del patrón MVC): recibe la petición, delega en el servicio
 * y devuelve la respuesta JSON. No contiene consultas ni lógica de datos.
 */
class LibroController extends Controller
{
    use ApiResponse;

    public function __construct(private readonly LibroService $libros)
    {
    }

    // GET /api/v1/libros -> 200
    public function index(): JsonResponse
    {
        $data = LibroResource::collection($this->libros->listar())->resolve();

        return $this->ok($data, 'Lista de libros obtenida correctamente');
    }

    // GET /api/v1/libros/{id} -> 200 | 404
    public function show(int $id): JsonResponse
    {
        $libro = $this->libros->obtener($id);

        return $this->ok((new LibroResource($libro))->resolve(), 'Libro encontrado');
    }

    // POST /api/v1/libros -> 201 | 400
    public function store(LibroRequest $request): JsonResponse
    {
        $libro = $this->libros->crear($request->validated());

        return $this->created((new LibroResource($libro))->resolve(), 'Libro creado correctamente');
    }

    // PUT /api/v1/libros/{id} -> 200 | 400 | 404
    public function update(LibroRequest $request, int $id): JsonResponse
    {
        $libro = $this->libros->actualizar($id, $request->validated());

        return $this->ok((new LibroResource($libro))->resolve(), 'Libro actualizado correctamente');
    }

    // DELETE /api/v1/libros/{id} -> 200 | 404
    public function destroy(int $id): JsonResponse
    {
        $this->libros->eliminar($id);

        return $this->ok(null, 'Libro eliminado correctamente');
    }
}
