<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Crear un superusuario
        User::create([
            'nombre' => 'Super Usuario',
            'apellidos' => 'Administrador',
            'fecha_nacimiento' => '1980-01-01',
            'genero' => 'Otro',
            'correo_personal' => 'dios@gmail.com',
            'correo_institucional' => 'dios@gmail.com',
            'licenciatura' => 'Derecho',
            'centro_universitario' => 'Ciudad Universitaria',
            'grupo' => null, // Dejar grupo como null para el superusuario
            'cedula_profesional' => null,
            'es_academico' => false,
            'password' => bcrypt('Dios1234'), // Contraseña por defecto
        ]);
    }
}
