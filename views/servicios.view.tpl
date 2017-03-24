<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
    <script src="public/css/c.js"></script>
    <title></title>
  </head>
  <body>
<center><p class="section-subheader"></p>
  <section id="intro1">
<h1>Servicios</h1></br>
<section class="container">
              <form action="index.php?page=servicios"  method="post" class="tm-contact-form">
                <hr />
                <table style="width:80%; margin:25px">
                  <tr>
                    <th>
                      Codigo
                    </th>
                    <th>
                      Servicio Nombre
                    </th>
                  </tr>
                  {{foreach tblservicios}}
                      <tr>
                        <td>
                          {{ServicioCodigo}}
                        </td>
                        <td>
                          {{ServicioNombre}}
                        </td>
                      </td>
                      <td>
                    <a class="btn" title="Eliminar Empresa" role="button"
                      href="index.php?page=serviciosAgregar&mode=DLT&ServicioCodigo={{ServicioCodigo}}"
                    >
                      <span class="glyphicon glyphicon-trash"></span>
                    </a>
                    </td>
                {{endfor tblservicios}}
                </tr>
              </table>
              <a class="btn btn-primary pull-right" role="button"
                href="index.php?page=serviciosAgregar&mode=INS">
                    <span class="glyphicon glyphicon-plus"></span>
                     &nbsp;Agregar Nuevo
              </a>
  </section>
</section>
</body>
</html>
