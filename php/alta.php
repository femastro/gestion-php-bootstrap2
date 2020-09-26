<?php
	session_start();

	require "../conexion.php";

	$params = $_POST['json']; /// recibe JSON 

	$cont = count($params); ///// Contador de Datos del JSON

	$local = $_SESSION['local']; /// Captura en que local estamos.

	$i = 0;

	$nuevoStock = 0;

	while ($cont > $i){

		$codigo = $params[$i]['Codigo'];
		$marca = $params[$i]['Marca'];
		$modelo = $params[$i]['Modelo'];
		$medida = $params[$i]['Medida'];
		$cantidad = $params[$i]['Cantidad'];
		
		$producto = substr($codigo,0,1); // Extrae el primer caracter N ó L para saber que tabla usar.

		if ($producto == "N"){
			$tabla = 'stockneumaticos';
		}
		if ($producto == "L"){
			$tabla = 'stockllantas';
		}

		/// BUSCA SI EXISTE EN STOCK !!!
		$sql = "SELECT cantidad FROM ".$tabla." WHERE cod_Articulo ='".$codigo."' AND marca ='".$marca."' AND modelo ='".$modelo."'";

		$resultado = mysqli_query($link,$sql) or die(mysqli_error($link));

		$cont = mysqli_num_rows($resultado);

		if ($cont > 0){

			$row = mysqli_fetch_assoc($resultado);

			$stock = $row['cantidad']; 
			
			actualizarAlta($codigo,$marca,$modelo,$medida,$cantidad,$stock,$tabla,$link,$local);

			actualizarUbicacion($codigo,$cantidad,$local,$link);

			echo 1;
			
		}else{
			
			altaNueva($codigo,$marca,$modelo,$medida,$cantidad,$tabla,$link,$local);
			
			altaUbicacion($codido,$cantidad,$local,$link);

			echo 2;
			
		};
		
		$i++;
	};
	
	////	
	//// ACTUALIZACION de STOCK !!!!
	
	function actualizarAlta($codigo,$marca,$modelo,$medida,$cantidad,$stock,$tabla,$link,$local) 
	{		
		$nuevoStock = $stock + $cantidad; /// Error ? =: syntax error, unexpected ';' on this line.
		
		$sql = "UPDATE ".$tabla." SET cantidad='".$nuevoStock."' WHERE cod_Articulo ='".$codigo."' AND marca ='".$marca."' AND modelo ='".$modelo."'";

		mysqli_query($link,$sql) or die(mysqli_error($link));

	}

	function actualizarUbicacion($codigo,$cantidad,$local,$link)
	{
		// Busca stock en ubicacion

		$sql = "SELECT cantidad FROM ubicacion WHERE codigo ='".$codigo."' AND ubicacion = ".$local;

		$resultado = mysqli_query($link,$sql) or die(mysqli_error($link));

		$row = mysqli_fetch_assoc($resultado);

		/// suma el ingreso nuevo al stock de ubicacion
		$stockAnterior = $row['cantidad'];

		$stockActual = $stockAnterior + $cantidad;

		$sql = "UPDATE ubicacion SET cantidad = ".$stockActual." WHERE codigo ='".$codigo."' AND ubicacion = ".$local;

		// actualiza la ubicacion
		mysqli_query($link,$sql) or die(mysqli_error($link));

	};


////
//// ALTA NUEVO PRODUCTO !!!

	function altaNueva($codigo,$marca,$modelo,$medida,$cantidad,$tabla,$link,$local)
	{

		$sql = "INSERT INTO ".$tabla." VALUES (null,'".$codigo."','".$marca."','".$modelo."','".$medida."','XXX',".$cantidad.",0,0,null,0,".$local.")";
		
		mysqli_query($link,$sql) or die(mysqli_error($link));

	};


////
//// ALTA NUEVA UBICACION DE PRODUCTO. 

	function altaUbicacion($codigo,$cantidad,$link,$local)
	{
		$x = 0;

		while ($x < 2){
			
			if ($x != $local) {
				$cantidad = 0;
			}

			$sql = "INSERT INTO ubicacion VALUES (null,'".$codigo."',".$cantidad.",".$x.")";
			
			mysqli_query($link,$sql) or die(mysqli_error($link));
			
			$x++;

		};

	};

	mysqli_close($link);
 ?>