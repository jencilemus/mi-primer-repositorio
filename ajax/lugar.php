<?php 
if (strlen(session_id())<1) 
	session_start();

require_once "../modelos/ejecutarSQL.php";
$categoria1=new ejecutarSQL();


$idcategoria=isset($_POST["idlugar"])? limpiarCadena($_POST["idlugar"]):"";
$nombre=isset($_POST["lugar"])? limpiarCadena($_POST["lugar"]):"";

//$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";

switch ($_GET["opc"]){

	
	case 'guardaryeditar':
		if (empty($idcategoria)){
			$sq="insert into lugar(lugar,estado) values('$nombre','1')";
			$rspta=$categoria1->insertar($sq);
			echo  $rspta ? "El lugar fue registrado" : "El lugar no se pudo registrar";
		}
		else {
			$sq="update lugar set lugar='$nombre' where idlugar='$idcategoria'";
			$rspta=$categoria1->insertar($sq);
			echo $rspta ? "Categoría actualizada" : "Categoría no se pudo actualizar";
		}
	break;

	case 'anular':
		$id=$_REQUEST['idcategoria'];
		$sq="update lugar set estado='0' where idlugar=".$id;
		$rspta=$categoria1->insertar($sq);
 		echo $rspta ? "El lugar fue Desactivado" : "El lugar no se puede desactivar";
	break;

	case 'activar':
		$id=$_REQUEST['idcategoria'];
		$sq="update lugar set estado='1' where idlugar=".$id;
		$rspta=$categoria1->insertar($sq);
 		echo $rspta ? "El lugar fue activado" : "El lugar no se puede activar";
	break;

	case 'mostrar':
		$id=$_REQUEST['idcategoria'];
		$sql="select * from lugar where idlugar=".$id;
		$rspta=$categoria1->mostrar($sql);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$categoria1->listar("select * from  lugar");
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>($reg->estado)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idlugar.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->idlugar.')"><i class="fa fa-close"></i></button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->idlugar.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->idlugar.')"><i class="fa fa-check"></i></button>',
 				"1"=>$reg->idlugar,
 				"2"=>$reg->lugar,				 
 				"3"=>($reg->estado)?'<span class="label bg-green">Activado</span>':
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