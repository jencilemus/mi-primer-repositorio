<?php 
if (strlen(session_id())<1) 
	session_start();

require_once "../modelos/ejecutarSQL.php";
$categoria1=new ejecutarSQL();


$idcategoria=isset($_POST["idproducto"])? limpiarCadena($_POST["idproducto"]):"";
$producto=isset($_POST["producto"])? limpiarCadena($_POST["producto"]):"";
$proveedores=isset($_POST["proveedores"])? limpiarCadena($_POST["proveedores"]):"";
$costo=isset($_POST["costo"])? limpiarCadena($_POST["costo"]):"";
$existencia=isset($_POST["existencia"])? limpiarCadena($_POST["existencia"]):"";
$clasificacion=isset($_POST["clasi"])? limpiarCadena($_POST["clasi"]):"";
$porcentaje1=isset($_POST["porcentaje1"])? limpiarCadena($_POST["porcentaje1"]):"";
$porcentaje2=isset($_POST["porcentaje2"])? limpiarCadena($_POST["porcentaje2"]):""; 
$porcentaje3=isset($_POST["porcentaje3"])? limpiarCadena($_POST["porcentaje3"]):""; 
$precio1=isset($_POST["precio1"])? limpiarCadena($_POST["precio1"]):"";
$precio2=isset($_POST["precio2"])? limpiarCadena($_POST["precio2"]):""; 
$precio3=isset($_POST["precio3"])? limpiarCadena($_POST["precio3"]):""; 
$imagen=isset($_POST["imagen"])? limpiarCadena($_POST["imagen"]):"";
$unidad=isset($_POST["unidad"])? limpiarCadena($_POST["unidad"]):"";
$codigo=isset($_POST["codigo"])? limpiarCadena($_POST["codigo"]):"";
$fechacreacion=isset($_POST["fechacreacion"])? limpiarCadena($_POST["fechacreacion"]):"";
//$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";

