<?php
require 'header.php';
?>
 <div class="content-wrapper"> 
        <!-- Main content -->
        <section class="content">
        <br>
          <?php
              if($_SESSION['proveedorcrear']==1){
              echo '<button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter">
              <i class="fa fa-plus-square" aria-hidden="true"></i> Crear Registros
       </button>';
              }
              ?>
    <br>
<button type="button" class="btn btn-warning" onclick="reporte1(0);">
       <i class="fa fa-id-badge" aria-hidden="true"></i> Reporte
</button>
    <br>
        <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-bordered table-striped">
                          <thead>
                          <th><i class="fa fa-cog"></i> Opciones</th>
                          <th>ID CLIENTE</th>
                            <th>RTN</th>
                            <th>Cliente</th>                           
                            <th>Direccion</th>                           
                            <th>Estado Civil</th> 
                            <th>Telefono</th>                           
                            
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                          <th><i class="fa fa-cog"></i> Opciones</th>
                          <th>ID CLIENTE</th>
                            <th>RTN</th>
                            <th>Cliente</th>                           
                            <th>Direccion</th>                           
                            <th>Estado Civil</th> 
                            <th>Telefono</th> 
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
        <h5 class="modal-title" id="exampleModalCenterTitle">Formulario Cliente</h5>
        <button type="button" class="close" data-dismiss="modal" onclick="limpiar()"; aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form role="form"  id="formulario" name="formulario">
            <div class="row">
              <div class="col-md-12">
                <label> Cliente:</label>
                <input type="text" hidden id="idcliente" name="idcliente">
                <input type="text" class="form-control" placeholder="Ingrese el rtn" name="rtn" id="rtn" required>
                <input type="text" class="form-control" placeholder="Ingrese el cliente" name="cliente" id="cliente" required>
                <input type="text" class="form-control" placeholder="Ingrese la direccion" name="direccion" id="direccion" required>
                <input type="text" class="form-control" placeholder="Ingrese el estado civil" name="estado" id="estado" required>
                <input type="text" class="form-control" placeholder="Ingrese el telefono" name="telefono" id="telefono" required>
                <select  id="lugares" name="lugares" class="form-control select2 select2-warning" data-dropdown-css-class="select2-warning" style="width: 100%;">
              </select>
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
<script type="text/javascript" src="scripts/cliente.js"></script>
<!-- Bootstrap 4 -->
<script src="../librerias/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<script src="../librerias/plugins/select2/js/select2.full.min.js"></script>
<script>
$(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

  })
</script>