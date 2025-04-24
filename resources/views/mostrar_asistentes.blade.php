@extends('template.main')

@section('title') 
    Lista de Empresas
@endsection

@section('contenido') 


<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<!-- Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="{{asset('css/caja_azul.css')}}">
<style type="text/css" media="screen">

table {
   margin: auto;
   width: 100%;
   border: 2px solid #64858C;

}
th, td {
   width: 0%;
   text-align: center;
   vertical-align: top;
   padding: 0.3em;
   caption-side: bottom;
}

th {
   background: #64858C;
    color: #fff;
    vertical-align: top;
}

p{
   font-weight: bold;
 }

</style>
<marquee>
	<b>Estimado Docente, los asistentes estan ordenados por nombre de forma ascendente</b>
</marquee>
<br>
<br>
 <center><p class="caja"> ASISTENTES DE REUNIÓN </p> </center>
  <br>
        @if(session('warning'))
            <div class="alert alert-danger alert-dismissible-fade-show" role="alert">
                {{ session('warning') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <form action="{{route('asistente.show')}}" method="get">
        <br>
        <div class="input-group">
          <form action="#" method="POST">
             <input type="text" name="asistente" class="form-control" placeholder="Buscar Asistente">
          </form>
         
          <span class="input-group-btn"  id="buscar">
            <form>
                <button type="submit" class="btn btn-info glyphicon glyphicon-search" title="Buscar Asistente"></button>
            </form>
        </span>
        </div>           
          <br>
          
          @if(isset($asistentes) || isset($i)) 
              <center>
                <strong>Coincidencias de registros:</strong> 
                  <p style="color:red;">{{$asistentes->total()}} </p> 
              </center>
              @php
              $i = 0
              @endphp

              <div style="text-align: right;">
              <a href="{{route('asistente.new')}}" class="btn btn-success glyphicon glyphicon-plus"> Nuevo Asistente</a>
              </div>
              <br>
              <div class="table-responsive">
              <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Núm.</th>
                      <th>Nombre</th>
                      <th>Apellido</th>
                      <th>Email</th>
                      <th>Telefono</th>
                      <th>Fecha</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                   
                  @foreach($asistentes as $asistente)
                    <tr>
                      <td>{{++$i}}</td>
                      <td>{{ucwords($asistente->nombre)}}</td>
                      <td>{{ucwords($asistente->apellidos)}}</td>
                      <td>{{ucwords($asistente->correo)}}</td>
                      <td>{{ucwords($asistente->telefono)}}</td>
                      <td>{{ucwords($asistente->created_at)}}</td>
                      <td>                              
                          <a href="{{route('asistente.editar',['id' => $asistente->id])}}" class="btn btn-warning" title="Editar Asistente">
                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                          </a>
                                      
                          <form id="eliminar-form-{{ $asistente->id }}" action="{{ route('asistente.eliminar', ['id' => $asistente->id]) }}" method="POST" style="display: inline;">
                                  @csrf
                                  @method('DELETE')
                                  <a href="{{route('asistente.eliminar',['id' => $asistente->id])}}"  class="btn btn-danger" title="Eliminar Asistente" onclick="confirmarEliminacion(event, 'eliminar-form-{{ $asistente->id }}');">    
                                  <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                  </a>  
                          </form>

                      </td>
                    </tr>
                  @endforeach
                  
                  </tbody>
              </table>
              </div>
              <center> {{ $asistentes->appends(request()->input())->links() }} </center>
              @endif

              <script>
    function confirmarEliminacion(event, formId) {
        event.preventDefault();
        if (confirm('¿Estás seguro de que deseas eliminar el registro del asistente?')) {
            document.getElementById(formId).submit();
        }
    }
</script>
        </form>



@endsection