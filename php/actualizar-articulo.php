<?php
session_start();

require "../conexion.php";

$codigo = $_POST['codigo'];

$cadena = substr($codigo, 0, 1);

if ($cadena == "N") {
	$tabla = "stockneumaticos";
}
if ($cadena == "L") {
	$tabla = "stockllantas";
}
if ($cadena == "A" || $cadena == "S" || $cadena == "C") {
	$tabla = "accesorios";
}

$marca  = $_POST['marca'];
$modelo = $_POST['modelo'];
$medida = $_POST['medida'];

$stock = $_POST['stock'];

$stockLocal      = $_POST['stockLocal'];
$nuevoStockLocal = $_POST['nuevoStockLocal'];

if ($nuevoStockLocal > $stockLocal) {
	$r     = $stockLocal-$nuevoStockLocal;
	$stock = $stock-($r);
} else {
	if ($nuevoStockLocal <= 0) {
		$stock = $stock-$stockLocal;
	} else {
		$r     = $stockLocal-$nuevoStockLocal;
		$stock = $stock-$r;
	}
}

$proveedor = $_POST['proveedor'];

$sql = "UPDATE ".$tabla." SET marca ='".$marca."', modelo='".$modelo."', medida='".$medida."', cantidad=".$stock." , cod_Proveedor ='".$proveedor."' WHERE cod_Articulo='".$codigo."' AND modelo ='".$modelo."'";

mysqli_query($link, $sql) or die(mysqli_error($link));

$sql = "UPDATE ubicacion SET cantidad=".$nuevoStockLocal." WHERE codigo='".$codigo."' AND ubicacion=".$_SESSION['local'];

mysqli_query($link, $sql) or die(mysqli_error($link));

header('location:../stock.php');

mysqli_close($link);

?>