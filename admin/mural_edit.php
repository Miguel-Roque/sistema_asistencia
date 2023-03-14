<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet">

    <title>Registro de Usuario</title>
    
  </head>
  <body>
  <div class="container">
    <div class="row">
      <div class="col-lg-10 col-xl-9 mx-auto">
        <div class="card flex-row my-5 border-0 shadow rounded-3 overflow-hidden">
          <div class="card-img-left d-none d-md-flex">
            <!-- Background image for card set in CSS! -->
          </div>
          <div class="card-body p-4 p-sm-5">
            <h5 class="card-title text-center mb-5 fw-light fs-5">Registrarse</h5>
            <form action="agregar.php" method="post">

              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="idUsuario" name="idUsuario" placeholder="Codigo" required autofocus>
                <label for="usuario">Codigo</label>
              </div>

              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuario" required autofocus>
                <label for="usuario">Usuario</label>
              </div>

              <div class="form-floating mb-3">
                <input type="password" class="form-control" id="contrasena" name="contrasena" placeholder="Password" required>
                <label for="password">Password</label>
              </div>

              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="dni" name="dni" placeholder="DNI" required autofocus>
                <label for="usuario">DNI</label>
              </div>


              <div class="d-grid mb-2">
                <button class="btn btn-lg btn-primary btn-login fw-bold text-uppercase" type="submit">Registrar</button>
              </div>
              <div class="d-grid mb-2">
                <button class="btn btn-lg btn-outline-danger btn-login fw-bold text-uppercase" type="button" onclick="window.history.back()">Cancelar</button>
              </div>

              <hr class="my-4">

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
    

   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

   
  </body>
</html>