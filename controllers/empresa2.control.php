<?php
require_once("libs/template_engine.php");
require_once("models/empresa.model.php");

function run(){

  if(mw_estaLogueado()){
    $arrDatos["EmpresaNombre"]="";
    $arrDatos["EmpresaRepresentante"] = "";
    $arrDatos["EmpresaComercial"]="";
    $arrDatos["EmpresaRTN"]="";

    $arrDatos["deleting"]= false;
    $arrDatos["mode"]= $_GET["mode"];


     if(isset($_POST["btnGuardar"])){
       if($arrDatos["mode"]=="INS"){
         insertarEmpresa($_POST["EmpresaNombre"],$_POST["EmpresaRepresentante"],$_POST["EmpresaComercial"],$_POST["EmpresaRTN"]);
     }
     else{
       actualizarEmpresa($_POST["EmpresaCodigo"],$_POST["EmpresaNombre"],$_POST["EmpresaRepresentante"],$_POST["EmpresaComercial"],$_POST["EmpresaRTN"]);

     }
      redirectWithMessage("Empresa Guardado Exitosamente","index.php?page=listadoEmpresa");
   }

    if(isset($_POST["btnEliminar"])){
      eliminarEmpresa($_POST["EmpresaCodigo"]);
      redirectWithMessage("Tipo de Empresa Eliminado ","index.php?page=listadoEmpresa");
    }

     if(isset($_GET["EmpresaCodigo"])){
       $arrDatos["EmpresaCodigo"]= $_GET["EmpresaCodigo"];
       $tmpRegistro= obtenerPorEmpresa($arrDatos["EmpresaCodigo"]);


       $arrDatos["EmpresaNombre"]=$tmpRegistro["EmpresaNombre"];
       $arrDatos["EmpresaRepresentante"]=$tmpRegistro["EmpresaRepresentante"];
       $arrDatos["EmpresaComercial"]=$tmpRegistro["EmpresaComercial"];
       $arrDatos["EmpresaRTN"]=$tmpRegistro["EmpresaRTN"];

       $arrDatos["enabled"]=false;
     }

       if($arrDatos["mode"]=="INS"){
         $arrDatos["enabled"]= true;
       }

       if($arrDatos["mode"]=="DLT"){
         $arrDatos["deleting"]= true;
       }

       renderizar("empresa2",$arrDatos);
  }else {
    mw_redirectToLogin("page=login2");
  }
   }
   run();
 ?>
