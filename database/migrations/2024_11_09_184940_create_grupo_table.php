<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGrupoTable extends Migration
{
    public function up()
    {
        Schema::create('grupo', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_grupo', 100);
            $table->string('materia', 100);
            $table->date('fecha_clase');
            $table->string('profesor', 100);
            $table->time('horario_clase');
            $table->time('horario_clase_final');
            $table->time('horario_registro');
            $table->string('qr_code', 255);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('grupo');
    }
}

