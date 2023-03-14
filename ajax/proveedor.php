<?php 
if (strlen(session_id())<1) 
	session_start();

require_once "../modelos/ejecutarSQL.php";
$categoria1=new ejecutarSQL();


$idcategoria=isset($_POST["idproveedor"])? limpiarCadena($_POST["idproveedor"]):"";
$rtn=isset($_POST["rtn"])? limpiarCadena($_POST["rtn"]):"";
$nombre=isset($_POST["proveedor"])? limpiarCadena($_POST["proveedor"]):"";
$telefono=isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";
$direccion=isset($_POST["direccion"])? limpiarCadena($_POST["direccion"]):"";
$telecontacto=isset($_POST["telecontacto"])? limpiarCadena($_POST["telecontacto"]):"";
$contacto=isset($_POST["contacto"])? limpiarCadena($_POST["contacto"]):"";
$lugares=isset($_POST["lugares"])? limpiarCadena($_POST["lugares"]):""; 
 
//$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";

switch ($_GET["opc"]){

	
	case 'guardaryeditar':
		if (empty($idcategoria)){
			$sq="insert into proveedor(rtn, proveedor, telefono, direccion, contacto, telecontacto, idlugar, condicion) values('$rtn','$nombre','$telefono','$direccion','$contacto','$telecontacto','$lugares','1')";
			$rspta=$categoria1->insertar($sq);
			echo  $rspta ? "El proveedor fue registrado" : "El proveedor no se pudo registrar";
		}
		else {
			$sq="update proveedor set rtn='$rtn', proveedor='$nombre', telefono='$telefono', direccion='$direccion', contacto='$contacto', telecontacto='$telecontacto', idlugar='$lugares' where idproveedor='$idcategoria'";
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
		$sq="update proveedor set condicion='0' where idproveedor=".$id;
		$rspta=$categoria1->insertar($sq);
 		echo $rspta ? "El proveedor fue Desactivado" : "El proveedor no se puede desactivar";
	break;

	case 'activar':
		$id=$_REQUEST['idcategoria'];
		$sq="update proveedor set condicion='1' where idproveedor=".$id;
		$rspta=$categoria1->insertar($sq);
 		echo $rspta ? "El proveedor fue activado" : "El proveedor no se puede activar";
	break;

	case 'mostrar':
		$id=$_REQUEST['idcategoria'];
		$sql="SELECT p.*,l.lugar FROM proveedor p INNER join lugar l on p.idlugar=l.idlugar where idproveedor=".$id;
		$rspta=$categoria1->mostrar($sql);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$categoria1->listar("SELECT p.*,l.lugar FROM proveedor p INNER join lugar l on p.idlugar=l.idlugar");
 		//Vamos a declarar un array
		$data= Array();

 		while ($reg=$rspta->fetch_object()){
			$anular="";
			$editar="";
			$activar="";
			if($_SESSION['proveedoranular']==1){
				$anular='<button class="btn btn-danger" onclick="desactivar('.$reg->idproveedor.')"><i class="fa fa-close"></i></button>';
			}
			if($_SESSION['proveedoranular']==1){
				$activar='<button class="btn btn-primary" onclick="activar('.$reg->idproveedor.')"><i class="fa fa-check"></i></button>';
			}
			if($_SESSION['proveedoreditar']==1){
				$editar='<button class="btn btn-warning" onclick="mostrar('.$reg->idproveedor.')"><i class="fa fa-pencil"></i></button>';
			}
			$data[]=array(
 				"0"=>($reg->condicion)?$editar.'<button class="btn btn-secondary" onclick="reporte1('.$reg->idproveedor.')"><i class="fa fa-print"></i></button>'.
 					$anular:
 					$editar.'<button class="btn btn-secondary" onclick="reporte1('.$reg->idproveedor.')"><i class="fa fa-print"></i></button>'.
 					$activar,
 				"1"=>$reg->idproveedor,
 				"2"=>$reg->rtn,				 
                 "3"=>$reg->proveedor,				 
                 "4"=>$reg->telefono,
				 "5"=>$reg->direccion,
 				"6"=>$reg->contacto,				 
                 "7"=>$reg->telecontacto,				 
                 "8"=>$reg->lugar,				 
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