<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReunion extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para realizar esta solicitud.
     *
     * @return bool
     */
    public function authorize()
    {
        // Permite que cualquier usuario autenticado pueda realizar la solicitud.
        // Si se requiere lógica de autorización específica, se puede modificar aquí.
        return true;
    }

    /**
     * Define las reglas de validación para los campos del formulario de creación de una reunión.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            // 'nombre_corto': Obligatorio, debe ser una cadena de texto con un máximo de 300 caracteres.
            'nombre_corto' => 'required|string|max:300',
            // 'asunto': Obligatorio, debe ser una cadena de texto con un máximo de 300 caracteres.
            'asunto' => 'required|string|max:300',
            // 'tema': Obligatorio, no se especifica tipo, pero debe estar presente.
            'tema' => 'required',
            // 'lugar': Obligatorio, debe ser una cadena de texto con un máximo de 300 caracteres.
            'lugar' => 'required|string|max:300',
            // 'modalidad': Obligatorio, no se especifica tipo, pero debe estar presente.
            'modalidad' => 'required',
            // 'ordendeldia': Obligatorio, debe ser una cadena de texto con un máximo de 800 caracteres.
            'ordendeldia' => 'required|string|max:800',
            // 'conclusiones': Obligatorio, debe ser una cadena de texto con un máximo de 500 caracteres.
            'conclusiones' => 'required|string|max:500',
            // 'evidencia1': Obligatorio, debe ser una imagen (formatos: jpeg, png, jpg, gif, svg) con un tamaño máximo de 4048 KB (aproximadamente 4 MB).
            'evidencia1' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4048',
            // 'evidencia2': Comentado, pero si se descomenta, sería obligatorio y aceptaría archivos de tipo pdf, docx, doc, xlsx, xls, ppt, pptx o txt, con un tamaño máximo de 4048 KB.
            // 'evidencia2' => 'required|image|mimes:pdf,docx,doc,xlsx,xls,ppt,pptx,txt|max:4048',
            // 'hora_inicio': Obligatorio, debe tener el formato de hora HH:mm (ejemplo: 14:30).
            'hora_inicio' => 'required|date_format:H:i',
            // 'hora_final': Obligatorio, debe tener el formato de hora HH:mm (ejemplo: 16:00).
            'hora_final' => 'required|date_format:H:i',
            // 'asistentes': Obligatorio, debe ser un arreglo (para manejar múltiples asistentes seleccionados).
            'asistentes' => 'required|array',
            // 'asistentes.*': Cada elemento del arreglo debe ser una cadena de texto.
            'asistentes.*' => 'string',
            // 'usuario': Obligatorio, representa el usuario/docente que registra la reunión.
            'usuario' => 'required',
        ];
    }

    /**
     * Personaliza los mensajes de error que se muestran cuando falla la validación.
     *
     * @return array<string, string>
     */
    public function messages()
    {
        return [
            // Mensaje de error si 'nombre_corto' no se proporciona.
            'nombre_corto.required' => 'El nombre es obligatorio.',
            // Mensaje de error si 'asunto' no se proporciona.
            'asunto.required' => 'El asunto es obligatorio.',
            // Mensaje de error si 'tema' no se proporciona.
            'tema.required' => 'El tema es obligatorio.',
            // Mensaje de error si 'lugar' no se proporciona.
            'lugar.required' => 'El lugar debe ser obligatorio.',
            // Mensaje de error si 'modalidad' no se proporciona.
            'modalidad.required' => 'El tema es obligatorio.', // Nota: Posible error en el mensaje, debería decir "La modalidad es obligatoria."
            // Mensaje de error si 'ordendeldia' no se proporciona.
            'ordendeldia.required' => 'La orden del día debe ser obligatorio.', // Nota: Puede mejorarse a "La orden del día es obligatoria."
            // Mensaje de error si 'conclusiones' no se proporciona.
            'conclusiones.required' => 'Las conclusiones deben ser obligatorias.', // Nota: Puede mejorarse a "Las conclusiones son obligatorias."
            // Mensaje de error si 'evidencia1' no se proporciona.
            'evidencia1.required' => 'La primera imagen es obligatoria.',
            // Mensaje de error si 'evidencia1' no es una imagen.
            'evidencia1.image' => 'El archivo debe ser una imagen.',
            // Mensaje de error si 'evidencia1' no tiene un formato válido.
            'evidencia1.mimes' => 'La imagen debe ser de tipo: jpeg, png, jpg, gif, svg.',
            // Mensaje de error si 'evidencia1' excede el tamaño máximo.
            'evidencia1.max' => 'La imagen no debe superar los 3Mb.', // Nota: El mensaje menciona 3 MB, pero la regla permite 4048 KB (~4 MB).
            // Mensaje de error si 'evidencia2' no se proporciona (comentado, pero incluido para documentación).
            'evidencia2.required' => 'La segunda imagen es obligatoria.', // Nota: El mensaje menciona "imagen", pero la regla incluye otros tipos de archivos.
            // Mensaje de error si 'evidencia2' excede el tamaño máximo (comentado).
            'evidencia2.max' => 'El documento no debe superar los 3Mb.', // Nota: Similar al caso anterior, la regla permite 4048 KB.
            // Mensaje de error si 'hora_inicio' no se proporciona.
            'hora_inicio.required' => 'La hora de inicio es obligatoria.',
            // Mensaje de error si 'hora_inicio' no tiene el formato correcto.
            'hora_inicio.date_format' => 'La hora de inicio debe tener el formato HH:mm.',
            // Mensaje de error si 'hora_final' no se proporciona.
            'hora_fin.required' => 'La hora de fin es obligatoria.', // Nota: Hay un error en la clave, debería ser 'hora_final.required'.
            // Mensaje de error si 'hora_final' no tiene el formato correcto.
            'hora_fin.date_format' => 'La hora de fin debe tener el formato HH:mm.', // Nota: Similar, debería ser 'hora_final.date_format'.
            // Mensaje de error si 'asistentes' no es un arreglo.
            'asistentes.array' => 'El campo select de asistentes debe ser un array.',
            // Mensaje de error si algún elemento de 'asistentes' no es una cadena.
            'asistentes.*.string' => 'Cada opción seleccionada debe ser una cadena de texto.',
            // Mensaje de error si 'usuario' no se proporciona.
            'usuario.required' => 'El Docente que registra la reunión es obligatorio.',
        ];
    }
}