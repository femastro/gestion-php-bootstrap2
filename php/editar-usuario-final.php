<?php 
    require '../conexion.php';
    
    if ($_POST['pass1'] == $_POST['pass2']){

        $pass = md5($_POST['pass1']);
        
        $sql = "UPDATE usuarios SET usuario='".$_POST['username']."', password='".$pass."', privilegios=".$_POST['role']." WHERE idusuarios=".$_POST['id'];
        
        mysqli_query($link,$sql) or die(mysqli_error($link));
        
        $check = mysqli_affected_rows($link);
        
        if ($check > 0){
            echo true; 
        }
    }
        
    mysqli_close($link);