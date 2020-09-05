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
        <div class="row">
            <div class="col-xl-12 col-sm-12">
                <form>
                    <table class="table">
                        <thead>
                            <tr>
                                <th colspan="2">Datos</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>MARCA </td>
                                <td>
                                    <input type="text" class="form-control" placeholder="Marca">
                                </td>
                            </tr>
                            <tr>
                                <td>MODELO </td>
                                <td>
                                    <input type="text" class="form-control" placeholder="Modelo">
                                </td>
                            </tr>
                            <tr>
                                <td>MEDIDA</td>
                                <td>
                                    <input type="text" class="form-control" placeholder="Medida">
                                </td>>
                            </tr>
                            <tr>
                                <td>CANTIDAD</td>
                                <td>
                                    <select name="" id="" class="form-control">
                                        <option value="0">0</option>
                                        <?php 
                                            $i = 1;
                                            while ( $i < 21) {
                                        ?>
                                                <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                        <?php
                                                $i++;
                                            }
                                         ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>COD. PROOVEDOR</td>
                                <td>
                                    <input type="text" class="form-control" placeholder="Dejar vacio si no hay proovedor">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </body>
</html>