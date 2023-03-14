<?php
require 'header.php';
?>
 <div class="content-wrapper">        
        <!-- Main content -->
        <section class="content">
         <div class="wrapper">

  <!-- Main content -->
  <section class="content">
        <br>
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3 id="ventasactuales">0</h3>
                <input hidden class="form-control" type="text" name="fecha2" id="fecha2" placeholder="Ingrese total1">
                <p>Ventas del Dia</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>        
              <a href="estadisticas.php" class="small-box-footer">Mas Información <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3 id="ingresosdia">0</h3>

                <p>Ingresos del dia</p>
              </div>
              <div class="icon">
                <i class="ion ion-social-usd"></i>
              </div>
              <a href="estadisticas.php" class="small-box-footer">Mas Información <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3 id="vendedormasventas">0</h3>

                <p>Vendedor con mas ventas en el dia</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="estadisticas.php" class="small-box-footer">Mas Información <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3 id="ventamasalta">0</h3>

                <p>Venta mas alta del dia</p>
              </div>
              <div class="icon">
                <i class="fas fa-line-chart"></i>
              </div>
              <a href="estadisticas.php" class="small-box-footer">Mas Información <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        <!-- ./col -->
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->

      <section class="content">
      <h1 class="m-0">Facturas</h1>
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
        <div class="panel-body" style="height: 150px;" id="formularioregistros">
        
        <div>
        
    
  </div>
          <!-- /.card -->
          <!-- solid sales graph -->
          
          <!-- /.card -->

          <!-- Calendar -->
          
          <!-- /.card -->
        </section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>    
        </section>
</div>

<?php
require 'footer.php';
?>
<script type="text/javascript" src="scripts/index.js"></script>
<script type="text/javascript" src="scripts/estadisticas.js"></script>
