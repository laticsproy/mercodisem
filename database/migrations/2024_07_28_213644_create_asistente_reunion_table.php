<?php

// Importar las clases necesarias para la migración
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Definir una clase anónima que extiende de Migration
return new class extends Migration
{
    /**
     * Ejecuta la migración para crear la tabla en la base de datos.
     */
    public function up(): void
    {
        // Crear la tabla 'asistente_reunion' usando el método Schema::create
        Schema::create('asistente_reunion', function (Blueprint $table) {
            // Establecer el motor de almacenamiento como InnoDB para soportar claves foráneas y transacciones
            $table->engine = 'InnoDB';
            
            // Crear una columna 'id' como clave primaria auto-incremental
            $table->id();
            
            // Crear una columna 'asistente_id' para almacenar el ID del asistente (entero grande sin signo)
            $table->unsignedBigInteger('asistente_id');
            
            // Crear una columna 'reunion_id' para almacenar el ID de la reunión (entero grande sin signo)
            $table->unsignedBigInteger('reunion_id');
            
            // Agregar columnas 'created_at' y 'updated_at' para registrar las marcas temporales
            $table->timestamps();
    
            // Definir una clave foránea para 'asistente_id' que referencia la columna 'id' de la tabla 'asistentes'
            // Si un asistente es eliminado, los registros relacionados en esta tabla también se eliminarán (onDelete('cascade'))
            $table->foreign('asistente_id')
                ->references('id')
                ->on('asistentes')
                ->onDelete('cascade');
    
            // Definir una clave foránea para 'reunion_id' que referencia la columna 'id' de la tabla 'reuniones'
            // Si una reunión es eliminada, los registros relacionados en esta tabla también se eliminarán (onDelete('cascade'))
            $table->foreign('reunion_id')
                ->references('id')
                ->on('reuniones')
                ->onDelete('cascade');
        });
    }

    /**
     * Revierte la migración eliminando la tabla de la base de datos.
     */
    public function down(): void
    {
        // Eliminar la tabla 'asistente_reunion' si existe
        Schema::dropIfExists('asistente_reunion');
    }
};