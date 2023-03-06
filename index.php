<?php session_start(); ?>
<?php include 'header.php'; ?>
<body>
<div class="login-box reloj">
    <div class="login-logo">
      <p id="time" class="bold"></p>
      <h1 id="date"></h1>
    </div>
    <div class="alert alert-success alert-dismissible mt20 text-center" style="display:none;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <span class="result"><i class="icon fa fa-check"></i> <span class="message"></span></span>
    </div>
    <div class="alert alert-danger alert-dismissible mt20 text-center" style="display:none;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <span class="result"><i class="icon fa fa-warning"></i> <span class="message"></span></span>
    </div>
</div>


<div class="container">
<div class="container" id="loginform">
  <div class="row justify-content-center">
    <div class="col-md-6 col-sm-8 col-xl-4 col-lg-5 formulario">
      <h4 class="login-box-msg">Ingrese su ID de Empleado</h4>

      <form id="attendance">
          <div class="form-group mx-sm-4 pt-3">
            <select class="form-control" placeholder="Elegir Turno" name="status">
              <option value="in">Hora de Entrada</option>
              <option value="out">Hora de Salida</option>
            </select>
          </div>
 
             <div class="form-group mx-sm-4 pt-3"> 
                  <input class="form-control" placeholder="Codigo de Asistencia" id="employee" name="employee" required>
                  <span class="glyphicon glyphicon-calendar form-control-feedback"></span>
             </div>
             <br>
             <div class="form-group mx-sm-4 pb-2">
                <button type="submit" class="btn btn-block ingresar" name="signin"><i class="fa fa-sign-in"></i> Login</button>
             </div>

      </form>
    </div>
  </div>
</div>
</div>

<?php include 'scripts.php' ?>
<script type="text/javascript">
$(function() {
  var interval = setInterval(function() {
    var momentNow = moment();

moment.lang('es', {
  months: 'Enero_Febrero_Marzo_Abril_Mayo_Junio_Julio_Agosto_Septiembre_Octubre_Noviembre_Diciembre'.split('_'),
  monthsShort: 'Enero._Feb._Mar_Abr._May_Jun_Jul._Ago_Sept._Oct._Nov._Dec.'.split('_'),
  weekdays: 'Domingo_Lunes_Martes_Miercoles_Jueves_Viernes_Sabado'.split('_'),
  weekdaysShort: 'Dom._Lun._Mar._Mier._Jue._Vier._Sab.'.split('_'),
  weekdaysMin: 'Do_Lu_Ma_Mi_Ju_Vi_Sa'.split('_')
})


    $('#date').html(momentNow.format('dddd').substring(0,10).toUpperCase() + ' - ' + momentNow.format('MMMM DD, YYYY'));  
    $('#time').html(momentNow.format('hh:mm:ss A'));
  }, 100);

  $('#attendance').submit(function(e){
    e.preventDefault();
    var attendance = $(this).serialize();
    $.ajax({
      type: 'POST',
      url: 'attendance.php',
      data: attendance,
      dataType: 'json',
      success: function(response){
        if(response.error){
          $('.alert').hide();
          $('.alert-danger').show();
          $('.message').html(response.message);
        }
        else{
          $('.alert').hide();
          $('.alert-success').show();
          $('.message').html(response.message);
          $('#employee').val('');
        }
      }
    });
  });
    
});
</script>
</body>
</html>


<?php 
  include('admin/includes/conn.php');
  $query = "select * from imagenes";
  $resultado = mysqli_query($conn,$query);
?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script> 
  <script src="admin/jquery.js"></script>
  <title>galeria</title>
</head>
<body>


<div id="general1">
    <ul class="galeria">
    <?php foreach($resultado as $row){ ?>
        <img src="admin/Backend/imagenes/<?php echo $row['nombre']; ?>" class="galeria__img">
    <?php }?>
    </ul>

</div>
<script src="admin/modal.js"></script>
</body>
</html>


<style type="text/css">
* {
  box-sizing: border-box;
}


body {
  margin: 0;

}

div#general1{
  position: absolute;

  left: 10px;
  bottom: 10px;
  top: 10px;
  margin: auto;
  margin-top: 50px;
  width: 500px;
  height: 650px;

}

.galeria {
  display: flex;
  width: 100%;
  justify-content: space-around;
  flex-wrap: wrap;
  max-width: 1000px;
  margin: auto;
}


.galeria__img{
  width: 200px;
  height: 300px;
  margin-bottom: 10px;
  padding: 10px;
  cursor: pointer;
  object-fit: cover;
  animation: escalar 1.5s infinite alternate;

  border: 2px solid white;
  box-shadow: inset 0 0 5px #11e6dc, 0 0 20px #11e6dc;
  

}

@keyframes escalar{
  to{
    transform: scale(1);
  }
  from{
    transform: scale(1.05);
  }
}


@media (min-width:480px) {
  .galeria__img,
  div#general1{

  
  }
}

@media (min-width:768px) {
  .galeria__img,
  div#general1{


  }
}

@media (min-width:1024px) {
  .galeria__img,
  div#general1{


  }
}

.modal {
  position: fixed;
  width: 100%;
  height: 100vh;
  background: rgba(0, 0, 0, 0.7);
  top: 0;
  left: 0;

  display: flex;
  justify-content: center;
  align-items: center;
}

.modal__img {
  width: 60%;
  max-width: 500px;
}

.modal__boton {
  width: 50px;
  height: 50px;
  color: #fff;
  font-weight: bold;
  font-size: 25px;
  font-family: monospace;
  line-height: 50px;
  text-align: center;
  background: red;
  border-radius: 50%;
  cursor: pointer;

  position: absolute;
  right: 10px;
  top: 10px;
}



</style>