<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcademicosTable extends Migration
{
    public function up()
    {
        Schema::create('academicos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellidos');
            $table->string('correo_institucional')->unique();
            $table->string('numero_cuenta')->unique();
            $table->string('centro_universitario');
            $table->string('licenciatura'); // Guardará múltiples licenciaturas como JSON
            $table->string('grupo');        // Guardará los grupos como JSON
            $table->string('cedula_profesional');
            $table->string('password');                // Contraseña con hash
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('grupo')->nullable(false)->change();
        });
        Schema::dropIfExists('academicos');
    }
}
