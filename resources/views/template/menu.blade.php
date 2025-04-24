<link rel="stylesheet" href="{{asset('css/menu.css')}}">
<link rel="stylesheet" href="{{asset('css/animation.css')}}">


<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
</head>
<body>

	<nav class="nav">
		<ul>
			@auth
			<li>
				<a href="{{ url('/dashboard') }}"> <center> <span class="glyphicon glyphicon-home"></span><br>Inicio </center></a>
			</li>
			<li>
				<a href="{{ url('asistente/mostrar') }}"> <center> <span class="glyphicon glyphicon-user"></span>Asistentes </center></a>
			</li>
            <li>
				<a href="{{ url('reunion/mostrar') }}"> <center> <span class="glyphicon glyphicon-list-alt"></span>Reuniones </center></a>
			</li>

			<li>
				<form action="{{route('logout')}}" method="post">
				@csrf
					<a href="#" onclick="this.closest('form').submit()"> <center> <span class="glyphicon glyphicon-log-out"></span><br>Salir </center> </a>
				</form>
			</li>
			@endauth
			<li>
					<a href="{{ url('/contacto') }}"> <center> <span  class="glyphicon glyphicon-info-sign"></span><br>Contacto</center> </a>
			</li>
		</ul>
	</nav>
</body>
</html>