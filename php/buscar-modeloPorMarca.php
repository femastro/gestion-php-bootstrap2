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

$sql = "SELECT DISTINCT(modelo) AS dato FROM ".$tabla;

if (strlen($_POST['marca']) > 2) {//// true
	$marca = $_POST['marca'];
	$sql .= " WHERE marca ='".$marca."'";
}

$sql .= " ORDER BY modelo ASC";

$datos = mysqli_query($link, $sql);
?>
<option value="0">Modelo ...</option>
<?php while ($row = mysqli_fetch_assoc($datos)) {
	?>
			<option value="<?php echo $row['dato']?>"><?php echo $row['dato']?></option>
	<?php
}

mysqli_close($link);
?>