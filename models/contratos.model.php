<?php
     //modelo de datos Contratos y documentos
     require_once("libs/dao.php");

     /*Insertar Contratos*/
     function insertarContratos($fechsinicio,$fechafinal,$vigencia,$valor ,$codigoEmpresa,$servcio){
         $strsql = "INSERT INTO tblcontratos
                     (ContratoFechaInicio, ContratoFechaFinal ,VigenciaCodigo,ContratoValor ,EmpresaCodigo,ServicioCodigo)
                    VALUES
                     ('%s', '%s', '%s','%f','%s','%s');";
         $strsql = sprintf($strsql,$fechsinicio,$fechafinal,
                                     $vigencia,$valor,$codigoEmpresa,$servcio);

         if(ejecutarNonQuery($strsql)){
             return getLastInserId();
         }

       }

       /*Vista de todos los contratos*/
          function obtenerContratosAlerta(){
          $contratos = array();
          $sqlstr = sprintf("SELECT  c.ContratoCodigo,e.EmpresaNombre 'NombreEmpresa',c.ContratoFechaInicio,c.ContratoFechaFinal, s.ServicioNombre 'TipodeServicio'
          from tblempresa as e, tblcontratos as c ,tblservicios as s  where e.EmpresaCodigo= c.EmpresaCodigo and s.ServicioCodigo=c.ServicioCodigo;");
          $contratos = obtenerRegistros($sqlstr);
          return $contratos;
          }

     /*Obtener vigencias de contratos*/
     function obtenerVigencias(){
     $servicio = array();
     $sqlstr = sprintf("SELECT * FROM tblvigencia");
     $servicio = obtenerRegistros($sqlstr);
     return $servicio;

    }

    function obtenerTodosLosContratos(){
    $servicio = array();
    $sqlstr = sprintf("SELECT c.ContratoCodigo, c.ContratoFechaInicio, c.ContratoFechaFinal, c.VigenciaCodigo, c.EmpresaCodigo, c.ServicioCodigo, c.ContratoValor, e.EmpresaNombre, s.ServicioNombre FROM tblcontratos as c, tblempresa as e, tblservicios as s where c.EmpresaCodigo=e.EmpresaCodigo and c.ServicioCodigo=s.ServicioCodigo ");
    $servicio = obtenerRegistros($sqlstr);
    return $servicio;

   }

    /*Obtener documentos*/
    function obtenerDocumento($DocumentoCodigo){
    $documento = array();
    $sqlstr = "SELECT * FROM tbldocumento where DocumentoCodigo=%d;";
    $documento = obtenerRegistro(sprintf($sqlstr,$DocumentoCodigo));
    return $documento;
   }

   function obtenerUnContrato($ContratoCodigo){
   $documento = array();
   $sqlstr = "SELECT * FROM tblcontratos where ContratoCodigo='%d';";
   $documento = obtenerUnRegistro(sprintf($sqlstr,$ContratoCodigo));
   return $documento;
  }


    /*Muestra contratos por emmpresa*/
    function obtenerContratos($EmpresaCodigo){
    $contratos = array();
    $sqlstr = "SELECT e.EmpresaCodigo, c.ContratoCodigo,c.ContratoFechaInicio,c.ContratoFechaFinal,c.ContratoValor, v.VigenciaMeses, s.ServicioNombre 'TipodeServicio'  ,d.DocumentoNombreArchivo 'NombredelContrato', d.DocumentoDireccion
    from tblempresa as e, tblcontratos as c ,tbldocumento as d, tblservicios as s, tblvigencia as v where c.VigenciaCodigo=v.VigenciaCodigo and e.EmpresaCodigo= c.EmpresaCodigo and c.ContratoCodigo=d.ContratoCodigo
    and c.ServicioCodigo=s.ServicioCodigo
    and e.EmpresaCodigo='%d';";
    $contratos = obtenerRegistros(sprintf($sqlstr,$EmpresaCodigo));
    return $contratos;
    }

    function borrarContrato($ContratoCodigo){
    $contratos = array();
    $sqlstr = sprintf("delete from tblcontratos where ContratoCodigo= '%d'",$ContratoCodigo);

    if(ejecutarNonQuery($sqlstr)){
        return getLastInserId();
    }

    return $contratos;
    }

    function DescargarArchivo($fichero){

      if (file_exists($fichero)) {
      set_time_limit(0);
             header('Connection: Keep-Alive');
             header('Content-Description: File Transfer');
             header('Content-Type: application/octet-stream');
             header('Content-Disposition: attachment; filename="'.basename($fichero).'"');
             header('Content-Transfer-Encoding: binary');
             header('Expires: 0');
             header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
             header('Pragma: public');
             header('Content-Length: ' . filesize($fichero));
             ob_clean();
             flush();
             readfile($fichero);
      }
    }


     /*Documentos*/
     function InsertarArchivos($tamanio,$nombreArchivo,$Tipo,$direccion){
      $strsql = "INSERT INTO tbldocumento (DocumentoNombreArchivo, DocumentoTamanio, DocumentoTipo,DocumentoDireccion) values('%s','%d','%s','%s');";
      $strsql = sprintf($strsql,$tamanio,$nombreArchivo,$Tipo,$direccion);

      if(ejecutarNonQuery($strsql)){
          return getLastInserId();
      }
    }


     /*Actualizar contratos variables tipo datetime */
     function ActualizarContrato($contratoCodigo,$servcio,$contratoVigencia,$contratoFechaInicio,$contratoFechaFinal,$ContratoValor){
      $updSql = "UPDATE tblcontratos set contratoFechaInicio = '%s', contratoFechaFinal = '%s', VigenciaCodigo='%s', ContratoValor='%f',ServicioCodigo='%s' where contratoCodigo ='%d';";
      $result = ejecutarNonQuery(sprintf($updSql,$contratoFechaInicio,$contratoFechaFinal,$contratoVigencia,$ContratoValor,$servcio,$contratoCodigo));
      return $result ;
     }

      /*Eliminar contrato*/
      function EliminarDocumento($DocumentoCodigo)
      {
        $delSql ="delete from tbldocumento where DocumentoCodigo=%d;";
        $result= ejecutarNonQuery(sprintf($delSql,$DocumentoCodigo));
        return ($result>0) && true;
      }
