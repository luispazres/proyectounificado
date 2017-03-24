<?php
/* althome Controller
 * 2015-10-28
 * Created By OJBA
 * Last Modification 2017-06-03
 */
  require_once("libs/template_engine.php");
  function run(){
    //http_response_code(200);
    $data = array();
    $errores = array();
    $data["contenido"]="";
    $user = array();
    if(isset($_SESSION["user"])){
      $user= $_SESSION["user"];
      $data["contenido"]=;
      if($user["rol"]==1){
        header("Location:index.php?page=servicios");
      }
      else {
         $errores[] = array("errmsg"=>"Usuario Restringido");
      }

    }

    //print_r($data[""]);
    renderizar("althome",$data);
  }

  run();
?>
