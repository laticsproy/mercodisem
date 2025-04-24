<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Clase anónima que extiende la clase Migration para manejar migraciones de base de datos
return new class extends Migration
{
    /**
     * Ejecuta las migraciones para crear la tabla 'users' en la base de datos.
     */
    public function up(): void
    {
        // Crea una nueva tabla llamada 'users' utilizando el esquema proporcionado
        Schema::create('users', function (Blueprint $table) {
            // Define una columna 'id' como clave primaria auto-incremental
            $table->id();
            // Define una columna 'name' de tipo string para almacenar el nombre del usuario
            $table->string('name');
            // Define una columna 'email' de tipo string, con restricción de unicidad
            $table->string('email')->unique();
            // Define una columna 'email_verified_at' de tipo timestamp, permite valores nulos
            $table->timestamp('email_verified_at')->nullable();
            // Define una columna 'password' de tipo string para almacenar la contraseña
            $table->string('password');
            // Agrega una columna 'remember_token' para manejar sesiones persistentes
            $table->rememberToken();
            // Agrega columnas 'created_at' y 'updated_at' para seguimiento de timestamps
            $table->timestamps();
        });
    }

    /**
     * Revierte las migraciones eliminando la tabla 'users' si existe.
     */
    public function down(): void
    {
        // Elimina la tabla 'users' si existe en la base de datos
        Schema::dropIfExists('users');
    }
};