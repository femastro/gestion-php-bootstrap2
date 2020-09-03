<?php 
	require '../conexion.php';

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

	$sql = "SELECT DISTINCT(medida) AS dato FROM ".$tabla." ORDER BY medida ASC";

	$datos = mysqli_query($link,$sql);
?>
	<option value="0">Seleccionar ...</option>
<?php
	while ($row = mysqli_fetch_assoc($datos)) {
?>
		<option value="<?php echo $row['dato'] ?>"><?php echo $row['dato'] ?></option>
<?php
	}

	mysqli_close($link);
?>