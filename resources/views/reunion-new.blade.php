@extends('template.main')

@section('title') 
    Registro 
@endsection

@section('contenido') 

<link rel="stylesheet" href="{{asset('css/caja_azul.css')}}">

<style>
      span.required 
      {
        color: red;
      }
  </style>

<center><p class="caja">  NUEVA REUNIÓN</p> </center>
<br>
@include('layouts.mensajes')
@if (session('success'))
        <div class="alert alert-success"  role="alert">
            {{ session('success') }}
        </div>
@endif
      <form action="{{route('reunion.store')}}" method="POST" enctype="multipart/form-data">
      @csrf
      <fieldset class="scheduler-border">
          <legend class="scheduler-border">Datos de la Reunión</legend>
                           
                <div class="form-group col-md-3">
                  <label for="nombre">Nombre Corto</label>
                  <span class="required">*</span>
                  <input type="text" class="form-control" name="nombre_corto" id="nombre_corto" placeholder="Nombre corto sin espacios" value="{{ old('nombre_corto') }}"required>
                </div>

                <div class="form-group col-md-2">
                  <label for="modalidad">Modalidad</label>
                  <span class="required">*</span>
                  <select name="modalidad" id="modalidad" class="form-control" required>
                        <option value="" selected>Elija una opción...</option>
                        <option value="presencial">Presencial</option>
                        <option value="virtual">Virtual</option>
                  </select>
                </div>

                <div class="form-group col-md-2">
                  <label for="tema">Tema</label>
                  <span class="required">*</span>
                  <select name="tema" id="tema" class="form-control" Required>
                        <option value="" selected>Elija una opción...</option>
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
                  <span class="required">*</span>
                  <input type="text" class="form-control" name="lugar" id="lugar" placeholder="Lugar de trabajo" value="{{old('lugar')}}" required>
                </div>
                
                <div class="form-group col-md-6">
                  <label for="asunto">Asunto</label>
                  <span class="required">*</span>
                  <input type="text" class="form-control" name="asunto" id="asunto" placeholder="Asunto" value="{{ old('nombre_corto') }}" required >
                </div>

                <div class="form-group col-md-3">
                  <label for="asunto">Hora Inicio</label>
                  <span class="required">*</span>
                  <input type="time" class="form-control" name="hora_inicio" id="hora_inicio" max="17:00" min="08:00" step="60" required>
                </div>

                <div class="form-group col-md-3">
                  <label for="asunto">Hora Final</label>
                  <span class="required">*</span>
                  <input type="time" class="form-control" name="hora_final" id="hora_final"   max="17:00" min="08:00" step="60" required>
                </div>

                <div class="form-group col-md-12">
                  <label for="nombre">Docente que registra la reunión:</label>
                  <span class="required">*</span>
                  <select name="usuario" id="usuario" class="form-control" required>
                         <option value="">Elige ...</option>
                              @foreach ($asistentes as $asistente)
                              <option value="{{$asistente['id']}}">{{$asistente['nombre']." ".$asistente['apellidos']}}</option>
                              @endforeach
                  </select>
                </div>

                <div class="form-group col-md-12">
                        <label for="emp_id">Selecciona a los Asistentes</label>
                        <span class="required">*</span>
                         <br>
                         <small class="text-muted">Mantén presionada la tecla <b>Ctrl</b> (o <b>Cmd</b> en Mac) y haz clic para seleccionar varias opciones. En móviles: Mantén presionada una opción para seleccionar varias.</small>
                          <select name="asistentes[]" id="asistentes" class="form-control" size="10" data-style="btn-primary" title="Selecciona" multiple required >
                                    @foreach ($asistentes as $asistente)
                                <option value="{{$asistente['id']}}">{{$asistente['nombre']." ".$asistente['apellidos']}}</option>
                                    @endforeach
                        </select>
                        
                </div> 
                
                <div class="form-group col-md-12">
                        <label for="aporte">Orden del Día</label>
                       <textarea class="form-control" name="ordendeldia" id="ordendeldia" rows="8">{{old('ordendeldia')}}</textarea>
                </div>

                <div class="form-group col-md-6">
                        <label for="aporte">Acuerdos</label>
                       <textarea class="form-control" name="acuerdos" id="acuerdos" rows="4">{{old('acuerdos')}}</textarea>
                </div>

                <div class="form-group col-md-6">
                        <label for="pendientes">Pendientes</label>
                       <textarea class="form-control" name="pendientes" id="pendientes" rows="4">{{old('pendientes')}}</textarea>
                </div>

                <div class="form-group col-md-12">
                        <label for="conclusiones">Conclusiones</label>
                       <textarea class="form-control" name="conclusiones" id="conclusiones" rows="4">{{old('conclusiones')}}</textarea>
                </div>

                <div class="form-group col-md-12">
                        <label for="evidencia1">Subir imagen evidencia 1 </label>
                        <span class="required">*</span>
                        <input type="file"  class="form-control" name="evidencia1" id="evidencia1" accept="image/*" required>
                </div>
                <div class="form-group col-md-12">
                        <label for="evidencia2">Subir documento evidencia 2</label>
                        <input type="file"  class="form-control" name="evidencia2" id="evidencia2">
                </div>

      </fieldset>
      <br><br>
             
      <div style="text-align: right;">
              <a class="btn btn-warning" onclick="window.location='{{ route('reunion.show') }}'"> Regresar</a>
              <button class="btn btn-success" onclick="return confirmacion()">Guardar</button>
     </div>            
  <form>

@endsection