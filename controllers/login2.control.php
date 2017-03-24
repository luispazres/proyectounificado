<?php
  require_once("libs/template_engine.php");
  require_once("libs/dao.php");
  require_once("models/login.model.php");
  require_once("models/roles.model.php");
  function run(){

    $userName = "";
    $returnUrl = "";
    $errores = array();
    $rolCod["txtCargo"]="";

    if(isset($_POST["btnLogin"])){
        $userName = $_POST["txtUser"];
        $pswd = $_POST["txtPswd"];
        $usuario = obtenerUsuario($userName);

        if($usuario){

          $pswd=md5($pswd);
          if(obtenerPassword($userName,$pswd)){

            mw_setEstaLogueado($userName, true, $usuario["rolCodigo"]);
            header("Location:index.php?page=listadoEmpresa");
            die();
           }else{
            $errores[] = array("errmsg"=>"Credenciales Incorrectas");
          }
        }else{
                 $errores[] = array("errmsg"=>"Credenciales Incorrectas");
               }
           }

      if(isset($_GET["returnUrl"])){
           $returnUrl = urldecode($_GET["returnUrl"]);
      }

           $datos = array("txtUser" => $userName,
                          "returnUrl" => $returnUrl,
                          "mostrarErrores" => (count($errores)>0),
                          "errores" => $errores);

           renderizar("login2", $datos);

         }
         run();
       ?>

