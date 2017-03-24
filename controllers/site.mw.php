<?php
//middleware de configuración de todo el sitio
require_once("models/contratos.model.php");
require_once("models/alertas.model.php");
require_once("clases/PHPMailerAutoload.php");
require_once("clases/class.phpmailer.php");
require_once("clases/class.phpmaileroauth.php");
require_once("clases/class.smtp.php");
require_once("clases/class.pop3.php");
require_once("clases/class.phpmaileroauthgoogle.php");
function site_init(){

  $contratos="";
  $contratosAVencer = array( );
  $contratosVencidos = array( );
  $dia="95";
  $mes="";
  $anio="";
  $resta=0;
  $mensaje="";
  $convertedDate="";
  $hoy=date('Y-m-d');
  $hoyObjeto= new DateTime(date('Y-m-d H:i:s'));
  $today_time = strtotime($hoy);
  $cont=0;
  $fecha=array();
  $today=array("mes"=>date("m"),"anio"=>date("Y"),"dia"=>date("d"));
  $alert=$today['anio']."-".$today["mes"]."-".$today["dia"];
  $contratosHeader="";

  $contratos=obtenerTodosLosContratos();

  foreach ($contratos as $key) {

  $convertedDate=strtotime($key["ContratoFechaFinal"]);
  $vencimientoObjeto = new DateTime(date($key["ContratoFechaFinal"]));
  $dia = date('d',$convertedDate);
  $mes = date('m',$convertedDate);
  $anio= date('Y',$convertedDate);

  $interval = $hoyObjeto->diff($vencimientoObjeto);

  //echo "Dias: ".$interval->format('%R%a días')." || ";

  if ($key["ContratoFechaFinal"]<=$hoy) {
    $contratosVencidos[]=$key;
  }

  if ($interval->days==13) {
    $contratosAVencer[]=$key;
  }

  if ($interval->days==28) {

  $contratosAVencer[]=$key;
  }

  if ($interval->days==5) {

  $contratosAVencer[]=$key;
  }
}

foreach ($contratosVencidos as $key) {
  $cont++;
/*  $contratosHeader.="<li class='notification'>
  <div class='media'>
  <div class='media-left'>
  <div class='media-object'>
   <img data-src='holder.js/50x50?bg=cccccc' class='img-circle' alt='Name'>
  </div>
  </div>
  <div class='media-body'>
  <strong class='notification-title'>Alerta Contrato: ".$key["ContratoCodigo"]." El contrato de ".$key["ServicioNombre"]." de la empresa ".$key["EmpresaNombre"]." esta vencido.</strong>

  <div class='notification-meta'>
   <small >Venció: ".$key["ContratoFechaFinal"]."</small>
  </div>

  </div>
  </div>
  </li>";*/

  $contratosHeader.="  <li>
      <a>
        <span class='image'><img src='public/imgs/img.jpg' alt='Profile Image'></span>
        <span>
          <span>Alerta de Vencimiento</span>
          <span class='time'>".$key["ContratoFechaFinal"]."</span>
        </span>
        <span class='message'>
          El contrato #".$key["ContratoCodigo"]." de la empresa ".$key["EmpresaNombre"]." esta vencido.
        </span>
      </a>
    </li>";
}

  foreach ($contratosAVencer as $key) {
    $cont++;
  /*  $contratosHeader.="<li class='notification'>
    <div class='media'>
    <div class='media-left'>
    <div class='media-object'>
     <img data-src='holder.js/50x50?bg=cccccc' class='img-circle' alt='Name'>
    </div>
    </div>
    <div class='media-body'>
    <strong class='notification-title'>Alerta Contrato: ".$key["ContratoCodigo"]." El contrato de ".$key["ServicioNombre"]." de la empresa ".$key["EmpresaNombre"]."</strong>

    <div class='notification-meta'>
     <small >Vence: ".$key["ContratoFechaFinal"]."</small>
    </div>

    </div>
    </div>
    </li>";*/

    $contratosHeader.="  <li>
        <a>
          <span class='image'><img src='public/imgs/img.jpg' alt='Profile Image'></span>
          <span>
            <span>Alerta de Vencimiento</span>
            <span class='time'>".$key["ContratoFechaFinal"]."</span>
          </span>
          <span class='message'>
            El contrato #".$key["ContratoCodigo"]." de la empresa ".$key["EmpresaNombre"]." esta por vencer.
          </span>
        </a>
      </li>";
  }

  if (!obtenerAlerta($alert)) {
      insertarAlerta($alert);
    $contratos=obtenerTodosLosContratos();

    foreach ($contratos as $key) {

      $convertedDate=strtotime($key["ContratoFechaFinal"]);
      $vencimientoObjeto = new DateTime(date($key["ContratoFechaFinal"]));
      $dia = date('d',$convertedDate);
      $mes = date('m',$convertedDate);
      $anio= date('Y',$convertedDate);

      $interval = $hoyObjeto->diff($vencimientoObjeto);

    if ($interval->days==28) {

      $mail = new PHPMailer;

    $mensaje="Alerta de vencimiento\n\n El contrato #".$key["ContratoCodigo"]." tiene 15 dias de vigencia antes de su vencimiento";
    $mail->isSMTP();
    //$mail->SMTPDebug=2;
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'desarrollojr@soyservidor.com';
    $mail->Password = 'soyservidor2017';                           // SMTP password
    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465 ;                                    // TCP port to connect to

    $mail->setFrom('desarrollojr@soyservidor.com', 'Mailer');
    $mail->addAddress('michi.navarro1994@gmail.com', 'Michelle');     // Add a recipient
    //$mail->addAddress('ellen@example.com');               // Name is optional
    $mail->addReplyTo('desarrollojr@soyservidor.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
    $mail->isHTML(true);                                  // Set email format to HTML

    $mail->Subject = 'Alerta de vencimiento de contrato';
    $mail->Body    = 'El contrato #'.$key["ContratoCodigo"].' de la empresa '.$key["EmpresaNombre"].' con servicio '.$key["ServicioNombre"].' esta a 30 dias de expirar.';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    if(!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'Message has been sent';
    }
  }

if ($interval->days==13) {

  $mail = new PHPMailer;

  $mensaje="Alerta de vencimiento\n\n El contrato #".$key["ContratoCodigo"]." tiene 15 dias de vigencia antes de su vencimiento";
  $mail->isSMTP();
  //$mail->SMTPDebug=2;
  $mail->Host = 'smtp.gmail.com';
  $mail->SMTPAuth = true;
  $mail->Username = 'desarrollojr@soyservidor.com';
  $mail->Password = 'soyservidor2017';                           // SMTP password
  $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
  $mail->Port = 465 ;                                    // TCP port to connect to

  $mail->setFrom('desarrollojr@soyservidor.com', 'Mailer');
  $mail->addAddress('michi.navarro1994@gmail.com', 'Michelle');        // Add a recipient
  //$mail->addAddress('ellen@example.com');               // Name is optional
  $mail->addReplyTo('desarrollojr@soyservidor.com', 'Information');
  //$mail->addCC('cc@example.com');
  //$mail->addBCC('bcc@example.com');

  //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
  $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
  $mail->isHTML(true);                                  // Set email format to HTML

  $mail->Subject = 'Alerta de vencimiento.';
  $mail->Body    = $mensaje;
  $mail->AltBody = 'El contrato #'.$key["ContratoCodigo"].' de la empresa '.$key["EmpresaNombre"].' con servicio '.$key["ServicioNombre"].' esta a 15 dias de expirar.';

  if(!$mail->send()) {
      echo 'Message could not be sent.';
      echo 'Mailer Error: ' . $mail->ErrorInfo;
  } else {
      echo 'Message has been sent';
  }
  }

  if ($interval->days==5) {

   $mail = new PHPMailer;

  $mensaje="Alerta de vencimiento\n\n El contrato #".$key["ContratoCodigo"]." tiene 7 dias de vigencia antes de su vencimiento";
  $mail->isSMTP();
  //$mail->SMTPDebug=2;
  $mail->Host = 'smtp.gmail.com';
  $mail->SMTPAuth = true;
  $mail->Username = 'desarrollojr@soyservidor.com';
  $mail->Password = 'soyservidor2017';
  $mail->SMTPSecure = 'ssl';
  $mail->Port = 465 ;

  $mail->setFrom('desarrollojr@soyservidor.com', 'Mailer');
  $mail->addAddress('michi.navarro1994@gmail.com', 'Michelle');

  $mail->addReplyTo('desarrollojr@soyservidor.com', 'Information');

  $mail->addAttachment('/tmp/image.jpg', 'new.jpg');
  $mail->isHTML(true);

  $mail->Subject = 'Alerta de vencimiento';
  $mail->Body    = $mensaje;
  $mail->AltBody = 'El contrato #'.$key["ContratoCodigo"].' de la empresa '.$key["EmpresaNombre"].' con servicio '.$key["ServicioNombre"].' esta a 7 dias de expirar.';

  if(!$mail->send()) {
      echo 'Message could not be sent.';
      echo 'Mailer Error: ' . $mail->ErrorInfo;
  } else {
      echo 'Message has been sent';
  }
}
    }
}

if(mw_estaLogueado()){
  if ($_SESSION["rol"]==1) {
    $navbar="
        <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset='utf-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>

        <title>SoyServidor </title>

        <!-- Bootstrap -->

        <!-- Font Awesome -->
        <link href='vendors/font-awesome/css/font-awesome.min.css' rel='stylesheet'>
        <!-- NProgress -->
        <link href='vendors/nprogress/nprogress.css' rel='stylesheet'>
        <!-- jQuery custom content scroller -->
        <link href='vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css' rel='stylesheet'/>

        <!-- Custom Theme Style -->
        <link href='build/css/custom.min.css' rel='stylesheet'>


      <body class='nav-md footer_fixed'>
        <div class='container body'>
          <div class='main_container'>
            <div class='col-md-3 left_col'>
              <div class='left_col scroll-view'>
                <div class='navbar nav_title' style='border: 0;'>
                  <a href='index.html' class='site_title'><i class='fa fa-paw'></i> <span>SoyServidor!</span></a>
                </div>

                <div class='clearfix'></div>

                <!-- menu profile quick info -->
                <div class='profile clearfix'>
                  <div class='profile_pic'>
                    <img src='public/imgs/img.jpg' alt='...' class='img-circle profile_img'>
                  </div>
                  <div class='profile_info'>
                    <span>Welcome,</span>
                    <h2>John Doe</h2>
                  </div>
                </div>
                <!-- /menu profile quick info -->

                <br />

                <!-- sidebar menu -->
                <div id='sidebar-menu' class='main_menu_side hidden-print main_menu'>
                  <div class='menu_section'>
                    <h3>General</h3>
                    <ul class='nav side-menu'>
                    <li><a><i class='fa fa-building-o'></i> Empresas <span class='fa fa-chevron-down'></span></a>
                      <ul class='nav child_menu'>
                        <li><a href='index.php?page=listadoEmpresa'>Listado de Empresas</a></li>
                        <li><a href='index.php?page=empresa'>Agregar Empresas</a></li>
                      </ul>
                    </li>
                      <li><a><i class='fa fa-file-text-o'></i> Contratos <span class='fa fa-chevron-down'></span></a>
                        <ul class='nav child_menu'>
                          <li><a href='index.php?page=alertaContratos'>Alertas de Contrato</a></li>
                        </ul>
                      </li>
                      <li><a><i class='fa fa-jsfiddle'></i>Servicios <span class='fa fa-chevron-down'></span></a>
                        <ul class='nav child_menu'>
                          <li><a href='index.php?page=servicios'>Listado de los Servicios</a></li>
                          <li><a href='index.php?page=serviciosAgregar&mode=INS'>Agregar Servicios</a></li>
                        </ul>
                      </li>
                      <li><a><i class='fa fa-user'></i> Usuarios <span class='fa fa-chevron-down'></span></a>
                        <ul class='nav child_menu'>
                          <li><a href='index.php?page=usuarios'>Ver Usuarios</a></li>
                          <li><a href='index.php?page=registrate'>Agregar Usuarios</a></li>
                        </ul>
                      </li>
                    </ul>
                  </div>
                </div>
                <!-- /sidebar menu -->

                <!-- /menu footer buttons -->
                <div class='sidebar-footer hidden-small'>
                  <a data-toggle='tooltip' data-placement='top' title='Settings'>
                    <span class='glyphicon glyphicon-cog' aria-hidden='true'></span>
                  </a>
                  <a data-toggle='tooltip' data-placement='top' title='FullScreen'>
                    <span class='glyphicon glyphicon-fullscreen' aria-hidden='true'></span>
                  </a>
                  <a data-toggle='tooltip' data-placement='top' title='Lock'>
                    <span class='glyphicon glyphicon-eye-close' aria-hidden='true'></span>
                  </a>
                    <a data-toggle='tooltip' data-placement='top' title='Logout' href='index.php?page=CerrarSesion'>
                    <span class='glyphicon glyphicon-off' aria-hidden='true'></span>
                  </a>
                </div>
                <!-- /menu footer buttons -->
              </div>
            </div>

            <!-- top navigation -->
            <div class='top_nav'>
              <div class='nav_menu'>
                <nav>
                  <div class='nav toggle'>
                    <a id='menu_toggle'><i class='fa fa-bars'></i></a>
                  </div>

                  <ul class='nav navbar-nav navbar-right'>
                    <li class=''>
                      <a href='javascript:;' class='user-profile dropdown-toggle' data-toggle='dropdown' aria-expanded='false'>
                        <img src='public/imgs/img.jpg' alt=''>John Doe
                        <span class=' fa fa-angle-down'></span>
                      </a>
                      <ul class='dropdown-menu dropdown-usermenu pull-right'>
                        <li><a href='javascript:;'> Profile</a></li>
                        <li>
                          <a href='javascript:;'>
                            <span class='badge bg-red pull-right'>50%</span>
                            <span>Settings</span>
                          </a>
                        </li>
                        <li><a href='javascript:;'>Help</a></li>
                        <li><a href='login.html'><i class='fa fa-sign-out pull-right'></i> Log Out</a></li>
                      </ul>
                    </li>

                    <li role='presentation' class='dropdown'>
                  <a href='javascript:;' class='dropdown-toggle info-number' data-toggle='dropdown' aria-expanded='false'>
                    <i class='fa fa-envelope-o'></i>
                    <span class='badge bg-green'>".$cont."</span>
                  </a>
                  <ul id='menu1' class='dropdown-menu list-unstyled msg_list' role='menu'>
                    ".$contratosHeader."
                    <li>
                      <div class='text-center'>
                        <a href='index.php?page=alertaContratos'>
                          <strong>See All Alerts</strong>
                          <i class='fa fa-angle-right'></i>
                        </a>
                      </div>
                    </li>
                  </ul>
                </li>
                      </ul>
                    </li>
                  </ul>
                </nav>
              </div>

            </div>
            <!-- /top navigation -->

            <!-- page content -->
            <div class='right_col' role='main'>
              <div class=''>
                <div class='page-title'>
                ";

    $navbar2="</div>
    </div>
    </div>
    <!-- /page content --><!-- page content -->
    <div class='right_col' role='main'>
      <div class=''>
        <div class='page-title'>
          <div class='title_left'>

          </div>
        </div>
      </div>
    </div>
    <!-- /page content --><!-- footer content -->
            <footer>
              <div class='pull-right'>
                Derechos Reservados 2017
              </div>
              <div class='clearfix'></div>
            </footer>
            <!-- /footer content -->
          </div>
        </div>

        <!-- jQuery -->

        <!-- FastClick -->
        <script src='vendors/fastclick/lib/fastclick.js'></script>
        <!-- NProgress -->
        <script src='vendors/nprogress/nprogress.js'></script>
        <!-- jQuery custom content scroller -->
        <script src='vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js'></script>

         <script src='vendors/Chart.js/dist/Chart.min.js'></script>

        <!-- Custom Theme Scripts -->
        <script src='build/js/custom.min.js'></script>
      </body>
    ";
  }else {
    $navbar="
    <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>

    <title>SoyServidor </title>

    <!-- Bootstrap -->
    <link href='vendors/bootstrap/dist/css/bootstrap.min.css' rel='stylesheet'>
    <!-- Font Awesome -->
    <link href='vendors/font-awesome/css/font-awesome.min.css' rel='stylesheet'>
    <!-- NProgress -->
    <link href='vendors/nprogress/nprogress.css' rel='stylesheet'>
    <!-- jQuery custom content scroller -->
    <link href='vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css' rel='stylesheet'/>

    <!-- Custom Theme Style -->
    <link href='build/css/custom.min.css' rel='stylesheet'>


  <body class='nav-md footer_fixed'>
    <div class='container body'>
      <div class='main_container'>
        <div class='col-md-3 left_col'>
          <div class='left_col scroll-view'>
            <div class='navbar nav_title' style='border: 0;'>
              <a href='index.html' class='site_title'><i class='fa fa-paw'></i> <span>SoyServidor!</span></a>
            </div>

            <div class='clearfix'></div>

            <!-- menu profile quick info -->
            <div class='profile clearfix'>
              <div class='profile_pic'>
                <img src='public/imgs/img.jpg' alt='...' class='img-circle profile_img'>
              </div>
              <div class='profile_info'>
                <span>Welcome,</span>
                <h2>John Doe</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id='sidebar-menu' class='main_menu_side hidden-print main_menu'>
              <div class='menu_section'>
                <h3>General</h3>
                <ul class='nav side-menu'>
                <li><a><i class='fa fa-building-o'></i> Empresas <span class='fa fa-chevron-down'></span></a>
                  <ul class='nav child_menu'>
                    <li><a href='index.php?page=listadoEmpresa'>Listado de Empresas</a></li>
                    <li><a href='index.php?page=empresa'>Agregar Empresas</a></li>
                  </ul>
                </li>
                  <li><a><i class='fa fa-file-text-o'></i> Contratos <span class='fa fa-chevron-down'></span></a>
                    <ul class='nav child_menu'>
                      <li><a href='index.php?page=alertaContratos'>Alertas de Contrato</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class='sidebar-footer hidden-small'>
              <a data-toggle='tooltip' data-placement='top' title='Settings'>
                <span class='glyphicon glyphicon-cog' aria-hidden='true'></span>
              </a>
              <a data-toggle='tooltip' data-placement='top' title='FullScreen'>
                <span class='glyphicon glyphicon-fullscreen' aria-hidden='true'></span>
              </a>
              <a data-toggle='tooltip' data-placement='top' title='Lock'>
                <span class='glyphicon glyphicon-eye-close' aria-hidden='true'></span>
              </a>
              <a data-toggle='tooltip' data-placement='top' title='Logout' href='index.php?page=CerrarSesion'>
                <span class='glyphicon glyphicon-off' aria-hidden='true'></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class='top_nav'>
          <div class='nav_menu'>
            <nav>
              <div class='nav toggle'>
                <a id='menu_toggle'><i class='fa fa-bars'></i></a>
              </div>

              <ul class='nav navbar-nav navbar-right'>
                <li class=''>
                  <a href='javascript:;' class='user-profile dropdown-toggle' data-toggle='dropdown' aria-expanded='false'>
                    <img src='public/imgs/img.jpg' alt=''>John Doe
                    <span class=' fa fa-angle-down'></span>
                  </a>
                  <ul class='dropdown-menu dropdown-usermenu pull-right'>
                    <li><a href='javascript:;'> Profile</a></li>
                    <li>
                      <a href='javascript:;'>
                        <span class='badge bg-red pull-right'>50%</span>
                        <span>Settings</span>
                      </a>
                    </li>
                    <li><a href='javascript:;'>Help</a></li>
                    <li><a href='login.html'><i class='fa fa-sign-out pull-right'></i> Log Out</a></li>
                  </ul>
                </li>

                <li role='presentation' class='dropdown'>
              <a href='javascript:;' class='dropdown-toggle info-number' data-toggle='dropdown' aria-expanded='false'>
                <i class='fa fa-envelope-o'></i>
                <span class='badge bg-green'>".$cont."</span>
              </a>
              <ul id='menu1' class='dropdown-menu list-unstyled msg_list' role='menu'>
                ".$contratosHeader."
                <li>
                      <div class='text-center'>
                        <a href='index.php?page=alertaContratos'>
                          <strong>See All Alerts</strong>
                          <i class='fa fa-angle-right'></i>
                        </a>
                      </div>
                    </li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>

        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class='right_col' role='main'>
          <div class=''>
            <div class='page-title'>

            ";

    $navbar2="</div>
    </div>
    </div>
    <!-- /page content --><!-- page content -->
    <div class='right_col' role='main'>
      <div class=''>
        <div class='page-title'>
          <div class='title_left'>

          </div>
        </div>
      </div>
    </div>
    <!-- /page content --><!-- footer content -->
            <footer>
              <div class='pull-right'>
                Derechos Reservados 2017
              </div>
              <div class='clearfix'></div>
            </footer>
            <!-- /footer content -->
          </div>
        </div>

        <!-- jQuery -->
        <script src='vendors/jquery/dist/jquery.min.js'></script>
        <!-- Bootstrap -->
        <script src='vendors/bootstrap/dist/js/bootstrap.min.js'></script>
        <!-- FastClick -->
        <script src='vendors/fastclick/lib/fastclick.js'></script>
        <!-- NProgress -->
        <script src='vendors/nprogress/nprogress.js'></script>
        <!-- jQuery custom content scroller -->
        <script src='vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js'></script>

        <!-- Custom Theme Scripts -->
        <script src='build/js/custom.min.js'></script>
      </body>
    ";
  }
}else {
  $navbar="";
  $navbar2="";
}

    addToContext("page_header",$navbar);
    addToContext("page_header2",$navbar2);
    addToContext("page_title","Proyecto Soy Servidor");

}
site_init();
?>
