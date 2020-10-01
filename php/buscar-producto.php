<?php 
	require "../conexion.php";

	$producto = $_POST['producto'];
	$cantidad = $_POST['cantidad'];

	if ($producto == 1) {
		$tabla = 'stockneumaticos';
	}
	if ($producto ==2) {
		$tabla = 'stockllantas';
	}
	if ($producto == 3) {
		$tabla = 'neumaticos';
	}
	if ($producto == 4) {
		$tabla = 'llantas';
	}

	$marca = $_POST['marca'];
	$modelo = $_POST['modelo'];
	$medida = $_POST['medida'];


	if (!empty($_POST['cant'])){
		$cant = str_replace(',','', $_POST['cant']);
		$cant = str_split($cant,1);
	}

	if (!empty($_POST['codigo'])){
		$codigoLista = str_replace(',', '', $_POST['codigo']);
		$codigoLista = str_split($codigoLista, 5);
	}

	$sql = "SELECT cod_Articulo AS codigo, marca, modelo, medida FROM ".$tabla." WHERE   marca = '".$marca."' AND modelo = '".$modelo."'  AND medida = '".$medida."'";

	$producto = mysqli_query($link,$sql);

	$cont = mysqli_num_rows($producto);

	if ($cont == 1) {

		$row = mysqli_fetch_assoc($producto);

		$cod = $row['codigo'];

		$x= 0;

		if (!empty($_POST['cant'])){
			foreach ($codigoLista as $codigo => $resp) {
				if ($resp == $cod) {
					$cantidad = $cantidad + $cant[$x];
				}
				$x++;
			}
		}

?>
		<tr class="resaltar" id="<?php echo $cod ?>">
			<td width="8%"><?php echo $cod ?></td>
			<td width="25%"><?php echo $row['marca'] ?></td>
			<td width="28%"><?php echo $row['modelo'] ?></td>
			<td width="28%"><?php echo $row['medida'] ?></td>
			<td width="8%" id="cantidad" onclick="cambiar()" style="cursor: pointer;s"><?php echo $cantidad ?></td>
			<td width="3%" class="hidden-print text-center"><a href="#" onclick="$('#<?php echo $cod ?>').remove()" class="borrar">Quitar</a></td>
		</tr>
<?php
	}
	mysqli_close($link);

 ?>