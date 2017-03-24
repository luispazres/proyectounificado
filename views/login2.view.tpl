{{if mostrarErrores}}
<ul class="error">
    {{foreach errores}}
        <li>{{errmsg}}</li>
    {{endfor errores}}
</ul>
{{endif mostrarErrores}}


  <center>
  <br>
  <tr>
    <h1>Inicio de Sesión</h1>
    <form action="index.php?page=login2" method="post">
      <label>Usuario:</label>
      <input type="text" name="txtUser" value="{{txtUser}}" placeholder="ejemplo@gmail.com"/></br>
      <label>Contraseña</label>
      <input type="password" name="txtPswd" value="{{txtPswd}}" placeholder="Contrasena">
        <br><input type="hidden" name="returnUrl" value="{{returnUrl}}"/>
      <br><input type="submit" name="btnLogin" value="Ingresar"/>
    </form>
  </tr>
  </center>
