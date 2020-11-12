<?php
require "validator.php";
require "header.php";
require "php/buscar-usuarios.php";

?>
<script>
	$(document).ready(function(){
		$('#spinner').hide();
	})
 </script>
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
						 <div class="col-xs-5 col-sm-5"><a href="#" onclick="new_user()" data-toggle="modal" data-target="#Modal">Nuevo</a></div>
					</div>
					<hr>
<?php
$i = 1;
while ($row = mysqli_fetch_assoc($resultado)) {
	?>
									<div class="row text-center mb-2 resaltar" style="padding: 10px 5px">
										<div class="col-xs-1 col-sm-1"><?php echo $i?></div>
										<div class="col-xs-3 col-sm-3"><?php echo $row['usuario']?></div>
										<div class="col-xs-3 col-sm-3"><?php echo $row['privilegios']?></div>
	<?php
	if ($row['usuario'] != "Admin") {
		?>
													<div class="col-xs-3 col-sm-3">
														<a href="#" onclick="edit_user(<?php echo $row['idusuarios']?>)" data-toggle="modal" data-target="#Modal">Editar</a>
													</div>
													<div class="col-xs-2 col-sm-2">
														<a href="#" onclick="delete_user(<?php echo $row['idusuarios']?>)" data-toggle="modal" data-target="#Modal">Quitar</a>
													</div>
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
	 <!---
		MODAL
	-->
	<div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true" style="width: 100%">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content" style="width: 100%;">
	      <div class="modal-header">
				<h6 id="title-modal"></h6>
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          		<span aria-hidden="true">&times;</span>
	        	</button>
	      </div>
	      <div class="modal-body row">
				<div  id="this-modal" class="col-12 col-sm-12"></div>
                <div class="col-xs-12 col-sm-12 text-center" style="margin: 3px;font-size:12px;" id="spinner">
					<div class="spinner-border text-primary" role="status">
						<span class="sr-only">Loading...</span>
					</div> Loading....
				</div>
	      </div>
	    </div>
	  </div>
	</div>
	<!--
		FIN MODAL
	-->
 </main>
 <script>

	function new_user(){
		$('#this-modal').html('');
		$('#title-modal').html('Nuevo');
		$('#this-modal').load('php/nuevo-usuario.php');
	}

	function edit_user(id){
		$('#this-modal').html('');
		$('#spinner').show();
		$('#title-modal').html('Editar');
		var dataString = "id="+id;
		$.ajax({
			type: 'POST',
			data: dataString,
			url: 'php/editar-usuario.php',
			cache: false,
			success: function (data){
				setTimeout(() => { $('#spinner').hide(); }, 1000);
				setTimeout(() => { $('#this-modal').html(data) }, 1200);
			}
		})
	}

	function delete_user(id){
		$('#this-modal').html('');
		$('#spinner').show();
		$('#title-modal').html('Eliminar');
		var dataString = "id="+id;
		$.ajax({
			type: 'POST',
			data: dataString,
			url: 'php/eliminar-usuario.php',
			cache: false,
			success: function (data){
				setTimeout(() => { $('#spinner').hide() }, 1000);
				setTimeout(() => { $('#this-modal').html(data) }, 1200);
			}
		})
	}
 </script>