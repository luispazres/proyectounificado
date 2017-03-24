<head>    
<link rel="stylesheet" href="public/vendor/bootstrap/css/bootstrap.css"/>
<link rel="stylesheet" href="public/dist/css/bootstrapValidator.css"/>
<script type="text/javascript" src="public/vendor/jquery/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="public/vendor/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="public/dist/js/bootstrapValidator.js"></script>
</head>
<h1>Contrato</h1>
  <div class="container">
      <div class="row">
          <section>
              <div class="col-lg-8 col-lg-offset-2">
              <form id="defaultForm" action="index.php?page=contratoEdicion" method="post" class="form-horizontal">

             <div class="form-group">
                <label class="col-lg-3 control-label">Código:</label>
                  <div class="col-lg-5">
                    <input type="hidden" name="txtEmpresaCodigo" value="{{empresaCodigo}}">
                    <input type="hidden" name="txtCodContrato" value="{{contratoCodigo}}">
                     {{contratoCodigo}}
                 </div>
            </div>


                <div class="form-group">
                  <label class="col-lg-3 control-label">Tipo de Servicio:</label>
                     <div class="col-lg-5">
                          <select class="form-control" id="txtServicio" name="txtServicio">
                          {{foreach servicio}}
                          <option value="{{ServicioCodigo}}">{{ServicioNombre}}</option>
                        {{endfor servicio}}
                              </select>
                    </div>
               </div>


               <div class="form-group">
                 <label class="col-lg-3 control-label">Vigencia del Contrato:</label>
                    <div class="col-lg-5">
                            <select class="form-control" name="txtVigencia" id="txtVigencia">
                              {{foreach vigencias}}
                                <option value="{{VigenciaCodigo}}">{{VigenciaMeses}}</option>
                              {{endfor vigencias}}
                            </select>
                    </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Valor del Contrato:</label>
                     <div class="col-lg-5">
                        <input type="text"  class="form-control" name="ContratoValor" id="ContratoValor" value="{{ContratoValor}}"/>
                         {{ContratoValor}}
                       </div>
                   </div>

                   <div class="form-group">
                     <label class="col-lg-3 control-label">Fecha Inicial del Contrato:</label>
                        <div class="col-lg-5">
                          <input type="date"  class="form-control" name="ContratoFechaInicio" id="ContratoFechaInicio" value=""/>
                        </div>
                     </div>

                     <div class="form-group">
                       <label class="col-lg-3 control-label">Fecha de Vencimiento del Contrato:</label>
                          <div class="col-lg-5">
                          <input type="date" class="form-control"  name="ContratoFechaFinal" id="ContratoFechaFinal" value=""/>
                          {{ContratoFechaFinal}}
                        </div>
                     </div>

                     <div class="form-group">
                       <div class="col-lg-9 col-lg-offset-3">
                         <td colspan="2" style="text-align:right">
                           <input type="submit"  class="btn btn-primary" value="Guardar" name="btnGuardar" />

                      &nbsp;
                      <a href="index.php?page=VerContratos&mode=Ver&EmpresaCodigo={{empresaCodigo}}" class="btn btn-warning" role="button">Cancelar</a>
                    </div>
                  </div>
              </form>
            </div>
      </section>
   </div>
</div>

<script type="text/javascript">
function getMonth(date) {
  var month = date.getMonth() + 1;
  return month < 10 ? '0' + month : '' + month;
}

$('#ContratoFechaInicio').change(function(){
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

  var fechaInicial=$("#ContratoFechaInicio").val();
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

  $("#ContratoFechaFinal").val(res);

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
            ContratoValor: {
                message: 'Valor del contrato inválido',
                validators: {
                    notEmpty: {
                        message: 'Este campo es obligatorio y no puede estar vacio.'
                    },
                    stringLength: {
                        min: 3,
                        max: 8,
                        message: 'Este campo debe estar comprendido entre 5 y 8 cifras.'
                    },
                    regexp: {
                        regexp: /^[0-9]+$/,
                        message: 'Solo se aceptan números.'
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
            ContratoFechaInicio: {
               validators: {
                 notEmpty: {
                   message: 'Este campo es obligatorio y no puede estar vacio.'
                 }
               }
            },
        }
    });
});
</script>
