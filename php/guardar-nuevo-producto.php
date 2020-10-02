<?php
	session_start();

    require "../conexion.php";

    $tipo = $_POST['tipo'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $medida = $_POST['medida'];

    if($tipo == 0){
        $tabla = "neumaticos";
        $letra = "N";
    }else{
        $tabla = "llantas";
        $letra = "L";
    }
    
    $sql = "SELECT MAX(cod_Articulo) as codigo FROM ".$tabla; // consulta el ultimo registro para poder aumentar 1 al cod_Articulo
    
    $resultado = mysqli_query($link,$sql) or die(mysqli_error($link));

    $row = mysqli_fetch_assoc($resultado);
    
    $cadena = intval(substr($row['codigo'], 1));

    $cadena = $cadena + 1;

    $codigo = $letra.$cadena;

    $sql = "INSERT INTO ".$tabla." VALUES (null,'".$codigo."','".$marca."','".$modelo."','".$medida."',null)";

    mysqli_query($link,$sql) or die(mysqli_error($link));

    $cont = mysqli_affected_rows($link);

    if ($cont == 1){
        echo 1;
    }else{
        echo 2;
    }


    mysqli_close($link);

?>

