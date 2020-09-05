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
                <form action="">
                    <table class="table">
                        <thead>
                            <tr>
                                <th colspan="2"><h6>Completar Datos</h6></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>PRODUCTO </td>
                                <td>
                                    <select name="" id="tipo-ProductoModal" class="form-control">
                                        <option value="0">Seleccionar...</option>
                                        <option value="1">NEUMATICOS</option>
                                        <option value="2">LLANTAS</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>MARCA </td>
                                <td>
                                    <select name="" id="selectMarcaModal" class="form-control">
                                        <option value="0">Seleccionar...</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>MODELO </td>
                                <td>
                                    <select name="" id="selectModeloModal" class="form-control">
                                        <option value="0">Seleccionar...</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>MEDIDA</td>
                                <td>
                                    <select name="" id="selectMedidaModal" class="form-control">
                                        <option value="0">Seleccionar...</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>CANTIDAD</td>
                                <td>
                                    <select name="" id="cantidadModal" class="form-control">
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
                                    <input type="text" id="proovedorModal"class="form-control" placeholder="Dejar vacio si no hay proovedor">
                                </td>
                            </tr>
                            <tr>
                                <td>LOCAL</td>
                                <td>
                                    <select name="" id="ubicacionModal" class="form-control">
                                        <option value="0">GARAY</option>
                                        <option value="1">HORNOS</option>
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </body>
</html>