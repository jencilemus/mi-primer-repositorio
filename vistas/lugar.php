<?php
require 'header.php';
?>

 <div class="content-wrapper">        
        <!-- Main content -->
        <section class="content">
          <br>
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter">
       <i class="fa fa-plus-square" aria-hidden="true"></i> Crear Registros
</button>
    <br>
        <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-bordered table-striped">
                          <thead>
                          <th><i class="fa fa-cog"></i> Opciones</th>
                            <th>ID Lugar</th>
                            <th>Nombre</th>                           
                            <th>Estado</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                            <th><i class="fa fa-cog"></i>Opciones</th>
                            <th>ID Lugar</th>                            
                            <th>Nombre</th>
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
        <h5 class="modal-title" id="exampleModalCenterTitle">Formulario Lugar</h5>
        <button type="button" class="close" data-dismiss="modal" onclick="limpiar()"; aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form role="form"  id="formulario" name="formulario">
            <div class="row">
              <div class="col-md-12">
                <label> Escriba el lugar:</label>
                <input type="text" hidden id="idlugar" name="idlugar">
                <input type="text" class="form-control" placeholder="Ingrese el lugar" name="lugar" id="lugar" required>

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
<script type="text/javascript" src="scripts/lugar.js"></script>
