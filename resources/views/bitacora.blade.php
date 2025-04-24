<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/pdf.css">
    <link rel="stylesheet" type="text/css" href="css/bitacora_tabla1.css">
    <link rel="stylesheet" type="text/css" href="css/bitacora_tabla2.css">
    <link rel="stylesheet" type="text/css" href="css/bitacora_imagen.css">
    <link rel="stylesheet" type="text/css" href="css/bitacora_asistente.css">


    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .justificado {
            text-align: justify;
        }

        .negro {
            color:black; /* Cambia este valor al color deseado */
            font-size: 18px; 
            font-weight: bold;
        }

        .red {
            color: red; /* Cambia este valor al color deseado */
            font-size: 30px; 
            font-weight: bold; 
        }
        .centrado {
            text-align: center;
        }

        .sindesborde {
            width: 200px; /* ajusta el ancho según tus necesidades */
            white-space: nowrap;
            overflow: hidden;
        }

        .page-break { /* Salto de pagina */
            page-break-before: always;
        }

        .registro {
    position: fixed;
    top: 94px; /* Ajusta la distancia desde el borde superior */
    right: 70px; /* Ajusta la distancia desde el borde derecho */
    color: black;
    font-size: 12px; 
    font-weight: bold;
    }

    .id {
    position: fixed;
    top: 94px; /* Ajusta la distancia desde el borde superior */
    right:310px; /* Ajusta la distancia desde el borde derecho */
    color: black;
    font-size: 12px; 
    font-weight: bold;
    }
        

    </style>

    <title>Minuta Electrónica</title>
</head>

<body>
    <center> <img src="img/Plantilla.png"> </center>
     
    <span class="id"> {{ $bitacora->id}} </span>
    <span class="registro"> {{ \Carbon\Carbon::parse($bitacora->created_at)->format('Y-m-d') }} </span>

    
    <br><br><br><br><br><br><br>

    <span class="negro"> Detalles de la reunión </span>
    <br>
    <table>
        <tr>
            <th style="width: auto;">Elementos</th>
            <th style="width: 100%;">Descripción</th>
        </tr>
        <tr>
            <td>Nombre:</td>
            <td>{{$bitacora->nombre_corto}}</td>
        </tr>
        <tr>
            <td>Asunto:</td>
            <td>{{$bitacora->asunto}}</td>
        </tr>
        <tr>
            <td>Modalidad:</td>
            <td>{{$bitacora->modalidad}}</td>
        </tr>
        <tr>
            <td>Tema:</td>
            <td>{{$bitacora->tema}}</td>
        </tr>
        <tr>
            <td>Lugar:</td>
            <td>{{$bitacora->lugar}}</td>
        </tr>
    </table>

    <span class="negro"> Descripción de la reunión </span>
    <br>
    
     <table class="tabla_descripcion">
        <tr>
            <th>Orden del Día</th>
        </tr>
        <tr>
            <td> {{$bitacora->ordendeldia}}  </td>
        </tr>
    </table>

    <table class="tabla_descripcion">
        <tr>
            <th>Acuerdos</th>
        </tr>
        <tr>
            <td> {{$bitacora->acuerdos}}  </td>
        </tr>
    </table>

    <table class="tabla_descripcion">
        <tr>
            <th>Pendientes</th>
        </tr>
        <tr>
            <td> {{$bitacora->pendientes}}  </td>
        </tr>
    </table>
    
    <table class="tabla_descripcion">
        <tr>
            <th>Conclusiones</th>
        </tr>
        <tr>
            <td> {{$bitacora->conclusiones}}  </td>
        </tr>
    </table>

    <div class="page-break"></div>
   
   <center> <img src="img/Plantilla.png" alt=""></center>

   <br><br><br><br><br><br><br>
   <span class="negro"> Asistentes de la reunión </span>
   <br>
        @php
        $i = 0
        @endphp
        <table class="tabla_asistentes">
                <thead>
                    <tr>
                      <th>Núm.</th>
                      <th>Nombre</th>
                      <th>Apellidos</th>
                      <th>Firma</th>
                    </tr>
                  </thead>
                  <tbody>  
                  @foreach($asistentes as $asistente)
                    <tr>
                      <td class="asistente">{{++$i}}</td>
                      <td class="asistente">{{$asistente->nombre}}</td>
                      <td class="asistente">{{$asistente->apellidos}}</td>
                      <td></td>
                    </tr>
                  @endforeach
                  </tbody>
        </table>
   
    <span class="negro"> Evidencias de la reunión </span>
    <br> <br>
    <img src="{{ $pic1 }}" style="width:280x; height:360px;">

<!--

    <div class="page-break"></div>
   
    <center> <img src="img/Plantilla.png" alt=""></center>

    <br> <br> <br> <br> <br> <br> <br> <br> 
    <span class="negro"> Evidencias de la reunión </span>
    <br> <br>

    <img src="{{ $pic1 }}" style=" width: 270x; height:360px;">

        <br> <br> <br> <br> <br> <br> <br> <br> <br>  
        <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> 
    <img src="{{ $pic2 }}" style=" width: 270x; height:360px;">
-->
</body>
</html>