<?php
require '../conexion.php';

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

if ($_POST['producto'] < 5) {

	$sql = "SELECT DISTINCT(marca) AS dato FROM ".$tabla." ORDER BY marca ASC";

	$datos = mysqli_query($link, $sql);
	?>
	<option value="">Marca ...</option>
	<?php while ($row = mysqli_fetch_assoc($datos)) {
		?>
					<option value="<?php echo $row['dato']?>"><?php echo $row['dato']?></option>
		<?php
	}
}

if ($_POST['producto'] > 4) {

	$sql = "SELECT DISTINCT(marca) AS dato FROM ".$tabla." ORDER BY marca ASC";

	$datos = mysqli_query($link, $sql);
	?>
	<option value="">Marca ...</option>
	<?php while ($row = mysqli_fetch_assoc($datos)) {
		?>
					<option value="<?php echo $row['dato']?>"><?php echo $row['dato']?></option>
		<?php
	}

}

mysqli_close($link);
?>