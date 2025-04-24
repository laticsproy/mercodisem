<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

// Clase StoreAsistente para validar los datos enviados al crear un asistente en la Minuta Electrónica de Reunión.
class StoreAsistente extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para realizar esta solicitud.
     *
     * @return bool
     */
    public function authorize()
    {
        // Permite que cualquier usuario autenticado pueda realizar esta solicitud.
        // Cambiar a false o agregar lógica de autorización si se requiere restringir el acceso.
        return true;
    }

    /**
     * Define las reglas de validación para los campos del formulario de un asistente.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            // El campo 'nombre' es obligatorio, debe ser una cadena de texto y no exceder 255 caracteres.
            'nombre' => 'required|string|max:255',
            // El campo 'apellidos' es obligatorio, debe ser una cadena de texto y no exceder 255 caracteres.
            'apellidos' => 'required|string|max:255',
            // El campo 'sexo' es obligatorio y solo puede ser 'Mujer' o 'Hombre'.
            'sexo' => 'required|in:Mujer,Hombre',
            // El campo 'telefono' es obligatorio, debe ser una cadena de texto y no exceder 20 caracteres.
            'telefono' => 'required|string|max:20',
            // El campo 'correo' es obligatorio, debe ser un correo electrónico válido y no exceder 255 caracteres.
            'correo' => 'required|email|max:255',
            // El campo 'institucion' es obligatorio, debe ser una cadena de texto y no exceder 255 caracteres.
            'institucion' => 'required|string|max:255',
            // El campo 'adscripcion' es obligatorio, debe ser una cadena de texto y no exceder 255 caracteres.
            'adscripcion' => 'required|string|max:255',
        ];
    }

    /**
     * Personaliza los mensajes de error para las reglas de validación.
     *
     * @return array<string, string>
     */
    public function messages()
    {
        return [
            // Mensaje de error si el campo 'nombre' no se proporciona.
            'nombre.required' => 'El nombre es obligatorio.',
            // Mensaje de error si el campo 'apellidos' no se proporciona.
            'apellidos.required' => 'Los apellidos son obligatorios.',
            // Mensaje de error si el campo 'sexo' no se proporciona.
            'sexo.required' => 'El sexo es obligatorio.',
            // Mensaje de error si el valor del campo 'sexo' no es 'Mujer' o 'Hombre'.
            'sexo.in' => 'El sexo debe ser Mujer u Hombre.',
            // Mensaje de error si el campo 'telefono' no se proporciona.
            'telefono.required' => 'El teléfono es obligatorio.',
            // Mensaje de error si el campo 'correo' no se proporciona.
            'correo.required' => 'El correo es obligatorio.',
            // Mensaje de error si el campo 'correo' no es un correo electrónico válido.
            'correo.email' => 'El correo debe ser una dirección de correo electrónico válida.',
            // Mensaje de error si el campo 'institucion' no se proporciona.
            'institucion.required' => 'La institución es obligatoria.',
            // Mensaje de error si el campo 'adscripcion' no se proporciona.
            'adscripcion.required' => 'La adscripción es obligatoria.',
        ];
    }
}