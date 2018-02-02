<?php
$email="";
$contrasena="";
$boolErrores=false; 
$errorEmail="";
$errorPass="";
    
include_once 'bd/conexion.php';
    $usuario=0;
    if(isset($_POST['Login'])){
        if(isset($_POST['email'])){
            $email = $_POST['email'];
        }
        if(isset($_POST['contrasena'])){
            $contrasena = $_POST['contrasena'];
        }   
        $consulta = "select * from usuario where email='".$email."';";
        $resultado = $mysqli->query($consulta);
        while ($fila = $resultado->fetch_assoc()) {
            if($fila['clave']==$contrasena && $fila['email']==$email){
                header('Location: /Prueba_2/ListaUsuarios.php');
            }
            else{
                $boolErrores=true;
            }
        }
        
        if($contrasena == ""){
            $errorPass = "ERROR: Debe ingresar password.";
        }
        if($email == ""){
            $errorEmail = "ERROR: Debe ingresar email.";
        }
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
        </style>
    </head>
    <body>
        <div class="container-fluid">
            <form action="Login.php" method="POST">
                <div class="row">
                    <br>
                    <div class="row">
                        <div class="col-md-2 etiqueta">Email</div>
                        <div class="col-md-3  ">
                            <input type="text" class="form-control" name="email" >
                        </div>
                        <?php if($errorEmail != ""):?>
                        <div class="col-md-3 alert-danger"><?=$errorEmail;?></div>
                        <?php endif;?>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-2 etiqueta">Contraseña</div>
                        <div class="col-md-3">
                            <input type="password" class="form-control" placeholder="********" name="contrasena">
                        </div>
                        <?php if($errorPass != ""):?>
                        <div class="col-md-3 alert-danger"><?=$errorPass;?></div>
                        <?php endif;?>
                    </div>
                    <br>
                    
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-6">
                            <input type="submit" value="Login" name="Login" class="btn btn-primary"/>
                        </div>
                    </div>
                    <br>
                    <?php
                    if($boolErrores==true){
                    ?>
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-2 alert-danger">Rut y/o Contraseña Incorrecta</div>
                    </div>
                    <?php }?>
                </div>
            </form>
        </div>
    </body>
</html>