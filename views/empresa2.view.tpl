<head>  
<link rel="stylesheet" href="public/vendor/bootstrap/css/bootstrap.css"/>
<link rel="stylesheet" href="public/dist/css/bootstrapValidator.css"/>
<script type="text/javascript" src="public/vendor/jquery/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="public/vendor/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="public/dist/js/bootstrapValidator.js"></script>
</head>
<h1>Empresa</h1>
  <div class="container">
      <div class="row">
        <section>
            <div class="col-lg-8 col-lg-offset-2">
              <form id="defaultForm" action="index.php?page=empresa2&mode={{mode}}&EmpresaCodigo={{EmpresaCodigo}}" method="post" class="form-horizontal">
                   <div class="form-group">                   
                      <label class="col-lg-3 control-label">Código:</label>
                   {{if enabled}}
                   <div class="col-lg-5">
                     <input type="text" name="EmpresaCodigo" value="{{EmpresaCodigo}}"
                       placeholder="Un Número" />
                    </div>
                   {{endif enabled}}

                   {{ifnot enabled}}
                     <b>{{EmpresaCodigo}}</b>
                     <input type="hidden" name="EmpresaCodigo" value="{{EmpresaCodigo}}"/>
                   {{endifnot enabled}}
              </div>


                      <div class="form-group">
                       <label class="col-lg-3 control-label">Razón Social:</label>
                           {{ifnot deleting}}
                             <div class="col-lg-5">
                               <input type="text" class="form-control" name="EmpresaNombre" value="{{EmpresaNombre}}"/>
                          </div>
                          {{endifnot deleting}}

                           {{if deleting}}
                               <b>{{EmpresaNombre}}</b>
                               <input type="hidden" name="EmpresaNombre" value="{{EmpresaNombre}}"/>
                           {{endif deleting}}
                 </div>

                <div class="form-group">
                   <label class="col-lg-3 control-label">Representante Legal</label>
                       {{ifnot deleting}}
                          <div class="col-lg-5">
                             <input type="text" class="form-control" name="EmpresaRepresentante" value="{{EmpresaRepresentante}}"/>
                              </div>
                             {{endifnot deleting}}

                             {{if deleting}}
                                 <b>{{EmpresaRepresentante}}</b>
                                 <input type="hidden" name="EmpresaRepresentante" value="{{EmpresaRepresentante}}"/>
                             {{endif deleting}}
                </div>

                <div class="form-group">
                     <label class="col-lg-3 control-label">Nombre Comercial</label>
                         {{ifnot deleting}}
                         <div class="col-lg-5">
                           <input type="text" class="form-control" name="EmpresaComercial" value="{{EmpresaComercial}}"/>
                         </div>
                         {{endifnot deleting}}</br>

                         {{if deleting}}
                             <b>{{EmpresaComercial}}</b>
                             <input type="hidden" name="EmpresaComercial" value="{{EmpresaComercial}}"/>
                         {{endif deleting}}
                </div>


                    <div class="form-group">
                      <label class="col-lg-3 control-label">RTN</label>
                          {{ifnot deleting}}
                          <div class="col-lg-5">
                             <input type="text"  class="form-control" name="EmpresaRTN" value="{{EmpresaRTN}}"/>
                          </div>
                           {{endifnot deleting}}

                           {{if deleting}}
                               <b>{{EmpresaRTN}}</b>
                               <input type="hidden"class="form-control" name="EmpresaRTN" value="{{EmpresaRTN}}"/>
                           {{endif deleting}}
                 </div>


                   <div class="form-group">
                   {{if deleting}}
                       <input type="submit" class="btn btn-primary" value="Eliminar" name="btnEliminar" />
                   {{endif deleting}}
                   {{ifnot deleting}}
                       <input type="submit"  class="btn btn-primary" value="Guardar" name="btnGuardar" />
                   {{endifnot deleting}}
                   &nbsp;
                   <a href="index.php?page=listadoEmpresa" class="btn btn-warning" role="button">Cancelar</a>
                    </td>
                  </div>
            </form>
         </div>
    </section>
  </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    $('#defaultForm').bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            EmpresaNombre: {
                message: 'El nombre de la empresa no es válido',
                validators: {
                    notEmpty: {
                        message: 'El nombre de la empresa es requerido no puede estar vacio'
                    },
                    stringLength: {
                        min: 6,
                        max: 25,
                        message: 'El nombre de la empresa debe tener más de 6 y menos de 25 caracteres'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z_áéíóúñ\s]*$/,
                        message: 'El nombre de la empresa sólo puede consistir en letras.'
                    }
                }
            },
            EmpresaRepresentante: {
                message: 'El representante no es válido',
                validators: {
                    notEmpty: {
                        message: 'Campo obligatorio, no puede estar vacio'
                    },
                    stringLength: {
                        min: 6,
                        max: 25,
                        message: 'El nombre del representante debe tener más de 6 y menos de 25 caracteres'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z_áéíóúñ\s]*$/,
                        message: 'El nombre del representante sólo puede consistir en letras.'
                    }
                }
            },
            EmpresaComercial: {
                message: 'El nombre comercial no es válido',
                validators: {
                    notEmpty: {
                        message: 'Campo obligatorio, no puede estar vacio'
                    },
                    stringLength: {
                        min: 6,
                        max: 25,
                        message: 'El nombre comercial debe tener más de 6 y menos de 25 caracteres'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z_áéíóúñ\s]*$/,
                        message: 'El nombre comercial sólo puede consistir en letras.'
                    }
                }
            },
            EmpresaRTN: {
                message: 'RTN no válido',
                validators: {
                    notEmpty: {
                        message: 'Campo obligatorio, no puede estar vacio'
                    },
                    stringLength: {
                        min: 6,
                        max: 10,
                        message: 'El RTN debe tener más de 6 y menos de 10 caracteres y números'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_\.]+$/,
                        message: 'El RTN sólo puede consistir en letras y números'
                    }
                }
            },
        }
    });
});
</script>
