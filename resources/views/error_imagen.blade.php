<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error - Archivo Demasiado Grande</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            margin-top: 50px;
        }
        .error-message {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="error-message">
            <h1 class="display-4">¡Error!</h1>
            <p class="lead">El archivo que intentas subir es demasiado grande.</p>
            <p>Por favor, selecciona un archivo más pequeño y vuelve a intentarlo.</p>
            <p> Te recomendamos disminuir el tamaño de la imagen con la siguiente herramienta: <strong><a href="https://imagecompressor.11zon.com/es/compress-jpg/" target="_blank"> imagencompressor</a></strong></p>
            <a href="{{ url()->previous() }}" class="btn btn-primary">Volver</a>
        </div>
    </div>
</body>