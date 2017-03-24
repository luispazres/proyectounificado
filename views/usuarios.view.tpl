{{if mostrarErrores}}
<ul class="error">
    {{foreach errores}}
        <li>{{errmsg}}</li>
    {{endfor errores}}
</ul>
{{endif mostrarErrores}}

<style media="screen">
  tr th{
    padding: 50px;
  }
</style>
<form class="" action="index.php?page=usuarios" method="post" class="tm-contact-form">
<h1>Usuarios</h1>
<hr />
<table>
  <tr>
    <th>
      Nombre
    </th>
    <th>
      Apellido
    </th>
    <th>
      Correo
    </th>
    <th>
      Cargo
    </th>
    <th>
      &nbsp;
    </th>
  </tr>
    <tbody>

  {{foreach tblusuarios}}
      <tr>
        <td>
          {{usuarioNombre}}
        </td>
        <td>
          {{usuarioApellido}}
        </td>
        <td>
          {{usuarioCorreo}}
        </td>
        <td>
          {{Cargo}}
        </td>
        <td>
          <a class="btn" title="Editar Usuario" role="button"
            href="index.php?page=usuarios2&mode=UPD&usuarioCodigo={{usuarioCodigo}}"
          >
            <span class="glyphicon glyphicon-pencil"></span>
          </a>
          <a class="btn" title="Eliminar Usuario" role="button"
            href="index.php?page=usuarios2&mode=DLT&usuarioCodigo={{usuarioCodigo}}"
          >
            <span class="glyphicon glyphicon-trash"></span>
          </a>
          <a class="btn" title="Eliminar Usuario" role="button"
            href="index.php?page=restablecerContrasena&mode=RTC&usuarioCodigo={{usuarioCodigo}}"
          >
            <span class="glyphicon glyphicon-cog"></span>
          </a>
        </td>
      </tr>
  {{endfor tblusuarios}}
    </tbody>
</table>
<a class="btn btn-primary pull-right" role="button"
  href="index.php?page=registrate&mode=INS">
      <span class="glyphicon glyphicon-plus"></span>
       &nbsp;Agregar Usuario
</a>
</form>
