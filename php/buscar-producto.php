<?php
require "../conexion.php";

$producto = $_POST['producto'];
$cantidad = $_POST['cantidad'];

if ($producto == 1) {
	$tabla = 'stockneumaticos';
}
if ($producto == 2) {
	$tabla = 'stockllantas';
}
if ($producto == 3) {
	$tabla = 'neumaticos';
}
if ($producto == 4) {
	$tabla = 'llantas';
}
if ($producto == 5) {
	$tabla = 'accesorios';
}

$marca  = $_POST['marca'];
$modelo = $_POST['modelo'];
$medida = $_POST['medida'];

if (!empty($_POST['cant'])) {
	$cant = explode(",", $_POST['cant']);
}

if (!empty($_POST['codigo'])) {
	$codigoLista = explode(",", $_POST['codigo']);
}

$sql = 'SELECT marca, modelo, medida, cod_Articulo AS codigo FROM '.$tabla.' WHERE marca = "'.$marca.'" AND modelo = "'.$modelo.'" AND medida = "'.$medida.'"';

$producto = mysqli_query($link, $sql);

$cont = mysqli_num_rows($producto);

if ($cont > 0) {

	while ($row = mysqli_fetch_assoc($producto)) {
		$cod    = $row['codigo'];
		$marca  = $row['marca'];
		$modelo = $row['modelo'];
		$medida = $row['medida'];
	};

	$x = 0;

	if (!empty($_POST['cant'])) {
		foreach ($codigoLista as &$resp) {
			if ($resp == $cod) {
				$cantidad = $cantidad+$cant[$x];
			}
			$x++;
		}
	}

	?>
											<tr class="resaltar" id="<?php echo $cod?>">
												<td width="8%"><?php echo $cod?></td>
												<td width="25%"><?php echo $marca?></td>
												<td width="28%"><?php echo $modelo?></td>
												<td width="28%"><?php echo $medida?></td>
												<td width="8%" id="cantidad"><?php echo $cantidad?></td>
												<td width="3%" class="hidden-print text-center"><a href="#" onclick="quitar('<?php echo $cod?>')" class="borrar">Quitar</a></td>
											</tr>
	<?php
}
mysqli_close($link);

?>