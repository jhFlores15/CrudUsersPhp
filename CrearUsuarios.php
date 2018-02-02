<?php
include_once 'bd/conexion.php';
$errorEmail = "";
$errorNombre = "";
$errorFecha = "";
$errorSexo = "";
$errorClave = "";
$errorRepitaClave = "";
$errorAdministrador="";

$email = "";
$nombre = "";
$fecha = "";
$sexo = "";
$clave = "";
$repitaClave = "";
$administrador="";
$bolErrores=false;

if(isset($_POST['CREAR'])){
    if(isset($_POST['email'])){
        $email = $_POST['email'];
    }
    if(isset($_POST['nombre'])){
        $nombre = $_POST['nombre'];
    }
    if(isset($_POST['fecha'])){
        $fecha = $_POST['fecha'];
    }
    if(isset($_POST['sexo'])){
        $sexo = $_POST['sexo'];
    }
    if(isset($_POST['clave'])){
        $clave = $_POST['clave'];
    }
    if(isset($_POST['repita_clave'])){
        $repitaClave = $_POST['repita_clave'];
    }
    if(isset($_POST['administrador'])){
        $administrador = $_POST['administrador'];
    }
    if($nombre == ""){
        $errorNombre = "ERROR: Debe ingresar nombre.";
        $bolErrores=true;
    }
    else{
        if(strlen($nombre)<3){
            $errorNombre = "ERROR: Nombre Debe tener 3 caracteres como minimo";
            $bolErrores=true;
        }
    }
    if($email == ""){
        $errorEmail = "ERROR: Debe ingresar email.";
        $bolErrores=true;
    }
    else{
        //strpos sirve para verficiar si en un string (variable)
        //existe un caracter en específico.
        //en este ejemplo se verifica que en $email exista @
        //si existe, entonces devuelve la posición donde esté
        //si no existe devuelve false
        if(strpos($email, "@")== false){
            $errorEmail = "ERROR: E-mail incorrecto.";
            $bolErrores=true;
        }
        if(strpos($email, ".")== false){
            $errorEmail = "ERROR: E-mail incorrecto.";
            $bolErrores=true;
        }
    }
    if($clave == ""){
        $errorClave = "ERROR: Debe ingresar clave.";
        $bolErrores=true;
    }
    else{
        
        //verificamos que la clave tenga al menos un número
        $numeros = "0123456789";
        $tieneNumeros = false;
        for($i=0;$i<strlen($clave);$i++){
            $caracter = $clave[$i];
            $posicion = strpos($numeros,$caracter);
            if($posicion != false){
                $tieneNumeros = true;
            }
        }
        
        //verificamos que la clave tenga al menos un número
        $letras = "abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ";
        $tieneLetras = false;
        for($i=0;$i<strlen($clave);$i++){
            $caracter = $clave[$i];
            $posicion = strpos($letras,$caracter);
            if($posicion != false){
                $tieneLetras = true;
            }
        }
                
        if($tieneLetras == false || $tieneNumeros == false){
            $errorClave = "ERROR: Clave debe tener letras y números.";
            $bolErrores=true;
        }
        
        //strlen devuelve el largo de la cadena
        if(strlen($clave) < 6){
            $errorClave = "ERROR: Clave debe tener mínimo 6 caracteres.";
            $bolErrores=true;
        }
        if($clave != $repitaClave){
            $errorClave = "ERROR: Claves no coinciden.";
            $bolErrores=true;
        }
    }
    if($fecha == ""){
        $errorFecha = "ERROR: Debe ingresar fecha.";
        $bolErrores=true;
    }
    else{
        //el explode revisa si existe un caracter dentro de una cadena
        //y si existe, entonces separa la cadena de acuerdo a ese caracter
        //creando un arreglo para cada posición un trozo de la cadena.
        $arrFecha = explode("-", $fecha);
        //count devuelve el tamaño de arreglo
        if(count($arrFecha) != 3){
            $errorFecha = "ERROR: Fecha debe tener el formato aaaa-mm-dd.";
            $bolErrores=true;
        }
        else{
            //strlen devuelve el largo de una cadena
            if(strlen($arrFecha[0])!=4){
                $errorFecha = "ERROR: Fecha debe tener el formato aaaa-mm-dd.";
                $bolErrores=true;
            }
            if(strlen($arrFecha[1])!=2){
                $errorFecha = "ERROR: Fecha debe tener el formato aaaa-mm-dd.";
                $bolErrores=true;
            }
            if(strlen($arrFecha[2])!=2){
                $errorFecha = "ERROR: Fecha debe tener el formato aaaa-mm-dd.";
                $bolErrores=true;
            }
        }
    }
    if($sexo == ""){
        $errorSexo = "ERROR: Debe ingresar un valor para sexo.";
        $bolErrores=true;
    }
    if($administrador==""){
        $errorAdministrador="ERROR: Debe ingresar un valor para administrador.";
        $bolErrores=true;
    }
    if($bolErrores==false){
        $insercion = "insert into usuario "
        . "                 (id,email,nombre,fecha_nacimiento,clave,sexo,administrador) "
        . "          values ('','".$email."','".$nombre."','".$fecha."','".$clave."','".$sexo."',".$administrador.")";
        if($mysqli->query($insercion) === TRUE){
            echo "Inserción correcta";
        }
        else{
            echo "Error en " . $insercion . ": " . $mysqli->error;
        }
    }
    else{
        echo" errores";
    }
             
}

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
        </style>
    </head>
    <body>
        <div class="container-fluid">
            <form action="CrearUsuarios.php" method="POST">
                <br/>
                <div class="row">
                    <div class="col-md-2 etiqueta">E-mail:</div>
                    
                    <?php
                    /*
                    if(isset($_POST['CREAR'])){
                        echo $email;
                    }
                    else{
                        echo "";
                    }
                     */
                    ?>
                    <div class="col-md-3"><input type="text" value="<?=isset($_POST['CREAR'])?$email:""?>" placeholder="ejemplo@email.com" class="form-control" name="email"/></div>
                    <?php if($errorEmail != ""):?>
                    <div class="col-md-3 alert-danger"><?=$errorEmail;?></div>
                    <?php endif;?>
                </div>
                <br/>
                <div class="row">
                    <div class="col-md-2 etiqueta">Nombre:</div>
                    <div class="col-md-3"><input value="<?=isset($_POST['CREAR'])?$nombre:""?>" type="text" placeholder="Nombre" class="form-control" name="nombre"/></div>
                    <?php if($errorNombre != ""):?>
                    <div class="col-md-3 alert-danger"><?=$errorNombre;?></div>
                    <?php endif;?>
                </div>
                <br/>
                <div class="row">
                    <div class="col-md-2 etiqueta">Fecha Nacimiento:</div>
                    <div class="col-md-3"><input type="text" placeholder="aaaa-mm-dd" class="form-control" value="<?=isset($_POST['CREAR'])?$fecha:""?>" name="fecha"/></div>
                    <?php if($errorFecha != ""):?>
                    <div class="col-md-3 alert-danger"><?=$errorFecha;?></div>
                    <?php endif;?>
                </div>
                <br/>
                <div class="row">
                    <div class="col-md-2 etiqueta">Sexo:</div>
                    <div class="col-md-3">
                        <input type='radio' name='sexo' <?=($sexo == 'M')?"checked":""?> value='M'/> Masculino
                        <input type='radio' name='sexo' <?=($sexo == 'F')?"checked":""?> value='F'/> Femenino</div>
                    <?php if($errorSexo != ""):?>
                    <div class="col-md-3 alert-danger"><?=$errorSexo;?></div>
                    <?php endif;?>
                </div>
                <br/>
                 <div class="row">
                    <div class="col-md-2 etiqueta">Administrador:</div>
                    <div class="col-md-3">
                        <input type='radio' name='administrador' <?php if(isset($_POST['CREAR'])){
                                                                            if($administrador==1){
                                                                                echo "checked";
                                                                            }else{
                                                                            "";}
                                                                            }?> value='1'/> Si
                        <input type='radio' name='administrador' <?php if(isset($_POST['CREAR'])){
                            if($errorAdministrador==""){
                                if($administrador==0){
                                    echo "checked";
                                }else{
                                "";
                                
                                }
                            }else{
                                "";
                            }
                        }?> value='0'/> No</div>                                                
                    <?php if($errorAdministrador != ""):?>
                    <div class="col-md-3 alert-danger"><?=$errorAdministrador;?></div>
                    <?php endif;?>
                </div>
                <br/>
                
                <div class="row">
                    <div class="col-md-2 etiqueta">Clave:</div>
                    <div class="col-md-3"><input type="password" placeholder="*****" value="" class="form-control" name="clave"/></div>
                    <?php if($errorClave != ""):?>
                    <div class="col-md-3 alert-danger"><?=$errorClave;?></div>
                    <?php endif;?>
                </div>
                <br/>
                <div class="row">
                    <div class="col-md-2 etiqueta">Repita Clave:</div>
                    <div class="col-md-3"><input type="password" placeholder="*****" value="" class="form-control" name="repita_clave"/></div>
                    <?php if($errorRepitaClave != ""):?>
                    <div class="col-md-3 alert-danger"><?=$errorRepitaClave;?></div>
                    <?php endif;?>
                </div>
                <br/>
                
                
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-6">
                        <input type="submit" value="Registrar" name="CREAR" class="btn btn-primary"/>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>
