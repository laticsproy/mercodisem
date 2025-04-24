<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Clase anónima que extiende de Migration para definir la migración de la tabla 'reuniones'
return new class extends Migration
{
    /**
     * Ejecuta las migraciones para crear la tabla 'reuniones'.
     *
     * @return void
     */
    public function up()
    {
        // Crea la tabla 'reuniones' utilizando el motor de almacenamiento InnoDB
        Schema::create('reuniones', function (Blueprint $table) {
            // Define el motor de la base de datos como InnoDB
            $table->engine = 'InnoDB';

            // Columna 'id' como clave primaria auto-incremental de tipo big integer
            $table->bigIncrements('id');

            // Columna 'nombre_corto' para almacenar el nombre corto de la reunión, máximo 200 caracteres
            $table->string('nombre_corto', 200);

            // Columna 'asunto' para describir el asunto principal de la reunión, máximo 200 caracteres
            $table->string('asunto', 200);

            // Columna 'tema' para especificar el tema de la reunión, máximo 200 caracteres
            $table->string('tema', 200);

            // Columna 'lugar' para indicar el lugar donde se realiza la reunión, máximo 200 caracteres
            $table->string('lugar', 200);

            // Columna 'modalidad' para definir si la reunión es presencial o virtual, máximo 200 caracteres
            $table->string('modalidad', 200);

            // Columna 'acuerdos' para registrar los acuerdos alcanzados, máximo 500 caracteres
            $table->text('acuerdos', 500);

            // Columna 'pendientes' para listar los temas pendientes, máximo 500 caracteres
            $table->text('pendientes', 500);

            // Columna 'conclusiones' para resumir las conclusiones de la reunión, máximo 500 caracteres
            $table->text('conclusiones', 500);

            // Columna 'hora_inicio' para registrar la hora de inicio de la reunión, máximo 200 caracteres
            $table->string('hora_inicio', 200);

            // Columna 'hora_final' para registrar la hora de finalización de la reunión, máximo 200 caracteres
            $table->string('hora_final', 200);

            // Columna 'evidencia1' para almacenar la ruta o nombre del primer archivo de evidencia
            $table->string('evidencia1');

            // Columna 'evidencia2' para almacenar la ruta o nombre del segundo archivo de evidencia
            $table->string('evidencia2');

            // Columnas 'created_at' y 'updated_at' para registrar la fecha de creación y actualización
            $table->timestamps();
        });
    }

    /**
     * Revierte las migraciones eliminando la tabla 'reuniones'.
     *
     * @return void
     */
    public function down()
    {
        // Elimina la tabla 'reuniones' si existe
        Schema::dropIfExists('reuniones');
    }
};