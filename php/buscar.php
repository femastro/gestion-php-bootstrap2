<?php 
	require "../conexion.php";

	$dato = $_POST['dato'];

	$sql = "SELECT cod_Articulo AS codigo, marca, modelo, medida, cantidad FROM stockneumaticos  WHERE  cod_Articulo LIKE 'N".$dato."%' OR marca  LIKE '".$dato."%' OR modelo  LIKE '".$dato."%'  OR medida  LIKE '".$dato."%'ORDER BY marca ASC";

	$neumaticos = mysqli_query($link,$sql);

	$x = 1;
	
	while ($row = mysqli_fetch_assoc($neumaticos)){
		$cod = $row['codigo'];
?>
		<tr id="<?php echo $row['codigo'] ?>" class="resaltar">
			<td width="5%"><?php echo $x ?></td>
			<td width="8%"><?php echo $row['codigo'] ?></td>
			<td width="20%"><?php echo $row['marca'] ?></td>
			<td width="20%"><?php echo $row['modelo'] ?></td>
			<td width="20%"><?php echo $row['medida'] ?></td>
			<td width="5%"><?php echo $row['cantidad'] ?></td>
			<td width="12%" class="hidden-print">
				<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-file-earmark" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4 1h5v1H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V6h1v7a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2z"/>
					<path d="M9 4.5V1l5 5h-3.5A1.5 1.5 0 0 1 9 4.5z"/>
				</svg>&nbsp;
				<a href="#" onclick="editar('<?php echo $cod ?>')">Editar</a>&nbsp;&nbsp;
				<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-x-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
				  	<path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
				  	<path fill-rule="evenodd" d="M11.854 4.146a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708-.708l7-7a.5.5 0 0 1 .708 0z"/>
				 	<path fill-rule="evenodd" d="M4.146 4.146a.5.5 0 0 0 0 .708l7 7a.5.5 0 0 0 .708-.708l-7-7a.5.5 0 0 0-.708 0z"/>
				</svg>&nbsp;
				<a href="#" onclick="quitar('<?php echo $cod ?>')">Quitar</a>
			</td>
			<td width="15%" class="hidden-print">
				<a href="#" onclick="ver('<?php echo $cod ?>')" class="btn-ver btn btn-primary" data-toggle="modal" data-target="#Modal">
					<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-info-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
					  <path fill-rule="evenodd" d="M14 1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
					  <path fill-rule="evenodd" d="M14 1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
					  <path d="M8.93 6.588l-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588z"/>
					  <circle cx="8" cy="4.5" r="1"/>
					</svg>&nbsp;Ver +
				</a>
			</td>
		</tr>
<?php
		$x++;
	}

	mysqli_close($link);

 ?>