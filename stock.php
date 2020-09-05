<?php 
	require "validator.php";
	
	require "header.php";
	require "conexion.php";

	$sql = "SELECT cod_Articulo AS codigo, marca, modelo, medida, cantidad FROM stockneumaticos ORDER BY marca ASC";
	$neumaticos = mysqli_query($link,$sql);

	$sql = "SELECT cod_Articulo AS codigo, marca, modelo, medida, cantidad FROM stockllantas ORDER BY marca ASC";
	$llantas = mysqli_query($link,$sql);
?>
<main class="container-fluid">
	<div class="row">
		<h5 style="padding: 8px 0;">Stock</h5>
		<div class="col-xl-12 col-sm-12 fieldset">
		  	<p class="legend">Filtros</p>
			<div class="row">
				<!-- SELECTS -->
				<div class="col-xl-3 col-sm-3 form-group">
					<label for="">Productos :</label>
					<select class="form-control"  onchange="tipo_producto(this.value)" id="tipo-producto">
						<option value="0">Seleccionar ...</option>
						<option value="1">Neumaticos</option>
						<option value="2">Llantas</option>
					</select>
				</div>
				<div class="col-xl-3 col-sm-3 form-group">
					<label for="">Marcas :</label>
					<select class="form-control"  id="selectMarca" onchange="buscar_modelo(this.value)"></select>
				</div>
				<div class="col-xl-3 col-sm-3 form-group">
					<label for="">Modelos :</label>
					<select class="form-control" id="selectModelo" onchange="buscar_medida(this.value)"></select>
				</div>
				<div class="col-xl-3 col-sm-3 form-group">
					<label for="">Medidas :</label>
					<select class="form-control" id="selectMedida" onchange="buscar_articulo(this.value)"></select>
				</div>

				<!--- Menu buscar -->
				<div class="col-xl-10 col-sm-9" style="margin-top: 12px;">
					<div class="row">
						<div class="col-xl-8 col-sm-6">
				    		<input class="form-control" type="text" placeholder="Buscar..." id="search" onkeypress="buscar(this.value)" style="width:100%;">
							&nbsp;
							
						</div>
						<div class="col-xl-2 col-sm-3">
						   	<button class="btn btn-secondary btn-block" onclick="buscar($('#search').val())">
						   		<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
								    <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
								    <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
								</svg>&nbsp;
						    	Buscar
						    </button>
							&nbsp;
							
						</div>
						<div class="col-xl-2 col-sm-3">
							<button class="btn btn-danger btn-block" onclick="location.href='stock.php'">
						   		<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-counterclockwise" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
								  	<path fill-rule="evenodd" d="M12.83 6.706a5 5 0 0 0-7.103-3.16.5.5 0 1 1-.454-.892A6 6 0 1 1 2.545 5.5a.5.5 0 1 1 .91.417 5 5 0 1 0 9.375.789z"/>
									<path fill-rule="evenodd" d="M7.854.146a.5.5 0 0 0-.708 0l-2.5 2.5a.5.5 0 0 0 0 .708l2.5 2.5a.5.5 0 1 0 .708-.708L5.707 3 7.854.854a.5.5 0 0 0 0-.708z"/>
								</svg>&nbsp;
						    	Limpiar
						    </button>
							
						</div>
					</div>
				</div>
				<div class="col-xl-2 col-sm-3">
					<button class="btn btn-link btn-block" style="font-size:12px;margin-top: 12px">
						<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-archive" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
						    <path fill-rule="evenodd" d="M2 5v7.5c0 .864.642 1.5 1.357 1.5h9.286c.715 0 1.357-.636 1.357-1.5V5h1v7.5c0 1.345-1.021 2.5-2.357 2.5H3.357C2.021 15 1 13.845 1 12.5V5h1z"/>
						    <path fill-rule="evenodd" d="M5.5 7.5A.5.5 0 0 1 6 7h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5zM15 2H1v2h14V2zM1 1a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H1z"/>
						</svg>&nbsp;
						RESPALDO
					</button>
				</div>
				<!-- fin de Buscar --->
			</div>
		</div>
	</div>
