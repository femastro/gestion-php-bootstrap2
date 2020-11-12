<?php
require "../validator.php";
require "../conexion.php";

$sql = "SELECT idusuarios, usuario FROM usuarios WHERE idusuarios=".$_POST['id'];

$resultado = mysqli_query($link, $sql) or die(mysqli_error($link));

$row = mysqli_fetch_assoc($resultado);

mysqli_close($link);

?>
<div class="col-12 col-sm-12">
    <div class="card-header mt-1">
        <h5>Datos del Usuario</h5>
    </div>
    <div class="card-body">
        <div class="form-group mt-2">
            <label for="name">Este usuario se va a Eliminar</label>
            <input type="text" class="form-control" name="username" id="username" placeholder="Ej. Juan" readonly value="<?php echo $row['usuario']?>">
        </div>
        <hr>
        <div class="mt-4">
            <button class="btn btn-primary btn-block" onclick="eliminar(<?php echo $row['idusuarios']?>)">ELIMINAR</button>
        </div>
        <div class="mt-3">
            <button type="button" class="btn btn-block btn-danger mt-2" data-dismiss="modal">CERRAR</button>
        </div>
    </div>
</div>
<script>
    function eliminar(id){
        var username= $('#username').val();
        var msj = "Ingrese el Nombre Usuario : <' "+username+" '>. Para Confirmar Eliminación.";
        if (prompt(msj) == username){
            var dataString = "id="+id;
            $.ajax({
                type: 'POST',
                data: dataString,
                url: "php/eliminar-usuario-final.php",
                cache: false,
                success: function(data){
                    if (data){
                        window.alert('EL USUARIO HA SIDO ELIMINADO CON EXITO !');
                        location.href="admin.php";
                    }else{
                        window.alert('HA OCURRIDO UN ERROR !.');
                    }
                }
            })
        }else{
            window.alert('Error, Vuelva a intentar.');
        }
    }
</script>