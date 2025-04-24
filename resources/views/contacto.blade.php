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

<style>
    .descripcion {
        font-size: 16px;
        text-align: justify;

    }
</style>

 <center><p class="caja"> EQUIPO DE TRABAJO (LATICS) RESPONSABLES DEL PROYECTO </p> </center>
    <br>
        <br>

        <div class="descripcion">
            
            El Equipo de Trabajo del Laboratorio de Tecnologías de la Información y Comunicación en Salud (LATICS) es un grupo de docentes adscritos a la División Académica de Multidisciplinaria de Comalcalco (DAMC) de la Universidad Juárez Autónoma de Tabasco (UJAT), dedicado a la investigación, divulgación y difusión del conocimiento en las áreas de Tecnologías de la Información y Comunicación (TIC) y Salud.
            
            <br>
            <br>

            Dentro de las actividades de LATICS destacan la realización de cursos, talleres y proyectos de innovación orientados a fortalecer el uso de las TIC en diversos ámbitos, especialmente en el área de la Salud. El equipo de trabajo ha desarrollado un proyecto de investigación enfocado en la implementación de una bitácora digital con el propósito de automatizar procesos administrativos, mejorando la eficiencia y gestión en su área de aplicación.

           <br>
           <br>

            Para obtener más información sobre esta herramienta tecnológica o recibir atención especializada, se recomienda contactar a los responsables del proyecto o consultar el sitio web académico de <a href="https://latics.damcomalcalco.net/" target="_blank">LATICS</a>.
        </div>
          <br>     
          <br>
              <div class="table-responsive">
              <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Núm.</th>
                      <th>Responsable</th>
                      <th>Email</th>
                      <th>Teléfono</th>
                      <th>Función</th>
                    </tr>
                  </thead>
                  <tbody>
                        <tr>
                            <td>1</td>
                            <td>M.A.T.I. Reinerio Zapata Salazar</td>
                            <td>reinerio@ujat.mx</td>
                            <td>9141110444</td>
                            <td>Desarrollo de Software</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Dr. Freddy De la Cruz Ruiz</td>
                            <td>freddy.delacruz@ujat.mx</td>
                            <td>919141203059</td>
                            <td>Analista de Datos</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>M.T.A.C. José Antonio Córdova Hernández</td>
                            <td>jose.cordova@ujat.mx</td>
                            <td>9141111360</td>
                            <td>Analista de Sistemas</td>
                        </tr>
                  </tbody>
              </table>
              </div>

            <br>

            <div style="text-align: right;">
                    <a class="btn btn-warning" onclick="window.location='{{ route('dashboard') }}'"> Regresar</a>
            </div>


@endsection