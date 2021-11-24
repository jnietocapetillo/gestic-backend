<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Usuario</title>
</head>
<body>
<div class="container">
    <img src="/public/storage/logo.png" alt="" width="205px" height="200px">
    <hr>
    <h3>Se ha dado de ALTA en Gestic. Recibirá una notificación cuando sea Activado para poder acceder a la plataforma.</h3>
    <div class="flex-row">
        <div class="p-2">
            <h3>Datos de Usuario: </h3><span>{{$datos['email']}}</span>
        </div>
        <div class="p-2">
            <h3>Acceso: </h3><span>https://aplicacionesnet.es/gestic</span>
        </div>
        <div class="p-2">
            <p>Podrá comprobar sus datos personales accediendo a la aplicación y modificarlos en caso necesario.</p>
        </div>
        <div class="p-2">
            <h4>Gracias por utilizar nuestro servicio. No conrteste a este email, es con fiones informativos.</h4>
        </div>
    </div>
</div>
    
</body>
<footer>
    <div class="flex-row justify-content-center">
        <div class="p-2">
            <h4>GESTIC</h4>
        </div>
        <div class="p-2">
            <h3>info@aplicacionesnet.es</h3>
        </div>
    </div>
</footer>
</html>