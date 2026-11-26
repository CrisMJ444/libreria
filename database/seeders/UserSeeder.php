<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Cuenta de prueba para el login de la página web.
        // El modelo User ya convierte "password" a hash automáticamente (cast "hashed").
        User::firstOrCreate(
            ['email' => 'admin@libros.test'],
            ['name' => 'Administrador', 'password' => 'admin123']
        );
    }
}
