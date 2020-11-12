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

$sql = "SELECT DISTINCT(medida) AS dato FROM ".$tabla;

if (strlen($_POST['marca']) > 2 || strlen($_POST['modelo']) > 2) {
	$sql .= " WHERE";
}

if (strlen($_POST['marca']) > 2) {
	$marca = $_POST['marca'];
	$sql .= " marca = '".$marca."'";
}

if (strlen($_POST['modelo']) > 2) {//// true
	if (strlen($_POST['marca']) > 2) {
		$sql .= " AND";
	}
	$modelo = $_POST['modelo'];
	$sql .= " modelo ='".$modelo."'";
}

$sql .= " ORDER BY medida ASC";

$datos = mysqli_query($link, $sql);

?>
<option value="0">Medida ...</option>
<?php while ($row = mysqli_fetch_assoc($datos)) {
	?>
					<option value="<?php echo $row['dato']?>"><?php echo $row['dato']?></option>
	<?php
}

mysqli_close($link);
?>