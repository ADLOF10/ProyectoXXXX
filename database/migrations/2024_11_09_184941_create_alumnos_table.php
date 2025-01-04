<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlumnosTable extends Migration
{
    public function up()
    {
        Schema::create('alumnos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellidos');
            $table->string('correo_institucional')->unique();
            $table->string('numero_cuenta')->unique();
            $table->unsignedBigInteger('grupo_id')->nullable(); // Relación con grupos
            $table->string('semestre');
            $table->string('licenciatura');
            $table->timestamps();
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('alumnos');
    }
}
