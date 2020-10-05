<?php 
    require '../conexion.php';
    
    if ($_POST['pass1'] == $_POST['pass2']){

        $pass = md5($_POST['pass1']);
        
        $sql = "INSERT INTO usuarios VALUES (null,'".$_POST['username']."','".$pass."',".$_POST['role'].")";
        
        mysqli_query($link,$sql) or die(mysqli_error($link));
        
        $check = mysqli_affected_rows($link);
        
        if ($check > 0){
            echo true; 
        }else{
            echo false;
        }
    }
        
    mysqli_close($link);