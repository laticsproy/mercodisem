<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Clase Reunion
 * 
 * Este modelo representa una minuta electrónica de reunión en el sistema.
 * Se encarga de interactuar con la tabla 'reuniones' en la base de datos
 * y define las relaciones con otros modelos, como los asistentes.
 */
class Reunion extends Model
{
    use HasFactory;

    /**
     * Nombre de la tabla en la base de datos asociada al modelo.
     * 
     * @var string
     */
    protected $table = 'reuniones';

    /**
     * Campos de la tabla que pueden ser llenados masivamente.
     * 
     * Estos campos son los que Laravel permitirá modificar o crear
     * mediante operaciones como create() o update().
     * 
     * @var array
     */
    protected $fillable = [
        'id',              // Identificador único de la reunión
        'nombre_corto',    // Nombre breve o título de la reunión
        'asunto',          // Asunto principal de la reunión
        'tema',            // Tema o propósito de la reunión
        'lugar',           // Ubicación donde se realiza la reunión
        'modalidad',       // Modalidad de la reunión (presencial, virtual, etc.)
        'ordendeldia',     // Puntos a tratar durante la reunión
        'acuerdos',        // Acuerdos alcanzados en la reunión
        'pendientes',      // Tareas o temas pendientes por resolver
        'conclusiones',    // Conclusiones finales de la reunión
        'hora_inicio',     // Hora de inicio de la reunión
        'hora_final',      // Hora de finalización de la reunión
        'evidencia1',      // Primer archivo o enlace de evidencia (e.g., fotos, documentos)
        'evidencia2',      // Segundo archivo o enlace de evidencia
        'usuario',         // Identificador o referencia del usuario que creó la reunión
        'create_at',       // Fecha de creación del registro (Nota: debería ser 'created_at')
        'update_at'        // Fecha de última actualización del registro (Nota: debería ser 'updated_at')
    ];

    /**
     * Relación muchos a muchos con el modelo Asistente.
     * 
     * Define la relación entre reuniones y asistentes a través de la tabla pivote
     * 'asistente_reunion', que almacena las asociaciones entre reuniones y asistentes.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function asistentes()
    {
        return $this->belongsToMany(Asistente::class, 'asistente_reunion');
    }
}