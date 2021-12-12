<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Document</title>
</head>
<style type="text/css">
    .contenedor{
        width: 600px;
        height: 720px;
        border: 1px solid rgb(16, 56, 58);
        margin: 0 auto;
    }

    .contenido{
        padding-top: 50px;
        width: 500px;
        height: 400px;
        margin: 0 auto;
    }
    h4{
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        color: rgb(8, 86, 90);
    }

    h5{
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        color: rgb(37, 48, 148);
        padding-top: 10px;
    }
    .mensaje{
        height: 250px;
    }
    span{
        color:gray;
    }
    .pie{
        background-color: rgb(27, 29, 29);
        color: floralwhite;
        text-align: center;
        height: 125px;
    }
    img{
        padding-top: 10px;
    }
    p{
        padding-top: 10px;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
    }

</style>
<body>
    <div class="contenedor">
        <img src="http://gestic/storage/logo.png" alt="" width="105px" height="100px">
        <hr>
        <div class="contenido">
            
                <h4>RECORDATORIO DE CONTRASEÑA DEL USUARIO EN GESTIC</h4>
                <h5>Usuario: {{$datos -> email}}</h5>
                <h5>Pulsa <a href="http://localhost:4200/reset">AQUI</a> para restablecer su contraseña<h5>
           
        </div>
        <div class="pie">
            
                <p>GESTIC - Control de Incidencias</p>
                <p>mail: info@aplicacionesnet.es</p>
                <p>Todos los derechos reservados.</p>
            
        </div>
    </div>
</body>
</html>