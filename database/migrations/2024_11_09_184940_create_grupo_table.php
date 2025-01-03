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
            $table->string('profesor');
            $table->string('clave', 20)->unique();
            $table->timestamps();
        });        
    }   

    public function down()
    {
        Schema::dropIfExists('grupos');
    }
}

