<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Alumno;
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
            'correo_personal' => 'dios@gmail.com',
            'correo_institucional' => 'alan@gmail.com',
            'cedula_profesional' => null,
            'es_academico' => false,
            'password' => bcrypt('Dios1234'), // Contraseña por defecto
        ]);

        User::create([
            'nombre' => 'marco',
            'apellidos' => 'castillo',
            'correo_personal' => 'marco@gmail.com',
            'correo_institucional' => 'lan@gmail.com',
            'cedula_profesional' => null,
            'es_academico' => True,
            'password' => bcrypt('Juan1234'), // Contraseña por defecto
        ]);

        User::create([
            'nombre' => 'juan',
            'apellidos' => 'momte',
            'correo_personal' => 'juan@gmail.com',
            'correo_institucional' => 'an@gmail.com',
            'cedula_profesional' => null,
            'es_academico' => false,
            'password' => bcrypt('Juan1234'), // Contraseña por defecto
        ]);

        Alumno::create([
            'nombre' => 'ger',
            'apellidos' => 'fer',
            'correo_institucional' => 'an@gmail.com',
            'numero_cuenta' => '1970511',
            'semestre' => '5',
            'licenciatura' => 'Derecho',
        ]);
        Alumno::create([
            'nombre' => 'arr',
            'apellidos' => 'cor',
            'correo_institucional' => 'hola@gmail.com',
            'numero_cuenta' => '1970515',
            'semestre' => '5',
            'licenciatura' => 'Derecho',
        ]);



    }
}
