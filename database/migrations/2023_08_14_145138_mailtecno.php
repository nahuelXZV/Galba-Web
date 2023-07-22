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
        Schema::create('prospecto', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('nombre');
            $table->string('telefono');
            $table->string('correo')->nullable();
            $table->string('interes');
            $table->string('carrera');
            $table->string('estado');
            $table->text('detalles')->nullable();
            $table->timestamps();
        });
        Schema::create('estudiante', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('honorifico');
            $table->string('nombre');
            $table->string('apellido');
            $table->string('ci');
            $table->string('ci_expedicion');
            $table->string('telefono');
            $table->string('correo')->nullable();
            $table->string('carrera');
            $table->string('universidad');
            $table->string('estado');
            $table->string('sexo');
            $table->string('nacionalidad');
            $table->string('fecha_inactividad')->nullable();
            $table->timestamps();
        });
        Schema::create('docente', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('honorifico');
            $table->string('nombre');
            $table->string('apellido');
            $table->string('correo')->nullable();
            $table->string('ci');
            $table->string('ci_expedicion');
            $table->string('telefono');
            $table->string('facturacion');
            $table->timestamps();
        });
        Schema::create('programa', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('codigo_programa');
            $table->string('nombre');
            $table->string('sigla');
            $table->string('edicion');
            $table->string('version');
            $table->string('fecha_finalizacion');
            $table->string('fecha_inicio');
            $table->string('tipo');
            $table->string('costo');
            $table->string('modalidad');
            $table->string('hrs_academicas');
            $table->timestamps();
        });
        Schema::create('modulo', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('codigo_modulo');
            $table->string('nombre');
            $table->string('sigla');
            $table->string('edicion');
            $table->string('version');
            $table->string('modalidad');
            $table->string('fecha_finalizacion');
            $table->string('fecha_inicio');
            $table->unsignedBigInteger('programa_id');
            $table->foreign('programa_id')->references('id')->on('programa')->onDelete('cascade');
            $table->unsignedBigInteger('docente_id');
            $table->foreign('docente_id')->references('id')->on('docente')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('estudiante_programa', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('fecha_inscripcion');
            $table->unsignedBigInteger('programa_id');
            $table->foreign('programa_id')->references('id')->on('programa')->onDelete('cascade');
            $table->unsignedBigInteger('estudiante_id');
            $table->foreign('estudiante_id')->references('id')->on('estudiante')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('estudiante_nota', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('nota')->default(0);
            $table->text('detalles')->nullable();
            $table->unsignedBigInteger('modulo_id');
            $table->foreign('modulo_id')->references('id')->on('modulo')->onDelete('cascade');
            $table->unsignedBigInteger('estudiante_id');
            $table->foreign('estudiante_id')->references('id')->on('estudiante')->onDelete('cascade');
            $table->unsignedBigInteger('programa_id');
            $table->foreign('programa_id')->references('id')->on('programa')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('proceso_modulo', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('nombre');
            $table->integer('orden')->default(0);
            $table->timestamps();
        });
        Schema::create('proceso_realizado', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('fecha');
            $table->unsignedBigInteger('modulo_id');
            $table->foreign('modulo_id')->references('id')->on('modulo')->onDelete('cascade');
            $table->unsignedBigInteger('proceso_modulo_id');
            $table->foreign('proceso_modulo_id')->references('id')->on('proceso_modulo')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('contrato', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('honorario');
            $table->string('fecha_finalizacion');
            $table->string('fecha_inicio');
            $table->text('horario');
            $table->string('pagado');
            $table->string('nro_preventiva');
            $table->string('estado');
            $table->unsignedBigInteger('modulo_id');
            $table->foreign('modulo_id')->references('id')->on('modulo')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('calendario_academico', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('nombre');
            $table->string('fecha_finalizacion');
            $table->string('fecha_inicio');
            $table->string('tipo');
            $table->string('tipo_fecha');
            $table->string('lugar')->nullable();
            $table->string('hora')->nullable();
            $table->string('encargado')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contrato');
        Schema::dropIfExists('proceso_realizado');
        Schema::dropIfExists('proceso_modulo');
        Schema::dropIfExists('estudiante_nota');
        Schema::dropIfExists('estudiante_programa');
        Schema::dropIfExists('modulo');
        Schema::dropIfExists('programa');
        Schema::dropIfExists('docente');
        Schema::dropIfExists('prospecto');
        Schema::dropIfExists('estudiante');
        Schema::dropIfExists('calendario_academico');
        // Schema::dropIfExists('usuario');
        // Schema::dropIfExists('rol');
    }
};
