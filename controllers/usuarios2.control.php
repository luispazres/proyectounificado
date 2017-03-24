<?php
require_once("libs/template_engine.php");
require_once("models/registro.model.php");
require_once("models/roles.model.php");

function run(){

  if(mw_estaLogueado()){
    $arrDatos["usuarioNombre"]="";
    $arrDatos["usuarioApellido"] = "";
    $arrDatos["usuarioCorreo"]="";
    $roles = array();
    $arrDatos=array();
    $arrDatos["roles"]=obtenerRoles();

    $arrDatos["deleting"]= false;
    $arrDatos["mode"]= $_GET["mode"];


     if(isset($_POST["btnGuardar"])){

       actualizarUsuario($_POST["usuarioCodigo"],$_POST["usuarioNombre"],$_POST["usuarioApellido"],$_POST["usuarioCorreo"],$_POST["rolCodigo"]);
      header("Location:index.php?page=usuarios");
   }

    if(isset($_POST["btnEliminar"])){
      borrarUsuario($_POST["usuarioCodigo"]);
      header("Location:index.php?page=usuarios");
    }

     if(isset($_GET["usuarioCodigo"])){
       $arrDatos["usuarioCodigo"]= $_GET["usuarioCodigo"];
       $tmpRegistro= obtenerCodigo($arrDatos["usuarioCodigo"]);

  	   $arrDatos["usuarioNombre"]=$tmpRegistro["usuarioNombre"];
       $arrDatos["usuarioApellido"]=$tmpRegistro["usuarioApellido"];
       $arrDatos["usuarioCorreo"]=$tmpRegistro["usuarioCorreo"];
       $arrDatos["rolCodigo"]=$tmpRegistro["rolCodigo"];

       $arrDatos["enabled"]=false;
     }

       if($arrDatos["mode"]=="DLT"){
            $arrDatos["deleting"] = true;
             if($arrDatos["rolCodigo"]==1){
               $arrDatos["rolNombre"] = "Administrador";
             }else{
               $arrDatos["rolNombre"] = "Recepcion";
             }
           }

       renderizar("usuarios2",$arrDatos);
  }else {
    mw_redirectToLogin("page=login2");
  }
   }
   run();
 ?>

