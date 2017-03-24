<div class="container">
    <div class="row">
        <section>
            <div class="col-lg-8 col-lg-offset-2">
              <form id="defaultForm" action="index.php?page=restablecerContrasena" method="post" class="form-horizontal">

                   <div class="form-group">
                     <label class="col-lg-3 control-label">Código:</label>
                       <div class="col-lg-5">
                          <input class="col8" type="hidden" name="txtUsuarioCodigo"  value="{{usuarioCodigo}}" />
                          {{usuarioCodigo}}
                        </div>
                     </div>

                         <div class="form-group">
                          <label class="col-lg-3 control-label">Nueva Contraseña:</label>
                            <div class="col-lg-5">
                            <input class="form-control" type="password" name="password" value="{{password}}" />
                          </div>
                        </div>

                        <div class="form-group">
                         <label class="col-lg-3 control-label">Confirmar Contraseña:</label>
                           <div class="col-lg-5">
                           <input class="form-control" type="password" name="txtPasswordCnf" value="{{txtPasswordCnf}}"/>
                         </div>
                       </div>

                       <div class="form-group">
                         <div class="col-lg-9 col-lg-offset-3">
                            <input type="submit" class="btn btn-primary"  style="margin-top: 15px;" name="btnGuardar" value="Guardar" />
                            &nbsp;
                            <a href="index.php?page=usuarios" style="margin-top: 15px;" class="btn btn-warning" role="button" >Cancelar</a>
                                     <input type="hidden" name="returnUrl" value="{{returnUrl}}"/>
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
