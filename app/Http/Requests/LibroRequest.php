<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Validación de entrada para POST y PUT (reemplazo completo del recurso).
 * Si falla, el handler global responde 400 Bad Request en JSON (ver bootstrap/app.php).
 */
class LibroRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'titulo' => ['required', 'string', 'max:255'],
            'editorial' => ['required', 'string', 'max:255'],
            'autor' => ['required', 'string', 'max:255'],
            'idioma' => ['required', 'string', 'max:100'],
            'coleccion' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'El campo :attribute es obligatorio.',
            'string' => 'El campo :attribute debe ser texto.',
            'max' => 'El campo :attribute no debe superar :max caracteres.',
        ];
    }
}
