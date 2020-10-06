<?php 
	require "validator.php";
	require "header.php";

	if (!empty($_GET['codigo'])){

?>
		<script>
			$(document).ready(function(){
				var codigo = $('#inCodigo').val();
				info_articulo(codigo);
			})
			</script>
<?php
	}

	?>
		<script type="text/javascript" src="js/checkRole.js"></script>
		<main class="container-fluid">
			<div class="row">
				<h5 class="mt-2">Salidas</h5>
				<div class="mt-2 col-xl-12 col-sm-12 fieldset">
				  	<p class="legend">Filtros</p>
					  <div class="row">
						  <input type="hidden" id="inCodigo" value="<?php echo $_GET['codigo'] ?>">
						  <div class="col-xl-2 col-sm-2 form-group">
							  <label for="">Productos :</label>
							<select class="form-control"  onchange="tipo_producto(this.value)" id="tipo-producto">
								<option value="0">Seleccionar ...</option>
								<option value="1">Neumaticos</option>
								<option value="2">Llantas</option>
							</select>
						</div>
						<div class="col-xl-2 col-sm-2 form-group">
							<label for="">Marcas :</label>
							<select class="form-control"  id="selectMarca" onchange="buscar_modelo(this.value)"></select>
						</div>
						<div class="col-xl-2 col-sm-2 form-group">
							<label for="">Modelos :</label>
							<select class="form-control" id="selectModelo" onchange="buscar_medida(this.value)"></select>
						</div>
						<div class="col-xl-2 col-sm-2 form-group">
							<label for="">Medidas :</label>
							<select class="form-control" id="selectMedida" onchange="buscar_cantidad(this.value)"></select>
						</div>
						<div class="col-xl-2 col-sm-2 form-group">
							<label for="">Cantidad</label>
							<select class="form-control" id="selectCantidad"></select>
						</div>
						<div class="col-xl-2 col-sm-2 form-group">
							<button class="btn btn-primary btn-block" style="margin-top: 27px;font-size:12px;" onclick="onAgregar()">
								<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-bookmark-plus" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    				<path fill-rule="evenodd" d="M4.5 2a.5.5 0 0 0-.5.5v11.066l4-2.667 4 2.667V8.5a.5.5 0 0 1 1 0v6.934l-5-3.333-5 3.333V2.5A1.5 1.5 0 0 1 4.5 1h4a.5.5 0 0 1 0 1h-4zm9-1a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1H13V1.5a.5.5 0 0 1 .5-.5z"/>
									<path fill-rule="evenodd" d="M13 3.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0v-2z"/>
								</svg>&nbsp;
								Agregar
							</button>
						</div>
					</div>
					<!-- Linea Botones -->
					<div class="row">		
						<div class="col-xl-6 col-sm-3 form-inline" style="margin-top: 12px">
							&nbsp;
				    	</div>
				    	<div class="col-xl-2 col-sm-3 form-inline" style="margin-top: 12px">
				    		<button class="btn btn-secondary btn-block my-1 text-center" style="font-size:10px;" onclick="printDiv()">
				    			<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-printer" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
									<path d="M11 2H5a1 1 0 0 0-1 1v2H3V3a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v2h-1V3a1 1 0 0 0-1-1zm3 4H2a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h1v1H2a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1z"/>
									<path fill-rule="evenodd" d="M11 9H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1zM5 8a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H5z"/>
									<path d="M3 7.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z"/>
								</svg>&nbsp;
							    IMPRIMIR
							</button>
						</div>
				    	<div class="col-xl-2 col-sm-3 form-inline" style="margin-top: 12px">
				    		<button class="btn btn-danger btn-block my-1 text-center" style="font-size:10px;" onclick="location.href='salida-multiple.php'">
				    			<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-counterclockwise" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
								  <path fill-rule="evenodd" d="M12.83 6.706a5 5 0 0 0-7.103-3.16.5.5 0 1 1-.454-.892A6 6 0 1 1 2.545 5.5a.5.5 0 1 1 .91.417 5 5 0 1 0 9.375.789z"/>
								  <path fill-rule="evenodd" d="M7.854.146a.5.5 0 0 0-.708 0l-2.5 2.5a.5.5 0 0 0 0 .708l2.5 2.5a.5.5 0 1 0 .708-.708L5.707 3 7.854.854a.5.5 0 0 0 0-.708z"/>
								</svg>&nbsp;
				    			RESETEAR
				    		</button>
				    	</div>
				    	<div class="col-xl-2 col-sm-3 form-inline" style="margin-top: 12px">
				    		<button class="btn btn-success btn-block my-1 text-center" style="font-size:10px;" onclick="procesar()" disabled="disabled" id="procesar">
					    		<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-archive" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
								  <path fill-rule="evenodd" d="M2 5v7.5c0 .864.642 1.5 1.357 1.5h9.286c.715 0 1.357-.636 1.357-1.5V5h1v7.5c0 1.345-1.021 2.5-2.357 2.5H3.357C2.021 15 1 13.845 1 12.5V5h1z"/>
								  <path fill-rule="evenodd" d="M5.5 7.5A.5.5 0 0 1 6 7h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5zM15 2H1v2h14V2zM1 1a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H1z"/>
								</svg>&nbsp;
					    		PROCESAR
				    		</button>
				    	</div>
					</div>
				</div>
			</div>
			<div class="row mt-2">
				<div class="col-xs-12 col-sm-12 text-center hidden" style="margin: 2px;font-size:12px;" id="spinner">
					<div class="spinner-border text-primary" role="status">
						<span class="sr-only">Loading...</span>
					</div> Loading....
				</div>
				<table class="col-xl-12 col-sm-12 table" id="table">
					<thead>
						<tr>
							<th colspan="6">
								<h6>REGISTRO de SALIDA: <span class="span-fecha">( Fecha : <?php echo date('d / m / Y  H:i') ?> )</span></h6>
							</th>
						</tr>
						<tr>
							<th width="5%" onclick="sortTable(0,'str')" class="sort">Codigo</th>
							<th width="28%" onclick="sortTable(1,'str')" class="sort">Marca</th>
							<th width="28%" onclick="sortTable(2,'str')" class="sort">Modelo</th>
							<th width="28%" onclick="sortTable(3,'str')" class="sort">Medida</th>
							<th width="8%" onclick="sortTable(4,'int')" class="sort">Cantidad</th>
							<th width="3%" class="hidden-print text-center">
								<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-display" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
								  <path d="M5.75 13.5c.167-.333.25-.833.25-1.5h4c0 .667.083 1.167.25 1.5H11a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1h.75z"/>
								  <path fill-rule="evenodd" d="M13.991 3H2c-.325 0-.502.078-.602.145a.758.758 0 0 0-.254.302A1.46 1.46 0 0 0 1 4.01V10c0 .325.078.502.145.602.07.105.17.188.302.254a1.464 1.464 0 0 0 .538.143L2.01 11H14c.325 0 .502-.078.602-.145a.758.758 0 0 0 .254-.302 1.464 1.464 0 0 0 .143-.538L15 9.99V4c0-.325-.078-.502-.145-.602a.757.757 0 0 0-.302-.254A1.46 1.46 0 0 0 13.99 3zM14 2H2C0 2 0 4 0 4v6c0 2 2 2 2 2h12c2 0 2-2 2-2V4c0-2-2-2-2-2z"/>
								</svg>
							</th>
						</tr>
					</thead>
					<tbody id="tbody"></tbody>
				</table>
			</div>
		</main>
	<!---
			MODAL 
	-->
		<div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="ModalLabel">ATENCIÓN</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div id="this-modal" class="modal-body"></div>
					<div class="col-xs-12 col-sm-12 text-center mt-3 mb-5 hidden" style="font-size:12px;" id="spinner2">
						<div class="spinner-border text-primary" role="status">
							<span class="sr-only">Loading...</span>
						</div> Loading....
					</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">CERRAR</button>
				</div>
			</div>
		</div>
	<!----
			FIN MODAL
	-->
	</body>
	<script>

		function procesar() {
			
			setTimeout( () => { $('.hidden-print').addClass('hidden')}, 500);

			var table = $("table"),
			rows = [],
			header = [];

			table.find("thead th").each(function () {
			    header.push($(this).html());
			});


			table.find("tbody tr").each(function () {

			    var row = {};
			    var key, value;

			    $(this).find("td").each(function (i) {
				    
				    key = header[i+1];
				    value = $(this).html();
					row[key] = value;

			    });
			    rows.push(row);
			});

			console.log(rows);

			var mensaje = "Desea imprimir el listado ?";
			var procesar = "ACEPTAR para procesar la salida de productos !.";

			if (confirm(procesar)) {

				if (confirm(mensaje)) {
					printDiv();
				}
				$.ajax({
					type: 'POST',
					data: {'json':rows},
					url: 'php/salida.php',
					cache: false,
					success: function(data){
						var msj = 'EL PROCESO SE REALIZO CON EXITO !';
						$('#this-modal').html(msj);
						$('#Modal').modal();
						$('#tbody').html('');
						$('#procesar').prop('disabled','disabled');
					}
				});
				//location.href="salida-multiple.php";

			}else{

				var msj = 'No se confirmo el proceso';
				$('#this-modal').html(msj);
				$('#Modal').modal();
				$('.hidden-print').removeClass('hidden');

			}

		}

		function sortTable(n,type) {
			var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
				 
			table = document.getElementById("table");
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
		function printDiv() {
	        var divToPrint = document.getElementById('table');
	        newWin = window.open("", 'PRINT', 'height=600,width=960,top=100,left=410,resizable=0');
	        newWin.document.write('<style>.table{width:95%;margin:auto;font-size:13px}.table input{font-size: 6px}th .span{font-size:.2rem}th{border: thin solid black}td{border: thin dotted lightgray}.hidden-print{display:none}</style>'+divToPrint.outerHTML);
	        newWin.print();
	        newWin.close();
	   	}		

		function tipo_producto(valor){
			$('#selectMarca').html('');
			$('#selectModelo').html('');
			$('#selectMedida').html('');
			var marca = 0;
			var modelo = 0;
			var medida = 0;
			var dataString = "producto="+valor;
			if (valor  == 0) {
				$('#selectMarca').html('');
		   		$('#selectModelo').html('');
				$('#selectMedida').html('');
				$('#selectCantidad').html('');
			}else{
				$.ajax({
					type: 'POST',
					data: dataString,
					url: 'php/buscar-marca.php',
					cache: false,
					success: function(data){
						$('#selectMarca').html(data);
					}
				})
			}
		}
		function buscar_modelo(marca){
			$('#selectModelo').html('');
			$('#selectMedida').html('');
			$('#selectCantidad').html('');
			var producto = $('#tipo-producto').val();
			var dataString = "marca="+marca+"&producto="+producto;
			if (marca != 0) {
				$.ajax({
					type: 'POST',
					data: dataString,
					url: 'php/buscar-modeloPorMarca.php',
					cache: false,
					success: function(data){
						$('#selectModelo').html(data);
					}
				})
			}
		}

		function buscar_medida(modelo){
			$('#selectMedida').html('');
			$('#selectCantidad').html('');
			var producto = $('#tipo-producto').val();
			var marca = $('#selectMarca').val();
			var dataString = "modelo="+modelo+"&marca="+marca+"&producto="+producto;
			if (modelo != 0) {
				$.ajax({
					type: 'POST',
					data: dataString,
					url: 'php/buscar-medidaPorModelo.php',
					cache: false,
					success: function(data){
						$('#selectMedida').html(data);
					}
				})
			}
		}

		function buscar_cantidad(medida){
			var x, y, codigo;
			var cant = 0;
			var table = document.getElementById('table');
			var rows = table.rows;
			var producto = $('#tipo-producto').val();
			var marca = $('#selectMarca').val();
			var modelo = $('#selectModelo').val();
			var dataString = "medida="+medida+"&modelo="+modelo+"&marca="+marca+"&producto="+producto;
			if (modelo != 0) {
				$.ajax({
					type: 'POST',
					data: dataString,
					url: 'php/buscar-codigo.php',
					cache: false,
					success: function(data){
						for (i = 2; i < (rows.length); i++) {
							x= rows[i].getElementsByTagName('TD')[4];
							y= rows[i].getElementsByTagName('TD')[0];
							if (y.innerHTML == data) {
								cant = x.innerHTML;
							}
						}
						dataString +="&cant="+cant;
						$.ajax({
							type: 'POST',
							data: dataString,
							url: 'php/buscar-cantidad.php',
							cache: false,
							success: function(data){
								$('#selectCantidad').html(data);
							}
						})
					}
				})
			}
		}

		function onAgregar(dato=null){
			
			if (dato != null){

				var producto = dato;
				var marca = $('#marca-in').val();
				var modelo = $('#modelo-in').val();
				var medida = $('#medida-in').val();
				var cantidad = $('#cantidad-in').val();

			}else{

				var producto = $('#tipo-producto').val();
				var marca = $('#selectMarca').val();
				var modelo = $('#selectModelo').val();
				var medida = $('#selectMedida').val();
				var cantidad = $('#selectCantidad').val();

			}

			var table = document.getElementById('table');
			var rows, x, y;
			var codigo = [];
			var cant = [];
			var contador;

			rows = table.rows;

			for (i = 2; i < (rows.length); i++) {

				y= rows[i].getElementsByTagName('TD')[0];
				x= rows[i].getElementsByTagName('TD')[4];

				cant.unshift(x.innerHTML);
				codigo.unshift(y.innerHTML);

			}

			var dataString = "producto="+producto+"&marca="+marca+"&modelo="+modelo+"&medida="+medida+"&cantidad="+cantidad+"&cant="+cant+"&codigo="+codigo;

			if (medida != null && cantidad > 0) {
				$.ajax({
					type: 'POST',
					data: dataString,
					url: 'php/buscar-producto.php',
					cache: false,
					success: function(data){
						if (data) {

							$('#spinner').removeClass('hidden');
			
							setTimeout(() => { chekCodigo(dataString) }, 1000 );

							setTimeout(() => { imprimir(data) }, 1500 );
							
						}else{

							$('#this-modal').html('ATENCIÓN, HA OCURRIDO UN PROBLEMA !');
							$('#Modal').modal();
							
						}
					}
				})
			}else{
				$('#this-modal').html('DEBE SELECCIONAR UNA CANTIDAD ó COMPLETAR LA BUSQUEDA !');
				$('#Modal').modal();
			}

		}

		async function chekCodigo(dataString){
			var table = document.getElementById('table');
			var rows, x, y;
			var codigo = [];
			var cant = 0;
			rows = table.rows;
			$.ajax({
				type: 'POST',
				data: dataString,
				url: 'php/buscar-codigo.php',
				cache: false,
				success: function(datos){
					for (i = 2; i < (rows.length); i++) {
						x= rows[i].getElementsByTagName('TD')[4];
						y= rows[i].getElementsByTagName('TD')[0];
						if ( y.innerHTML  ==  datos ) {
							cod = y.innerHTML;
							$('#'+cod).remove();
						}
					}
				}
			})
		}

		async function imprimir(data){
			var tbody = document.getElementById('tbody').innerHTML;
			$('#tbody ').html(tbody);
			$('#tbody ').append(data);
			$('#tipo-producto').val(0);
			$('#selectMarca').html('');
			$('#selectModelo').html('');
			$('#selectMedida').html('');
			$('#selectCantidad').html('');
			$('#spinner').addClass('hidden');
			$('#procesar').prop('disabled','');
		}

		function info_articulo(codigo){
			$('#this-modal').html('');
			$('.modal-footer').hide();
			var dataString = "codigo="+codigo;
			$.ajax({
				type: 'POST',
				data: dataString,
				url: "php/buscar-articulo-codigo.php",
				cache: false,
				success: function (data){
					$('#spinner2').removeClass('hidden');
					setTimeout(() => { $('#this-modal').html(data) }, 1000);
					setTimeout(() => { $('#spinner2').addClass('hidden') }, 1000);
					$('#Modal').modal();
				}
			})

		}


	</script>
</html>