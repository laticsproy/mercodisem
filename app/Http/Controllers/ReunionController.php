<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File; // Facade para manejar operaciones con archivos
use Intervention\Image\Facades\Image; // Facade para manipulación de imágenes
use Illuminate\Http\Request; // Clase para manejar solicitudes HTTP
use App\Http\Requests\StoreReunion; // Request personalizado para validar datos de reunión
use App\Models\Asistente; // Modelo para la tabla de asistentes
use App\Models\Reunion; // Modelo para la tabla de reuniones
use DB; // Facade para operaciones directas con la base de datos
use PDF; // Facade para generar documentos PDF
use Carbon\Carbon; // Biblioteca para manipulación de fechas y horas

class ReunionController extends Controller
{
    /**
     * Muestra el formulario para crear una nueva reunión.
     * 
     * @return \Illuminate\Http\Response
     */
    public function new()
    {
        // Obtiene todos los asistentes activos (no desactivados) ordenados por nombre
        $asistentes = Asistente::where('desactivado', 0)->orderBy('nombre', 'asc')->get();
        // Retorna la vista 'reunion-new' con la lista de asistentes
        return view('reunion-new', compact('asistentes'));
    }

    /**
     * Muestra una lista de reuniones (método no implementado).
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // TODO: Implementar lógica para listar reuniones
    }

    /**
     * Muestra el formulario para crear una nueva reunión (método alternativo).
     * 
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Retorna la vista 'create' para el formulario de creación
        return view('create');
    }

    /**
     * Almacena una nueva reunión en la base de datos.
     * 
     * @param  \App\Http\Requests\StoreReunion  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReunion $request)
    {
        // Valida los archivos subidos (evidencia1: imagen, evidencia2: documento)
        $request->validate([
            'evidencia1' => 'file|mimes:jpg,jpeg,png|max:3048', // Máximo 3 MB
            'evidencia2' => 'file|mimes:pdf,docx,doc,xlsx,xls,ppt,pptx,txt|max:3048', // Máximo 3 MB
        ], [
            // Mensajes personalizados para errores de validación
            'evidencia1.max' => 'ERROR: En la Evidencia 1 el archivo NO debe superar los 3 MB. Se recomienda usar <a href="https://imagecompressor.11zon.com/es/compress-jpg/" target="_blank">imagecompressor</a> para disminuir el tamaño de la imagen. <BR>',
            'evidencia1.mimes' => 'El archivo debe ser una imagen con formato jpg, jpeg o png.',
            'evidencia2.max' => 'ERROR: En la Evidencia 2 el archivo NO debe superar los 3 MB. Se recomienda usar <a href="https://imagecompressor.11zon.com/es/compress-jpg/" target="_blank">imagecompressor</a> para disminuir el tamaño de la imagen.',
            'evidencia2.mimes' => 'El archivo debe ser un documento con formato pdf,docx,doc,xlsx,xls,ppt,pptx,txt.',
        ]);

        // Inicia una transacción para asegurar consistencia en la base de datos
        DB::beginTransaction();

        try {
            // Crea una nueva instancia del modelo Reunion
            $reunion = new Reunion;
            // Asigna los valores del formulario a los campos del modelo
            $reunion->nombre_corto = $request->get('nombre_corto');
            $reunion->modalidad = $request->get('modalidad');
            $reunion->tema = $request->get('tema');
            $reunion->lugar = $request->get('lugar');
            $reunion->asunto = $request->get('asunto');
            $reunion->hora_inicio = $request->get('hora_inicio');
            $reunion->hora_final = $request->get('hora_final');
            $reunion->ordendeldia = $request->get('ordendeldia');
            $reunion->acuerdos = $request->get('acuerdos');
            $reunion->pendientes = $request->get('pendientes');
            $reunion->conclusiones = $request->get('conclusiones');
            $reunion->usuario = $request->get('usuario');

            // Procesa el archivo de evidencia1 (imagen) si existe
            if ($request->hasFile('evidencia1')) {
                $evidencia1 = $request->file('evidencia1');
                // Guarda el archivo en la carpeta public/evidencia1
                $evidencia1->move(public_path() . '/evidencia1/', $evidencia1->getClientOriginalName());
                $reunion->evidencia1 = $evidencia1->getClientOriginalName();
            }

            // Procesa el archivo de evidencia2 (documento) si existe
            if ($request->hasFile('evidencia2')) {
                $evidencia2 = $request->file('evidencia2');
                // Guarda el archivo en la carpeta public/evidencia2
                $evidencia2->move(public_path() . '/evidencia2/', $evidencia2->getClientOriginalName());
                $reunion->evidencia2 = $evidencia2->getClientOriginalName();
            }

            // Guarda la reunión en la base de datos
            $reunion->saveOrFail();

            // Obtiene el ID de la reunión recién creada
            $reunionId = $reunion->id;

            // Asocia los asistentes seleccionados a la reunión
            $asistentes = $request->input('asistentes');
            foreach ($asistentes as $asistenteId) {
                DB::table('asistente_reunion')->insert([
                    'asistente_id' => $asistenteId,
                    'reunion_id' => $reunionId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            // Confirma la transacción
            DB::commit();

            // Redirige a la vista de reuniones con un mensaje de éxito
            return redirect()->route('reunion.show')->with('success', 'La bitácora de la reunión se guardó exitosamente');
        } catch (\Exception $e) {
            // En caso de error, revierte la transacción
            DB::rollBack();

            // Retorna una respuesta JSON con el mensaje de error
            return response()->json([
                'message' => 'Error al crear la reunión',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Muestra una lista de reuniones con opción de búsqueda.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        // Obtiene el término de búsqueda del formulario
        $buscar = $request->input('reunion');

        // Consulta las reuniones filtrando por nombre_corto, asunto o tema
        $reuniones = DB::table('reuniones')
            ->select('reuniones.id', 'reuniones.nombre_corto', 'reuniones.tema', 'reuniones.asunto', 'reuniones.hora_inicio', 'reuniones.hora_final', 'reuniones.created_at')
            ->where('reuniones.nombre_corto', 'LIKE', '%' . $buscar . '%')
            ->orWhere('reuniones.asunto', 'LIKE', '%' . $buscar . '%')
            ->orWhere('reuniones.tema', 'LIKE', '%' . $buscar . '%')
            ->orderBy('reuniones.created_at', 'DESC')
            ->paginate(20);

        // Calcula la duración de cada reunión
        foreach ($reuniones as $reunion) {
            $horaInicio = Carbon::parse($reunion->hora_inicio);
            $horaFinal = Carbon::parse($reunion->hora_final);
            $reunion->diferencia_horas = $horaInicio->diffInHours($horaFinal);
            $diferencia = $horaInicio->diff($horaFinal);
            $reunion->diferencia_minutos = $diferencia->i;
            $reunion->diferencia_segundos = $diferencia->s;
        }

        // Retorna la vista 'mostrar_reuniones' con los resultados
        return view('mostrar_reuniones', ['reuniones' => $reuniones]);
    }

    /**
     * Muestra el formulario para editar una reunión específica.
     * 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editar($id)
    {
        // Obtiene los datos de la reunión con información del usuario asociado
        $reunion = Reunion::join('asistentes', 'reuniones.usuario', '=', 'asistentes.id')
            ->where('reuniones.id', $id)
            ->select(
                'reuniones.id',
                'reuniones.nombre_corto',
                'reuniones.modalidad',
                'reuniones.tema',
                'reuniones.lugar',
                'reuniones.asunto',
                'reuniones.hora_inicio',
                'reuniones.ordendeldia',
                'reuniones.acuerdos',
                'reuniones.pendientes',
                'reuniones.conclusiones',
                'reuniones.evidencia1',
                'reuniones.evidencia2',
                'reuniones.hora_final',
                'asistentes.nombre',
                'asistentes.apellidos'
            )
            ->first();

        // Obtiene todos los asistentes disponibles
        $asistentes = DB::table('asistentes')
            ->select('id', 'nombre', 'apellidos')
            ->orderBy('nombre', 'ASC')
            ->get();

        // Obtiene los IDs de los asistentes asociados a la reunión
        $asistentesSeleccionados = DB::table('asistente_reunion')
            ->where('reunion_id', $id)
            ->pluck('asistente_id')
            ->toArray();

        // Retorna la vista 'editar_reuniones' con los datos necesarios
        return view('editar_reuniones', compact('reunion', 'asistentes', 'asistentesSeleccionados'));
    }

    /**
     * Muestra el formulario para editar una reunión (método no implementado).
     * 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // TODO: Implementar lógica para el formulario de edición
    }

    /**
     * Actualiza una reunión existente en la base de datos.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Valida los archivos subidos (evidencia1: imagen, evidencia2: documento)
        $request->validate([
            'evidencia1' => 'file|mimes:jpg,jpeg,png|max:3048', // Máximo 3 MB
            'evidencia2' => 'file|mimes:pdf,docx,doc,xlsx,xls,ppt,pptx,txt|max:3048', // Máximo 3 MB
        ], [
            // Mensajes personalizados para errores de validación
            'evidencia1.max' => 'ERROR: En la Evidencia 1 el archivo NO debe superar los 3 MB. Se recomienda usar <a href="https://imagecompressor.11zon.com/es/compress-jpg/" target="_blank">imagecompressor</a> para disminuir el tamaño de la imagen. <BR>',
            'evidencia1.mimes' => 'El archivo debe ser una imagen con formato jpg, jpeg o png.',
            'evidencia2.max' => 'ERROR: En la Evidencia 2 el archivo NO debe superar los 3 MB. Se recomienda usar <a href="https://imagecompressor.11zon.com/es/compress-jpg/" target="_blank">imagecompressor</a> para disminuir el tamaño de la imagen.',
            'evidencia2.mimes' => 'El archivo debe ser un documento con formato pdf,docx,doc,xlsx,xls,ppt,pptx,txt.',
        ]);

        // Actualiza los campos de la reunión en la base de datos
        Reunion::where('id', $id)->update([
            'nombre_corto' => $request->input('nombre_corto'),
            'modalidad' => $request->input('modalidad'),
            'tema' => $request->input('tema'),
            'lugar' => $request->input('lugar'),
            'asunto' => $request->input('asunto'),
            'hora_inicio' => $request->input('hora_inicio'),
            'hora_final' => $request->input('hora_final'),
            'usuario' => $request->input('usuario'),
            'ordendeldia' => $request->input('ordendeldia'),
            'acuerdos' => $request->input('acuerdos'),
            'pendientes' => $request->input('pendientes'),
            'conclusiones' => $request->input('conclusiones')
        ]);

        // Maneja la actualización de evidencia1 (imagen)
        $reunion = DB::table('reuniones')->where('id', $id)->first();
        if ($request->hasFile('evidencia1')) {
            // Elimina el archivo anterior si existe
            if ($reunion->evidencia1) {
                $existingFilePath = public_path('evidencia1/' . $reunion->evidencia1);
                if (File::exists($existingFilePath)) {
                    File::delete($existingFilePath);
                }
            }
            // Guarda el nuevo archivo
            $file = $request->file('evidencia1');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('evidencia1'), $filename);
            DB::table('reuniones')->where('id', $id)->update(['evidencia1' => $filename]);
        }

        // Maneja la actualización de evidencia2 (documento)
        if ($request->hasFile('evidencia2')) {
            // Elimina el archivo anterior si existe
            if ($reunion->evidencia2) {
                $existingFilePath = public_path('evidencia2/' . $reunion->evidencia2);
                if (File::exists($existingFilePath)) {
                    File::delete($existingFilePath);
                }
            }
            // Guarda el nuevo archivo
            $file = $request->file('evidencia2');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('evidencia2'), $filename);
            DB::table('reuniones')->where('id', $id)->update(['evidencia2' => $filename]);
        }

        // Actualiza los asistentes asociados a la reunión
        $asistentes = $request->input('asistentes', []);
        // Elimina las relaciones existentes
        DB::table('asistente_reunion')->where('reunion_id', $id)->delete();
        // Inserta las nuevas relaciones
        foreach ($asistentes as $asistente_id) {
            DB::table('asistente_reunion')->insert([
                'reunion_id' => $id,
                'asistente_id' => $asistente_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Redirige al formulario de edición con un mensaje de éxito
        return redirect()->route('reunion.editar', $id)->with('success', 'Los cambios se realizaron correctamente');
    }

    /**
     * Elimina una reunión específica de la base de datos.
     * 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Obtiene la reunión actual
        $reunion = DB::table('reuniones')->where('id', $id)->first();

        // Elimina las relaciones en la tabla intermedia asistente_reunion
        DB::table('asistente_reunion')->where('reunion_id', $id)->delete();

        // Elimina el archivo de evidencia1 si existe
        if ($reunion->evidencia1) {
            $existingFilePath = public_path('evidencia1/' . $reunion->evidencia1);
            if (File::exists($existingFilePath)) {
                File::delete($existingFilePath);
            }
        }

        // Elimina el archivo de evidencia2 si existe
        if ($reunion->evidencia2) {
            $existingFilePath = public_path('evidencia2/' . $reunion->evidencia2);
            if (File::exists($existingFilePath)) {
                File::delete($existingFilePath);
            }
        }

        // Elimina la reunión de la base de datos
        DB::table('reuniones')->where('id', $id)->delete();

        // Redirige a la lista de reuniones con un mensaje de confirmación
        return redirect()->route('reunion.show')->with('warning', 'La reunión ha sido eliminada');
    }

    /**
     * Genera un PDF con la bitácora de una reunión específica.
     * 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function bitacora($id)
    {
        // Obtiene la reunión específica
        $reuniones = Reunion::findOrFail($id);

        // Obtiene los datos de la reunión
        $bitacora = DB::table('reuniones')
            ->select('*')
            ->where('reuniones.id', '=', $id)
            ->first();

        // Obtiene los asistentes asociados a la reunión
        $asistentes = DB::table('asistente_reunion')
            ->join('reuniones', 'reuniones.id', '=', 'asistente_reunion.reunion_id')
            ->join('asistentes', 'asistentes.id', '=', 'asistente_reunion.asistente_id')
            ->select('asistentes.nombre', 'asistentes.apellidos', 'asistentes.correo')
            ->where('reuniones.id', '=', $id)
            ->orderBy('asistentes.nombre', 'ASC')
            ->get();

        // Procesa la imagen de evidencia1 (redimensionada a 300x300 píxeles)
        $path = public_path('evidencia1/' . $reuniones->evidencia1);
        $image = Image::make($path)->resize(300, 300);
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = (string) $image->encode($type);
        $pic1 = 'data:image/' . $type . ';base64,' . base64_encode($data);

        // Procesa la evidencia2 (documento)
        $path = public_path('evidencia2/' . $reuniones->evidencia2);
        if (!empty($reuniones->evidencia2) && File::exists($path) && !is_dir($path)) {
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
            $pic2 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        } else {
            $pic2 = "No hay evidencias";
        }

        // Genera el PDF con la vista 'bitacora' y los datos procesados
        $pdf = \PDF::loadView('bitacora', [
            'pic1' => $pic1,
            'pic2' => $pic2,
            'bitacora' => $bitacora,
            'asistentes' => $asistentes
        ]);

        // Retorna el PDF como un flujo para visualización
        return $pdf->stream('bitacora_digital.pdf');
    }
}