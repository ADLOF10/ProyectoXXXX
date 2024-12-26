<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use SebastianBergmann\Type\TrueType;

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
            'correo_institucional' => 'alan@gmail.com',
            'licenciatura' => 'Derecho',
            'centro_universitario' => 'Ciudad Universitaria',
            'grupo' => null, // Dejar grupo como null para el superusuario
            'cedula_profesional' => null,
            'es_academico' => false,
            'password' => bcrypt('Dio12345'), // Contraseña por defecto
        ]);

        User::create([
            'nombre' => 'marco',
            'apellidos' => 'castillo',
            'fecha_nacimiento' => '1980-01-02',
            'genero' => 'Otro',
            'correo_personal' => 'marco@gmail.com',
            'correo_institucional' => 'lan@gmail.com',
            'licenciatura' => 'Derecho',
            'centro_universitario' => 'Ciudad Universitaria',
            'grupo' => null, // Dejar grupo como null para el superusuario
            'cedula_profesional' => null,
            'es_academico' => True,
            'password' => bcrypt('Juan1234'), // Contraseña por defecto
        ]);

        User::create([
            'nombre' => 'Super Usuario',
            'apellidos' => 'Administrador',
            'fecha_nacimiento' => '1980-01-01',
            'genero' => 'Otro',
            'correo_personal' => 'juan@gmail.com',
            'correo_institucional' => 'an@gmail.com',
            'licenciatura' => 'Derecho',
            'centro_universitario' => 'Ciudad Universitaria',
            'grupo' => null, // Dejar grupo como null para el superusuario
            'cedula_profesional' => null,
            'es_academico' => false,
            'password' => bcrypt('Juan1234'), // Contraseña por defecto
        ]);
    }
}
