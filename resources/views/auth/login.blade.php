@extends('template.main')

@section('title') 
    Inicio
@endsection

@section('contenido') 

<link rel="stylesheet" href="{{asset('css/caja_azul.css')}}">
<link rel="stylesheet" href="{{asset('css/login.css')}}">

<center><p class="caja"> INGRESA LAS CREDENCIALES PARA AUTENTICACIÓN </p> </center>
<br>

<form method="POST" action="/login">
    <!-- Token CSRF -->
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    
    <div class="global-container">
	<div class="card login-form">
	<div class="card-body">
	<div class="card-text">

    <!-- Dirección de Email -->
    <div class="form-group">
        <label for="email" class="form-label">Email</label>
        <input id="email" class="form-control" type="email" name="email" required autofocus autocomplete="username">
        <div class="text-danger mt-2">
            <!-- Mensajes de error de email -->
            <!--Error message for email.-->
        </div>
    </div>

    <!-- Contraseña -->
    <div class="form-group">
        <label for="password" class="form-label">Password</label>
        <input id="password" class="form-control" type="password" name="password" required autocomplete="current-password">
        <div class="text-danger mt-2">
            <!-- Mensajes de error de contraseña -->
           <!-- Error message for password.-->
        </div>
    </div>

    <!-- Recordar sesión -->
    <div class="form-check mb-3">
        <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
        <label for="remember_me" class="form-check-label">Remember me</label>
    </div>

    <div class="d-flex justify-content-between align-items-center">
        <a class="text-sm" href="/forgot-password">Forgot your password?</a>
        <button type="submit" class="btn btn-primary">Entrar</button>
    </div>

    </div>
    </div>
    </div>
    </div>


</form>

@endsection