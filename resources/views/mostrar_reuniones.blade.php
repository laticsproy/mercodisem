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

 <center><p class="caja"> MINUTAS DE REUNIÓN </p> </center>
  <br>
        @if(session('warning'))
            <div class="alert alert-danger alert-dismissible-fade-show" role="alert">
                {{ session('warning') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <form action="{{route('reunion.show')}}" method="get">
        <br>
        <div class="input-group">
          <form action="#" method="POST">
             <input type="text" name="reunion" class="form-control" placeholder="Buscar Reunión">
          </form>
         
          <span class="input-group-btn"  id="buscar">
            <form>
            <button type="submit" class="btn btn-info glyphicon glyphicon-search" title="Buscar Reunión"></button>
            </form>
        </span>
        </div>           
          <br>
          
          @if(isset($reuniones) || isset($i)) 
              <center>
                <strong>Coincidencias de registros:</strong> 
                  <p style="color:red;">{{$reuniones->total()}} </p> 
              </center>
              @php
              $i = 0
              @endphp

              <div style="text-align: right;">
              <a href="{{route('reunion.new')}}" class="btn btn-success glyphicon glyphicon-plus"> Nueva Minuta</a>
              </div>
              <br>
              <div class="table-responsive">
              <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Núm.</th>
                      <th>Nombre</th>
                      <th>Tema</th>
                      <th>Hora Inicio</th>
                      <th>Hora Final</th>
                      <th>Fecha</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                   
                  @foreach($reuniones as $reunion)
                    <tr>
                      <td>{{++$i}}</td>
                      <td>{{ucwords($reunion->nombre_corto)}}</td>
                      <td>{{ucwords($reunion->tema)}}</td>
                      <td>{{ucwords($reunion->hora_inicio)}}</td>
                      <td>{{ucwords($reunion->hora_final)}}</td>
                      <td>{{ucwords($reunion->created_at)}}</td>
                      <td>                              
                          <a href="{{route('reunion.editar',['id' => $reunion->id])}}" class="btn btn-warning" title="Editar Reunión">
                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                          </a>


                          <a href="{{route('reunion.bitacora',['id' => $reunion->id])}}" class="btn btn-primary" title="Generar Minuta de reunión">
                            <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                          </a>

                          <form id="eliminar-form-{{ $reunion->id }}" action="{{ route('reunion.eliminar', ['id' => $reunion->id]) }}" method="POST" style="display: inline;">
                                  @csrf
                                  @method('DELETE')
                                  <a href="{{route('reunion.eliminar',['id' => $reunion->id])}}"  class="btn btn-danger" title="Eliminar Reunión" onclick="confirmarEliminacion(event, 'eliminar-form-{{ $reunion->id }}');">    
                                  <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                  </a>
                       
                          </form>
                      </td>
                    </tr>
                  @endforeach
                  
                  </tbody>
              </table>
              </div>
              <center> {{ $reuniones->appends(request()->input())->links() }} </center>
              @endif

              <script>
    function confirmarEliminacion(event, formId) {
        event.preventDefault();
        if (confirm('¿Estás seguro de que deseas eliminar la bitacora de reunión?')) {
            document.getElementById(formId).submit();
        }
    }
</script>
        </form>

@endsection