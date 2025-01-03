<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellidos');
            $table->string('correo_personal')->unique();
            $table->string('correo_institucional')->unique();
            $table->string('cedula_profesional')->nullable();
            $table->boolean('es_academico')->default(false);
            $table->string('password')->default('Jo123456'); // Asignar una contraseña predeterminada4
            $table->timestamps();
        });
        
    }


    public function down()
    {
        Schema::dropIfExists('users');
    }
}
