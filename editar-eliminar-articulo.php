<?php
    require "conexion.php";

    $codigo = $_POST['codigo'];

    if (!empty($_POST['eliminar'])){
?>
        <script>
            $(document).ready(function(){
                $('input').attr('Readonly', 'Readonly');
                $('#btn-actualizar').remove();
                $('#input-stock').remove();
                $('#input-proveedor').remove();
            })
        </script>
<?php
    }

    $cadena = substr($codigo, 0, 1);

    if ($cadena == 'N'){
        $tabla = "stockneumaticos";
    }
    if ($cadena == 'L'){
        $tabla = "stockllantas";
    }

    $sql = "SELECT marca, modelo, medida, cantidad, cod_Proveedor FROM ".$tabla." WHERE cod_Articulo ='".$codigo."'";

    $resultado = mysqli_query($link,$sql) or die(mysqli_error($link));

    $row = mysqli_fetch_assoc($resultado);

    function image($img){
		$url = 'imgProducto/'.$img.'.jpg';
		$url2 = 'imgProducto/'.$img.'.png';
		$sinFoto = 'imgProducto/sin-foto.png';
		if (file_exists($url)) {
			echo $url;
		}elseif (file_exists($url2)){
			echo $url2;
		}else{
			echo $sinFoto;
		}
	}

    mysqli_close($link);
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
    </head>
    <body class="container-fluid">
        <script type="text/javascript" src="js/checkRole.js"></script>
        <div class="card" style="margin: 0 auto">
            <div class="card-header">
                <h4><?php echo $row['marca'] ?></h4>
            </div>
            <div class="card-body">
                <form action="php/actualizar-articulo.php" method="POST">
                    <div class="form-group">
                        <label for="marca" style="font-size: 12px;">MARCA</label>
                        <input type="text" class="form-control" value="<?php echo $row['marca'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="modelo">MODELO</label>
                        <input type="text" class="form-control" value="<?php echo $row['modelo'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="medida">MEDIDA</label>
                        <input type="text" class="form-control" value="<?php echo $row['medida'] ?>">
                    </div>
                    <div class="form-group" id="input-stock">
                        <label for="stock">STOCK</label>
                        <input type="text" class="form-control" value="<?php echo $row['cantidad'] ?>">
                    </div>
                    <div class="form-group" id="input-proveedor">
                        <label for="proveedor">PROVEEDOR</label>
                        <input type="text" class="form-control" value="<?php echo $row['cod_Proveedor'] ?>">
                    </div>
                    <div class="mt-2" id="btn-actualizar">
                        <input type="hidden" value="<?php echo $codigo ?>" id="codigo">
                        <button type="submit" class="btn btn-primary btn-block" onclick="editar_articulo()">Actualizar Datos</button>
                    </div>
                    <div class="form-group mt-3">
                        <img style="height: 210px; width: 50%; display: block;margin: auto" src="<?php image($codigo) ?>" alt="Card image">
                    </div>
                </form>
            </div>
        </div>
        <script>
            function editar_articulo(){
                var codigo = $('#codigo').val();



            }

            function eliminar_articulo(){
                var codigo = $('#codigo').val();
            }





        </script>



    </body>
</html>


