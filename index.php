<?php session_start(); ?>
<?php include 'header.php'; ?>
<body>

<div class="asistencia">
  <div class="asistencia__contend">
    <div class="asistencia__campos">
      <h1 class="asistencia__tittle">¡Hola, Neonhouseled SAC te da la bienvenida!</h1>
      <div class="alert alert-dismissible mt20 text-center success__alert" style="display:none;">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <span class="result"><span class="message"></span></span>
      </div>
      <div class="alert alert-dismissible mt20 text-center danger__alert tittle__error" style="display:none;">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <span class="result"> <i class="icon fa fa-warning"></i><span class="message"></span></span>
      </div>
      <div class="asistencia__frace-time">
        <div class="login-logo login-time_asistencia">
          <h1 id="date" class="fecha__cambio time-asistencia3"></h1>
          <p id="time" class="time-asistencia time-asistencia2"></p>
          <div class="alert alert-dismissible mt20 text-center success__alert asistencia__frace-on asistencia-sep" style="display:none;">
          <span class="result ">
            <button type="submit" class=" btn_perfil-estadisticas" name="">VISITAR MI PERFIL</button><br>
            <button type="submit" class=" btn_perfil-estadisticas" name="">VER MIS ESTADÍSTICAS</button>
          </span>
        </div>
        </div>
        <div class="alert alert-dismissible mt20 text-center success__alert asistencia__frace-on" style="display:none;">
          <span class="result">
            <div class="asistencia__frace">
                <img class="aistencia__img-frace" src="https://cdn-icons-png.flaticon.com/512/3989/3989540.png" alt="img-motivacion"> <br>
                <span class="frase">¡Tu esfuerzo de hoy será el éxito de mañana!</span>
            </div>
          </span>
        </div>
      </div>
      
      <div class="alert alert-dismissible mt20 text-center danger__alert" style="display:none;">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <span class="result"><button class=" btn_perfil-estadisticas volver-btn" onclick="location.reload()">VOLVER</button></span>
      </div>
      <form id="attendance" class="asistencia__form-in">
          <div class="form-group mx-sm-4 pt-3 asistencia__form">
            <select class="form-control asistencia-imput select__imput" placeholder="Elegir Turno" name="status">
              <option value="in">INGRESO</option>
              <option value="out">SALIDA</option>
              <option value="">MI PERFIL</option>
            </select>
          </div>
          <div class="form-group mx-sm-4 pt-3 asistencia__form"> 
              <input class="form-control asistencia-imput code__imput" placeholder="CÓDIGO ID" id="employee" name="employee" required>
              <span class="glyphicon glyphicon-calendar form-control-feedback"></span>
          </div>
          <br>
          <div onclick="removeImput()" class="form-group mx-sm-4 pb-2 asistencia__form"">
            <button type="submit" class="btn btn-block ingresar asistencia-imput login-btn__asistencia" name="signin">ENTRAR</button>
          </div>
      </form>
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
          $('.danger__alert').show();
          $('.message').html(response.message);
        }
        else{
          $('.alert').hide();
          $('.success__alert').show();
          $('.message').html(response.message);
          $('#employee').val('');
        }
      }
    });
  });
    
});
</script>
<script type="text/javascript">
  let ocultarImput = document.querySelector(".asistencia__form-in");
  let title = document.querySelector(".asistencia__tittle");
  let caracter = document.querySelector(".code__imput");
  let cambioTime = document.querySelector(".time-asistencia");
  let cambioFecha = document.querySelector(".fecha__cambio");
  function removeImput() {
    if (caracter.value.length > 0) {
      ocultarImput.classList.add("remove__imput");
      title.classList.add("remove__imput");
      cambioTime.classList.add("time-asistencia2");
      cambioFecha.classList.add("time-asistencia3");
    }
  }
</script>
</body>
</html>


<?php 
  include('admin/includes/conn.php');
  $query = "select * from imagenes";
  $resultado = mysqli_query($conn,$query);
?>

<!--
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script> 
  <script src="admin/jquery.js"></script>
  <link rel="stylesheet" href="css/NewStyle.css">
  <title>galeria</title>
</head>
<body>

<div id="general1">
    <ul class="galeria">
    ""
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

-->
