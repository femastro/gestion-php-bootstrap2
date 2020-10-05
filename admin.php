<?php 
	require "validator.php";
	require "header.php";
	require "conexion.php";
	require "php/buscar-usuarios.php";
 ?>
 <script type="text/javascript" src="js/checkRole.js"></script>
 <main class="container">
 	<div class="row">
		<div class="col-xs-12 col-sm-3"></div>
		<div class="col-xs-12 col-sm-6">
			<div class="card mt-5">
				<div class="card-header text-center">
					 <h3>Listado de Usuarios</h3>
				</div>
				<div class="card-body div-body-listado">
					<div class="row text-center title-listado">
						<div class="col-xs-1 col-sm-1">#</div>
						 <div class="col-xs-3 col-sm-3">Usuarios</div>
						 <div class="col-xs-3 col-sm-3">Role</div>
						 <div class="col-xs-5 col-sm-5"><a href="#">Nuevo</a></div>
					</div>
					<hr>
					<?php
						$i = 1;
						while ($row = mysqli_fetch_assoc($resultado)) {
					?>
							<div class="row text-center mb-2 resaltar" style="padding: 10px 5px">
								<div class="col-xs-1 col-sm-1"><?php echo $i ?></div>
								<div class="col-xs-3 col-sm-3"><?php echo $row['usuario'] ?></div>
								<div class="col-xs-3 col-sm-3"><?php echo $row['privilegios'] ?></div>
					<?php
								if($row['usuario'] != "admin"){
					?>
									<div class="col-xs-3 col-sm-3"><a href="#">Editar</a></div>
									<div class="col-xs-2 col-sm-2"><a href="#">Quitar</a></div>
					<?php
								}
					?>
							</div>
							<hr>
					<?php
							$i++;
						}
					?>
					<div class="row text-center">
						<div class="col-xs-12 col-sm-12">
							<a class="btn btn-danger btn-block" href="index.php">CERRAR</a>
						</div>
					</div>
				 </div>
			</div>
 		</div>
 	</div>
 </main>