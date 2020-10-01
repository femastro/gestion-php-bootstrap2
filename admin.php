<?php 
	require "validator.php";
	require "header.php";
	require "conexion.php";
	require "php/buscar-usuarios.php";
 ?>
 <script type="text/javascript" src="js/checkRole.js"></script>
 <main class="container">
 	<div class="row">
		<div class="col-12 col-sm-3"></div>
		 	<div class="col-12 col-sm-6">
				 <div class="card mt-5">
				 <div class="card-header text-center">
					 <h3>Listado de Usuarios</h3>
				 </div>
				 <div class="card-body div-body-listado">
					 <div class="row text-center title-listado">
						 <div class="col-1 col-sm-1">#</div>
						 <div class="col-3 col-sm-3">Usuarios</div>
						 <div class="col-3 col-sm-3">Role</div>
						 <div class="col-5 col-sm-5"><a href="#">Nuevo</a></div>
					</div>
					<hr><br>
					<?php
						$i = 1;
						while ($row = mysqli_fetch_assoc($resultado)) {
					?>
							<div class="row text-center mb-3 resaltar" style="padding: 10px 5px">
								<div class="col-1 col-sm-1"><?php echo $i ?></div>
								<div class="col-3 col-sm-3"><?php echo $row['usuario'] ?></div>
								<div class="col-3 col-sm-3"><?php echo $row['privilegios'] ?></div>
								<div class="col-3 col-sm-3"><a href="#">Editar</a></div>
								<div class="col-2 col-sm-2"><a href="#">Quitar</a></div>
							</div>
					<?php
							$i++;
						}
					?>
						<hr>
						<div class="row text-center">
							<div class="col-12 col-sm-12">
								<a class="btn btn-danger" href="index.php">Cerrar</a>
							</div>
						</div>
				 </div>
			</div>
 		</div>
 	</div>
 </main>