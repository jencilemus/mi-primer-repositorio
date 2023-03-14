<?php 
if (strlen(session_id())<1) 
	session_start();

require_once "../modelos/ejecutarSQL.php";
$categoria1=new ejecutarSQL();


$idcategoria=isset($_POST["idusuario"])? limpiarCadena($_POST["idusuario"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$login=isset($_POST["login"])? limpiarCadena($_POST["login"]):"";
$clave=isset($_POST["clave"])? limpiarCadena($_POST["clave"]):"";
$cargo=isset($_POST["cargo"])? limpiarCadena($_POST["cargo"]):"";
$imagen=isset($_POST["imagen"])? limpiarCadena($_POST["imagen"]):"";
//$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";

switch ($_GET["opc"]){
	case 'permisos':
        $sql="select * from permisos";
        $marcados = $categoria1->listar($sql);
        //Declaramos el array para almacenar todos los permisos marcados
        $valores=array();
        //Mostramos la lista de permisos en la vista y si están o no marcados

        while ($reg =$marcados->fetch_object())
                {
                //  $sw=in_array($reg->idpermiso,$valores)?'checked':'';4   
                $sw="";

                    echo '<li> <input type="checkbox" '.$sw.'  name="permiso[]" value="'.$reg->idpermisos.'">'.$reg->permisos.'</li>';

                }
    break;
	
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
    move_uploaded_file($_FILES["imagen"]["tmp_name"], "../files/usuario/" . $imagen);
   }
  }
		if (empty($idcategoria)){
			$sq="insert into usuario(nombre, login, clave, cargo, imagen, estado) values('$nombre','$login','$clave','$cargo','$imagen','1')";
			$rspta=$categoria1->insertar($sq);
			$per=$_POST['permiso'];
			$i=0;
			while($i<count($per)){
				$sq="INSERT INTO `detalleusuario`( `idusuario`, `idpermiso`) VALUES ((select max(idusuario) from usuario), '$per[$i]')";
				$rspta=$categoria1->insertar($sq);
				$i++;
			}
			echo  $rspta ? "El usuario fue registrado" : "El usuario no se pudo registrar";
		}
		else if(empty($imagen)){
			$sq="update usuario set nombre='$nombre', login='$login', clave='$clave', cargo='$cargo' where idusuario='$idcategoria'";
			$rspta=$categoria1->insertar($sq);
			$per=$_POST['permiso'];
			$i=0;
			while($i<count($per)){
				$sq="insert into `detalleusuario`( `idusuario`, `idpermiso`) VALUES ($idcategoria, '$per[$i]')";
				$rspta=$categoria1->insertar($sq);
				$i++;
			}
			echo $rspta ? "Categoría actualizada" : "Categoría no se pudo actualizar";
		}else{
			$sq="update usuario set nombre='$nombre', login='$login', clave='$clave', cargo='$cargo', imagen='$imagen' where idusuario='$idcategoria'";
			$rspta=$categoria1->insertar($sq);
			$per=$_POST['permiso'];
			$i=0;
			while($i<count($per)){
				$sq="insert into `detalleusuario`( `idusuario`, `idpermiso`) VALUES ($idcategoria, '$per[$i]')";
				$rspta=$categoria1->insertar($sq);
				$i++;
			}
			echo $rspta ? "Categoría actualizada" : "Categoría no se pudo actualizar";
		}

	break;

	case 'anular':
		$id=$_REQUEST['idcategoria'];
		$sq="update usuario set estado='0' where idusuario=".$id;
		$rspta=$categoria1->insertar($sq);
 		echo $rspta ? "El usuario fue Desactivado" : "El usuario no se puede desactivar";
	break;

	case 'activar':
		$id=$_REQUEST['idcategoria'];
		$sq="update usuario set estado='1' where idusuario=".$id;
		$rspta=$categoria1->insertar($sq);
 		echo $rspta ? "El usuario fue activado" : "El usuario no se puede activar";
	break;

	case 'mostrar':
		$id=$_REQUEST['idcategoria'];
		$sql="select * from usuario where idusuario=".$id;
		$rspta=$categoria1->mostrar($sql);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;
	
	case 'verificar':
		$usua=$_POST['usua'];
		$cla=$_POST['cla'];
		$rspta=$categoria1->listar("select * from usuario where clave='$cla' and login='$usua'");

		$data=Array();
		$salida="0";
		$idus=0;
		while ($reg=$rspta->fetch_object()){
			$idus=$reg->idusuario;
			$_SESSION['nombreusuario']=$reg->nombre;
			$_SESSION['login']=$reg->login;
			$_SESSION['cargo']=$reg->cargo;
			$_SESSION['imagen']=$reg->imagen;

			$salida=$reg->nombre;
		}
		$valores=array();
		$rspta=$categoria1->listar("select * from detalleusuario where idusuario='$idus'");
		while ($reg2=$rspta->fetch_object()){
			array_push($valores, $reg2->idpermiso);
		}
		in_array(1, $valores)?$_SESSION['crudlugar']=1:$_SESSION['crudlugar']=0;
		in_array(2, $valores)?$_SESSION['proveedorcrear']=1:$_SESSION['proveedorcrear']=0;
		in_array(3, $valores)?$_SESSION['proveedoreditar']=1:$_SESSION['proveedoreditar']=0;
		in_array(4, $valores)?$_SESSION['proveedoranular']=1:$_SESSION['proveedoranular']=0;
		in_array(5, $valores)?$_SESSION['productocrear']=1:$_SESSION['productocrear']=0;
		in_array(6, $valores)?$_SESSION['productoeditar']=1:$_SESSION['productoeditar']=0;
		in_array(7, $valores)?$_SESSION['productoanular']=1:$_SESSION['productoanular']=0;
		in_array(8, $valores)?$_SESSION['usuariocrear']=1:$_SESSION['usuariocrear']=0;
		in_array(9, $valores)?$_SESSION['usuarioeditar']=1:$_SESSION['usuarioeditar']=0;
		in_array(10, $valores)?$_SESSION['usuarioanular']=1:$_SESSION['usuarioanular']=0;
		in_array(11, $valores)?$_SESSION['escritorio']=1:$_SESSION['escritorio']=0;

		echo json_encode($salida);
	break;
	case 'estado':
		$usua=$_POST['usua'];
		$cla=$_POST['cla'];
		$rspta=$categoria1->listar("select * from usuario where clave='$cla' and login='$usua'");

		$data=Array();
		$salida="0";
		$idus=0;
		while ($reg=$rspta->fetch_object()){
			$idus=$reg->idusuario;
			$_SESSION['nombreusuario']=$reg->nombre;
			$_SESSION['login']=$reg->login;
			$_SESSION['cargo']=$reg->cargo;
			$_SESSION['imagen']=$reg->imagen;

			$salida=$reg->estado;
		}
		$valores=array();
		$rspta=$categoria1->listar("select * from detalleusuario where idusuario='$idus'");
		while ($reg2=$rspta->fetch_object()){
			array_push($valores, $reg2->idpermiso);
		}
		in_array(1, $valores)?$_SESSION['crudlugar']=1:$_SESSION['crudlugar']=0;
		in_array(2, $valores)?$_SESSION['proveedorcrear']=1:$_SESSION['proveedorcrear']=0;
		in_array(3, $valores)?$_SESSION['proveedoreditar']=1:$_SESSION['proveedoreditar']=0;
		in_array(4, $valores)?$_SESSION['proveedoranular']=1:$_SESSION['proveedoranular']=0;
		in_array(5, $valores)?$_SESSION['productocrear']=1:$_SESSION['productocrear']=0;
		in_array(6, $valores)?$_SESSION['productoeditar']=1:$_SESSION['productoeditar']=0;
		in_array(7, $valores)?$_SESSION['productoanular']=1:$_SESSION['productoanular']=0;
		in_array(8, $valores)?$_SESSION['usuariocrear']=1:$_SESSION['usuariocrear']=0;
		in_array(9, $valores)?$_SESSION['usuarioeditar']=1:$_SESSION['usuarioeditar']=0;
		in_array(10, $valores)?$_SESSION['usuarioanular']=1:$_SESSION['usuarioanular']=0;
		in_array(11, $valores)?$_SESSION['escritorio']=1:$_SESSION['escritorio']=0;

		echo json_encode($salida);
	break;
	case 'listar':
		$rspta=$categoria1->listar("select * from  usuario");
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
			$anular="";
			$editar="";
			$activar="";
			if($_SESSION['usuarioanular']==1){
				$anular='<button class="btn btn-danger" onclick="desactivar('.$reg->idusuario.')"><i class="fa fa-close"></i></button>';
			}
			if($_SESSION['usuarioanular']==1){
				$activar='<button class="btn btn-primary" onclick="activar('.$reg->idusuario.')"><i class="fa fa-check"></i></button>';
			}
			if($_SESSION['usuarioeditar']==1){
				$editar='<button class="btn btn-warning" onclick="mostrar('.$reg->idusuario.')"><i class="fa fa-pencil"></i></button>';
			}
 			$data[]=array(
 				"0"=>($reg->estado)?$editar.
 					$anular:
 					$editar.
 					$activar,
                "1"=>$reg->idusuario,
                "2"=>$reg->nombre,
 				"3"=>$reg->login,
                 "4"=>$reg->clave,
 				"5"=>$reg->cargo,
                 "6"=>'<img src="../files/usuario/'.$reg->imagen.'" width=100 height=100>',		 
 				"7"=>($reg->estado)?'<span class="label bg-green">Activado</span>':
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