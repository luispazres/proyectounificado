<?php
  require_once("libs/template_engine.php");
  require_once("models/contratos.model.php");
  require_once("models/subirArchivo.model.php");

  function run(){

    if(mw_estaLogueado()){
      $dataPlantilla = array();
     $empresaCodigo=$_GET["EmpresaCodigo"];

      $accion=$_GET["mode"];

      switch ($accion) {
        case 'DLT':
          $codigoContrato=$_GET["ContratoCodigo"];
          borrarContrato($codigoContrato);
          //redirectWithMessage("Contrato Eliminado ");
          break;
         case 'Ver':

           break;
        default:
          # code...
          break;
      }
      //validar

   if(isset($_GET["DocumentoDireccion"])){
     DescargarArchivo($_GET["DocumentoDireccion"]);
   }

      $dataPlantilla["tblcontratos"] = obtenerContratos($empresaCodigo);
      renderizar("VerContratos",$dataPlantilla);
    }else {
      mw_redirectToLogin("page=login2");
    }
  }
  run();
 ?>

