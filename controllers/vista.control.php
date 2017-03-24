<?php
require_once("libs/template_engine.php");
require_once("models/contratos.model.php");


function run(){
    $datos= "";
    $datos=$_GET["DocumentoDireccion"];

   renderizar("vista", array('DocumentoDireccion' =>$datos  ));
}

  run();
 ?>
