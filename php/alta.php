<?php
	require "../conexion.php";

	$params = $_POST['json']; /// recibe JSON 

	$cont = count($params); ///// Contador de Datos del JSON

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

		$cont = mysqli_num_rows($resultdo);

		if ($cont > 0){

			$row = mysqli_fetch_assoc($resultado);

			$stock = $row['cantidad'];
			
			actualizarAlta($codigo,$marca,$modelo,$medida,$cantidad,$stock,$tabla);
			
		}else{
			
			altaNueva($codigo,$marca,$modelo,$medida,$cantidad,$tabla);
			
			altaUbicacion($codido,$cantidad);
			
		};
		
		$i++;
	};
	
	////	
	//// ACTUALIZACION de STOCK !!!!
	
	function actualizarAlta($codigo,$marca,$modelo,$medida,$cantidad,$stock,$tabla) 
	{		
		$nuevoStock = $cantidad + $stock; /// Error ? =: syntax error, unexpected ';' on this line.
		
		$sql = "UPDATE ".$tabla." SET cantidad='".$nuevoStock."' WHERE cod_Articulo ='".$codigo."' AND marca ='".$marca."' AND modelo ='".$modelo."'";

		mysqli_query($link,$sql) or die(mysqli_error($link));

		$x = 0;

		// Busca stock en ubicacion

		$sql = "SELECT cantidad FROM ubicacion WHERE codigo ='".$codigo."' AND ubicacion = ".$_SESSION['local'];

		$resultado = mysqli_query($link,$sql) or die(mysqli_error($link));

		$row = mysqli_fetch_assoc($resultado);

		/// suma el ingreso nuevo al stock de ubicacion

		$localStock = $row['cantidad'] + $cantidad;

		$sql = "UPDATE ubicacion SET cantidad = ".$localStock." WHERE codigo ='".$codigo."' AND ubicacion = ".$_SESSION['local'];

		// actualiza la ubicacion

		mysqli_query($link,$sql) or die(mysqli_error($link));

		$x++;

	};


////
//// ALTA NUEVO PRODUCTO !!!

	function altaNueva($codigo,$marca,$modelo,$medida,$cantidad,$tabla)
	{

		$sql = "INSERT INTO ".$tabla." VALUES (null,'".$codigo."','".$marca."','".$modelo."','".$medida."','XXX',".$cantidad.",0,0,null,0,".$_SESSION['local'].")";
		
		mysqli_query($link,$sql) or die(mysqli_error($link));

	};


////
//// ALTA NUEVA UBICACION DE PRODUCTO. 

	function altaUbicacion($codigo,$cantidad)
	{
		$x = 0;

		while ($x < 2){
			
			if ($x != $_SESSION['local']) {
				$cantidad = 0;
			}

			$sql = "INSERT INTO ubicacion VALUES (null,'".$codigo."',".$cantidad.",".$x.")";
			
			mysqli_query($link,$sql) or die(mysqli_error($link));
			
			$x++;

		};

	};



	mysqli_close($link);
 ?>