<?php

namespace App\Http\Controllers;

use App\Models\Asistente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AsistenteController extends Controller
{
    /**
     * Muestra una lista de todos los asistentes.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Obtiene todos los asistentes de la base de datos
        $asistentes = Asistente::all();
        
        // Retorna la vista 'asistentes.index' con la lista de asistentes
        return view('asistentes.index', compact('asistentes'));
    }

    /**
     * Muestra el formulario para crear un nuevo asistente.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Retorna la vista 'asistentes.create' para el formulario de creación
        return view('asistentes.create');
    }

    /**
     * Almacena un nuevo asistente en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Valida los datos enviados en el formulario
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:asistentes,email',
        ]);

        // Si la validación falla, redirige con errores
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Crea un nuevo asistente con los datos validados
        Asistente::create($request->all());

        // Redirige a la lista de asistentes con un mensaje de éxito
        return redirect()->route('asistentes.index')->with('success', 'Asistente creado exitosamente.');
    }

    /**
     * Muestra el formulario para editar un asistente existente.
     *
     * @param  \App\Models\Asistente  $asistente
     * @return \Illuminate\View\View
     */
    public function edit(Asistente $asistente)
    {
        // Retorna la vista 'asistentes.edit' con los datos del asistente
        return view('asistentes.edit', compact('asistente'));
    }

    /**
     * Actualiza un asistente existente en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Asistente  $asistente
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Asistente $asistente)
    {
        // Valida los datos enviados en el formulario
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:asistentes,email,' . $asistente->id,
        ]);

        // Si la validación falla, redirige con errores
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Actualiza los datos del asistente
        $asistente->update($request->all());

        // Redirige a la lista de asistentes con un mensaje de éxito
        return redirect()->route('asistentes.index')->with('success', 'Asistente actualizado exitosamente.');
    }

    /**
     * Elimina un asistente de la base de datos.
     *
     * @param  \App\Models\Asistente  $asistente
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Asistente $asistente)
    {
        // Elimina el asistente
        $asistente->delete();

        // Redirige a la lista de asistentes con un mensaje de éxito
        return redirect()->route('asistentes.index')->with('success', 'Asistente eliminado exitosamente.');
    }
}