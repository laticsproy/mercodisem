<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Clase anónima que extiende de Migration para definir una migración de base de datos
return new class extends Migration
{
    /**
     * Ejecuta la migración para crear la tabla 'asistentes' en la base de datos.
     *
     * @return void
     */
    public function up()
    {
        // Crea la tabla 'asistentes' utilizando el motor de almacenamiento InnoDB
        Schema::create('asistentes', function (Blueprint $table) {
            // Define el motor de la tabla como InnoDB para soportar transacciones y claves foráneas
            $table->engine = 'InnoDB';
            
            // Columna 'id' como clave primaria auto-incremental de tipo big integer
            $table->bigIncrements('id');
            
            // Columna 'nombre' para almacenar el nombre del asistente, máximo 200 caracteres
            $table->string('nombre', 200);
            
            // Columna 'apellidos' para almacenar los apellidos del asistente, máximo 200 caracteres
            $table->string('apellidos', 200);
            
            // Columna 'sexo' para almacenar el sexo del asistente, máximo 10 caracteres
            $table->string('sexo', 10);
            
            // Columna 'telefono' para almacenar el número de teléfono, máximo 10 caracteres
            $table->string('telefono', 10);
            
            // Columna 'correo' para almacenar el correo electrónico, máximo 100 caracteres
            $table->string('correo', 100);
            
            // Columna 'institucion' para almacenar la institución del asistente, máximo 200 caracteres
            $table->string('institucion', 200);
            
            // Columna 'adscripcion' para almacenar la adscripción del asistente, máximo 200 caracteres
            $table->string('adscripcion', 200);
            
            // Columna 'desactivado' para indicar si el asistente está desactivado, almacena un valor entero
            $table->integer('desactivado');
            
            // Columnas 'created_at' y 'updated_at' para el registro de fechas de creación y actualización
            $table->timestamps();
        });
    }

    /**
     * Revierte la migración eliminando la tabla 'asistentes' de la base de datos.
     *
     * @return void
     */
    public function down()
    {
        // Elimina la tabla 'asistentes' si existe
        Schema::dropIfExists('asistentes');
    }
};