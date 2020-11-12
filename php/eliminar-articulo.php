<?php
require "../conexion.php";

$codigo = $_POST['codigo'];

$cadena = substr($codigo, 0, 1);

if ($cadena == "N") {
	$tabla = "stockneumaticos";
} else {
	$tabla = "stockllantas";
}
if ($cadena == "A" || $cadena == "S" || $cadena == "C") {
	$tabla    = "accesorios";
	$articulo = "ACCESORIO";
};

$sql = "DELETE FROM ".$tabla." WHERE cod_Articulo = '".$codigo."'";

mysqli_query($link, $sql) or die(mysqli_error($link));

$contStock = mysqli_affected_rows($link);

$sql = "DELETE FROM ubicacion WHERE codigo = '".$codigo."'";

mysqli_query($link, $sql) or die(mysqli_error($link));

$contUbicacion = mysqli_affected_rows($link);

if ($contStock > 0 && $contUbicacion > 0) {
	echo true;
} else {
	echo false;
}

mysqli_close($link);
?>