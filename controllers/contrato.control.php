<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
  require_once("libs/template_engine.php");
  require_once("models/contratos.model.php");
  require_once("models/servicios.model.php");
  require_once("models/subirArchivo.model.php");
  //require_once("models/subirArchivo.model.php");
  function run(){

    if(mw_estaLogueado()){
      $datos = array();
      $datos["mostrarErrores"] = false;
      $datos["errores"] = array();
      $datos["txtNombre"]="";
      $datos["txtVigencia"] = "";
      $datos["txtValor"]="";
      $datos["fechaInicial"]="";
      $datos["fechaVencimiento"]="";
      $datos["documento"]= "";
      $servicio = array();
      $servicio= obtenerServicios();//obtenemos el array de servicios
      $vigencia=  array();
      $vigencia= obtenerVigencias();
      $contratoId="";
      $codigoEmpresa="";
      $codigoEmpresa="";
      $alerta="";

      if (isset($_GET["EmpresaCodigo"])) {
        $codigoEmpresa=$_GET["EmpresaCodigo"];
      }

      if(isset($_POST["btnGuardar"])){
        $datos["txtCodEmpresa"]=$_POST["txtCodEmpresa"];
        $datos["txtServicio"]=$_POST["txtServicio"];
        $datos["txtVigencia"]=$_POST["txtVigencia"];
        $datos["txtValor"]=$_POST["txtValor"];
        $datos["fechaInicial"]=$_POST["fechaInicial"];
        $datos["fechaVencimiento"]=$_POST["fechaVencimiento"];
        //$datos["documento"]=$_POST["documento"];
        $contratoId=InsertarContratos( $datos["fechaInicial"],  $datos["fechaVencimiento"],$datos["txtVigencia"],$datos["txtValor"],$datos["txtCodEmpresa"],$datos["txtServicio"]);
        $files = $_FILES['userfile']['name'];
       //creamos una nueva instancia de la clase multiupload
        $upload = new Multiupload();
      //llamamos a la funcion upFiles y le pasamos el array de campos file del formulario
       $isUpload = $upload->upFiles($files,$contratoId);
       if ($isUpload<1) {

         borrarContrato($contratoId);
         $alerta="<script language='javascript'>alert('Error al subir el archivo.');</script>";

       }else {
         header("Location:index.php?page=listadoEmpresa");
       }
      }

      if(isset($_POST["btnCancelar"])){
          header("Location:index.php?page=listadoEmpresa");
      }

        renderizar("contrato", array("servicio"=>$servicio,"vigencia"=>$vigencia,"datos"=> $codigoEmpresa,"alerta"=>$alerta));
    }else {
      mw_redirectToLogin("page=login2");
    }


  }
  run();

 ?>
