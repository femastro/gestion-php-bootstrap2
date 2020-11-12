<?php

require '../conexion.php';
$cantidad = 0;

if ($_POST['producto'] == 1) {
	$tabla = 'stockneumaticos';
}
if ($_POST['producto'] == 2) {
	$tabla = 'stockllantas';
}
if ($_POST['producto'] == 3) {
	$tabla = 'neumaticos';
}
if ($_POST['producto'] == 4) {
	$tabla = 'llantas';
}
if ($_POST['producto'] == 5) {
	$tabla = 'accesorios';
}

$sql = "SELECT cantidad  FROM ".$tabla." WHERE marca ='".$_POST['marca']."' AND modelo = '".$_POST['modelo']."' AND medida = '".$_POST['medida']."'";

$datos = mysqli_query($link, $sql);

$row = mysqli_fetch_assoc($datos);

$cont = mysqli_num_rows($datos);

?>
<option value="0">Cantidad ...</option>
<?php
if ($cont == 1 || $cont != null) {

	$i        = 1;
	$cantidad = $row['cantidad'];

	if ($_POST['cant']) {
		$cantidad = $cantidad-$_POST['cant'];
	}

	while ($i <= $cantidad) {
		?>
					<option value="<?php echo $i?>"><strong><?php echo $i?></strong>&nbsp;Unidad</option>
		<?php
		$i++;
	}

}
mysqli_close($link);
?>