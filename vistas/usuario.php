<?php
require 'header.php';
?>
<?php 
if (strlen(session_id())<1) 
	session_start();
  ?>
 <div class="content-wrapper">        
        <!-- Main content -->
        <section class="content">
          <br>
          <?php
              if($_SESSION['usuariocrear']==1){
              echo '<button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter">
              <i class="fa fa-plus-square" aria-hidden="true"></i> Crear Registros
       </button>';
              }
              ?>
    <br>
        <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-bordered table-striped">
                          <thead>
                          <th><i class="fa fa-cog"></i> Opciones</th>
                            <th>ID Usuario</th>
                            <th>Usuario</th>                           
                            <th>Login</th>
                            <th>Clave</th>
                            <th>Cargo</th>                           
                            <th>Imagen</th>
                            <th>Estado</th>                           
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                            <th><i class="fa fa-cog"></i>Opciones</th>
                            <th>ID Usuario</th>
                            <th>Usuario</th>                           
                            <th>Login</th>
                            <th>Clave</th>
                            <th>Cargo</th>                           
                            <th>Imagen</th>
                            <th>Estado</th> 
                          </tfoot>
                        </table>
                    </div>
        <div class="panel-body" style="height: 400px;" id="formularioregistros">
        
        <div>

</section>
</div>

<?php
require 'footer.php';
?>
<!--
<script>
  $(function () {
    $("#tbllistado").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#tbllistado_wrapper .col-md-6:eq(0)');
   
  });
</script>-->

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Perfil del Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" onclick="limpiar()"; aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

          <form role="form"  id="formulario" name="formulario">

            <div class="row">
              <div class="col-md-6">
                <label>Nombre usuario:</label>
                <input type="text" hidden id="idusuario" name="idusuario">
                <input type="text" class="form-control" placeholder="Ingrese el nombre" name="nombre" id="nombre" required>
              </div>
              <div class="col-md-6">
                <label>Login:</label>
                <input type="text" class="form-control" id="login" name="login">
                </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <label>Clave:</label>
                <input type="password" class="form-control" placeholder="Ingrese la clave" name="clave" id="clave" required>
              </div>
              <div class="col-md-6">
                <label>Cargo:</label>
                <select class="form-control select2" id="cargo" name="cargo">
                    <option value="Administrador">Administrador</option>
                    <option value="Vendedor">Vendedor</option>
                    <option value="Cajero">Cajero</option>
                    <option value="Reportes">Reportes</option>
                </select>
                </div>
            </div>
            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Imagen:</label>
                            <input type="file" class="form-control" name="imagen" id="imagen">
                            <input type="hidden" name="imagenactual" id="imagenactual">
                            <img src="" width="150px" height="120px" id="imagenmuestra">
            </div>
            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <label>Permisos:</label>
              <ul style="list-style: none;" id="permisos">

              </ul>
            </div>  
              <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="limpiar()"; data-dismiss="modal">Cerrar</button>
        <button type="button" onclick="guardarRegistro()"; class="btn btn-primary">Guardar Registro</button>
      </div>
</form>
      </div>
      
    </div>
  </div>
</div>
<script type="text/javascript" src="scripts/usuario.js"></script>
