<head>
<link rel="stylesheet" href="public/vendor/bootstrap/css/bootstrap.css"/>
<link rel="stylesheet" href="public/dist/css/bootstrapValidator.css"/>
<script type="text/javascript" src="public/vendor/jquery/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="public/vendor/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="public/dist/js/bootstrapValidator.js"></script>
</head>
<h1> Registrate</h1>
    <div class="container">
        <div class="row">
            <section>
                <div class="col-lg-8 col-lg-offset-2">
                  <form id="defaultForm" action="index.php?page=registrate"  method="post" class="form-horizontal">

                    <div class="form-group">
                       <label class="col-lg-3 control-label"> Nombre:</label>
                       <div class="col-lg-5">
                             <input type="text" class="form-control" name="txtUserName" id="txtUserName" value="{{txtUserName}}"/>
                           </div>
                        </div>

                          <div class="form-group">
                             <label class="col-lg-3 control-label"> Apellido:</label>
                             <div class="col-lg-5">
                               <input type="text" class="form-control" name="txtApellido" id="txtApellido" value="{{txtApellido}}"/>
                              </div>
                          </div>

                        <div class="form-group">
                          <label class="col-lg-3 control-label" >Email:</label>
                           <div class="col-lg-5">
                            <input type="text" class="form-control" name="txtEmail" id="txtEmail" placeholder="example@gmail.com" value="{{txtEmail}}"/>
                            </div>
                        </div>

                        <div class="form-group">
                          <label class="col-lg-3 control-label">Cargo:</label>
                          <div class="col-lg-5">
                          <select class="form-control"  name="txtCargo" id="txtCargo">
                           {{foreach rol}}
                           <option value="{{rolCodigo}}" {{seleccionado}}>{{rolNombre}}</option>
                           {{endfor rol}}
                         </select>
                       </div>
                    </div>

                       <div class="form-group">
                          <label class="col-lg-3 control-label">Contraseña:</label>
                          <div class="col-lg-5">
                          <input type="password"  class="form-control" name="password" id="password" placeholder="x12589Ska" value="{{password}}"/>
                        </div>
                      </div>

                       <div class="form-group">
                          <label class="col-lg-3 control-label">Confirme Contraseña:</label>
                            <div class="col-lg-5">
                              <input type="password" class="form-control" name="txtPasswordCnf" id="txtPasswordCnf" placeholder="x12589Ska"  value="{{txtPasswordCnf}}"/>
                            </div>
                        </div>


                          <div class="form-group">
                            <div class="col-lg-9 col-lg-offset-3">
                            <input type="submit" value="Regístrate" class="btn btn-primary" name="btnRegistrar" style="margin-top: 15px;"/>

                            &nbsp;
                            <a href="index.php?page=usuarios" style="margin-top: 15px;" class="btn btn-warning" role="button" >Cancelar</a>
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
            txtUserName: {
                message: 'Este usuario es inválido',
                validators: {
                    notEmpty: {
                        message: 'Campo obligatorio, no puede estar vacio.'
                    },
                    stringLength: {
                        min: 3,
                        max: 30,
                        message: 'El usuario debe tener entre 6 y 30 caracteres.'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z_áéíóúñ\s]*$/,
                        message: 'Solo se aceptan letras.'
                    }
                }
            },
            txtApellido: {
              validators: {
                  notEmpty: {
                      message: 'Campo obligatorio, no puede estr vacio.'
                  },
                  stringLength: {
                      min: 3,
                      max: 30,
                      message: 'El apellido debe tener entre 6 y 30 caracteres.'
                  },
                  regexp: {
                      regexp: /^[a-zA-Z_áéíóúñ\s]*$/,
                      message: 'Solo se aceptan letras.'
                  }
              }
          },
            txtEmail: {
                validators: {
                    notEmpty: {
                        message: 'El correo es un campo obligatorio no puede estar vacio.'
                    },
                    emailAddress: {
                        message: 'Formato de correo incorrecta.'
                    }
                }
            },
            txtCargo: {
               validators: {
                 notEmpty: {
                   message: 'Campo obligatorio no puede estar vacio.'
                 }
               }
            },
            password: {
                validators: {
                    notEmpty: {
                        message: 'Contraseña obligatoria no puede estar vacia.'
                    },
                    identical: {
                        field: 'txtPasswordCnf',
                        message: 'La contraseña y su confirmación no son los mismos'
                    }
                }
            },
            txtPasswordCnf: {
                validators: {
                    notEmpty: {
                        message: 'La contraseña de confirmación es obligatoria y no puede estar vacía'
                    },
                    identical: {
                        field: 'password',
                        message: 'La contraseña y su confirmación no son los mismos'
                    }
                }
            },
        }
    });
});
</script>
