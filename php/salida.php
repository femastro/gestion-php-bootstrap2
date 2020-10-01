<?php
	session_start();

	require "../conexion.php";

	$params = $_POST['json']; /// recibe JSON 

	$local = $_SESSION['local']; /// Captura en que local-sucursal esta el usuario.

	$i = 0;
	$contador = count($params);
	///// Contador de Datos del JSON .

	while ($i < $contador){ 
		// No se ejecuta el loop- solo una vez y en el caso de que sean mas de 1, solo procesa el primer registro.
		// en el array pueden llegar mas de un registro formato ( json / array ).

		$codigo = $params[$i]['Codigo'];
		$marca = $params[$i]['Marca'];
		$modelo = $params[$i]['Modelo'];
		$medida = $params[$i]['Medida'];
		$cantidad = intval($params[$i]['Cantidad']);
		
		$cadena = substr($codigo,0,1); // Extrae el primer caracter N ó L para saber que tabla usar.

		if ($cadena == "N"){
			$tabla = 'stockneumaticos';
		}
		if ($cadena == "L"){
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
			
        }
        
		$i++;
	};
	
	////	
	//// ACTUALIZACION de STOCK !!!!
	
	function actualizarAlta($codigo,$marca,$modelo,$medida,$cantidad,$stock,$tabla,$link,$local) 
	{
		
		$nuevoStock = $stock - $cantidad; /// Error ? =: syntax error, unexpected ';' on this line.
		
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

		$stockActual = $stockAnterior - $cantidad;

		$sql = "UPDATE ubicacion SET cantidad = ".$stockActual." WHERE codigo ='".$codigo."' AND ubicacion = ".$local;

		// actualiza la ubicacion
		mysqli_query($link,$sql) or die(mysqli_error($link));

	};

	mysqli_close($link);
 ?>