<?php
    //modelo de datos de usuarios
    require_once("libs/dao.php");

   /*Obtiene los datos del usuario*/
   function obtenerRoles(){
       $roles= array();
       $sqlstr = "Select * from tblroles;";
       $roles = obtenerRegistros($sqlstr);
       return $roles;
     }

    ?>
