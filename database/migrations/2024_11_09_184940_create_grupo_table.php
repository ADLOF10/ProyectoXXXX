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
            $table->date('fecha_clase')->nullable();
            $table->string('profesor');
            $table->time('horario_clase')->nullable();
            $table->time('horario_clase_final')->nullable();
            $table->time('horario_registro')->nullable();
            $table->string('qr_code')->nullable();
            $table->timestamps();
        });        
    }   

    public function down()
    {
        Schema::dropIfExists('grupos');
    }
}

