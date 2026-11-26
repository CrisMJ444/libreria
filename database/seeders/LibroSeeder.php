<?php

namespace Database\Seeders;

use App\Models\Libro;
use Illuminate\Database\Seeder;

class LibroSeeder extends Seeder
{
    public function run(): void
    {
        $libros = [
            ['titulo' => 'El Hobbit', 'editorial' => 'Minotauro', 'autor' => 'J. R. R. Tolkien', 'idioma' => 'Español', 'coleccion' => 'Tierra Media'],
            ['titulo' => 'Fundación', 'editorial' => 'Debolsillo', 'autor' => 'Isaac Asimov', 'idioma' => 'Español', 'coleccion' => 'Serie Fundación'],
            ['titulo' => 'Clean Code', 'editorial' => 'Prentice Hall', 'autor' => 'Robert C. Martin', 'idioma' => 'Inglés', 'coleccion' => null],
        ];

        foreach ($libros as $libro) {
            Libro::create($libro);
        }
    }
}
