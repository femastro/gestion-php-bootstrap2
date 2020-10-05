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
            <input type="text" class="form-control" name="username" placeholder="Ej. Juan" id="username">
            <div class="label">El usuario debe tener al menos 3 caracteres.</div>
        </div>
        <div class="form-group mt-2">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="pass1" id="pass1">
            <div class="label">El password debe tener al menos 6 caracteres.</div>
        </div>
        <div class="form-group mt-2">
            <label for="password-2">Repetir Password</label>
            <input type="password" class="form-control" name="pass2" id="pass2">
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
            <button class="btn btn-primary btn-block" onclick="guardar()">GUARDAR</button>
        </div>
        <div class="mt-3">
            <button type="button" class="btn btn-block btn-danger mt-2" data-dismiss="modal">CERRAR</button>
        </div>
    </div>
</div>
<script>
    function guardar(){
        var username = $('#username').val();
        var pass1 = $('#pass1').val();
        var pass2 = $('#pass2').val();
        var role = $('#role').val();
        $('#error').html('');
        $('#pass1').removeClass('error-pass');
        $('#pass2').removeClass('error-pass');

        if( pass1.length > 5 && pass2.length > 5){
            if (pass1 === pass2){
                if (username.length > 3){
                    var dataString = "username="+username+"&pass1="+pass1+"&pass2="+pass2+"&role="+role;
                    $.ajax({
                        type: 'POST',
                        data: dataString,
                        url: "php/nuevo-usuario-final.php",
                        cache: false,
                        success: function(data){
                            if (data){
                                window.alert('EL USUARIO HA SIDO CREADO CON EXITO !');
                                location.href="admin.php";
                            }else{
                                window.alert('HA OCURRIDO UN ERROR !.');
                            }
                        }
                    })
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
                $('#error').html('Debe completar los campos de password.')
                if (pass1.length < 1) {
                    $('#pass1').addClass('error-pass');
                }
                if (pass2.length < 1) {
                    $('#pass2').addClass('error-pass');
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



    }
</script>