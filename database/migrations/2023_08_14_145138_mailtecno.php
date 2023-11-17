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
        // Schema::create('rol', function (Blueprint $table) {
        //     $table->id()->autoIncrement();
        //     $table->string('nombre');
        //     $table->text('descripcion');
        //     $table->timestamps();
        // });
        // Schema::create('usuario', function (Blueprint $table) {
        //     $table->id()->autoIncrement();
        //     $table->string('nombre');
        //     $table->string('correo')->unique();
        //     $table->string('contraseña');
        //     $table->string('area');
        //     $table->unsignedBigInteger('rol_id');
        //     $table->foreign('rol_id')->references('id')->on('rol')->onDelete('cascade');
        //     $table->timestamps();
        // });
        Schema::create('inicio_sesiones', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('fecha');
            $table->string('hora');
            $table->string('ip');
            $table->unsignedBigInteger('usuario_id')->nullable();
            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('pagina', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('nombre');
            $table->string('ruta');
            $table->unsignedBigInteger('visitas')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inicio_sesiones');
        Schema::dropIfExists('pagina');
        // Schema::dropIfExists('usuario');
        // Schema::dropIfExists('rol');
    }
};
