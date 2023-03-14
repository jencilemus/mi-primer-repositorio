<?php 
if (strlen(session_id())<1) 
	session_start();

require_once "../modelos/ejecutarSQL.php";
$categoria1=new ejecutarSQL();


$idcategoria=isset($_POST["idfactura"])? limpiarCadena($_POST["idfactura"]):"";
$codigocliente=isset($_POST["codigocliente"])? limpiarCadena($_POST["codigocliente"]):"";
$cliente=isset($_POST["cliente"])? limpiarCadena($_POST["cliente"]):"";
$rtn=isset($_POST["rtn"])? limpiarCadena($_POST["rtn"]):"";
$vendedor=isset($_POST["vendedores"])? limpiarCadena($_POST["vendedores"]):"";
$tipofactura=isset($_POST["tipofactura"])? limpiarCadena($_POST["tipofactura"]):"";
$tipopago=isset($_POST["tipopago"])? limpiarCadena($_POST["tipopago"]):"";
$telefono=isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):""; 
$cargo=isset($_POST["cargoenvio"])? limpiarCadena($_POST["cargoenvio"]):""; 
$total=isset($_POST["total1"])? limpiarCadena($_POST["total1"]):"";
$fecha=isset($_POST["fecha2"])? limpiarCadena($_POST["fecha2"]):""; 
 

//$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";

switch ($_GET["opc"]){

	
	case 'guardaryeditar':
		if (empty($idcategoria)){
			$sq="insert into factura(codigocliente, cliente, rtn, vendedor, tipofactura, tipopago, telefono, cargo, total, fecha) values('$codigocliente','$cliente','$rtn','$vendedor','$tipofactura','$tipopago', '$telefono','$cargo','$total', '$fecha')";
			$rspta=$categoria1->insertar($sq);
			echo  $rspta ? "El producto fue registrado" : "El producto no se pudo registrar";
		}
		else{
			$sq="update factura set codigocliente='$codigocliente', cliente='$cliente', rtn='$rtn', vendedor='$vendedor', tipofactura='$tipofactura', tipopago='$tipopago', telefono='$telefono', cargo='$cargo', total='$total', fecha='$fecha' where idfactura='$idcategoria'";
			$rspta=$categoria1->insertar($sq);
			echo $rspta ? "Categoría actualizada" : "Categoría no se pudo actualizar";
		}
	break;
    case 'listapro':
		$rspta=$categoria1->listar("SELECT * FROM producto where estado='1'");

		while ($reg = $rspta->fetch_object())
				{
				echo '<option value="'.$reg->producto.'">'.$reg->producto. '</option>';
		}
        
		break;
	case 'listaprecio':
		$pro=$_POST['pro'];
			$rspta=$categoria1->listar("select * from producto where producto='$pro'");
			while ($reg = $rspta->fetch_object())
					{
					echo '<option value="'.$reg->precio1.'">'.$reg->precio1. '</option>';
					echo '<option value="'.$reg->precio2.'">'.$reg->precio2. '</option>';
					echo '<option value="'.$reg->precio3.'">'.$reg->precio3. '</option>';
			}
			
			break;
	case 'listaven':
		$rspta=$categoria1->listar("SELECT * FROM usuario where cargo='Vendedor'");
	
			while ($reg = $rspta->fetch_object())
					{
					echo '<option value="'.$reg->nombre.'">'.$reg->nombre. '</option>';
			}
			
			break;

	case 'mostrar':
		$pro=$_POST['pro'];
		$rspta=$categoria1->mostrar("select * from producto where producto='$pro'");
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;
	case 'mostrarf':
		$fecha3=$_POST['fecha3'];
		$rspta=$categoria1->mostrar("SELECT COUNT(fecha) FROM `factura` WHERE fecha='$fecha3'");
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;
	case 'mostrari':
		$fecha3=$_POST['fecha3'];
		$rspta=$categoria1->mostrar("SELECT SUM(TOTAL) FROM `factura` WHERE fecha='$fecha3'");
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;
	case 'mostrarv1':
		$fecha3=$_POST['fecha3'];
		$rspta=$categoria1->mostrar("SELECT count(vendedor) from factura where vendedor='Carlos Argeñal' and fecha='$fecha3'");
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;
	case 'mostrarmax':
		$fecha3=$_POST['fecha3'];
		$rspta=$categoria1->mostrar("SELECT max(total) from factura where fecha='$fecha3'");
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;
	case 'mostrarv2':
		$fecha3=$_POST['fecha3'];
		$rspta=$categoria1->mostrar("SELECT count(vendedor) from factura where vendedor='Daniel Argeñal' and fecha='$fecha3'");
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;
	
	case 'listar':
		$rspta=$categoria1->listar("select * from factura");
 		//Vamos a declarar un array
		$data= Array();

 		while ($reg=$rspta->fetch_object()){
				
			$data[]=array(
				"0"=>$reg->idfactura,
 				"1"=>$reg->codigocliente,				 
                 "2"=>$reg->cliente,				 
                 "3"=>$reg->rtn,
 				"4"=>$reg->vendedor,				 
                 "5"=>$reg->tipofactura,				 
                 "6"=>$reg->tipopago,
				 "7"=>$reg->telefono,
 				"8"=>$reg->cargo,				 
                 "9"=>$reg->total,	
				 "10"=>$reg->fecha,	 
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;
}
?>