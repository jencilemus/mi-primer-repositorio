<?php
require 'header.php'
?>
<div class="content-wrapper">
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf">
        <meta name="viewport" content="width=device-width, initial-scale-1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="../librerias/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../librerias/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../librerias/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../librerias/dist/css/adminlte.min.css">
      </head>
    <body>
    <form role="form"  id="formulario" name="formulario">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                
                <div class="card-body">
                <div class="container">
                <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                <h4>
                    <img src="../librerias/dist/img/logogilber.jpg" width="20%" height="5%">
                    <small class="float-right"><h2 id="facturan" name="facturan">Factura</h2></small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  <address>
                    <strong>COMERCIAL GILBERT</strong><br>
                  RTN B23YT-4<br>
                    Saba colon, <br>BO. El Coyol<br>
                    Calle frente a Comercial Chavez<br>
                    Tel: 424-8309   424-7272<br>
                    Saba, Colon, Honduras
                  </address>
                
                </div>
                <div class="col-sm-4 invoice-col no-print">
                    <label>Codigo del cliente:</label>
                    <input onchange="calcular();" required class="form-control" type="text" name="codigocliente" id="codigocliente" placeholder="Ingrese el codigo">
                    <br>
                    <label>RTN:</label>
                    <input required onblur="validar()" onchange="calcular();" class="form-control" type="text" name="rtn" id="rtn" placeholder="Ingrese el RTN">
                    <br>
                    <label>Tipo Factura:</label>
                    <select id="tipofactura" class="form-control" name="tipofactura" required>
                        <option value="Credito">Credito</option>
                        <option value="Contado">Contado</option>
                    </select>
                    <br>
                    <label >Teléfono:</label>
                    <input class="form-control" onchange="calcular();" type="text" name="telefono" id="telefono" placeholder="Ingrese el telefono del cliente">
                    <br>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col no-print">
                <label>Cliente:</label>
                    <input required onchange="calcular();" class="form-control" type="text" name="cliente" id="cliente" placeholder="Ingrese nombre del cliente">
                    
                <br>
                    <label>Vendedor:</label>
                    <select onchange="calcular();" id="vendedores" name="vendedores" class="form-control" data-dropdown-css-class="select2-warning" style="width: 100%;">
              </select>
              <br>
              <label>Tipo de pago:</label>
                    <select id="tipopago" class="form-control" name="tipopago" required>
                        <option value="Efectivo">Efectivo</option>
                        <option value="Tarjeta">Tarjeta</option>
                        <option value="Moneda">Moneda</option>
                        <option value="Credito">Credito</option>
                        <option value="Deposito">Deposito</option>
                        <option value="Cheque">Cheque</option>
                    </select>
                    <br>
                    <label >Cargo de envio:</label> 
                    <input onchange="calcular()" class="form-control" type="number" name="cargoenvio" id="cargoenvio" placeholder="Ingrese cargo de envio" value="0">
                    <br>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>   
            <br>
            <div class="row no-print">
            <input class="form-control" hidden type="text" name="idfactura" id="idfactura" placeholder="Ingrese idfactura" required>
                
                    <input class="form-control" hidden type="text" name="codigo" id="codigo" placeholder="Ingrese codigo" required>
                <div class="col-md-4">
                    <label>Producto:</label>
                    <select onchange="calcular();" id="producto" name="producto" class="form-control select2 select2-warning" data-dropdown-css-class="select2-warning" style="width: 100%;">
              </select>
                </div>
                <div class="col-md-2">
                    <label>Precio: </label>
                    <select id="precio" name="precio" class="form-control select2 select2-warning" data-dropdown-css-class="select2-warning" style="width: 100%;">
              </select>
            </div>
                
                    <input class="form-control" hidden type="text" name="impuesto" id="impuesto" placeholder="Ingrese impuesto" required>
                    <input class="form-control" hidden type="text" name="unidad" id="unidad" placeholder="Ingrese unidad" required>
                    <input class="form-control" hidden type="number" name="total1" id="total1" placeholder="Ingrese total1" required>
                    <input class="form-control" hidden type="text" name="fecha2" id="fecha2" placeholder="Ingrese total1" required>
                
                <div class="col-md-2">
                    <label>Cantidad: </label>
                    <input onblur="validarproducto()" required class="form-control" type="number" step="any" name="cantidad" id="cantidad" placeholder="Ingrese cantidad">
                </div>
            </div>
            <br>
            <div class="row no-print">
                <div class="col-md-2">
                    <button disabled type="submit" id="btn1" name="btn1" class="btn btn-warning" onclick="agregarfila()">Agregar fila</button>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-secondary" onclick="window.location.reload();">Limpiar</button>
                </div>
                
            </div>
            <br>
            <div class="row">
                <div class="col-md-2">
                <small class="float-left" ><h6 id="clienten" name="clienten"></h6></small>
                    </div>
                <div class="col-md-7">
                   </div>
                <div class="col-md-3">
                    <small class="float-right"><h6 id="fecha1" name="fecha1">0</h6></small><br>
                    <small class="float-right"><h6 id="vendedor1" name="vendedor1"></h6></small>
                </div>
                
            </div>

            <div class="row">
                <div class="col-md-12">
                    <table class="table" id="detalles">
                        <thead class="table">
                            <tr>
                                <th class="no-print" >Opciones</th>
                                <th>#</th>
                                <th>Codigo</th>
                                <th style="text-align:left" width="25%">Producto</th>
                                <th style="text-align:right">Cantidad</th>
                                <th style="text-align:right">Precio</th>
                                <th style="text-align:right">SubTotal</th>
                            </tr>
                        </thead>
                        <body>

                        </body>
                    </table>
                    <div class="row">
                <!-- accepted payments column -->
                <div class="col-md-6">
                </div>
                <!-- /.col -->
                <div class="col-md-6">

                  <div class="table-responsive">
                    <table class="table">
                      <tr>
                        <th>Subtotal</th>
                        <td><h6 style="text-align:right" id="subtotal" name="subtotal">0.0</h6></td>
                      </tr>
                      <tr>
                        <th>Impuestos Sobre Venta L.(15%)</th>
                        <td><h6 style="text-align:right" id="totalimpuesto15">0.0</h6></td>
                      </tr>
                      <tr>
                        <th>Cargo de envío</th>
                        <td><h6 style="text-align:right" id="cargo" name="cargo">0.0</h6></td>
                      </tr>
                      <tr>
                        <th class="table-warning">Total</th>
                        <td class="table-warning" ><h6 style="text-align:right" id="total" name="total">0.0</h6></td>
                      </tr>
                    </table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
                    <div class="row no-print">
                                                
                        <div class="col-md-2">
                        <a onclick="imprimir();" rel="noopener" target="_blank" class="btn btn-secondary"><i class="fas fa-print"></i> Imprimir</a>
                
                        </div>
                        <div class="col-md-2" id="contenedor">
                          </div>
                        
                        <div class="col-md-2">
                            <label>Cambio:</label>
                           <input class="form-control" name="cambio" id="cambio" placeholder="Cambio" readonly>
                        </div>
                        <div class="col-md-3">
                            <label>Solicitud de efectivo:</label>
                            <input class="form-control" type="number" name="efectivo" id="efectivo" placeholder="Ingrese efectivo">
                            </div>
                        <div class="col-md-3">
                            <button disabled type="button" id="ingresar" class="btn btn-success float-right" onclick="validarefectivo()"><i class="far fa-credit-card"></i> Ingresar pago</button>
                        </div>
                    </div>
                    <br>
                </div>
            </div>
        </div>
                  
                </div>
                    <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
</form>
    </body>
</html>
</div>
<?php
require 'footer.php'
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
<script type="text/javascript" src="scripts/factura.js"></script>
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
