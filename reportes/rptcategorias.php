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
$pdf->Cell(80, 6,'COMERCIAL GIBERT',0,0,'C');
$pdf->Ln(10);
$pdf->Cell(90, 6,'',0,0,'C');
$pdf->SetFont('Arial','B',14);
$pdf->Cell(80,6,'LISTA DE PROVEEDORES',0,0,'C');
$pdf->Ln(10);
 
//Creamos las celdas para los títulos de cada columna y le asignamos un fondo gris y el tipo de letra
$pdf->SetFillColor(232,232,232);
 
$pdf->SetFont('Arial','B',7);
$pdf->Cell(20,6,'ID Proveedor',1,0,'C',1);
$pdf->Cell(25,6,'RTN',1,0,'C',1);
$pdf->Cell(35,6,'Proveedor',1,0,'C',1);
$pdf->Cell(30,6,'Telefono',1,0,'C',1);
$pdf->Cell(60,6,'Direccion',1,0,'C',1);
$pdf->Cell(20,6,'Contacto',1,0,'C',1);
$pdf->Cell(20,6,'Telecontacto',1,0,'C',1);
$pdf->Cell(30,6,'Lugar',1,0,'C',1);
$pdf->Cell(20,6,'Condicion',1,0,'C',1);
 
$pdf->Ln(6);
//Comenzamos a crear las filas de los registros según la consulta mysql
require_once "../modelos/ejecutarSQL.php";
$categoria1=new ejecutarSQL();
if(isset($_GET['id'])){
  $id=$_GET['id'];
  $rspta = $categoria1->listar("SELECT p.*,l.lugar FROM proveedor p INNER join lugar l on p.idlugar=l.idlugar where idproveedor=".$id);
}else{
  $rspta = $categoria1->listar("SELECT p.*,l.lugar FROM proveedor p INNER join lugar l on p.idlugar=l.idlugar");
}


//Table with 20 rows and 4 columns
$pdf->SetWidths(array(20, 25, 35, 30, 60, 20, 20, 30, 20));

while($reg= $rspta->fetch_object())
{  
    $nombre = $reg->proveedor;
 	$pdf->SetFont('Arial','',7); 
    $pdf->Row(array($reg->idproveedor, $reg->rtn, utf8_decode($nombre), $reg->telefono, utf8_decode($reg->direccion), utf8_decode($reg->telecontacto), utf8_decode($reg->contacto), utf8_decode($reg->lugar), ($reg->condicion)? "Activado": "Desactivado"));
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