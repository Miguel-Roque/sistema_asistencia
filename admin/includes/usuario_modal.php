<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Agregar Admin</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="usuario_add.php" enctype="multipart/form-data">
          		  <div class="form-group">
                  	<label for="username" class="col-sm-3 control-label">Usuario</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="username" name="username" required>
                  	</div>
                </div>
                <div class="form-group">
                  	<label for="password" class="col-sm-3 control-label">Contraseña</label>

                  	<div class="col-sm-9">
                    	<input type="password" class="form-control" id="password" name="password" required>
                  	</div>
                </div>
                <div class="form-group">
                  	<label for="firstname" class="col-sm-3 control-label">Nombre</label>

                  	<div class="col-sm-9">
                      <input type="text" class="form-control" name="firstname" id="firstname" require></input>
                  	</div>
                </div>
                <div class="form-group">
                  	<label for="lastname" class="col-sm-3 control-label">Apellido</label>

                  	<div class="col-sm-9">
                      <input type="text" class="form-control" name="lastname" id="lastname" require></input>
                  	</div>
                </div>
                <div class="form-group">
                  	<label for="rango" class="col-sm-3 control-label">Rango</label>

					<div class="col-sm-9">
                        <select class="form-control" name="rango" id="rango" required>
                        <option value="" selected>- Seleccionar -</option>
                        <?php
                          $sql = "SELECT * FROM rango";
                          $query = $conn->query($sql);
                          while($prow = $query->fetch_assoc()){
                            echo "
                              <option value='".$prow['id']."'>".$prow['rango']."</option>
                            ";
                          }
                        ?>
                        </select>
                    </div>
                </div>
                
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
            	<button type="submit" class="btn btn-primary btn-flat" name="add"><i class="fa fa-save"></i> Guardar</button>
            	</form>
          	</div>
        </div>
    </div>
</div>

<!-- Edit -->
<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Actualizar Admin</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="usuario_edit.php">
            		<input type="hidden" class="id" name="id">
                <div class="form-group">
                    <label for="edit_username" class="col-sm-3 control-label">Usuario</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_username" name="username">
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_password" class="col-sm-3 control-label">Contraseña</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_password" name="password">
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_firstname" class="col-sm-3 control-label">Nombre</label>

                    <div class="col-sm-9">
                      <label class="form-control" name="firstname" id="edit_firstname"></label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_lastname" class="col-sm-3 control-label">Apellido</label>

                    <div class="col-sm-9">
                      <label class="form-control" name="lastname" id="edit_lastname"></label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_photo" class="col-sm-3 control-label">Foto</label>

                    <div class="col-sm-9">
                      <label class="form-control" name="photo" id="edit_photo"></label>
                    </div>
                </div>
                <div class="form-group">
                  	<label for="edit_rango" class="col-sm-3 control-label">Rango</label>

                  	<div class="col-sm-9">
                    <select class="form-control" name="rango" id="edit_rango" required>
                        <option selected id="rango_val">- Seleccionar -</option>
                        <option value="admin">admin</option>
                        <option value="user">user</option>
                      </select>
                  	</div>
                </div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
            	<button type="submit" class="btn btn-success btn-flat" name="edit"><i class="fa fa-check-square-o"></i> Actualizar</button>
            	</form>
          	</div>
        </div>
    </div>
</div>

<!-- Delete -->
<div class="modal fade" id="delete">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Borrando...</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="usuario_delete.php">
            		<input type="hidden" class="id" name="id">
            		<div class="text-center">
	                	<p>Borrar Admin</p>
	                	<h2 class="bold del_usuario_name"></h2>
	            	</div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
            	<button type="submit" class="btn btn-danger btn-flat" name="delete"><i class="fa fa-trash"></i> Eliminar</button>
            	</form>
          	</div>
        </div>
    </div>
</div>
