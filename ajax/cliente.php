<?php 
if (strlen(session_id())<1) 
	session_start();

require_once "../modelos/ejecutarSQL.php";
$categoria1=new ejecutarSQL();


$idcategoria=isset($_POST["idcliente"])? limpiarCadena($_POST["idcliente"]):"";
$rtn=isset($_POST["rtn"])? limpiarCadena($_POST["rtn"]):"";
$nombre=isset($_POST["cliente"])? limpiarCadena($_POST["clienter"]):"";
$telefono=isset($_POST["direccion"])? limpiarCadena($_POST["direccion"]):"";
$direccion=isset($_POST["estado civil"])? limpiarCadena($_POST["estado civil"]):"";
$telecontacto=isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";

 
//$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";

switch ($_GET["opc"]){

	
	case 'guardaryeditar':
		if (empty($idcategoria)){
			$sq="insert into cliente(rtn, cliente, direccion, estadocivil, telefono) values('$rtn','$cliente','$direcion','$estadocivil','$telefono','1')";
			$rspta=$categoria1->insertar($sq);
			echo  $rspta ? "El cliente fue registrado" : "El cliente no se pudo registrar";
		}
		else {
			$sq="update cliente set rtn='$rtn', cliente='$cliente', direccion='$direccion', estadocivil='$estadocivil', telefono='$telefono', telecontacto='$telecontacto' where idcliente='$idcategoria'";
			$rspta=$categoria1->insertar($sq);
			echo $rspta ? "Categoría actualizada" : "Categoría no se pudo actualizar";
		}
	break;
    case 'listapr':
		$rspta=$categoria1->listar("SELECT * FROM lugar where estado='1'");

		while ($reg = $rspta->fetch_object())
				{
				echo '<option value="'.$reg->idlugar.'">'.$reg->lugar. '</option>';
		}
        
		break;
	case 'anular':
		$id=$_REQUEST['idcategoria'];
		$sq="update cliente set condicion='0' where idcliente=".$id;
		$rspta=$categoria1->insertar($sq);
 		echo $rspta ? "El cliente fue Desactivado" : "El proveedor no se puede desactivar";
	break;

	case 'activar':
		$id=$_REQUEST['idcategoria'];
		$sq="update cliente set condicion='1' where idcliente=".$id;
		$rspta=$categoria1->insertar($sq);
 		echo $rspta ? "El cliente fue activado" : "El cliente no se puede activar";
	break;

	case 'mostrar':
		$id=$_REQUEST['idcategoria'];
		$sql="SELECT p.*,l.lugar FROM cliente p INNER join lugar l on p.idlugar=l.idlugar where idcliente=".$id;
		$rspta=$categoria1->mostrar($sql);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$categoria1->listar("SELECT p.*,l.lugar FROM cliente p INNER join lugar l on p.idlugar=l.idlugar");
 		//Vamos a declarar un array
		$data= Array();

 		while ($reg=$rspta->fetch_object()){
			$anular="";
			$editar="";
			$activar="";
			//if($_SESSION['proveedoranular']==1){
				//$anular='<button class="btn btn-danger" onclick="desactivar('.$reg->idcliente.')"><i class="fa fa-close"></i></button>';
			//}
			//if($_SESSION['proveedoranular']==1){
			//	$activar='<button class="btn btn-primary" onclick="activar('.$reg->idcliente.')"><i class="fa fa-check"></i></button>';
			//}
			//if($_SESSION['proveedoreditar']==1){
				//$editar='<button class="btn btn-warning" onclick="mostrar('.$reg->idcliente.')"><i class="fa fa-pencil"></i></button>';
			//}
			$data[]=array(
 				"0"=>($reg->condicion)?$editar.'<button class="btn btn-secondary" onclick="reporte1('.$reg->idcliente.')"><i class="fa fa-print"></i></button>'.
 					$anular:
 					$editar.'<button class="btn btn-secondary" onclick="reporte1('.$reg->idcliente.')"><i class="fa fa-print"></i></button>'.
 					$activar,
 				"1"=>$reg->idcliente,
 				"2"=>$reg->rtn,				 
                 "3"=>$reg->cliente,				 
                 "4"=>$reg->direccion,
				 "5"=>$reg->estadocivil,
 				"6"=>$reg->telefono,				 			 
 				"9"=>($reg->condicion)?'<span class="label bg-green">Activado</span>':
 				'<span class="label bg-red">Desactivado</span>'
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

