<?php 
	require '../conexion.php';
	$cantidad = 0;

	if ($_POST['producto']==1) {
		$tabla = 'stockneumaticos';
	}
	if ($_POST['producto']==2) {
		$tabla = 'stockllantas';
	}
	if ($_POST['producto']==3) {
		$tabla = 'neumaticos';
	}
	if ($_POST['producto']==4) {
		$tabla = 'llantas';
	}

	$sql = "SELECT cod_Articulo  AS codigo  FROM ".$tabla." WHERE marca ='".$_POST['marca']."' AND modelo = '".$_POST['modelo']."' AND medida = '".$_POST['medida']."'";

	$datos = mysqli_query($link,$sql);
	
	$row = mysqli_fetch_assoc($datos);

	$cont = mysqli_num_rows($datos);

	if ($cont == 1 || $cont != null) {

		echo $row['codigo'];

	}
	mysqli_close($link);
?>