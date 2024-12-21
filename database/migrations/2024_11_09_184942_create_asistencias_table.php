<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsistenciasTable extends Migration
{
    public function up()
    {
        Schema::create('asistencias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('grupo_id');
            $table->unsignedBigInteger('alumno_id');
            $table->string('numero_cuenta');
            $table->date('fecha');
            $table->time('hora_registro');
            $table->string('estado'); // Puede ser "asistio", "falta", etc.
            $table->timestamps();
        
            $table->foreign('grupo_id')->references('id')->on('grupos')->onDelete('cascade');
            $table->foreign('alumno_id')->references('id')->on('alumnos')->onDelete('cascade');
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('asistencias');
    }
}

