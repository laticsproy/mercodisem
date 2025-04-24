<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Clase Asistente
 * 
 * Este modelo representa un asistente que participa en reuniones electrónicas.
 * Se encarga de gestionar la información de los asistentes y su relación con las reuniones.
 */
class Asistente extends Model
{
    // Habilita el uso de fábricas para generar datos de prueba
    use HasFactory;

    /**
     * Nombre de la tabla en la base de datos asociada al modelo.
     * 
     * @var string
     */
    protected $table = 'asistentes';

    /**
     * Campos de la tabla que pueden ser asignados masivamente.
     * 
     * Estos campos son los que Laravel permitirá rellenar al usar métodos como create() o update().
     * 
     * @var array
     */
    protected $fillable = [
        'id',           // Identificador único del asistente
        'nombre',       // Nombre del asistente
        'apellidos',    // Apellidos del asistente
        'sexo',         // Sexo del asistente
        'telefono',     // Número de teléfono del asistente
        'correo',       // Correo electrónico del asistente
        'institucion',  // Institución a la que pertenece el asistente
        'adscripcion',  // Adscripción o departamento del asistente
        'created_at',   // Fecha de creación del registro
        'updated_at'    // Fecha de última actualización del registro
    ];

    /**
     * Relación muchos a muchos con el modelo Reunion.
     * 
     * Define la relación entre asistentes y reuniones a través de la tabla pivote 'asistente_reunion'.
     * Un asistente puede participar en múltiples reuniones, y una reunión puede tener múltiples asistentes.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function reuniones()
    {
        return $this->belongsToMany(Reunion::class, 'asistente_reunion');
    }
}