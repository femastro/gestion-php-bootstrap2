<?php
require "../conexion.php";

$producto = $_POST['producto'];

$order = "marca";

if ($producto == 1) {
	$tabla = "stockneumaticos";
}
if ($producto == 2) {
	$tabla = "stockllantas";
}
if ($producto == 5) {
	$tabla = "accesorios";
}

$sql = "SELECT cod_Articulo AS codigo, marca, modelo, medida, cantidad FROM ".$tabla;

if (strlen($_POST['marca']) > 3 || strlen($_POST['modelo']) > 3 || strlen($_POST['medida']) > 3) {
	$sql .= " WHERE";
}

if (strlen($_POST['marca']) > 3) {//// true
	$sql .= " marca ='".$_POST['marca']."'";
}

if (strlen($_POST['modelo']) > 3) {/// true
	if (strlen($_POST['marca']) > 3) {
		$sql .= " AND";
	}
	$sql .= " modelo ='".$_POST['modelo']."'";
	$order = "modelo";
}

if (strlen($_POST['medida']) > 3) {/// true
	if (strlen($_POST['modelo']) > 3 || strlen($_POST['marca']) > 3) {
		$sql .= " AND";
	}
	$sql .= " medida ='".$_POST['medida']."'";
	$order = "medida";
}

$sql .= " ORDER BY ".$order." ASC";

$lista = mysqli_query($link, $sql);

$x = 1;

function image($img) {
	$url     = '../imgProducto/'.$img.'.jpg';
	$url2    = '../imgProducto/'.$img.'.png';
	$sinFoto = '../imgProducto/sin-foto.png';
	if (file_exists($url)) {
		echo $img.'.jpg';
	} elseif (file_exists($url2)) {
		echo $img.'.png';
	} else {
		echo 'sin-foto.png';
	}
}

while ($row = mysqli_fetch_assoc($lista)) {
	$cod = $row['codigo'];
	?>
			<tr id="<?php echo $row['codigo']?>" class="resaltar" ondblclick="salida_multiple('<?php echo $row['codigo']?>')">
				<td width="5%"><?php echo $x?></td>
				<td width="8%"><?php echo $row['codigo']?></td>
				<td width="20%"><?php echo $row['marca']?></td>
				<td width="20%"><?php echo $row['modelo']?></td>
				<td width="20%"><?php echo $row['medida']?></td>
				<td width="5%"><?php echo $row['cantidad']?></td>
				<td width="12%" class="hidden-print text-center">
					<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-file-earmark" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
	                    <path d="M4 1h5v1H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V6h1v7a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2z"/>
						<path d="M9 4.5V1l5 5h-3.5A1.5 1.5 0 0 1 9 4.5z"/>
					</svg>&nbsp;
					<a href="#" onclick="editar('<?php echo $cod?>')" data-toggle="modal" data-target="#Modal-edit">Editar</a>&nbsp;
	&nbsp;
					<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-x-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
					  	<path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
					  	<path fill-rule="evenodd" d="M11.854 4.146a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708-.708l7-7a.5.5 0 0 1 .708 0z"/>
					 	<path fill-rule="evenodd" d="M4.146 4.146a.5.5 0 0 0 0 .708l7 7a.5.5 0 0 0 .708-.708l-7-7a.5.5 0 0 0-.708 0z"/>
					</svg>&nbsp;
					<a href="#" onclick="quitar('<?php echo $cod?>')" data-toggle="modal" data-target="#Modal-edit">Quitar</a>
				</td>
				<td width="15%" class="hidden-print">
					<a href="#" onclick="ver('<?php echo $cod?>')" class="btn-ver btn" data-toggle="modal" data-target="#Modal-edit">
						<img src="imgProducto/<?php image($cod)?>" alt="rueda" width="60%">
					</a>
				</td>
			</tr>
	<?php
	$x++;
}
mysqli_close($link);
?>