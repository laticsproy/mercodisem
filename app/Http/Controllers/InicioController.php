<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\File; // Importa el facade File
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use App\Models\Asistente;
use App\Models\Reunion;
use DB;
use PDF;
use Carbon\Carbon;


class InicioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function new()
    {
        return view('inicio');
    }


    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

      $usuario = Reunion::latest()->value('usuario'); // Obtener el último usuario que registró una reunión


      $ultimoUsuario = Asistente::where('id', $usuario)
      ->selectRaw("CONCAT(nombre, ' ', apellidos) AS nombre")
      ->first();
    

      $ultimoAsunto = Reunion::latest()->value('asunto'); // Obtener el último asunto que registró una reunión

    
      $reuniones = DB::table('reuniones')
      ->select('reuniones.id','reuniones.nombre_corto','reuniones.tema','reuniones.asunto', 'reuniones.hora_inicio', 'reuniones.hora_final','reuniones.created_at')
      ->paginate(20);


      return view('inicio', ['reuniones' => $reuniones, 'ultimoUsuario' => $ultimoUsuario, 'ultimoAsunto' => $ultimoAsunto ]);

    }

    public function editar($id)
    {
    // Obtener la reunión específica
    $reunion = DB::table('reuniones')->where('id', $id)->first();

    // Obtener todos los asistentes
    $asistentes = DB::table('asistentes')
        ->select('id', 'nombre', 'apellidos')
        ->orderBy('nombre', 'ASC')
        ->get();

    // Obtener los IDs de los asistentes seleccionados para la reunión específica
    $asistentesSeleccionados = DB::table('asistente_reunion')
        ->where('reunion_id', $id)
        ->pluck('asistente_id')
        ->toArray();

    return view('editar_reuniones', compact('reunion', 'asistentes', 'asistentesSeleccionados'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Reunion::where('id', $id)->update(['nombre_corto' => $request->input('nombre_corto')]);
        Reunion::where('id', $id)->update(['modalidad' => $request->input('modalidad')]);
        Reunion::where('id', $id)->update(['tema' => $request->input('tema')]);
        Reunion::where('id', $id)->update(['lugar' => $request->input('lugar')]);
        Reunion::where('id', $id)->update(['asunto' => $request->input('asunto')]);
        Reunion::where('id', $id)->update(['hora_inicio' => $request->input('hora_inicio')]);
        Reunion::where('id', $id)->update(['hora_final' => $request->input('hora_final')]);
        Reunion::where('id', $id)->update(['acuerdos' => $request->input('acuerdos')]);
        Reunion::where('id', $id)->update(['pendientes' => $request->input('pendientes')]);
        Reunion::where('id', $id)->update(['conclusiones' => $request->input('conclusiones')]);

        //PARA ACTUALIZAR EVIDENCIA 1
        // Manejar el archivo
        // Obtener la reunión actual
        $reunion = DB::table('reuniones')->where('id', $id)->first();

        // Manejar el archivo
        if ($request->hasFile('evidencia1'))
        {
        // Eliminar el archivo anterior si existe
            if ($reunion->evidencia1)
            {
                $existingFilePath = public_path('evidencia1/' . $reunion->evidencia1);
                     if (File::exists($existingFilePath))
                     {
                         File::delete($existingFilePath);
                     }
            }

            // Guardar el nuevo archivo
            $file = $request->file('evidencia1');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('evidencia1'), $filename);

            // Actualizar la reunión con el nuevo archivo
             DB::table('reuniones')->where('id', $id)->update(['evidencia1' => $filename,]);
        }

        //PARA ACTUALIZAR EVIDENCIA 2
        // Manejar el archivo
        // Obtener la reunión actual
        $reunion = DB::table('reuniones')->where('id', $id)->first();

        // Manejar el archivo
        if ($request->hasFile('evidencia2'))
        {
        // Eliminar el archivo anterior si existe
            if ($reunion->evidencia2)
            {
                $existingFilePath = public_path('evidencia2/' . $reunion->evidencia2);
                     if (File::exists($existingFilePath))
                     {
                         File::delete($existingFilePath);
                     }
            }

            // Guardar el nuevo archivo
            $file = $request->file('evidencia2');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('evidencia2'), $filename);

            // Actualizar la reunión con el nuevo archivo
             DB::table('reuniones')->where('id', $id)->update(['evidencia2' => $filename,]);
        }


        $asistentes = $request->input('asistentes', []);

        // Primero, eliminar todos los registros existentes para la reunión
        DB::table('asistente_reunion')->where('reunion_id', $id)->delete();

        // Luego, insertar los nuevos registros
        foreach ($asistentes as $asistente_id) {
            DB::table('asistente_reunion')->insert([
                'reunion_id' => $id,
                'asistente_id' => $asistente_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return redirect()->route('reunion.editar', $id)->with('success', 'Los cambios se realizaron correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         // Obtener la reunión actual
         $reunion = DB::table('reuniones')->where('id', $id)->first();

         // Eliminar las relaciones en la tabla intermedia asistente_reunion
         DB::table('asistente_reunion')->where('reunion_id', $id)->delete();

         // Eliminar el archivo de evidencia si existe
         if ($reunion->evidencia1)
         {
             $existingFilePath = public_path('evidencia1/' . $reunion->evidencia1);
                if (File::exists($existingFilePath))
                {
                     File::delete($existingFilePath);
                }
         }

         if ($reunion->evidencia2)
         {
             $existingFilePath = public_path('evidencia2/' . $reunion->evidencia2);
                if (File::exists($existingFilePath))
                {
                     File::delete($existingFilePath);
                }
         }


         // Eliminar la reunión
         DB::table('reuniones')->where('id', $id)->delete();

         return redirect()->route('reunion.show')->with('warning', 'La reunión ha sido eliminada');
        }


    public function bitacora($id)
    {

        $reuniones = Reunion::findOrFail($id);

        $bitacora = DB::table('reuniones')
        ->select('*')
        ->where('reuniones.id','=', $id)
        ->first();

        $asistentes = DB::table('asistente_reunion')
        ->join('reuniones', 'reuniones.id', '=', 'asistente_reunion.reunion_id')
        ->join('asistentes', 'asistentes.id', '=', 'asistente_reunion.asistente_id')
        ->select('asistentes.nombre','asistentes.apellidos','asistentes.correo')
        ->where('reuniones.id','=', $id)
        ->orderBy('asistentes.nombre','ASC')
        ->get();


       /* $path = public_path('evidencia1/'.$reuniones->evidencia1);
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $pic1 = 'data:image/' .$type . ';base64,' .base64_encode($data);*/

        $path = public_path('evidencia1/'.$reuniones->evidencia1);

        // Crea una instancia de la imagen
        $image = Image::make($path);

        // Redimensiona la imagen (por ejemplo, a 300x300 píxeles)
        $image->resize(300, 300);

        // Obtén el tipo de imagen
        $type = pathinfo($path, PATHINFO_EXTENSION);

        // Obtén los datos de la imagen redimensionada en formato base64
        $data = (string) $image->encode($type);
        $pic1 = 'data:image/' . $type . ';base64,' . base64_encode($data);

        $path = public_path('evidencia2/'.$reuniones->evidencia2);
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $pic2 = 'data:image/' .$type . ';base64,' .base64_encode($data);

        $pdf = \PDF::loadView('bitacora', ['pic1' => $pic1,'pic2' => $pic2, 'bitacora' => $bitacora,'asistentes' => $asistentes]);
        return $pdf->stream('bitacora_digital.pdf');

    }

    public function contacto()
    {
        //
        return view('contacto');
    }

}
