<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
  require_once("libs/template_engine.php");
  require_once("models/registro.model.php");
  require_once("models/roles.model.php");
  function run(){

    if(mw_estaLogueado()){
      $datos = array();
      $datos["mostrarErrores"] = false;
      $datos["errores"] = array();
      $datos["txtEmail"]="";
      $datos["txtUserName"] = "";
      $datos["txtApellido"] = "";
      $datos["password"]="";
      $datos["txtPasswordCnf"]="";
      $roles = array();
      $roles= obtenerRoles();
      $datos["txtCargo"]="";

      if(isset($_POST["btnRegistrar"])){
        $datos["txtEmail"] = $_POST["txtEmail"];
        $datos["txtUserName"] = $_POST["txtUserName"];
        $datos["txtApellido"] = $_POST["txtApellido"];
        $password = $_POST["password"];
        $passwordCnf = $_POST["txtPasswordCnf"];
        $datos["txtCargo"]= $_POST["txtCargo"];


        if($password  ==   $passwordCnf){
          $checkUser = obtenerUsuario($datos["txtEmail"]);/*verifica que no exista el usuario*/
          if(count($checkUser)==0){
             $datos["mostrarErrores"] == true;
             $datos["errores"][]=array("errmsg" => "Correo Electronico ya usado");
          }
         //else {
            $password=md5($password);
            $datos["rol"][]=array("nombre"=>"Administrador",
                                 "seleccionado"=>"");
            $datos["rol"][]=array("nombre"=>"Operador",
                                  "seleccionado"=>"");
            $datos["rol"][]=array("nombre"=>"Recepcion",
                                 "seleccionado"=>"");


            $datos["rol"] = addSelectedCmbArray(
            $datos["rol"],
            "nombre",
            $datos["txtCargo"],
            "seleccionado"
        );

            insertarRegistro(   $_POST["txtUserName"],
                                $_POST["txtApellido"],
                                $_POST["txtEmail"],
                                $password,
                                $_POST["txtCargo"]
                                );
          header("Location:index.php?page=usuarios");
          //}
        }else{
          $datos["mostrarErrores"] = true;
          $datos["errores"][]=array("errmsg"=>"Contraseñas no coinciden");
        }
      }
      print_r($datos["txtCargo"]);
      if(isset($_POST["btnCancelar"])){
          header("Location:index.php?page=usuarios");
      }

      renderizar("registrate",array("rol"=>$roles));
    }else {
      mw_redirectToLogin("page=login2");
    }
  }
  run();
?>

