@extends('template.main')

@section('title') 
    Editar Empresa
@endsection

@section('contenido') 

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{asset('css/caja_azul.css')}}">
  <title>Document</title>
</head>
<body>


<script type="text/javascript">
 
 function confirmacion() {
        return confirm('¿Estás seguro de que deseas actualizar la información de la Bitacora?');
    }

</script> 


<marquee>
	<b>Estimado profesor, verifica la información antes de realizar la actualización de datos</b>
</marquee>
<br>
<br>
 <center><p class="caja"> EDITA LA INFORMACIÓN SOLICITADA</p> </center>
  <br>
@if ($errors->has('evidencia1'))
    <span class="text-danger">{!! $errors->first('evidencia1') !!}</span>
@endif

@if ($errors->has('evidencia2'))
    <span class="text-danger">{!! $errors->first('evidencia2') !!}</span>
@endif
@if (session('success'))
        <div class="alert alert-success"  role="alert">
            {{ session('success') }}
        </div>
@endif
<form action="{{ route('reunion.actualizar',['id' => $reunion->id]) }}" method="post" enctype="multipart/form-data">  
    @csrf @method('PATCH')         
    <br> <br>

    <fieldset class="scheduler-border">
          <legend class="scheduler-border">Datos de la Reunion</legend>
                           
                <div class="form-group col-md-3">
                  <label for="nombre">Nombre Corto</label>
                  <input type="text" class="form-control" name="nombre_corto" id="nombre_corto" value="{{ $reunion->nombre_corto }}" required>
                </div>

                <div class="form-group col-md-2">
                  <label for="modalidad">Modalidad</label>
                  <select name="modalidad" id="modalidad" class="form-control" required>
                        <option value="{{ $reunion->modalidad }}">{{ $reunion->modalidad }}</option>
                        <option value="presencial">Presencial</option>
                        <option value="virtual">Virtual</option>
                  </select>
                </div>

                <div class="form-group col-md-2">
                  <label for="tema">Tema</label>
                  <select name="tema" id="tema" class="form-control" required>
                        <option value="{{ $reunion->tema }}">{{ $reunion->tema }}</option>
                        <option value="avisos">Avisos</option>
                        <option value="cohortes">Cohortes</option>
                        <option value="egresados">Egresados</option>
                        <option value="empleadores">Empleadores</option>
                        <option value="eventos">Eventos</option>
                        <option value="generalidades">Generalidades</option>
                        <option value="informeresultados">Informe de Resultados</option>
                        <option value="mercadolaboral">Mercado Laboral</option>
                  </select>
                </div>

                <div class="form-group col-md-5">
                  <label for="lugar">Lugar</label>
                  <input type="text" class="form-control" name="lugar" id="lugar" value="{{ $reunion->lugar }}" required>
                </div>
                
                <div class="form-group col-md-6">
                  <label for="asunto">Asunto</label>
                  <input type="text" class="form-control" name="asunto" id="asunto" value="{{ $reunion->asunto }}" required>
                </div>

                <div class="form-group col-md-3">
                  <label for="asunto">Hora Inicio</label>
                  <input type="time" class="form-control" name="hora_inicio"   id="hora_inicio"   value="{{ $reunion->hora_inicio }}" max="17:00:00" min="08:00:00" step="1" placeholder="Asunto" required>
                </div>

                <div class="form-group col-md-3">
                  <label for="asunto">Hora Final</label>
                  <input type="time" class="form-control" name="hora_final"   id="hora_final"  value="{{ $reunion->hora_final }}" max="17:00:00" min="08:00:00" step="1" placeholder="Asunto" required>
                </div>

                <div class="form-group col-md-12">
                  <label for="nombre">Docente que registró la reunión:</label>
                    <select class="form-control" name="usuario" id="usuario" required>
                          <option value="{{ $reunion->id}}"> {{ $reunion->nombre }} {{ $reunion->apellidos }} </option>
                          @foreach ($asistentes as $asistente)
                          <option value="{{ $asistente->id }}"> {{ $asistente->nombre }} {{ $asistente->apellidos }}</option>
                            @endforeach
                     </select>  
                </div>

                <div class="form-group col-md-12">
                        <label for="emp_id">Selecciona a los Asistentes</label>
                         <br>
                        <small class="text-muted">Mantén presionada la tecla <b>Ctrl</b> (o <b>Cmd</b> en Mac) y haz clic para seleccionar varias opciones. En móviles: Mantén presionada una opción para seleccionar varias.
                        </small>
                        <select name="asistentes[]" id="asistentes" class="form-control" size="10" data-style="btn-primary" title="Selecciona" multiple required>
                                 @foreach ($asistentes as $asistente)
                                        <option value="{{ $asistente->id }}" {{ in_array($asistente->id, $asistentesSeleccionados) ? 'selected' : '' }}>
                                             {{ $asistente->nombre . " " . $asistente->apellidos }}
                                         </option>
                                 @endforeach
                         </select>
                </div> 
                
                <div class="form-group col-md-12">
                        <label for="aporte">Orden del Día</label>
                       <textarea class="form-control" name="ordendeldia" id="ordendeldia" rows="8">  {{ $reunion->ordendeldia }} </textarea>
                </div>

                <div class="form-group col-md-6">
                        <label for="aporte">Acuerdos</label>
                       <textarea class="form-control" name="acuerdos" id="acuerdos" rows="4">  {{ $reunion->acuerdos }} </textarea>
                </div>

                <div class="form-group col-md-6">
                        <label for="pendientes">Pendientes</label>
                       <textarea class="form-control" name="pendientes" id="pendientes" rows="4"> {{ $reunion->pendientes }} </textarea>
                </div>

                <div class="form-group col-md-12">
                        <label for="conclusiones">Conclusiones</label>
                       <textarea class="form-control" name="conclusiones" id="conclusiones" rows="4" required> {{ $reunion->conclusiones }} </textarea>
                </div>

                <div class="form-group col-md-12">
                    <label for="evidencia1">La Evidencia 1 debe ser una imagen</label>
                         @if($reunion->evidencia1)
                             <p>
                                 Archivo actual: 
                                    <a href="{{ asset('evidencia1/' . $reunion->evidencia1) }}">
                                         {{ $reunion->evidencia1 }}
                                    </a>
                             </p>
                              {{-- Si es una imagen, puedes mostrarla directamente --}}
                             <center> <img src="{{ asset('evidencia1/' . $reunion->evidencia1) }}" alt="Evidencia 1" style="max-width: 65%;"></center>
                             <br>
                          @endif

                        <input type="file" class="form-control" name="evidencia1" id="evidencia1" accept="image/*">
                </div>

                <div class="form-group col-md-12">
                    <label for="evidencia2">La Evidencia 2 debe ser un documento</label>
                         @if($reunion->evidencia2)
                             <p>
                                 Archivo actual: 
                                    <a href="{{ asset('evidencia2/' . $reunion->evidencia2) }}" target="_blank">
                                         {{ $reunion->evidencia2 }}
                                    </a>
                             </p>
                              {{-- Si es una imagen, puedes mostrarla directamente --}}
                              <center> <img src="{{ asset('evidencia2/' . $reunion->evidencia2) }}" alt="Evidencia 2" style="max-width: 65%;"></center>
                              <br>
                         @endif

                        <input type="file" class="form-control" name="evidencia2" id="evidencia2" >
                </div>

      </fieldset>

    <div style="text-align: right;">
              <a class="btn btn-warning" onclick="window.location='{{ route('reunion.show') }}'"> Regresar</a>
              <button class="btn btn-success" onclick="return confirmacion()">Actualizar</button>
    </div>
<form>
</body>
</html>

@endsection