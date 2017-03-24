<?php
//middleware de verificación
    function mw_estaLogueado(){
        if( isset($_SESSION["userLogged"]) && $_SESSION["userLogged"] == true){
          return true;
        }else{
          $_SESSION["userLogged"] = false;
          $_SESSION["userName"] = "";
          $_SESSION["rol"] = "";
          return false;
        }
    }
    function mw_setEstaLogueado($usuario, $logueado, $rol){
        if($logueado){
            $_SESSION["userLogged"] = true;
            $_SESSION["userName"] = $usuario;
            $_SESSION["rol"]=$rol;
        }else{
            $_SESSION["userLogged"] = false;
            $_SESSION["userName"] = "";
            $_SESSION["rol"] = "";
        }
    }
    function mw_redirectToLogin($to){
        $loginstring = urlencode("?".$to);
        $url = "index.php?page=login2&returnUrl=".$loginstring;
        header("Location:" . $url);
        die();
    }
?>
