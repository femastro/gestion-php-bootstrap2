<?php 
    require "../conexion.php";
    
    $codigo = $_POST['codigo'];

    $cadena = substr($codigo,0,1);

    if ($cadena == "N") {
        $tabla = "stockneumaticos";
        $producto = 1;
    };
    if ($cadena == "L"){
        $tabla = "stockllantas";
        $producto = 2;
    };


	$sql = "SELECT marca, modelo, medida, cantidad FROM ".$tabla." WHERE cod_Articulo='".$codigo."'";

	$res = mysqli_query($link,$sql);

    $cont = mysqli_num_rows($res);
    
    $row = mysqli_fetch_assoc($res);

	if ($cont > 0) {
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Gestion Cueto</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/boostrap.css">
        <link rel="stylesheet" href="css/custom.min.css">
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <style>
            .leyenda{
                font-size: 9px;
                font-weight: bold;
            }
        </style>
    </head>
    <body class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3>Articulo</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="codigo">CODIGO</label>
                    <input type="text" class="form-control" value="<?php echo $codigo ?>" id="codigo-in">
                </div>
                <div class="form-group">
                    <label for="marca">MARCA</label>
                    <input type="text" class="form-control" value="<?php echo $row['marca'] ?>" id="marca-in">
                    <input type="hidden" value="<?php echo $row['modelo'] ?>" id="modelo-in">
                </div>
                <div class="form-group">
                    <label for="medida">MEDIDA</label>
                    <input type="text" class="form-control" value="<?php echo $row['medida'] ?>" id="medida-in">
                </div>
                <div class="form-group">
                    <label for="medida">MEDIDA</label>
                    <select name="cantidad" class="form-control" id="cantidad-in">
                    <?php
                        $cant = $row['cantidad'];
                        $x= 1;
                        while ($x <= $cant){
                    ?>
                            <option value="<?php echo $x ?>"><?php echo $x ?> Un.</option>
                    <?php
                            $x++;
                        }
                    ?>
                    </select>
                </div>
                <div class="form-group leyenda">
                    <p class="text-danger">- SE VA A AGREGAR A LA LISTA DE SALIDA EL SIGUIENTE ARTICULO "ACEPTAR o CANCELAR".</p>
                    <p class="text-warning">- SELECCIONE LA CANTIDAD ANTES DE ACEPTAR.</p>
                </div>
                <div class="mt-3 text-right">
                    <a href="salida-multiple.php" class="btn btn-danger">CANCELAR</a>
                    &nbsp;&nbsp;
                    <a href="#" class="btn btn-primary" onclick="onAgregar('<?php echo $producto ?>')" data-dismiss="modal">ACEPTAR</a>
                </div>
            </div>
        </div>
    </body>
</html>
<?php
    }
    
	mysqli_close($link);

 ?>