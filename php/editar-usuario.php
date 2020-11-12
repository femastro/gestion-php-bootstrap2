<?php
require '../validator.php';
require '../conexion.php';

$sql = "SELECT idusuarios, usuario, privilegios FROM usuarios WHERE idusuarios=".$_POST['id'];

$resultado = mysqli_query($link, $sql) or die(mysqli_error($link));

$row = mysqli_fetch_assoc($resultado);

mysqli_close($link);

?>
<style>
    .error-pass{
        border: thin solid red;
    }
    .label{
        font-size: 9px;
    }
</style>
<div class="col-12 col-sm-12">
    <div class="card-header mt-1">
        <h5>Datos del Usuario</h5>
    </div>
    <div class="card-body">
        <div class="form-group mt-2">
            <label for="name">Nombre</label>
            <input type="text" class="form-control" name="username" value="<?php echo $row['usuario']?>" id="username">
            <div class="label">El usuario debe tener al menos 3 caracteres.</div>
        </div>
        <div class="form-group mt-2">
            <input type="checkbox" id="checkbox"> Tildar para cambiar password. <br>
            <label for="password" class="mt-2">Password</label>
            <input type="password" class="form-control" name="pass1" id="pass1" disabled="true">
            <div class="label">El password debe tener al menos 6 caracteres.</div>
        </div>
        <div class="form-group mt-2">
            <label for="password-2">Repetir Password</label>
            <input type="password" class="form-control" name="pass2" id="pass2" disabled="true">
        </div>
        <div class="mt-2 text-center">
            <span style="color: red" id="error"></span>
        </div>
        <div class="form-group mt-2 mb-4">
            <label for="name">Nivel Seguridad</label>
            <select class="form-control" name="role" id="role">
                <option value="1">Nivel 1 Basico</option>
                <option value="2">Nivel 2 Operador</option>
                <option value="3">Nivel 3 Admin</option>
            </select>
            <div class="label">1- Solo ve Stock. // 2- Puede realizar operaciones. // 3- Administrador Full</div>
        </div>
        <hr>
        <div class="mt-4">
            <button class="btn btn-primary btn-block" onclick="actualizar(<?php echo $row['idusuarios']?>)">ACTUALIZAR</button>
        </div>
        <div class="mt-3">
            <button type="button" class="btn btn-block btn-danger mt-2" data-dismiss="modal">CERRAR</button>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){

        $('#checkbox').click(function(){

            var checkbox = $('#checkbox').prop('checked');

            if (checkbox){
                $('#pass1').attr('disabled', false);
                $('#pass2').attr('disabled', false);
            }else{
                $('#pass1').attr('disabled', true);
                $('#pass2').attr('disabled', true);
                $('#pass1').val('');
                $('#pass2').val('');
                $('#pass1').removeClass('error-pass');
                $('#pass2').removeClass('error-pass');
                $('#error').html('');
            }
        })
    })
    function actualizar(id){
        var username = $('#username').val();
        var pass1 = $('#pass1').val();
        var pass2 = $('#pass2').val();
        var role = $('#role').val();
        var checkbox = $('#checkbox').prop('checked');

        $('#error').html('');
        $('#pass1').removeClass('error-pass');
        $('#pass2').removeClass('error-pass');

        var dataString = "id="+id+"&username="+username+"&pass1="+pass1+"&pass2="+pass2+"&role="+role;

        if( pass1.length > 5 && pass2.length > 5 ){
            if (pass1 === pass2){
                if (username.length > 3){

                    guardar(dataString);

                }else{
                    $('#error').html("Complete el campo de Usuario. ")
                    $('#username').addClass('error-pass');
                }
            }else{
                $('#error').html("Error los password no Coinceden ! ")
                $('#pass2').addClass('error-pass');
            }
        }else{
            if (pass1.length < 1 || pass2.length < 1){

                if (!checkbox){
                    if (username.length > 3){

                        guardar(dataString);

                    }else{

                        $('#error').html("Complete el campo de Usuario. ")
                        $('#username').addClass('error-pass');

                    }
                }else{
                    $('#error').html('Debe completar los campos de password.')
                    if (pass1.length < 1) {
                        $('#pass1').addClass('error-pass');
                    }
                    if (pass2.length < 1) {
                        $('#pass2').addClass('error-pass');
                    }
                }
            }else{
                if (pass1.length < 6) {
                    $('#pass1').addClass('error-pass');
                }
                if (pass2.length < 6) {
                    $('#pass2').addClass('error-pass');
                }
                $('#error').html('El password deben tener 6 ó más caracteres.');
            }
        }
    };

    function guardar(dataString){
        console.log(dataString);
        $.ajax({
            type: 'POST',
            data: dataString,
            url: "php/editar-usuario-final.php",
            cache: false,
            success: function(data){
                console.log(data);
                if (data){
                    window.alert('EL USUARIO HA ACTUALIZADO CON EXITO !');
                    location.href="admin.php";
                }else{
                    window.alert('HA OCURRIDO UN ERROR !.');
                }
            }
        })
    }
</script>