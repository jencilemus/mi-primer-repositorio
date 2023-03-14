<?php
require 'header.php';
?>
 <div class="content-wrapper"> 
        <!-- Main content -->
        <section class="content">
        <br>
          <?php
              if($_SESSION['productocrear']==1){
              echo '<button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter">
              <i class="fa fa-plus-square" aria-hidden="true"></i> Crear Registros
       </button>';
              }
              ?>
             <button type="button" class="btn btn-warning" onclick="reporte1(0);">
       <i class="fa fa-id-badge" aria-hidden="true"></i> Reporte
</button> 
    <br>
        <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-bordered table-striped">
                          <thead>
                          <th><i class="fa fa-cog"></i> Opciones</th>
                          <th>ID Producto</th>
                            <th>Codigo</th>
                            <th>Producto</th>                           
                            <th>Proveedor</th>                           
                            <th>Existencia</th>                                                     
                            <th>Porcentaje1</th>                         
                            <th>Porcentaje2</th>
                            <th>Porcentaje3</th>                         
                            <th>Precio1</th>
                            <th>Precio2</th>
                            <th>Precio3</th>
                            <th>Clasificacion</th> 
                            <th>Unidad</th>
                            <th>Imagen</th>
                            <th>Fecha de Creación</th>
                            <th>Estado</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                          <th><i class="fa fa-cog"></i> Opciones</th>
                          <th>ID Producto</th>
                            <th>Codigo</th>
                            <th>Producto</th>                           
                            <th>Proveedor</th>                           
                            <th>Existencia</th>                                                     
                            <th>Porcentaje1</th>                         
                            <th>Porcentaje2</th>
                            <th>Porcentaje3</th>                         
                            <th>Precio1</th>
                            <th>Precio2</th>
                            <th>Precio3</th>
                            <th>Clasificacion</th> 
                            <th>Unidad</th>
                            <th>Imagen</th>
                            <th>Fecha de Creación</th>
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
        <h5 class="modal-title" id="exampleModalCenterTitle">Formulario Producto</h5>
        <button type="button" class="close" data-dismiss="modal" onclick="limpiar()"; aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form role="form"  id="formulario" name="formulario">
            <div class="row">
              <div class="col-md-12">
                <input type="text" hidden id="idproducto" name="idproducto">
                <input type="text" id="fechacreacion" name="fechacreacion">
                <div class="row">
              <div class="col-md-6">
              <label> Producto:</label>
                <input type="text" class="form-control" placeholder="Ingrese el producto" name="producto" id="producto" required>
            </div>
              <div class="col-md-6">
              <label> Proveedor:</label>
                <select  id="proveedores" name="proveedores" class="form-control" >
              </select>
                </div>
            </div>
            <div class="row">
              <div class="col-md-6">
              <label> Clasificacion:</label>
                <select  id="clasi" name="clasi" class="form-control" >
                <option value="Baño">Baño</option>
                    <option value="Cocina">Cocina</option>
                    <option value="Marmol">Marmol</option>
                    <option value="Madera">Madera</option>
                    <option value="Exterior">Exterior</option>
                    <option value="Porcelanato">Porcelanato</option>
                    <option value="Geometrica">Geometrica</option>
                    <option value="Pegamento">Pegamento</option>
                    <option value="Pieza de Baño">Pieza de Baño</option>
              </select>
            </div>
              <div class="col-md-6">
              <label> Costo:</label>
              <input type="text" onchange="calcular()" class="form-control" placeholder="Ingrese el costo" name="costo" id="costo" required>

                </div>
            </div>
            <div class="row">
              <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Imagen:</label>
                            <input type="file" class="form-control" name="imagen" id="imagen">
                            <input type="hidden" name="imagenactual" id="imagenactual">
                            <img src="" width="150px" height="120px" id="imagenmuestra">
            </div>
            
              <div class="col-md-6">
              <label> Existencia:</label>
                <input type="number" class="form-control" placeholder="Ingrese la existencia" name="existencia" id="existencia" required>
            <label> Unidad:</label>
                <select  id="unidad" name="unidad" class="form-control" style="width: 100%;">
                <option value="mt.2">mt.2</option>
                <option value="saco">saco</option>
                <option value="unidad">unidad</option>
            </select>
                </div>
            </div>
            <div class="row">
              <div class="col-md-6">
              <label> Porcentajes%:</label>
                <input type="text" onchange="calcularprecio()" class="form-control" placeholder="Ingrese porcentaje 1 sin el %" name="porcentaje1" id="porcentaje1" required>
                <input type="text" onchange="calcularprecio()" class="form-control" placeholder="Ingrese porcentaje 2 sin el %" name="porcentaje2" id="porcentaje2" required>
                <input type="text" onchange="calcularprecio()" class="form-control" placeholder="Ingrese porcentaje 3 sin el %" name="porcentaje3" id="porcentaje3" required>
                
            </div>
              <div class="col-md-6">
              <label> Precios:</label>
                <input type="text" onchange="calcularporcentaje()" class="form-control" placeholder="Ingrese precio 1" name="precio1" id="precio1" required>
                <input type="text" onchange="calcularporcentaje()" class="form-control" placeholder="Ingrese precio 2" name="precio2" id="precio2" required>
                <input type="text" onchange="calcularporcentaje()" class="form-control" placeholder="Ingrese precio 3" name="precio3" id="precio3" required>
              
                </div>
            </div>
            <div class="row">
              <div class="col-md-6">
              <label> Codigo:</label>
              <input type="text" class="form-control" placeholder="Ingrese el codigo" name="codigo" id="codigo" required>
            
            </div>
              <div class="col-md-6">
              <svg id="barcode"></svg>
                </div>
            </div>
            <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="limpiar()"; data-dismiss="modal">Cerrar</button>
        <button type="button" onclick="generarbarcode()"; class="btn btn-success">Generar</button>
        <button type="button" id="guardar" disabled onclick="guardarRegistro()"; class="btn btn-primary">Guardar Registro</button>
      </div>
</form>
      </div>
      
    </div>
  </div>
</div>
<script type="text/javascript" src="scripts/producto.js"></script>
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