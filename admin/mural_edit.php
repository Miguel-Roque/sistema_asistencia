<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet">
    <style>
      body{
        background: url(../admin/Backend/imagenes/ledback1.jpg);
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
      }

      .card{
        background-color: rgba(255, 255, 255, 0.2);
        color:white;
      }
    </style>

    <title>Edición de comunicado</title>
    
  </head>
  <body>
    

  <div class="container">
    <div class="row">
      <div class="col-lg-10 col-xl-9 opacity-50 mx-auto" style="max-width: 45rem;">>
        <div class="card flex-row my-5 border-0 shadow rounded-3 overflow-hidden">
          <div class="card-img-left d-none d-md-flex">
            <!-- Background image for card set in CSS! -->
          </div>
          <div class="card-body p-4 p-sm-5">
            <h5 class="card-title text-center mb-5 fw-light fs-1">Edite el comunicado</h5>
            <form action="../admin/Backend/editar.php" method="POST" enctype="multipart/form-data">

            <div class="form-group">
              <label for="formFile" class="form-label">Seleccione una Imagen</label>
              <input class="form-control" type="file" id="formFile" name="imgedit">
            </div><br>

              <div class="d-grid mb-2">
                <button class="btn btn-lg btn-primary btn-login fw-bold text-uppercase" type="submit" name="editarcomunic">Editar</button>
              </div>
              <div class="d-grid mb-2">
                <button class="btn btn-lg btn-outline-danger btn-login fw-bold text-uppercase" type="button" onclick="window.history.back()">Cancelar edición</button>
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