@extends('template.main')

@section('title') 
    Registro 
@endsection

@section('contenido') 

<meta charset="UTF-8">

<link rel="stylesheet" href="{{asset('css/caja_azul.css')}}">

<style>
      span.required 
      {
        color: red;
      }
  </style>

<center><p class="caja">  NUEVO ASISTENTE</p> </center>
<br>
@include('layouts.mensajes')
@if (session('success'))
        <div class="alert alert-success"  role="alert">
            {{ session('success') }}
        </div>
@endif
      <form action="{{route('asistente.store')}}" method="POST" >
      @csrf
      <fieldset class="scheduler-border">
          <legend class="scheduler-border">Datos del Docente</legend>
                           
                <div class="form-group col-md-4">
                  <label for="nombre">Nombre</label>
                  <span class="required">*</span>
                  <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" required>
                </div>
                
                <div class="form-group col-md-4">
                  <label for="apellidos">Apellidos</label>
                  <span class="required">*</span>
                  <input type="text" class="form-control" name="apellidos" id="apellidos" placeholder="Apellidos" required >
                </div>
                
                <div class="form-group col-md-4">
                  <label for="sexo">Sexo</label>
                  <span class="required">*</span>
                  <select name="sexo" id="sexo" class="form-control" required>
                        <option value="" selected>Elija una opción...</option>
                        <option value="Mujer">Mujer</option>
                        <option value="Hombre">Hombre</option>
                  </select>
                </div>

                <div class="form-group col-md-3">
                        <label for="empleado">Email</label>
                        <span class="required">*</span>
                        <input type="email" class="form-control" name="correo" id="correo" placeholder="Email" required>
                </div>

                <div class="form-group col-md-3">
                        <label for="empleado">Celular</label>
                        <span class="required">*</span>
                        <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Tel&eacute;fono" required>
                </div>

                <div class="form-group col-md-3">
                        <label for="empleado">Institución</label>
                        <span class="required">*</span>
                        <input type="text" class="form-control" name="institucion" id="institucion" placeholder="Instituci&oacute;n" required>
                </div>

                <div class="form-group col-md-3">
                        <label for="empleado">Adscripción</label>
                        <span class="required">*</span>
                        <input type="text" class="form-control" name="adscripcion" id="adscripcion" placeholder="Adscripci&oacute;n" required>
                </div>


      </fieldset>
      <br><br>
             
      <div style="text-align: right;">
              <a class="btn btn-warning" onclick="window.location='{{ route('asistente.show') }}'"> Regresar</a>
              <button class="btn btn-success" onclick="return confirmacion()">Guardar</button>
      </div>            
  <form>

@endsection