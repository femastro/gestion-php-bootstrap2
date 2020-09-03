<?php

    if (!empty($_FILES['img']['name']))
    {
        $nombre = $_POST['codigo'].".jpg";
        $ruta_provisional = $_FILES['img']['tmp_name'];
        $ruta = "imgProducto/";
        if (!file_exists($ruta)){
            mkdir($ruta, 0777, true);
        }
        $carpeta = $ruta.$nombre;
        move_uploaded_file($ruta_provisional, $carpeta);

        echo $carpeta;
    }

?>
