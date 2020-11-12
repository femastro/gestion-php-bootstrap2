<?php
session_start();

require "../conexion.php";

$tipo   = $_POST['tipo'];
$marca  = $_POST['marca'];
$modelo = $_POST['modelo'];
$medida = $_POST['medida'];

if ($tipo == 1) {
	$tabla = "neumaticos";
	$letra = "N";
}
if ($tipo == 2) {
	$tabla = "llantas";
	$letra = "L";
}
if ($tipo == 3) {
	$tabla = "accesorios";
	$letra = "C";
}
if ($tipo == 4) {
	$tabla = "accesorios";
	$letra = "S";
}
if ($tipo == 5) {
	$tabla = "accesorios";
	$letra = "A";
}

$sql = "SELECT MAX(cod_Articulo) as codigo FROM ".$tabla;// consulta el ultimo registro para poder aumentar 1 al cod_Articulo

$resultado = mysqli_query($link, $sql) or die(mysqli_error($link));

$row = mysqli_fetch_assoc($resultado);

$cadena = intval(substr($row['codigo'], 1));

$cadena = $cadena+1;

$codigo = $letra.$cadena;

if ($letra == "A" || $letra == "S" || $letra == "C") {

	$sql = "INSERT INTO ".$tabla." VALUES (null,'".$codigo."','".$marca."','".$modelo."','".$medida."',0,'','',null)";

	$sqlUbicacion = "INSERT INTO ubicacion VALUES (null,'".$codigo."',0,0)";

	$sqlUbicacion2 = "INSERT INTO ubicacion VALUES (null,'".$codigo."',0,1)";

} else {
	$sql = "INSERT INTO ".$tabla." VALUES (null,'".$codigo."','".$marca."','".$modelo."','".$medida."',null)";
};

mysqli_query($link, $sql) or die(mysqli_error($link));
mysqli_query($link, $sqlUbicacion) or die(mysqli_error($link));
mysqli_query($link, $sqlUbicacion2) or die(mysqli_error($link));

$cont = mysqli_affected_rows($link);

if ($cont == 1) {
	echo 1;
} else {
	echo 2;
}

mysqli_close($link);

?>

