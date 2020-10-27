<?php 
    require '../conexion.php';

    $sql = "DELETE FROM usuarios WHERE idusuarios=".$_POST['id'];

    mysqli_query($link,$sql) or die(mysqli_error($link));

    $check = mysqli_affected_rows($link);

    if ($check > 0){
        echo true; 
    }else{
        echo false;
    }

    mysqli_close($link);