<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();

/*if (!isset($_SESSION["nombre"]))
{
  echo 'Debe ingresar al sistema correctamente para visualizar el reporte';
}
else
{
if ($_SESSION['almacen']==1)
{*/

//Inlcuímos a la clase PDF_MC_Table
require('PDF_MC_Table.php');
 
//Instanciamos la clase para generar el documento pdf
$pdf=new PDF_MC_Table('L', 'mm', 'letter');
 
//Agregamos la primera página al documento pdf
$pdf->AddPage();
 
//Seteamos el inicio del margen superior en 25 pixeles 
$y_axis_initial = 25;
 
//Seteamos el tipo de letra y creamos el título de la página. No es un encabezado no se repetirá
$pdf->SetFont('Arial','B',12);
$Date = date('d/m/Y');
$pdf->Cell(205, 6,'',0,0,'C');
$pdf->Cell(20, 6, 'Fecha de reporte:', 0, 0, 'C');
$pdf->Cell(15, 6,'',0,0,'C'); 
$pdf->Cell(10, 6, $Date, 0, 0, 'C');  
$pdf->Cell(100, 6,'',0,0,'C');
$pdf->Image('../librerias/dist/img/logogilber.jpg', 6, 6, 65, 35);
$pdf->Ln(10);
$pdf->SetFillColor(232,232,232);
$pdf->SetFont('Arial','B',16);
$pdf->Cell(90, 6,'',0,0,'C');
$pdf->Cell(80, 6,'COMERCIAL GILBERT',0,0,'C');
$pdf->Ln(10);
$pdf->Cell(90, 6,'',0,0,'C');
$pdf->SetFont('Arial','B',14);
$pdf->Cell(80,6,'LISTA DE PRODUCTOS',0,0,'C');
$pdf->Ln(10);
 
//Creamos las celdas para los títulos de cada columna y le asignamos un fondo gris y el tipo de letra
$pdf->SetFillColor(232,232,232);

$pdf->SetFont('Arial','B',7);
$pdf->Cell(15,6,'Codigo',1,0,'C',1);
$pdf->Cell(35,6,'Producto',1,0,'C',1);
$pdf->Cell(20,6,'Proveedor',1,0,'C',1);
$pdf->Cell(15,6,'Costo',1,0,'C',1);
$pdf->Cell(15,6,'Existencia',1,0,'C',1); 
$pdf->Cell(20,6,'Porcentaje1',1,0,'C',1);  
$pdf->Cell(20,6,'Porcentaje2',1,0,'C',1);
$pdf->Cell(20,6,'Porcentaje3',1,0,'C',1);
$pdf->Cell(15,6,'Precio1',1,0,'C',1);
$pdf->Cell(15,6,'Precio2',1,0,'C',1);
$pdf->Cell(15,6,'Precio3',1,0,'C',1);
$pdf->Cell(15,6,'Clasificacion',1,0,'C',1); 
$pdf->Cell(20,6,'FechaCreacion',1,0,'C',1);  
$pdf->Cell(20,6,'Estado',1,0,'C',1); 
$pdf->Ln(6);

//Comenzamos a crear las filas de los registros según la consulta mysql
require_once "../modelos/ejecutarSQL.php";
$categoria1=new ejecutarSQL();
if (isset($_GET['id'])){
  $id=$_GET['id'];
  $rspta = $categoria1->listar("SELECT p.*,l.proveedor FROM producto p INNER join proveedor l on p.idproveedor=l.idproveedor where idproducto=".$id);
}else
$rspta = $categoria1->listar("SELECT p.*,l.proveedor FROM producto p INNER join proveedor l on p.idproveedor=l.idproveedor");

//Table with 20 rows and 4 columns
$pdf->SetWidths(array(15,35,20,15,15,20,20,20,15,15,15, 15, 20,20));

while($reg= $rspta->fetch_object())
{  
    $producto = $reg->producto;
 	$pdf->SetFont('Arial','',7); 
    $pdf->Row(array($reg->codigo,utf8_decode($producto),utf8_decode($reg->proveedor),$reg->costo,$reg->existencia,$reg->porcentaje1,$reg->porcentaje2,$reg->porcentaje2,$reg->precio1,$reg->precio2,$reg->precio3,utf8_decode($reg->clasificacion),$reg->fechacreacion, ($reg->estado)? "Activado": "Desactivado"));
}
//Mostramos el documento pdf
$pdf->Output();

/*?>
<?php
}
else
{
  echo 'No tiene permiso para visualizar el reporte';
}

}*/
ob_end_flush();
?>