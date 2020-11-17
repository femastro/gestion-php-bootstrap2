<?php
session_start();

require "conexion.php";

$codigo = $_POST['codigo'];

if ($_SESSION['local'] == 0) {
	$local = " GARAY";
} else {
	$local = " HORNOS";
}

if (!empty($_POST['eliminar'])) {
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

if ($cadena == 'N') {
	$tabla    = "stockneumaticos";
	$articulo = "NEUMÁTICO";
}
if ($cadena == 'L') {
	$tabla    = "stockllantas";
	$articulo = "LLANTA";
}
if ($cadena == "A" || $cadena == "S" || $cadena == "C") {
	$tabla    = "accesorios";
	$articulo = "ACCESORIO";
};

    $sql = "SELECT ".$tabla.".cod_Articulo, 
                            ".$tabla.".marca, 
                            ".$tabla.".modelo, 
                            ".$tabla.".medida, 
                            ".$tabla.".cantidad AS cantTotal, 
                            ".$tabla.".cod_Proveedor, 
                            ubicacion.cantidad, 
                            ubicacion.ubicacion 
                            FROM ".$tabla." inner join ubicacion 
                            WHERE ".$tabla.".cod_Articulo ='".$codigo."' 
                                        AND ubicacion.codigo = '".$codigo."' 
                                        AND ubicacion.ubicacion =".$_SESSION['local'];$sql = "SELECT marca, modelo, medida, cantidad, cod_Proveedor FROM ".$tabla." WHERE cod_Articulo ='".$codigo."'";

$resultado = mysqli_query($link, $sql) or die(mysqli_error($link));

$row = mysqli_fetch_assoc($resultado);

function image($img) {
	$url     = 'imgProducto/'.$img.'.jpg';
	$url2    = 'imgProducto/'.$img.'.png';
	$sinFoto = 'imgProducto/sin-foto.png';
	if (file_exists($url)) {
		echo $url;
	} elseif (file_exists($url2)) {
		echo $url2;
	} else {
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
                <h3><?php echo $articulo?></h3>
            </div>
            <div class="card-body">
                <form action="php/actualizar-articulo.php" method="POST">
                    <input type="hidden" name="codigo" value="<?php echo $codigo?>" id="codigo">
                    <input type="hidden" name="stockLocal" value="<?php echo $row['cantidad']?>">
                    <div class="form-group">
                        <label for="marca" style="font-size: 12px;">MARCA</label>
                        <input type="text" name="marca" class="form-control" value="<?php echo $row['marca']?>">
                    </div>
                    <div class="form-group">
                        <label for="modelo">MODELO</label>
                        <input type="text" name="modelo" class="form-control" value="<?php echo $row['modelo']?>">
                    </div>
                    <div class="form-group">
                        <label for="medida">MEDIDA</label>
                        <input type="text" name="medida" class="form-control" value="<?php echo $row['medida']?>">
                    </div>
                    <div class="form-group" id="input-stock">
                        <label for="stock">STOCK LOCAL : <strong><?php echo $local?></strong></label>
                        <input type="text" name="nuevoStockLocal" class="form-control" value="<?php echo $row['cantidad']?>">
                    </div>
                    <div class="form-group" id="input-stock">
                        <label for="stock">STOCK TOTAL</label>
                        <input type="text" name="stock" class="form-control" readonly value="<?php echo $row['cantTotal']?>">
                    </div>
                    <div class="form-group" id="input-proveedor">
                        <label for="proveedor">PROVEEDOR</label>
                        <input type="text" name="proveedor" class="form-control" value="<?php echo $row['cod_Proveedor']?>">
                    </div>
                    <div class="mt-2" id="btn-actualizar">
                        <button type="submit" class="btn btn-primary btn-block">ACTUALIZAR DATOS</button>
                    </div>
                    <div class="form-group mt-3">
                        <img style="height: 210px; width: 50%; display: block;margin: auto" src="<?php image($codigo)?>" alt="Card image">
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>


