<?php
    session_start();
    
    require "../conexion.php";
    
    $pass1 = $_POST['pass1'];
    $pass2 = $_POST['pass2'];
    $id = $_SESSION['iduser'];

    if ( $pass1 === $pass2 ){

        $password = md5($pass1);

        $sql = "UPDATE usuarios SET password ='".$password."' WHERE idusuarios =".$id;

        mysqli_query($link,$sql) or die(mysqli_error($link));

        $cont = $mysqli_affected_rows($link);

        if ( $cont > 0 ){
            echo true;
        }

    }

    echo false;

    mysqli_close($link);

?>

