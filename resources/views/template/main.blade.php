<!DOCTYPE html>
<html lang="es">

 <head>
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	    <meta name="description" content="">
	    <meta name="author" content="">
	    
		<title>@yield('title', 'Default') | Nuevo Docente</title>
	    
	    <link rel="stylesheet" href="{{asset('plugins/bootstrap/css/bootstrap.css')}}">
	    <link rel="stylesheet" href="{{asset('plugins/bootstrap/css/bootstrap.min.css')}}">
	    <link rel="stylesheet" href="{{asset('plugins/bootstrap/js/bootstrap.min.js')}}">
	    <link rel="stylesheet" href="{{asset('css/nav-banner.css')}}">
	    <link rel="stylesheet" href="{{asset('css/nav.css')}}">
	    <link rel="stylesheet" href="{{asset('css/nav-tab.css')}}">
	    <link rel="stylesheet" href="{{asset('css/footer.css')}}">
		<link rel="stylesheet" href="{{asset('css/fieldset.css')}}">


		<link href="https://fonts.googleapis.com/css?family=Coda" rel="stylesheet">
		

</head>

  <body>
			<div  id="particles-js" > </div>
   	    	<div class="container">
			@include('template.banner')
   	    	@include('template.menu')
   	    		<div class="jumbotron jumbotron-fluid">
							@yield('contenido')	
				</div>
   	    	</div>		
  </body>

  <footer class="footer-base panel-footer jumbotron">
        <font color=#ffffff><center>&copy; Laboratorio de Tecnologías de Información y Comunicación en Salud (LATICS) - Actulización 03-2025</center></font>
  </footer>

  	{{asset('jquery/jquery.min.js')}}
	{{asset('jquery/dropdown.js')}}
	<script src="{{asset('plugins/bootstrap/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('js/particles.js')}}" ></script>
	<script src="{{asset('js/app.js')}}" ></script>

</html>
