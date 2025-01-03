<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('userAlumno', function (Blueprint $table) {
            $table->id();
            $table->string('correo_institucional_alumno');
            $table->string('correo_institucional_user');
            $table->timestamps();

            $table->foreign('correo_institucional_alumno')->references('correo_institucional')->on('alumnos')->onDelete('cascade');
            $table->foreign('correo_institucional_user')->references('correo_institucional')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
