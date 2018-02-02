
<?php
include_once 'bd/conexion.php';
$usuario=0;
if(isset($_GET["usuario"])){
    $usuario= $_GET["usuario"];
    
}
//1. selección de datos
$consulta = "select * from usuario where id=".$usuario.";";
$resultado = $mysqli->query($consulta);
while ($fila = $resultado->fetch_assoc()) {
    
    $nombre=$fila['nombre'];
    $email=$fila['email'];
    $fechNac=$fila['fecha_nacimiento'];
    $sexo=$fila['sexo'];
    $admin=$fila['administrador'];
}
?>



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
            .col-md-2{
                font-size: 15px;
                font-weight: 700;
            }
            .titulo{
                font-size: 20px;
                font-weight: 700;
                color: blue;
                padding-left: 100px;
            }
            .mar{
                margin-bottom: 10px;
            }
            
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row titulo ">Detalle Usuario</div>
            <br>
            <div class="row mar">
                <div class="col-md-2">Id:</div>
                <div class="col-md-10"><?php echo $usuario?></div>
            </div>
            <div class="row mar">
                <div class="col-md-2">Nombre:</div>
                <div class="col-md-10"><?php echo $nombre?></div>
            </div>
            <div class="row mar">
                <div class="col-md-2">Email:</div>
                <div class="col-md-10"><?php echo $email?></div>
            </div>
            <div class="row mar">
                <div class="col-md-2">Fecha de Nacimiento:</div>
                <div class="col-md-10"><?php  echo $fechNac?></div>
            </div>
            <div class="row mar">
                <div class="col-md-2">Sexo:</div>
                <div class="col-md-10"><?php echo $sexo?></div>
            </div>
            <div class="row mar ">
                <div class="col-md-2">Administrador:</div>
                <div class="col-md-10"><?=$admin==1?"Si":"No" ?></div>
            </div>
        </div>
        
    </body>
</html>