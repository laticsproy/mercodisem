<?php

namespace App\Models;

// Importa clases necesarias de Laravel
use Illuminate\Database\Eloquent\Factories\HasFactory; // Habilita la creación de fábricas para generar datos de prueba
use Illuminate\Foundation\Auth\User as Authenticatable; // Clase base para autenticación de usuarios
use Illuminate\Notifications\Notifiable; // Permite enviar notificaciones al usuario
use Laravel\Sanctum\HasApiTokens; // Habilita la gestión de tokens para autenticación en APIs

// Clase User que representa el modelo de usuario en la aplicación
class User extends Authenticatable
{
    // Traits utilizados para añadir funcionalidades al modelo
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Atributos que pueden ser asignados de forma masiva.
     * Estos campos son los que se permiten llenar al crear o actualizar un usuario.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', // Nombre del usuario
        'email', // Correo electrónico del usuario
        'password', // Contraseña del usuario
    ];

    /**
     * Atributos que deben ocultarse al serializar el modelo.
     * Esto asegura que información sensible no se exponga en respuestas JSON.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password', // Contraseña del usuario (sensibilidad alta)
        'remember_token', // Token para "recordar" sesiones del usuario
    ];

    /**
     * Atributos que deben ser transformados a tipos específicos.
     * Define cómo se deben manejar ciertos campos al interactuar con la base de datos.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime', // Convierte el campo de verificación de correo a un objeto de fecha
        'password' => 'hashed', // Asegura que la contraseña se almacene como un hash
    ];
}