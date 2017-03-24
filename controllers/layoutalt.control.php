<?php
/* Example Controller
     * 2015-10-14
     * Created By OJBA
     * Last Modification 2015-10-14 20:04
     */

      //Cargando Plantillero
      require_once("libs/template_engine.php");
      require_once("clases/PHPMailerAutoload.php");
      require_once("clases/class.phpmailer.php");
      require_once("clases/class.phpmaileroauth.php");
      require_once("clases/class.smtp.php");
      require_once("clases/class.pop3.php");
      require_once("clases/class.phpmaileroauthgoogle.php");
      require_once("models/contratos.model.php");

      function run(){
        $contratos="";
        $dia="95";
        $mes="";
        $anio="";
        $resta=0;
        $mensaje="";
        $convertedDate="";
        $today=array("mes"=>date("m"),"anio"=>date("Y"),"dia"=>date("d"));
        //$today=getDate();
        $contratos=obtenerTodosLosContratos();

        foreach ($contratos as $key) {

          $convertedDate=strtotime($key["ContratoFechaFinal"]);
          $dia = date('d',$convertedDate);
          $mes = date('m',$convertedDate);
          $anio= date('Y',$convertedDate);

          //$resta=($dia-$today["dia"]);

          if ($anio==$today["anio"] && $mes==$today["mes"] && ($dia-$today["dia"])==15 || ($dia-$today["dia"])==-15) {
            $mail = new PHPMailer;

        $mensaje="Alerta de vencimiento\n\n El contrato #".$key["ContratoCodigo"]." tiene 15 dias de vigencia antes de su vencimiento";
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'desarrollojr@soyservidor.com';
        $mail->Password = 'soyservidor2017';                           // SMTP password
        $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 465 ;                                    // TCP port to connect to

        $mail->setFrom('desarrollojr@soyservidor.com', 'Mailer');
        $mail->addAddress('luispazreyes@hotmail.com', 'Luis Paz');     // Add a recipient
        //$mail->addAddress('ellen@example.com');               // Name is optional
        $mail->addReplyTo('desarrollojr@soyservidor.com', 'Information');
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');

        //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
        $mail->isHTML(true);                                  // Set email format to HTML

        $mail->Subject = 'Luis te quiero =)';
        $mail->Body    = $mensaje;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        if(!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'Message has been sent';
        }
          }
        }

        renderizar("layoutalt", array('dia' => $dia ));
      }
      run();
?>