<!--
	GRILLA de NEUMATICOS
-->
	<div class="row">
		<table class="col-xl-12 col-sm-12 table" id="table1">
			<thead>
				<tr>
					<td colspan="6"><h3 id="tipo1">NEUMATICOS :</h3></td>
					<td colspan="1" class="hidden-print">
						<button class="btn btn-success btn-block text-center" style="font-size:10px;" onclick="tableToExcel('table1', 'Listado')">
							<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-file-earmark-spreadsheet" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
								<path fill-rule="evenodd" d="M5 9H3V8h10v1h-3v2h3v1h-3v2H9v-2H6v2H5v-2H3v-1h2V9zm1 0v2h3V9H6z"/>
								<path d="M4 1h5v1H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V6h1v7a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2z"/>
								<path d="M9 4.5V1l5 5h-3.5A1.5 1.5 0 0 1 9 4.5z"/>
							</svg>&nbsp;EXCEL
						</button>
					<td coslpan="1" class="hidden-print">
						<button class="btn btn-secondary btn-block text-center" style="font-size:10px;" onclick="printTable(1)">
							<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-printer" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
							    <path d="M11 2H5a1 1 0 0 0-1 1v2H3V3a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v2h-1V3a1 1 0 0 0-1-1zm3 4H2a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h1v1H2a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1z"/>
							    <path fill-rule="evenodd" d="M11 9H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1zM5 8a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H5z"/>
							    <path d="M3 7.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z"/>
							</svg>&nbsp;IMPRIMIR
						</button>
					</td>
				</tr>
				<tr>
					<th width="5%">#</th>
					<th width="8%" onclick="sortTable(1,'str',1)" class="sort">Codigo</th>
					<th width="20%" onclick="sortTable(2,'str',1)" class="sort">Marca</th>
					<th width="20%" onclick="sortTable(3,'str',1)" class="sort">Modelo</th>
					<th width="20%" onclick="sortTable(4,'str',1)" class="sort">Medida</th>
					<th width="5%" onclick="sortTable(5,'int',1)" class="sort">Stock</th>
					<th width="12%" class="hidden-print">
						<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-bookmark-plus" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
							  <path fill-rule="evenodd" d="M4.5 2a.5.5 0 0 0-.5.5v11.066l4-2.667 4 2.667V8.5a.5.5 0 0 1 1 0v6.934l-5-3.333-5 3.333V2.5A1.5 1.5 0 0 1 4.5 1h4a.5.5 0 0 1 0 1h-4zm9-1a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1H13V1.5a.5.5 0 0 1 .5-.5z"/>
							  <path fill-rule="evenodd" d="M13 3.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0v-2z"/>
						</svg>&nbsp;
						<a href="#" data-toggle="modal" data-target="#ModalEntrada">Entrada</a>
					</th>
					<th width="15%" class="text-center hidden-print">
						<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-display" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
						  <path d="M5.75 13.5c.167-.333.25-.833.25-1.5h4c0 .667.083 1.167.25 1.5H11a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1h.75z"/>
						  <path fill-rule="evenodd" d="M13.991 3H2c-.325 0-.502.078-.602.145a.758.758 0 0 0-.254.302A1.46 1.46 0 0 0 1 4.01V10c0 .325.078.502.145.602.07.105.17.188.302.254a1.464 1.464 0 0 0 .538.143L2.01 11H14c.325 0 .502-.078.602-.145a.758.758 0 0 0 .254-.302 1.464 1.464 0 0 0 .143-.538L15 9.99V4c0-.325-.078-.502-.145-.602a.757.757 0 0 0-.302-.254A1.46 1.46 0 0 0 13.99 3zM14 2H2C0 2 0 4 0 4v6c0 2 2 2 2 2h12c2 0 2-2 2-2V4c0-2-2-2-2-2z"/>
						</svg>
					</th>
				</tr>
			</thead>
			<tbody id="tbody">
				<?php 
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
							<a href="#" onclick="ver('<?php echo $cod ?>')" class="btn btn-primary btn-ver" data-toggle="modal" data-target="#Modal">
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
				?>
			</tbody>
		</table>
	</div>
