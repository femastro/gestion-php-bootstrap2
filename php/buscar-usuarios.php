<?php

    $sql = "SELECT idusuarios, usuario, privilegios FROM usuarios ORDER BY usuario";

    $resultado = mysqli_query($link,$sql) or die(mysqli_error($link));

    mysqli_close($link);

?>