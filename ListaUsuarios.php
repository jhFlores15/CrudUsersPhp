
<?php
include_once 'bd/conexion.php';

?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
        <script src="bootstrap/js/jquery-3.2.1.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <style>
            .etiqueta{
                text-align:right;
            }
            .encabezado{
                font-weight: 700;
                font-size: 14px;
                border-bottom: 4px solid;
            }
            .accion{
                padding-left: 60px;
            }
            .usu{
                font-size: 20px;
                font-weight: 700;
            }
            
            
        </style>
    </head>
    <body>
        <div class="container">
            <br>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-5 usu">Usuarios</div>
                        <div class="col-md-4"> <a class='btn btn-primary ' href='CrearUsuarios.php'><i>Agregar Usuarios</i></a></div>
                    </div>
                    <br>
                    <div class="row encabezado ">
                        <div class="col-md-1">ID</div>
                        <div class="col-md-1">Nombre</div>
                        <div class="col-md-2">Email</div>
                        <div class="col-md-2">F.Nacimiento</div>
                        <div class="col-md-1">Sexo</div>
                        <div class="col-md-1">Admin</div>
                        <div class="col-md-3 accion">Accion</div>
                    </div>
                    <br>

                        <?php

                        $consulta = "select * from usuario";
                        $resultado = $mysqli->query($consulta);
                        while ($fila = $resultado->fetch_assoc()) {
                            echo "<div class='row'>";
                                echo "<div class='col-md-1'>".$fila['id']."</div>";
                                echo "<div class='col-md-1'>".$fila['nombre']."</div>";
                                echo "<div class='col-md-2'>".$fila['email']."</div>";
                                echo "<div class='col-md-2'>".$fila['fecha_nacimiento']."</div>";
                                echo "<div class='col-md-1'>".$fila['sexo']."</div>";
                                echo "<div class='col-md-1'>".$fila['administrador']."</div>";
                                echo "<div class='col-md-3'>";
                                echo" <a class=' btn btn-primary' href='VisualizarUsuarios.php?usuario=".$fila['id']."'><i>Ver</i></a>";
                                echo" <a class='btn btn-primary' href='ModificarUsuarios.php?usuario=".$fila['id']."'><i>Editar</i></a>";
                                echo" <a class='btn btn-primary' href='EliminarUsuarios.php?usuario=".$fila['id']."'><i>Eliminar</i></a>";
                                echo "</div>";
                            echo "</div>";
                            echo "<br>";
                        }
                        ?>
                    
                </div>
            
        </div> 
    </body>
</html>