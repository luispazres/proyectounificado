<?php
  require_once("libs/template_engine.php");
  require_once("models/contratos.model.php");

  function run(){

    if(mw_estaLogueado()){
      $dataPlantilla = array();
      $errores="";
      $hoy=date('Y-m-d');
      $hoyObjeto= new DateTime(date('Y-m-d H:i:s'));
      $dataPlantilla["tblcontratos"] = obtenerContratosAlerta();
      $td="";

      $contratos=obtenerTodosLosContratos();

      foreach ($contratos as $key) {

      $convertedDate=strtotime($key["ContratoFechaFinal"]);
      $vencimientoObjeto = new DateTime(date($key["ContratoFechaFinal"]));
      $dia = date('d',$convertedDate);
      $mes = date('m',$convertedDate);
      $anio= date('Y',$convertedDate);

      $interval = $vencimientoObjeto->diff($hoyObjeto);

      if ($key["ContratoFechaFinal"]<=$hoy) {
        $td.="<tr class='danger'>
          <td>
            ".$key["ContratoCodigo"]."
          </td>
          <td>
            ".$key["ContratoFechaInicio"]."
          </td>
          <td>
            ".$key["ContratoFechaFinal"]."
          </td>
          <td>
            ".$key["EmpresaNombre"]."
          </td>
          <td>
            ".$key["ServicioNombre"]."
          </td>
        </tr>";
      }

      if ($interval->days==13) {
        $td.="<tr class='warning'>
          <td>
            ".$key["ContratoCodigo"]."
          </td>
          <td>
            ".$key["ContratoFechaInicio"]."
          </td>
          <td>
            ".$key["ContratoFechaFinal"]."
          </td>
          <td>
            ".$key["EmpresaNombre"]."
          </td>
          <td>
            ".$key["ServicioNombre"]."
          </td>
        </tr>";
      }

      if ($interval->days==28) {

        $td.="<tr class='success'>
          <td>
            ".$key["ContratoCodigo"]."
          </td>
          <td>
            ".$key["ContratoFechaInicio"]."
          </td>
          <td>
            ".$key["ContratoFechaFinal"]."
          </td>
          <td>
            ".$key["EmpresaNombre"]."
          </td>
          <td>
            ".$key["ServicioNombre"]."
          </td>
        </tr>";
      }

      if ($interval->days==5) {

        $td.="<tr class='info'>
          <td>
            ".$key["ContratoCodigo"]."
          </td>
          <td>
            ".$key["ContratoFechaInicio"]."
          </td>
          <td>
            ".$key["ContratoFechaFinal"]."
          </td>
          <td>
            ".$key["EmpresaNombre"]."
          </td>
          <td>
            ".$key["ServicioNombre"]."
          </td>
        </tr>";
      }
    }
      renderizar("alertaContratos", array('td' => $td ) );
    }else {
      mw_redirectToLogin("page=login2");
    }
  }
  run();
 ?>
