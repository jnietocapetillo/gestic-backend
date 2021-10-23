<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200&family=Open+Sans+Condensed:wght@300&family=Roboto:wght@100&display=swap" rel="stylesheet">  
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <title>Document</title>
</head>
    
<body>
<div class="container">
    <img class="m-5" src="/app/storage/app/public/logo.png" width="200px" height="104px">

    <h3 class="text-info">Solicitud al Director</h3>
    <hr>
    <form action="{{ route('datos') }}" method="post" class="form-group">
  <div class="mb-3 row">
    <label for="nombre" class="col-sm-2 col-form-label text-info">Nombre y Apellidos:</label>
    <div class="col-sm-10">
      <input type="text" readonly class="form-control-plaintext" id="nombre" value="nombre y apellidos">
    </div>
  </div>
  <div class="mb-3 row">
    <label for="categoria" class="col-sm-2 col-form-label text-info">Categoría:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control-plaintext" id="categoria" value="categoria">
    </div>
  </div>
    <div class="mb-3 row">
    <label for="solicita" class="col-sm-2 col-form-label text-info">Solicita:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="solicita">
    </div>
  </div>
   <div class="mb-3 row">
    <label for="observaciones" class="col-sm-2 col-form-label text-info">Observaciones:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="observaciones">
    </div>
  </div>
    <hr>
    <div class="d-flex flex-row justify-content-end">
        <div class="p-2">
            <h4 class="text-info">fecha</h4>
        </div>
    </div>
    <hr>
    <div class="d-flex flex-row justify-content-start">
        <div class="p-2">
            <h6>Firma del interesado:</h6>
        </div>
    </div>
    <div class="d-flex flex-row mb-5 justify-content-center">
        <div class="p-2" style="width: 300px; height:200px;border:1px solid grey;"></div>
    </div>
    <div class="mb-3">
        <label for="informeDepartamento" class="form-label text-info">Informe del departamento:</label>
        <textarea class="form-control bg-info text-light" cols="10" id="informeDepartamento" >Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</textarea>     
    </div>
    <div class="d-flex flex-row justify-content-end">
        <div class="p-2"><h6>Jefe del Departamento</h6></div>
    </div>
    <div class="mb-3">
        <label for="informePersonal" class="form-label text-info">Informe de personal:</label>
        <textarea class="form-control bg-info text-light" cols="10" id="informePersonal">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</textarea>     
    </div>
    <div class="d-flex flex-row justify-content-end">
        <div class="p-2"><h6>Jefe de Personal</h6></div>
    </div>
    <hr>
    <div class="d-flex flex-row align-items-center mb-5">
        <div class="p-2"><label for="resolucion" class="col-sm-2 col-form-label text-info">Resolución:</label></div>
        <div class="p-2"><input type="radio" id="resolucion" name="resolucion" value="aprobada"> Aprobada</div>
        <div class="p-2"><input type="radio" id="resolcuion1" name="resolucion" value="denegada"> Denegada</div>
    </div>

    <h6>Vº.Bº dirección</h6>

    <hr>
    <div class="d-flex flex-row justify-content-end">
        <div class="p-2">
            <h4 class="text-info">fecha</h4>
        </div>
    </div>
</form>
</div>

<script>
    document.getElementById('informeDepartamento').addEventListener("click",function(event){
        this.className = "form-control";
    });
    document.getElementById('informeDepartamento').addEventListener("focusout",function(event){
        this.className = "form-control bg-info text-light";
    });
    document.getElementById('informePersonal').addEventListener("click",function(event){
        this.className = "form-control";
    });
    document.getElementById('informePersonal').addEventListener("focusout",function(event){
        this.className = "form-control bg-info text-light";
    });
</script> 
</body>
</html>

