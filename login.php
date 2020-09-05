<main class="container">
	<div class="row">
		<div class="col-xl-12 col-sm-7" style="margin: 20px auto">
			<div class="card">
				<div class="card-header">
					<h4 class="text-center">LOGIN</h4>
				</div>
				<div class="card-body login">
					<form action="php/login.php" method="POST">
					  <div class="form-group">
					    <label for="exampleInputEmail1">Usuario</label>
					    <input type="text" class="form-control" name="username" aria-describedby="emailHelp">
					  </div>
					  <div class="form-group">
					    <label for="exampleInputPassword1">Password</label>
					    <input type="password" class="form-control" name="password">
					  </div>
					  <div class="form-group">
					  	<label for="local">Sucursal</label>
					  	<select name="local" class="form-control" id="local">
					  		<option value="0">GARAY</option>
					  		<option value="1">HORNOS</option>
					  	</select>
					  </div>
					  <br>
					  <div class="mt-1 text-center">
						<?php
							if (!empty($_GET['error'])) {
						?>
								<p><span class="error-login">USUARIO ó PASSWORD ERROR !</span></p>
						<?php
							}
						?>
					  	
					  </div>
					  <div class="mt-3 text-right">
					  	<button type="submit" class="btn btn-primary">Submit</button>
					  </div>
					</form>
				</div>
				<div class="card-footer text-left mt-2">
					- Seccionar la sucursal en la que se encuentra.
				</div>
			</div>
		</div>
	</div>
</main>