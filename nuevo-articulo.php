<?php
require "validator.php";
?>
                <div class="card">
                    <div class="card-header">
                        <h3>Nuevo Articulo</h3>
                    </div>
                    <form id="form" class="form-group">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th colspan="2"><h6>Complete los Datos *</h6></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>PRODUCTO </td>
                                    <td>
                                        <select name="" id="lista-producto" class="form-control">
                                            <option value="0">Seleccionar...</option>
                                            <option value="1">NEUMATICOS</option>
                                            <option value="2">LLANTAS</option>
                                            <option value="3">CRITALES</option>
                                            <option value="4">SERVICIO</option>
                                            <option value="5">ACCESORIO</option>
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
                                        <div class="row">
                                            <div class="col-4">
                                                <input class="btn btn-block btn-success" type="reset" value="RESET">
                                            </div>
                                            <div class="col-4">
                                                <input id="guardar" class="btn btn-block btn-primary" value="GUARDAR">
                                            </div>
                                            <div class="col-4">
                                                <a href="entrada-multiple.php" class="btn btn-block btn-danger">CANCELAR</a>&nbsp;
                                                &nbsp;
                                                &nbsp;
                                                &nbsp;
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                    <p style="color:gray;">
                        <strong>-</strong> Aquí se agrega un articulo que NO se encuentra en la Base de Datos de Stock. <br>
                        * Todos los Campos son Obligatorios.
                    </p>
                </div>
    <script>
        $('#guardar').click(function(){

            var tipo = $('#lista-producto').val();
            var marca = $('#marca').val();
            var modelo = $('#modelo').val();
            var medida = $('#medida').val();

            if (tipo == 0){

                window.alert("DEBE SELECCIONAR TIPO DE PRODUCTO !");

            }else{

                if (marca.length > 0 && modelo.length > 0 && medida.length > 0){

                    var dataString = "tipo="+tipo+"&marca="+marca+"&modelo="+modelo+"&medida="+medida;

                    $.ajax({
                        type: 'POST',
                        data: dataString,
                        url: 'php/guardar-nuevo-producto.php',
                        cache: false,
                        success: function(res){
                            console.log(res);
                            if (res == 1) {
                                window.alert("El Articulo se Guardo Correctamente !");
                                location.href="entrada-multiple.php";
                            }else{
                                window.alert("Ha Ocurrido un Error !");
                            }
                        }
                    });

                }else{
                    window.alert("Complete Los Campos !");
                }

            }
        });
    </script>
</html>