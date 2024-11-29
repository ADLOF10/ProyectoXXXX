<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Super Usuario',
            'email' => 'dios@correo.com',
            'password' => bcrypt('alan'),
            'tipo' => 'superusuario',
        ]);
    }
}