<!-- 
	GRILLA de LLANTAS 
-->
	<div class="row">
		<table class="col-xl-12 col-sm-12 table" id="table2">
			<thead>
				<tr>
					<td colspan="6"><h3 id="tipo2">LLANTAS :</h3></td>
					<td colspan="1" class="hidden-print">
						<button class="btn btn-success btn-block text-center" style="font-size:10px;" onclick="tableToExcel('table2', 'Listado')">
						<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-file-earmark-spreadsheet" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
								<path fill-rule="evenodd" d="M5 9H3V8h10v1h-3v2h3v1h-3v2H9v-2H6v2H5v-2H3v-1h2V9zm1 0v2h3V9H6z"/>
								<path d="M4 1h5v1H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V6h1v7a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2z"/>
								<path d="M9 4.5V1l5 5h-3.5A1.5 1.5 0 0 1 9 4.5z"/>
							</svg>&nbsp;EXCEL
						</button>
					</td>
					<td colspan="1" class="hidden-print">
						<button class="btn btn-secondary btn-block text-center" style="font-size:10px;" onclick="printTable(2)">
							<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-printer" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
							    <path d="M11 2H5a1 1 0 0 0-1 1v2H3V3a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v2h-1V3a1 1 0 0 0-1-1zm3 4H2a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h1v1H2a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1z"/>
							    <path fill-rule="evenodd" d="M11 9H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1zM5 8a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H5z"/>
							    <path d="M3 7.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z"/>
							</svg>&nbsp;IMPRIMIR
						</button>
					</td>
				</tr>
				<tr>
					<th width="5%">#</th>
					<th width="8%" onclick="sortTable(1,'str',2)" class="sort">Codigo</th>
					<th width="20%" onclick="sortTable(2,'str',2)" class="sort">Marca</th>
					<th width="20%" onclick="sortTable(3,'str',2)" class="sort">Modelo</th>
					<th width="20%" onclick="sortTable(4,'str',2)" class="sort">Medida</th>
					<th width="5%" onclick="sortTable(5,'int',2)" class="sort">Stock</th>
					<th width="12%" class="hidden-print">
						<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-bookmark-plus" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
							  <path fill-rule="evenodd" d="M4.5 2a.5.5 0 0 0-.5.5v11.066l4-2.667 4 2.667V8.5a.5.5 0 0 1 1 0v6.934l-5-3.333-5 3.333V2.5A1.5 1.5 0 0 1 4.5 1h4a.5.5 0 0 1 0 1h-4zm9-1a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1H13V1.5a.5.5 0 0 1 .5-.5z"/>
							  <path fill-rule="evenodd" d="M13 3.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0v-2z"/>
						</svg>&nbsp;
						<a href="#" data-toggle="modalEntrada" data-target="#ModalEntrada">Entrada</a>
					</th>
					<th width="15%" class="text-center hidden-print">
						<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-display" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
						  <path d="M5.75 13.5c.167-.333.25-.833.25-1.5h4c0 .667.083 1.167.25 1.5H11a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1h.75z"/>
						  <path fill-rule="evenodd" d="M13.991 3H2c-.325 0-.502.078-.602.145a.758.758 0 0 0-.254.302A1.46 1.46 0 0 0 1 4.01V10c0 .325.078.502.145.602.07.105.17.188.302.254a1.464 1.464 0 0 0 .538.143L2.01 11H14c.325 0 .502-.078.602-.145a.758.758 0 0 0 .254-.302 1.464 1.464 0 0 0 .143-.538L15 9.99V4c0-.325-.078-.502-.145-.602a.757.757 0 0 0-.302-.254A1.46 1.46 0 0 0 13.99 3zM14 2H2C0 2 0 4 0 4v6c0 2 2 2 2 2h12c2 0 2-2 2-2V4c0-2-2-2-2-2z"/>
						</svg>
					</th>						
				</tr>
			</thead>
			<tbody id="tbody2">
				<?php
					$x = 1;
					while ($row = mysqli_fetch_assoc($llantas)){
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
			</tbody>
		</table>
	</div>
</main>
	<!---
		MODAL VER ARTICULO 
	-->
	<div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true" style="width: 95%">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content" style="width: 100%;">
	      <div class="modal-header">
	        	<h6 class="modal-title" id="ModalLabel">VISTA DE ARTICULO</h6>
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          		<span aria-hidden="true">&times;</span>
	        	</button>
	      </div>
	      <div class="modal-body">
	      		<div  id="this-modal"></div>
	      		<div class="mt-1">
			  		<form id="form-img" method="post" enctype="multipart/form-data">
			  		    <input type="file" name="img">
			  			<input type="hidden" name="codigo" value="<?php echo $_POST['codigo'] ?>"><br><br>
			  			<button class="btn btn-block btn-primary" onclick="actualizar_foto()">Actualizar Imagén</button>
			 		</form>
			    </div>
	      </div>
	      <div class="modal-footer">
	        	<button type="button" class="btn btn-block btn-danger" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>
	<!----
		FIN MODAL

		MODAL ENTRADA
	-->
	<div class="modal fade" id="ModalEntrada" tabindex="-1" role="dialog" aria-labelledby="ModalLabelEntrada" aria-hidden="true" style="width: 100%">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content" style="width: 100%;">
	      <div class="modal-header">
	        <h5 class="modal-title" id="ModalLabelEntrada">INGRESO de ARTICULO</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
				<?php require 'nuevo-ingreso-articulo.php' ?>
	      </div>
	      <div class="modal-footer">
				<button type="button" class="btn btn-primary" class="btn-ver btn btn-primary"  data-dismiss="modal" data-toggle="modal" data-target="#ModalNewEntrada">Nuevo Articulo</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<button type="button" class="btn btn-secondary">Guardar</button>&nbsp;&nbsp;
			    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	  <script>
	  	$('.modal-body').ready(function(){

	  	});
	  </script>
	</div>
	<!----
		FIN MODAL

		MODAL NUEVO ENTRADA
	-->
	<div class="modal fade" id="ModalNewEntrada" tabindex="-1" role="dialog" aria-labelledby="ModalLabelNewEntrada" aria-hidden="true" style="width: 90%">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content" style="width: 130%;">
	      <div class="modal-header">
	        <h5 class="modal-title" id="ModalLabelNewEntrada">NUEVO INGRESO de ARTICULO</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
				<?php require 'nuevo-articulo-entrada.php' ?>
	      </div>
	      <div class="modal-footer">
				<button type="button" class="btn btn-secondary">Guardar</button>&nbsp;&nbsp;
			    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>
	<!--
		FIN MODAL
	-->
<script>
///
/// FUNCTION 
//////////////////////

	function printTable(table) {
		console.log(table);
	    var divToPrint = document.getElementById('table'+table);
	    newWin = window.open("", 'PRINT', 'height=600,width=960,top=100,left=410,resizable=0');
	    if (table == 1) {
	    	newWin.document.write('<style>#table1{width:98%;margin:auto;font-size:13px}th{border:thin solid black}td{border:thin dotted lightgray}.hidden-print{display:none}</style>'+divToPrint.outerHTML);
	    }else{
	    	newWin.document.write('<style>#table2{width:98%;margin:auto;font-size:13px}th{border:thin solid black}td{border:thin dotted lightgray}.hidden-print{display:none}</style>'+divToPrint.outerHTML);
	    }
	    newWin.print();
	    newWin.close();
	 }

	 var tableToExcel = (function() {
		 var uri = 'data:application/vnd.ms-excel;base64,'
		    , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
		    , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
		    , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
		 return function(table, name) {
		    if (!table.nodeType) table = document.getElementById(table)
		    var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
		    window.location.href = uri + base64(format(template, ctx))
		 }
	})()

	function actualizar_foto(){
	 	var formData = new FormData($('#form-img')[0]);
	    $.ajax({
	        type: 'POST',
	        data: formData,
	        url: 'actualizar-foto.php',
	        contentType: false,
	        processData: false,
	        success: function(response) {
			    if (response) {
			     	alert('Imagen Guardada con Exito !')		               	
	            }
	        },
	    });
	}

	function sortTable(n,type,tabla) {
		var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
		 
		table = document.getElementById("table"+tabla);
		switching = true;
		  //Set the sorting direction to ascending:
		dir = "asc";
		 
		  /*Make a loop that will continue until no switching has been done:*/
	  	while (switching) {
		    switching = false;
		    rows = table.rows;
		    /*Loop through all table rows (except the first, which contains table headers):*/
		    for (i = 2; i < (rows.length - 1); i++) {
			      //start by saying there should be no switching:
		        shouldSwitch = false;
			      /*Get the two elements you want to compare, one from current row and one from the next:*/
		        x = rows[i].getElementsByTagName("TD")[n];
		        y = rows[i + 1].getElementsByTagName("TD")[n];
			      /*check if the two rows should switch place, based on the direction, asc or desc:*/
		        if (dir == "asc") {
			        if ((type=="str" && x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) || (type=="int" && parseFloat(x.innerHTML) > parseFloat(y.innerHTML))) {
						//start by saying: no switching is done:
			            //if so, mark as a switch and break the loop:
			          shouldSwitch= true;
			          break;
			        }
		        } else if (dir == "desc") {
			        if ((type=="str" && x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) || (type=="int" && parseFloat(x.innerHTML) < parseFloat(y.innerHTML))) {
			          //if so, mark as a switch and break the loop:
			          shouldSwitch = true;
			          break;
			        }
		        }
		    }
		    if (shouldSwitch) {
			      /*If a switch has been marked, make the switch and mark that a switch has been done:*/
		        rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
		        switching = true;
			      //Each time a switch is done, increase this count by 1:
		        switchcount ++;
		    } else {
			      /*If no switching has been done AND the direction is "asc", set the direction to "desc" and run the while loop again.*/
		        if (switchcount == 0 && dir == "asc") {
			        dir = "desc";
			        switching = true;
		        }
		    }
	  	}
	}

	function ver(cod){
		var dataString = "codigo="+cod;
		$.ajax({
			type: 'POST',
			data: dataString,
			url: 'articulo.php',
			cache: false,
			success: function(data){
				$('#this-modal').html(data);
			}
		})
	}


	function tipo_producto(valor){
		var marca = 0;
		var modelo = 0;
		var medida = 0;
		var dataString = "medida="+medida+"&modelo="+modelo+"&marca="+marca;
		if (valor  == 0) {
			window.location="stock.php";
		}
		if (valor  == 1) {
			dataString += "&producto="+valor;
			$.ajax({
				type: 'POST',
				data: dataString,
				url: 'php/listado.php',
				cache: false,
				success: function(data){
					$('#table1').show();
					$('#table2').hide();
					$('#tbody').html(data);
					$('#tipo1').html('NEUMATICOS');
				}
			})
		}
		if (valor  == 2) {
			dataString += "&producto="+valor;
			$.ajax({
				type: 'POST',
				data: dataString,
				url: 'php/listado.php',
				cache: false,
				success: function(data){
					$('#table1').hide();
					$('#table2').show();
					$('#tbody2').html(data);
					$('#tipo2').html('LLANTAS');
				}
			})
		}
		$.ajax({
			type: 'POST',
			data: dataString,
			url: 'php/buscar-marca.php',
			cache: false,
			success: function(data){
				$('#selectMarca').html(data);
			}
		})
		$.ajax({
			type: 'POST',
			data: dataString,
			url: 'php/buscar-modelo.php',
			cache: false,
			success: function(data){
				$('#selectModelo').html(data);
			}
		})
		$.ajax({
			type: 'POST',
			data: dataString,
			url: 'php/buscar-medida.php',
			cache: false,
			success: function(data){
				$('#selectMedida').html(data);
			}
		})
	}

	function buscar_modelo(marca){
		$('#tbody2').html('');
		var producto = $('#tipo-producto').val();
		var modelo = 0;////$('#selectModelo').val();
		var medida = 0;////$('#selectMedida').val();
		var dataString = "medida="+medida+"&modelo="+modelo+"&marca="+marca+"&producto="+producto;
		$.ajax({
			type: 'POST',
			data: dataString,
			url: 'php/buscar-modeloPorMarca.php',
			cache: false,
			success: function(data){
				$('#selectModelo').html(data);
			}
		})
		$.ajax({
			type: 'POST',
			data: dataString,
			url: 'php/buscar-medidaPorModelo.php',
			cache: false,
			success: function(data){
				$('#selectMedida').html(data);
			}
		})
		console.log(dataString);
		$.ajax({
			type: 'POST',
			data: dataString,
			url: 'php/listado.php',
			cache: false,
			success: function(data){
				console.log(data);
				if (producto == 1) {
					$('#tipo1').html('NEUMATICOS');
				}
				if(producto == 2){
					$('#tipo1').html('LLANTAS');
				}
				$('#table1').show();
				$('#table2').hide();
				$('#tbody').html(data);
				$('#selectMedida').val(0);
			}
		})
	}
	function buscar_medida(modelo){
		var producto = $('#tipo-producto').val();
		var marca = $('#selectMarca').val();
		var medida = 0;//$('#selectMedida').val();
		var dataString = "medida="+medida+"&modelo="+modelo+"&marca="+marca+"&producto="+producto;
		$.ajax({
			type: 'POST',
			data: dataString,
			url: 'php/buscar-medidaPorModelo.php',
			cache: false,
			success: function(data){
				$('#selectMedida').html(data);
			}
		})
		console.log(dataString);
		$.ajax({
			type: 'POST',
			data: dataString,
			url: 'php/listado.php',
			cache: false,
			success: function(data){
				console.log(dataString);
				if (producto == 1) {
					$('#tipo1').html('NEUMATICOS');
				}
				if(producto == 2){
					$('#tipo1').html('LLANTAS');
				}
				$('#table1').show();
				$('#table2').hide();
				$('#tbody').html(data);
			}
		})
	}
	function buscar_articulo(medida){
		var producto = $('#tipo-producto').val();
		var marca = $('#selectMarca').val();
		var modelo = $('#selectModelo').val();
		var dataString = "medida="+medida+"&modelo="+modelo+"&marca="+marca+"&producto="+producto;
		console.log(dataString);
		$.ajax({
			type: 'POST',
			data: dataString,
			url: 'php/listado.php',
			cache: false,
			success: function(data){
				console.log(data);
				if (producto == 1) {
					$('#tipo1').html('NEUMATICOS');
				}
				if(producto == 2){
					$('#tipo1').html('LLANTAS');
				}
				$('#table1').show();
				$('#table2').hide();
				$('#tbody').html(data);
			}
		})
	}

	function buscar(dato){
   		var dataString = "dato="+dato;
   		$.ajax({
   			type: 'POST',
   			data: dataString,
   			url: 'php/buscar.php',
   			cache: false,
   			success: function(data){
   				if (data) {
   					$('#table1').show();
	   				$('#tbody').html(data);
					$('#tipo1').html('NEUMATICOS');
   				}else{
   					$('#table1').hide();
   				}
   			}
   		})
   		$.ajax({
   			type: 'POST',
   			data: dataString,
   			url: 'php/buscar2.php',
   			cache: false,
   			success: function(data){
   				if (data) {
   					$('#table2').show();
	   				$('#tbody2').html(data);
	   				$('#tipo2').html('LLANTAS');
   				}else{
   					$('#table2').hide();
   				}
   			}
   		})
  	}
</script>
