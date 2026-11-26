<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * VISTA (V del patrón MVC en una API): define la representación JSON del modelo.
 */
class LibroResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'titulo' => $this->titulo,
            'editorial' => $this->editorial,
            'autor' => $this->autor,
            'idioma' => $this->idioma,
            'coleccion' => $this->coleccion,
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
