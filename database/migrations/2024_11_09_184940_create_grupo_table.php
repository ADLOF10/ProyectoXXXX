<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGrupoTable extends Migration
{
    public function up()
    {
        Schema::create('grupos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_grupo');
            $table->string('materia');
            $table->date('fecha_clase');
            $table->string('profesor');
            $table->time('horario_clase');
            $table->time('horario_clase_final');
            $table->time('horario_registro');
            $table->string('qr_code')->nullable();
            $table->timestamps();
        });        
    }

    public function down()
    {
        Schema::dropIfExists('grupos');
    }
}

