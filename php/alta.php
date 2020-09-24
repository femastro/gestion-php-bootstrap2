<?php
	require "../conexion.php";

	$params = $_POST['json'];

	$cont = count($params);

	$i = 0;

	while ($cont > $i){

		$codigo = $params[$i]['Codigo'];
		$marca = $params[$i]['Marca'];
		$modelo = $params[$i]['Modelo'];
		$medida = $params[$i]['Medida'];
		$cantidad = $params[$i]['Cantidad'];
		
		$producto = substr($codigo,0,1); // extrae el primer caracter N ó L para saber que tabla usar.

		if ($producto == "N"){
			$tabla = 'neumaticos';
		}
		if ($producto == "L"){
			$tabla = 'llantas';
		}

		$sql = "SELECT cantidad FROM stock".$tabla." WHERE cod_Articulo ='".$codigo."' AND marca ='".$marca."' AND modelo ='".$modelo."'";

		$resultado = mysqli_query($link,$sql) or die(mysqli_error($link));

		$cont = mysqli_num_rows($resultdo);

		if ($cont > 0){

			$row = mysqli_fetch_assoc($resultado);

			$stock = $row['cantidad'];
			
			actualizarAlta($codigo,$marca,$modelo,$medida,$cantidad,$stock,$tabla);
			
		}else{
			
			altaNueva($codigo,$marca,$modelo,$medida,$cantidad);
			
			altaUbicacion($codido,$cantidad);
			
		};
		
		$i++;
	};
		

	actualizarAlta($codigo,$marca,$modelo,$medida,$cantidad,$stock,$tabla)
	{
		$nuevoStock = $cantidad + $stock;

		$sql = "UPDATE ".$tabla." SET cantidad='".$nuevoStock."' WHERE cod_Articulo ='".$codigo."' AND marca ='".$marca."' AND modelo ='".$modelo."'";

		mysqli_query($link,$sql) or die(mysqli_error($link));

		$x = 0;

		$sql = "SELECT cantidad FROM ubicacion WHERE codigo ='".$codigo."' AND ubicacion = ".$_SESSION['local'];

		$resultado = mysqli_query($link,$sql) or die(mysqli_error($link));

		$row = mysqli_fetch_assoc($resultado);

		$localStock = $row['cantidad'] + $cantidad;

		$sql = "UPDATE ubicacion SET cantidad = ".$localStock." WHERE codigo ='".$codigo."'";

		mysqli_query($link,$sql) or die(mysqli_error($link));

		$x++;

	};

	altaNueva($codigo,$marca,$modelo,$medida,$cantidad)
	{

		$sql = "INSERT INTO stock".$tabla." VALUES (null,'".$codigo."','".$marca."','".$modelo."','".$medida."','xxx',".$cantidad.",0,0,null,0,".$_SESSION['local'].")";
		
		mysqli_query($link,$sql) or die(mysqli_error($link));

	};

	altaUbicacion($codigo,$cantidad)
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