<head>
    <link rel="stylesheet" href="public/vendor/bootstrap/css/bootstrap.css"/>
    <link rel="stylesheet" href="public/dist/css/bootstrapValidator.css"/>
    <script type="text/javascript" src="public/vendor/jquery/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="public/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="public/dist/js/bootstrapValidator.js"></script>
</head>
<h1>Nuevo Contrato</h1></br>
  <h1>{{probando}}</h1>
  <div class="container">
      <div class="row">
          <section>
              <div class="col-lg-8 col-lg-offset-2">
              <form id="defaultForm" action="index.php?page=contrato"  method="post" class="form-horizontal" enctype="multipart/form-data">

                <input type="hidden" name="contratoCodigo" value="{{ContratoCodigo}}">

                 <div class="form-group">
                <label class="col-lg-3 control-label"> EmpresaCodigo:</label>
                  <div class="col-lg-5">
                   <input type="hidden" class="form-control" name="txtCodEmpresa" id="txtCodEmpresa" value="{{datos}}" >
                   {{datos}}
                 </div>
              </div>

               <div class="form-group">
                <label class="col-lg-3 control-label"> Valor del Contrato:</label>
                  <div class="col-lg-5">
                    <input type="text" class="form-control" name="txtValor" id="txtValor" value="{{txtValor}}" >
              </div>
           </div>

                    <div class="form-group">
                    <label class="col-lg-3 control-label"> Tipo de Servicio:</label>
                      <div class="col-lg-5">
                      <select class="form-control"  id="txtServicio" name="txtServicio">
                      {{foreach servicio}}
                      <option value="{{ServicioCodigo}}">{{ServicioNombre}}</option>
                      {{endfor servicio}}
                    </select>
                  </div>
               </div>


                    <div class="form-group">
                    <label class="col-lg-3 control-label">Vigencia de Contrato:</label>
                     <div class="col-lg-5">
                    <select class="form-control" name="txtVigencia" id="txtVigencia">
                      {{foreach vigencia}}
                      <option value="{{VigenciaCodigo}}">{{VigenciaMeses}}</option>
                      {{endfor vigencia}}
                    </select>
                  </div>
               </div>

                     <div class="form-group">
                      <label class="col-lg-3 control-label">Fecha Inicial del Contrato:</label>
                      <div class="col-lg-5">
                        <input type="date" class="form-control" name="fechaInicial" id="fechaInicial" required min="2016-12-24" value="{{fechaInicial}}"/>
                    </div>
                  </div>


                      <div class="form-group">
                      <label class="col-lg-3 control-label">Fecha de Vencimiento Contrato:</label>
                        <div class="col-lg-5">
                         <input type="date" class="form-control"  name="fechaVencimiento" id="fechaVencimiento" value="{{fechaVencimiento}}"/>
                       </div>
                     </div>
                    <hr>

                    <div class="col-lg-5">
                      <input type="file" name="userfile[]" id="userfile" class="form-control"/></br>
                        </div>

                    <div class="subirArchivos">

                    </div>
                      </br>
                      </br>
                      <input type="button" id="btnSubirOtro" name="btnSubirOtro" value="Subir Otro Documento">
                    </br>

                    <hr>
                    <div class="form-group">
                      <div class="col-lg-9 col-lg-offset-3">
                      <input type="submit" value="Guardar" class="btn btn-primary" name="btnGuardar"/>

                      &nbsp;
                      <a href="index.php?page=listadoEmpresa" class="btn btn-warning" role="button" >Cancelar</a>
                    </div>
                  </div>
                </form>
              </div>
       </section>
   </div>
</div>


<script type="text/javascript">
  $("#btnSubirOtro").click(function(){
      $(".subirArchivos").append("<input type='file' name='userfile[]'' id='userfile'/></br> <input type='submit' id='btnSubir' name='btnSubir' value='Subir archivo'><br>");
  });

  function getMonth(date) {
    var month = date.getMonth() + 1;
    return month < 10 ? '0' + month : '' + month;
  }

  $('#fechaInicial').change(function(){
    var vigencia=$("#txtVigencia").val();
    var vigenciaMeses;
    switch (vigencia) {
      case "1":
        vigenciaMeses=3;
        break;
      case "2":
        vigenciaMeses=6;
        break;
      case "3":
        vigenciaMeses=9;
        break;
      case "4":
        vigenciaMeses=12;
        break;
      case "5":
        vigenciaMeses=18;
        break;
      case "6":
        vigenciaMeses=24;
        break;
    }

    var fechaInicial=$("#fechaInicial").val();
    var date = new Date();
    var dateArray = fechaInicial.split("-");
    date.setFullYear(parseInt(dateArray[0]));
    date.setMonth(parseInt(dateArray[1])-1);
    date.setDate(parseInt(dateArray[2]));
    var fechaFinal=new Date();
    fechaFinal.setFullYear(date.getFullYear());
    fechaFinal.setDate(date.getDate());
    fechaFinal.setMonth(date.getMonth()+parseInt(vigenciaMeses));

    var anio = String(fechaFinal.getFullYear());
    var month= String(getMonth(fechaFinal));
    var dia= String(fechaFinal.getDate());
    var res= anio.concat("-",month,"-",dia);

    $("#fechaVencimiento").val(res);

    console.log(res);
});

$(document).ready(function() {
    $('#defaultForm').bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
          txtValor: {
              message: 'Valor del Contrato no válido',
              validators: {
                  notEmpty: {
                      message: 'Este campo es obligatorio y no puede estar vacio.'
                  },
                  stringLength: {
                      min: 3,
                      max: 8,
                      message: 'Debe contener entre 3 y 8 numeros.'
                  },
                  regexp: {
                      regexp: /^[0-9]+$/,
                      message: 'Solo se aceptan numeros.'
                  }
              }
          },
          txtServicio: {
             validators: {
               notEmpty: {
                 message: 'Este campo es obligatorio y no puede estar vacio.'
               }
             }
          },
          txtVigencia: {
             validators: {
               notEmpty: {
                 message: 'Este campo es obligatorio y no puede estar vacio.'
               }
             }
          },
          fechaInicial: {
             validators: {
               notEmpty: {
                 message: 'Este campo es obligatorio y no puede estar vacio.'
               }
             }
          },

         }
    })
});
</script>
