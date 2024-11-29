<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'nombre' => 'Super Usuario',
            'apellidos' => 'Administrador',
            'fecha_nacimiento' => '1980-01-01',
            'genero' => 'Otro',
            'correo_personal' => 'dios@gmail.com',
            'password' => Hash::make('12345'),
            'licenciatura' => 'Derecho',
            'centro_universitario' => 'Ciudad Universitaria',
            'es_academico' => false,
        ]);
        
        
    }
}
