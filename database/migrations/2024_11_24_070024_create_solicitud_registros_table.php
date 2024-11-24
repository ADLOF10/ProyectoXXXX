<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudRegistrosTable extends Migration
{
    public function up()
    {
        Schema::create('solicitud_registros', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellido_paterno');
            $table->string('apellido_materno');
            $table->string('centro_educativo');
            $table->string('licenciatura');
            $table->date('fecha_nacimiento');
            $table->string('genero');
            $table->string('correo_personal')->unique();
            $table->string('telefono');
            $table->text('domicilio');
            $table->string('tipo_usuario'); // alumno o profesor
            $table->string('matricula')->nullable(); // Solo para profesores
            $table->string('departamento')->nullable(); // Solo para profesores
            $table->string('estado')->default('pendiente'); // pendiente, aprobado, rechazado
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('solicitud_registros');
    }
}
