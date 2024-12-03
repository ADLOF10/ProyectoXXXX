<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudesTable extends Migration
{
    public function up()
    {
        Schema::create('solicitudes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellidos');
            $table->date('fecha_nacimiento');
            $table->string('genero');
            $table->string('correo_personal')->unique();
            $table->string('licenciatura');
            $table->string('centro_universitario');
            $table->string('cedula_profesional')->nullable(); // Solo para académicos
            $table->boolean('es_academico')->default(false);
            $table->string('estatus')->default('pendiente'); // pendiente, aprobado, rechazado
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('solicitudes');
    }
}
