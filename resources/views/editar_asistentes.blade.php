@extends('template.main')

@section('title') 
    Registro 
@endsection

@section('contenido') 

<link rel="stylesheet" href="{{asset('css/caja_azul.css')}}">

<marquee>
	<b>Estimado Docente, verifica la informaci&oacute;n antes de realizar la actualizaci&oacute;n de datos</b>
</marquee>
<br>
<br>
<center><p class="caja">  EDITAR DATOS DEL ASISTENTE</p> </center>
<br>
@if (session('success'))
        <div class="alert alert-success"  role="alert">
            {{ session('success') }}
        </div>
@endif
<form action="{{ route('asistente.actualizar',['id' => $asistente->id]) }}" method="post">  
    @csrf @method('PATCH') 
      <fieldset class="scheduler-border">
          <legend class="scheduler-border">EDICI&Oacute;N DE DATOS</legend>
                           
                <div class="form-group col-md-4">
                  <label for="nombre">Nombre</label>
                  <input type="text" class="form-control" name="nombre" id="nombre" value="{{ $asistente->nombre }}" required>
                </div>
                
                <div class="form-group col-md-4">
                  <label for="apellidos">Apellidos</label>
                  <input type="text" class="form-control" name="apellidos" id="apellidos" value="{{ $asistente->apellidos }}" required>
                </div>
                
                <div class="form-group col-md-4">
                  <label for="sexo">Sexo</label>
                  <select name="sexo" id="sexo" class="form-control" required>
                        <option value="{{ $asistente->sexo }}">{{ $asistente->sexo }}</option>
                        <option value="Mujer">Mujer</option>
                        <option value="Hombre">Hombre</option>
                  </select>
                </div>

                <div class="form-group col-md-3">
                        <label for="empleado">Email</label>
                        <input type="text" class="form-control" name="correo" id="correo" value="{{ $asistente->correo }}" required>
                </div>

                <div class="form-group col-md-3">
                        <label for="empleado">Celular</label>
                        <input type="text" class="form-control" name="telefono" id="telefono" value="{{ $asistente->telefono }}" required>
                </div>

                <div class="form-group col-md-3">
                        <label for="empleado">Institución</label>
                        <input type="text" class="form-control" name="institucion" id="institucion" value="{{ $asistente->institucion }}" required>
                </div>

                <div class="form-group col-md-3">
                        <label for="empleado">Adscripción</label>
                        <input type="text" class="form-control" name="adscripcion" id="adscripcion" value="{{ $asistente->adscripcion }}" required>
                </div>


      </fieldset>
      <br><br>

      <div style="text-align: right;">
              <a class="btn btn-warning" onclick="window.location='{{ route('asistente.show') }}'"> Regresar</a>
              <button class="btn btn-success" onclick="return confirmacion()">Actualizar</button>
      </div>
            
  <form>

@endsection