<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <div class="container w-50">
        <img src="inicio.png" alt="" width="105px" height="100px">
        <hr>
        <div class="d-flex flex-row pt-5 pb-5 justify-content-center border border-dark">
            <div class="p-2">
                <h4>SE HA CAMBIADO EL ESTADO DE INCIDENCIA EN GESTIC</h4>
                <h5 class="pt-3">DATOS:</h5>
                <h6 class="text-primary pt-3">Número incidencia: {{$datos -> incidencia}}</h6>
                <h6 class="text-primary pt-3 pb-5">Estado: {{$datos -> estado}}</h6>

                <span>Más detalles en Gestic, mis incidencias.</span>
            </div>
        </div>
        <div class="d-flex justify-content-center bg-dark">
            <div class="p-2 pt-5">
                <p class="text-light">GESTIC - Control de Incidencias</p>
                <p class="text-light">mail: info@aplicacionesnet.es</p>
                <p class="text-light">Todos los derechos reservados.</p>
            </div>
        </div>
    </div>
</body>
</html>