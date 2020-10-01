<?php
    require "validator.php";
    require "header.php";
?>
    <body class="container-fluid">
        <div class="row mt-5">
            <div class="col-12 col-sm-3"></div>
            <div class="col-12 col-sm-6">
                <div class="card">
                    <div class="card-header">
                        <h3>Nuevo Artiuclo</h3>
                    </div>
                </div>
                <form>
                    <table class="table">
                        <thead>
                            <tr>
                                <th colspan="2">Datos</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>PRODUCTO </td>
                                <td>
                                    <select name="" id="tipo-Producto" class="form-control">
                                        <option value="0">Seleccionar...</option>
                                        <option value="1">NEUMATICOS</option>
                                        <option value="2">LLANTAS</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>MARCA </td>
                                <td>
                                    <input type="text" class="form-control" placeholder="Marca" id="marca">
                                </td>
                            </tr>
                            <tr>
                                <td>MODELO </td>
                                <td>
                                    <input type="text" class="form-control" placeholder="Modelo" id="modelo">
                                </td>
                            </tr>
                            <tr>
                                <td>MEDIDA</td>
                                <td>
                                    <input type="text" class="form-control" placeholder="Medida" id="medida">
                                </td>>
                            </tr>
                            <tr>
                                <td colspan="2">
                                <tr>
                                <td colspan="2" class="text-right">
                                    <a href="#" id="guardar" class="btn btn-primary">Guardar</a>
                                    <input class="btn btn-success" type="reset" value="Reset">
                                    <a href="entrada-multiple.php" class="btn btn-danger">Cancelar</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </body>
    <script>
        $('#guardar').click(function(){
            var tipo = $('#tipo-producto').val();
            var marca = $('#marca').val();
            var modelo = $('#modelo').val();
            var medida = $('#medida').val();
            var dataString = "tipo="+tipo+"&marca="+marca+"&modelo="+modelo+"&medida="+medida;
            $.ajax({
                type: 'POST',
                data: dataString,
                url: 'php/guardar-nuevo-producto.php',
                cache: false,
                success: function(resp){
                    console.log('Respuesta-> ', resp);
                }
            });
            //location.href="entrada-multiple.php";
        });
    </script>
</html>