switch ($_GET["opc"]){

	
	case 'guardaryeditar':
		if (!file_exists($_FILES['imagen']['tmp_name']) || !is_uploaded_file($_FILES['imagen']['tmp_name']))
  {
   $imagen=$_POST["imagenactual"];
  }
  else 
  {
   $ext = explode(".", $_FILES["imagen"]["name"]);
   if ($_FILES['imagen']['type'] == "image/jpg" || $_FILES['imagen']['type'] == "image/jpeg" || $_FILES['imagen']['type'] == "image/png")
   {
    $imagen = round(microtime(true)) . '.' . end($ext);
    move_uploaded_file($_FILES["imagen"]["tmp_name"], "../files/producto/" . $imagen);
   }
  }
		if (empty($idcategoria)){
			$sq="insert into producto(codigo, producto, idproveedor, costo, existencia, porcentaje1, porcentaje2, porcentaje3, precio1, precio2, precio3, clasificacion, unidad, imagen, fechacreacion, estado) values('$codigo','$producto','$proveedores','$costo','$existencia','$porcentaje1', '$porcentaje2','$porcentaje3','$precio1','$precio2','$precio3', '$clasificacion','$unidad','$imagen', '$fechacreacion', '1')";
			$rspta=$categoria1->insertar($sq);
			echo  $rspta ? "El producto fue registrado" : "El producto no se pudo registrar";
		}
		else if(empty($imagen)){
			$sq="update producto set codigo='$codigo', producto='$producto', idproveedor='$proveedores', costo='$costo', existencia='$existencia', porcentaje1='$porcentaje1', porcentaje2='$porcentaje2', porcentaje3='$porcentaje3', precio1='$precio1', precio2='$precio2', precio3='$precio3', clasificacion='$clasificacion', unidad='$unidad', fechacreacion='$fechacreacion' where idproducto='$idcategoria'";
			$rspta=$categoria1->insertar($sq);
			echo $rspta ? "Categoría actualizada" : "Categoría no se pudo actualizar";
		}else{
			$sq="update producto set codigo='$codigo', producto='$producto', idproveedor='$proveedores', costo='$costo', existencia='$existencia', porcentaje1='$porcentaje1', porcentaje2='$porcentaje2', porcentaje3='$porcentaje3', precio1='$precio1', precio2='$precio2', precio3='$precio3', clasificacion='$clasificacion', unidad='$unidad', imagen='$imagen', fechacreacion='$fechacreacion' where idproducto='$idcategoria'";
			$rspta=$categoria1->insertar($sq);
			echo $rspta ? "Categoría actualizada" : "Categoría no se pudo actualizar";
		}
	break;
    case 'listapr':
		$rspta=$categoria1->listar("SELECT * FROM proveedor where condicion='1'");

		while ($reg = $rspta->fetch_object())
				{
				echo '<option value="'.$reg->idproveedor.'">'.$reg->proveedor. '</option>';
		}
        
		break;
	case 'anular':
		$id=$_REQUEST['idcategoria'];
		$sq="update producto set estado='0' where idproducto=".$id;
		$rspta=$categoria1->insertar($sq);
 		echo $rspta ? "El producto fue Desactivado" : "El producto no se puede desactivar";
	break;

	case 'activar':
		$id=$_REQUEST['idcategoria'];
		$sq="update producto set estado='1' where idproducto=".$id;
		$rspta=$categoria1->insertar($sq);
 		echo $rspta ? "El producto fue activado" : "El producto no se puede activar";
	break;

	case 'mostrar':
		$id=$_REQUEST['idcategoria'];
		$sql="SELECT p.*,l.proveedor FROM producto p INNER join proveedor l on p.idproveedor=l.idproveedor where idproducto=".$id;
		$rspta=$categoria1->mostrar($sql);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$categoria1->listar("SELECT p.*,l.proveedor FROM producto p INNER join proveedor l on p.idproveedor=l.idproveedor");
 		//Vamos a declarar un array
		$data= Array();

 		while ($reg=$rspta->fetch_object()){
			$anular="";
			$editar="";
			$activar="";
			if($_SESSION['productoanular']==1){
				$anular='<button class="btn btn-danger" onclick="desactivar('.$reg->idproducto.')"><i class="fa fa-close"></i></button>';
			}
			if($_SESSION['productoanular']==1){
				$activar='<button class="btn btn-primary" onclick="activar('.$reg->idproducto.')"><i class="fa fa-check"></i></button>';
			}
			if($_SESSION['productoeditar']==1){
				$editar='<button class="btn btn-warning" onclick="mostrar('.$reg->idproducto.')"><i class="fa fa-pencil"></i></button>';
			}
			$data[]=array(
				"0"=>($reg->estado)?$editar.'<button class="btn btn-secondary" onclick="reporte1('.$reg->idproveedor.')"><i class="fa fa-print"></i></button>'.
				$anular:
				$editar.'<button class="btn btn-secondary" onclick="reporte1('.$reg->idproveedor.')"><i class="fa fa-print"></i></button>'.
				$activar,
				"1"=>$reg->idproducto,
 				"2"=>$reg->codigo,				 
                 "3"=>$reg->producto,				 
                 "4"=>$reg->proveedor,
 				"5"=>$reg->existencia,				 				 
                 "6"=>$reg->porcentaje1,
				 "7"=>$reg->porcentaje2,
 				"8"=>$reg->porcentaje3,				 
                 "9"=>$reg->precio1,				 
                 "10"=>$reg->precio2,
				 "11"=>$reg->precio3,
				 "12"=>$reg->clasificacion,				 
                 "13"=>$reg->unidad,
 				"14"=>'<img src="../files/producto/'.$reg->imagen.'" width=100 height=100>',				 
                 "15"=>$reg->fechacreacion,				 				 
 				"16"=>($reg->estado)?'<span class="label bg-green">Activado</span>':
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