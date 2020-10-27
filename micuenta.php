<?php 
	require "validator.php";
	require "header.php";
?>
<script>
    $(document).ready(function(){
        var user = sessionStorage.getItem('user');
        $('#users').val(user);
    });
</script>
<main class="container">
 	<div class="row">
		<div class="col-12 col-sm-3"></div>
		 	<div class="col-12 col-sm-6 mt-5">
				 <div class="card">
				 <div class="card-header text-center">
					 <h3>Mi Cuenta</h3>
				 </div>
				 <div class="card-body div-body-listado">
                     <form id="formulario">
                        <div class="row mb-2">
                            <div class="col-12 col-sm-6">
                                Usuario :
                            </div>
                            <div class="col-12 col-sm-6">
                                <input type="text" id="users" width="100%">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-12 col-sm-6">
                                Password :
                            </div>
                            <div class="col-12 col-sm-6">
                                <input type="password" id="pass-1" width="100%">
                                <span class="error" style="color: red"></span>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-12 col-sm-6">
                                Repetir Password :
                            </div>
                            <div class="col-12 col-sm-6">
                                <input type="password" id="pass-2" width="100%">
                                <span class="error" style="color: red"></span>
                                <div id="campo-pass2" style="color: red;font-size: 9px"></div>
                            </div>
                        </div>
                        <hr>
                        <div class="row text-right">
                            <div class="col-12 col-sm-6">
                                <a class="btn btn-danger btn-block mb-2" href="index.php">Cancelar</a>
                            </div>
                            <div class="col-12 col-sm-6">
                                <buttton class="btn btn-primary btn-block mb-2" onclick="actualizar()">Actualizar</button>
                            </div>
                        </div>
                    </form>
				 </div>
			</div>
 		</div>
     </div>
     <script>
        function actualizar(){
            var pass1 = $('#pass-1').val();
            var pass2 = $('#pass-2').val();
            $('.error').html('');
            $('#campo-pass2').html('');
            if (pass1.length > 0 && pass2.length > 0){
                if ( pass1 == pass2 ){
                    var dataString = "pass1="+pass1+"&pass2="+pass2;
                    $.ajax({
                        type: 'POST',
                        data : dataString,
                        url: 'php/actualizar-usuario.php',
                        cache: false,
                        success: function(data){
                            if( data ){
                                window.alert("La Actualización se Realizo con Exito !");
                                location.href="php/logout.php";
                            }else{
                                window.alert("Error en la Actualización");
                                $('#pass-1').val('');
                                $('#pass-2').val('');
                                $('.error').html('*');
                            }
                        }
                    });

                }else{
                    $('.error').html('*');
                    $('#campo-pass2').html('Completar Campo ó Password no son Iguales');
                }
            }else{
                $('#campo-pass2').html('Completar Campo ó Password no son Iguales');
            }
        }
     </script>
 </main>