<head>
    
<link rel="stylesheet" href="public/vendor/bootstrap/css/bootstrap.css"/>
 
<link rel="stylesheet" href="public/dist/css/bootstrapValidator.css"/>

  
<script type="text/javascript" src="public/vendor/jquery/jquery-1.10.2.min.js"></script>

<script type="text/javascript" src="public/vendor/bootstrap/js/bootstrap.min.js"></script>
 
<script type="text/javascript" src="public/dist/js/bootstrapValidator.js"></script>
</head>
<h1>Empresa</h1>
   <section class="container">
     <div class="row">
         <section>
              <div class="col-lg-8 col-lg-offset-2">
              <form id="defaultForm" action="index.php?page=empresa"  method="post" class="form-horizontal">

                    <div class="form-group">
                      <label class="col-lg-3 control-label"> Nombre de Empresa:</label>
                      <div class="col-lg-5">
                         <input type="text" class="form-control" name="txtNombre" id="txtNombre" value="{{txtNombre}}"/>
                       </div>
                    </div>

                   <div class="form-group">
                      <label class="col-lg-3 control-label">Nombre del Representante Legal:</label>
                      <div class="col-lg-5">
                         <input type="text" class="form-control" name="txtRepresentante" id="txtRepresentante" value="{{txtRepresentante}}"/>
                    </div>
                </div>

                  <div class="form-group">
                      <label class="col-lg-3 control-label">Nombre Comercial:</label>
                      <div class="col-lg-5">
                      <input type="text" class="form-control" name="txtComercial" id="txtComercial" placeholder="Honduras S.A" value="{{txtComercial}}"/>
                    </div>
                </div>

                    <div class="form-group">
                      <label class="col-lg-3 control-label">RTN:</label>
                      <div class="col-lg-5">
                          <input type="text" class="form-control" name="txtRTN" id="txtRTN" value="{{txtRTN}}"/>
                     </div>
                  </div>

                  <div class="form-group">
                      <div class="col-lg-9 col-lg-offset-3">
                         <input type="submit" value="Guardar"  style="margin-top: 15px;" class="btn btn-primary" name="btnGuardar"/>

                         &nbsp;
                         <a href="index.php?page=listadoEmpresa" style="margin-top: 15px;" class="btn btn-warning" role="button" >Cancelar</a>
                       </div>
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
            txtNombre: {
                message: 'El nombre de la empresa no es válido',
                validators: {
                    notEmpty: {
                        message: 'El nombre de la empresa es requerido no puede estar vacio'
                    },
                    stringLength: {
                        min: 3,
                        max: 25,
                        message: 'El nombre de la empresa debe tener mas de 6 y menos de 25 caracteres'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z_áéíóúñ\s]*$/,
                        message: 'El nombre de la empresa solo puede consistir en letras.'
                    }
                }
            },
            txtRepresentante: {
                message: 'El representante no es válido',
                validators: {
                    notEmpty: {
                        message: 'El nombre del representante es obligatorio no puede estar vacio'
                    },
                    stringLength: {
                        min: 3,
                        max: 25,
                        message: 'El nombre del representante debe tener mas de 6 y menos de 25 caracteres'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z_áéíóúñ\s]*$/,
                        message: 'El nombre del representante solo puede consistir en letras.'
                    }
                }
            },
            txtComercial: {
                message: 'El nombre comercial no es válido',
                validators: {
                    notEmpty: {
                        message: 'El nombre comercial es obligatorio no puede estar vacio'
                    },
                    stringLength: {
                        min: 4,
                        max: 25,
                        message: 'El nombre comercial debe tener mas de 6 y menos de 25 caracteres'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z_áéíóúñ\s]*$/,
                        message: 'El nombre comercial solo puede consistir en letras.'
                    }
                }
            },
            txtRTN: {
                message: 'RTN no válido',
                validators: {
                    notEmpty: {
                        message: 'RTN obligatorio, no puede estar vacio'
                    },
                    stringLength: {
                        min: 6,
                        max: 10,
                        message: 'El RTN debe tener mas de 6 y menos de 10 caracteres y numeros'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_\.]+$/,
                        message: 'El RTN sólo puede consistir en alfabético y numeros'
                    }
                }
            },
        }
    });
});
</script>
