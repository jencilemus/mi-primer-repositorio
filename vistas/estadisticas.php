<?php
require 'header.php';
?>
 <div class="content-wrapper"> 
        <!-- Main content -->
        <section class="content">
        <br>
    <br>
        <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-bordered table-striped">
                          <thead>
                          
                          <th>ID Factura</th>
                            <th>Codigo Cliente</th>
                            <th>Cliente</th>                           
                            <th>RTN</th>                           
                            <th>Vendedor</th>                                                     
                            <th>Tipo Factura</th>                         
                            <th>Tipo Pago</th>
                            <th>Telefono</th>                         
                            <th>Cargo</th>
                            <th>Total</th>
                            <th>Fecha</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                          
                          <th>ID Factura</th>
                            <th>Codigo Cliente</th>
                            <th>Cliente</th>                           
                            <th>RTN</th>                           
                            <th>Vendedor</th>                                                     
                            <th>Tipo Factura</th>                         
                            <th>Tipo Pago</th>
                            <th>Telefono</th>                         
                            <th>Cargo</th>
                            <th>Total</th>
                            <th>Fecha</th>
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

<script type="text/javascript" src="scripts/estadisticas.js"></script>
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