@extends('template.main')

@section('title') 
    Inicio
@endsection

@section('contenido') 

<link rel="stylesheet" href="{{asset('css/caja_azul.css')}}">
<style>
        .mi-parrafo {
            line-height: 0; /* Disminuye el interlineado */
        }
</style>

<center><p class="caja">Bienvenido:    <strong class="glyphicon glyphicon-education">{{Auth::user()->name}}</strong> </p> </center>
<br>

<center>    <img src="{{ asset('img/egresados.png') }}"  class="img-fluid" style="max-width: 67%; height: auto;">

<br>


<p> 
    <strong  style="color:#64858C"> 
        Reuniones:
    </strong> 

    <strong  style="color:#A4BABF"> 
        {{$reuniones->total()}} 
    </strong> 

    |
    <strong style="color:#64858C"> 
       Última Minuta por:
    </strong>

    <strong style="color:#A4BABF"> 
      {{ $ultimoUsuario->nombre ?? 'No disponible'}}
    </strong>
</p>

</BR>

<p class="mi-parrafo">
<strong  style="color:#A64962"> 
        Asunto: {{$ultimoAsunto ?? 'No disponible'}}
</strong>
</p>
  
</center>

@endsection

