<h1>Listado de Empresas</h1>
<hr />
  <div class="container">
     <div class="col-md-3">
          <form method="post" action="index.php?page=listadoEmpresa" >
                <div class="input-group">

                    <input class="form-control" id="system-search" name="q" placeholder="Search for" required>
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
                    </span>
                </div>
            </form>
        </div></br></br></br>
        <button id="btnExport">Exportar a pdf</button>
        <br />
        <br />
	   <div class="row">
<div class="col-md-9" id="table_wrapper">
<table class="table table-list-search" id="example-table" >
  <thead>
  <tr>
    <th>
      Nombre de Empresa o Razon Social
    </th>
    <th>
      Nombre Representante legal
    </th>
    <th>
      Nombre Comercial
    </th>
    <th>
      Nombre RTN
    </th>
    <th>
      Numero Contratos
    </th>
    <th>
      &nbsp;
    </th>
  </tr>
    </thead>
    <tbody>


  {{foreach tblempresa}}
      <tr>
        <td>
          {{EmpresaNombre}}
        </td>
        <td>
          {{EmpresaRepresentante}}
        </td>
        <td>
          {{EmpresaComercial}}
        </td>
        <td>
          {{EmpresaRTN}}
        </td>
        <td>
          {{CantidadContratos}}
        </td>
        <td>
          <a class="btn" title="Editar Empresa" role="button"
            href="index.php?page=empresa2&mode=UPD&EmpresaCodigo={{EmpresaCodigo}}"
          >
            <span class="glyphicon glyphicon-edit"></span>
          </a>
          <a class="btn" title="Eliminar Empresa" role="button"
            href="index.php?page=empresa2&mode=DLT&EmpresaCodigo={{EmpresaCodigo}}"
          >
            <span class="glyphicon glyphicon-trash"></span>
          </a>
          <a class="btn" title="Ver Contratos" role="button"
            href="index.php?page=VerContratos&mode=Ver&EmpresaCodigo={{EmpresaCodigo}}"
          >
          <span class="glyphicon glyphicon-eye-open"></span>
          </a>
          <a class="btn" title="Agregar Contratos" role="button"
            href="index.php?page=contrato&mode=AGR&EmpresaCodigo={{EmpresaCodigo}}"
          >
          <span class="glyphicon glyphicon-plus"></span>
          </a>
        </td>
      </tr>
  {{endfor tblempresa}}
    </tbody>
</table>
</div>
</div>
</div>
<div class="paging"></div>
<a class="btn btn-primary pull-right" role="button"
  href="index.php?page=empresa&mode=INS">
      <span class="glyphicon glyphicon-plus"></span>
       &nbsp;Agregar Nueva Empresa
</a>



<script type="text/javascript" src="public/js/datatable.min.js"></script>
  <script type="text/javascript" src="public/js/datatable.jquery.min.js"></script>
<script type="text/javascript">

$(document).ready(function() {
    var activeSystemClass = $('.list-group-item.active');

    $('#system-search').keyup( function() {
       var that = this;

        var tableBody = $('.table-list-search tbody');
        var tableRowsClass = $('.table-list-search tbody tr');
        $('.search-sf').remove();
        tableRowsClass.each( function(i, val) {


            var rowText = $(val).text().toLowerCase();
            var inputText = $(that).val().toLowerCase();
            if(inputText != '')
            {
                $('.search-query-sf').remove();
                tableBody.prepend('<tr class="search-query-sf"><td colspan="6"><strong>Searching for: "'
                    + $(that).val()
                    + '"</strong></td></tr>');
            }
            else
            {
                $('.search-query-sf').remove();
            }

            if( rowText.indexOf( inputText ) == -1 )
            {

                tableRowsClass.eq(i).hide();

            }
            else
            {
                $('.search-sf').remove();
                tableRowsClass.eq(i).show();
            }
        });

        if(tableRowsClass.children(':visible').length == 0)
        {
            tableBody.append('<tr class="search-sf"><td class="text-muted" colspan="6">No entries found.</td></tr>');
        }
    });

    $('#example-table').datatable({
        pageSize: 5,
        sort: [true, true, false],
    }) ;

    $("#btnExport").click(function(e) {
      e.preventDefault();


      var data_type = 'data:application/vnd.ms-word';
      var table_div = document.getElementById('table_wrapper');
      var table_html = table_div.outerHTML.replace(/ /g, '%20');

      var a = document.createElement('a');
      a.href = data_type + ', ' + table_html;
      a.download = 'exported_table_' + Math.floor((Math.random() * 9999999) + 1000000) + '.doc';
      a.click();
    });
});
	</script>
