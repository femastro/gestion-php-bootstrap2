<?php 
	require "conexion.php";

	$cadena = substr($_POST['codigo'],0,1);

		if ($cadena == "N") {
			$tabla = "stockneumaticos";
			$articulo = "NEUMÁTICO";
		};
		if ($cadena == "L"){
			$tabla = "stockllantas";
			$articulo = "LLANTA";
		};

	$sql = "SELECT * FROM ".$tabla." WHERE cod_Articulo ='".$_POST['codigo']."'";

	$resultado = mysqli_query($link,$sql);

	$row = mysqli_fetch_assoc($resultado);

	$cod = $row['cod_Articulo'];

	function image($img){
		$url = 'imgProducto/'.$img.'.jpg';
		$url2 = 'imgProducto/'.$img.'.png';
		$sinFoto = 'imgProducto/sin-foto.png';
		if (file_exists($url)) {
			echo $url;
		}elseif (file_exists($url2)){
			echo $url2;
		}else{
			echo $sinFoto;
		}
	}

	mysqli_close($link);

 ?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Gestion Cueto</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/boostrap.css">
        <link rel="stylesheet" href="css/custom.min.css">
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </head>
    <body class="container-fluid">
		 <div class="card" style="margin: 0 auto">
		 	<h3 class="card-header"><?php echo $articulo ?></h3>
			<div class="card-body">
				<h4 class="card-title"><?php echo $row['marca'] ?>&nbsp;<span style="font-size:12px" >(<span id="codigo"><?php echo $_POST['codigo'] ?></span> )</span></h4>
				<h5 class="mt-2"><?php echo $row['modelo'] ?></h5>
				<h6 class="mt 2"><?php echo $row['medida'] ?></h6>
			    <p class="mt-3"><strong>STOCK Gral. : </strong><?php echo $row['cantidad']; ?></p>
			    <p class="mt-2">
			   	<?php 
			   		if ($row['cantidad'] > 0){
			   	?>
			   			<a href="#" onclick="salida_multiple()" class="btn btn-primary btn-block" style="font-size: 12px">
							<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-cart-dash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
								<path fill-rule="evenodd" d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm7 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
								<path fill-rule="evenodd" d="M6 7.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5z"/>
							</svg>&nbsp; ENVIAR a SALIDA
					   </a>
			   	<?php
			   		}else{
			   	?>
			   			<button class="btn btn-primary btn-block" style="font-size: 10px" disabled="disabled">
							<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-cart-dash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
								<path fill-rule="evenodd" d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm7 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
								<path fill-rule="evenodd" d="M6 7.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5z"/>
							</svg>&nbsp;  ENVIAR a SALIDA
			   			</button>
				<?php
			   		}
				?>
			    </p>
			</div>
			<div class="mb-3">
				<img style="height: 210px; width: 50%; display: block;margin: auto" src="<?php image($cod) ?>" alt="Card image">
			</div>
		</div>

		<!-- MODAL -->
        <div class="modal fade" id="ModalCenterOK" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTitle" aria-hidden="true">
          	<div class="modal-dialog modal-dialog-centered" role="document">
	            <div class="modal-content">
	              	<div class="modal-header">
	                	<h5 class="modal-title" id="ModalLongTitle">Atención</h5>
	              	</div>
	              	<div class="modal-body">
	              		<h6 id="texto-modal"></h6>  
	              </div>
	            </div>
          	</div>
        </div>
		<script>
			function salida_multiple(){
				var codigo = $('#codigo').text();
				location.href="salida-multiple.php?codigo="+codigo;
			}
		</script>
    </body>
</html>
