<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Jorge Alberto Ponce Turrubiates">
    <link rel="shortcut icon" type="image/x-icon" href="./img/favicon.ico">

    <title>DicDb Data Dictionary</title>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link href="./metro-bootstrap/dist/css/metro-bootstrap.min.css" rel="stylesheet">

    <style>
    body {
      padding-top: 5px;
      padding-bottom: 5px;
    }

    .navbar {
      margin-bottom: 5px;
    }

    .list-group-item {
      padding: 4px 10px;
    }

    .tooltip > .tooltip-inner {
      background-color: #428bca;
    }

    .scroll-500{
        height: 500px;
        border-top: solid 1px #BBB;
        border-left: solid 1px #BBB;
        border-bottom: solid 1px #FFF;
        border-right: solid 1px #FFF;
        background: #FFF;
        overflow: scroll;
        padding: 5px;
      }

    .jumbotron{
        padding: 15px;
      }
    </style>
  </head>
  <body>
    <div class="container">

      <!-- Static navbar -->
      <div class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
            </button>
            <a class="navbar-brand" href="#">DicDb</a>
          </div>

          <ul class="nav navbar-nav navbar-right">
            <li class="active" id="btn_credits"><a href="#">Créditos<span class="sr-only">(current)</span></a></li>
          </ul>
        </div><!--/.container-fluid -->
      </div>

      <div class="jumbotron">  
        <div class="row">
          <div class="col-md-4 col-lg-4">
          </div>

          <div class="col-md-8 col-lg-8">
            <ul class="nav nav-pills nav-justified">
              <li class="active" id="tab_tablas"><a href="#">Tablas</a>
              </li>
              <li id="tab_rutinas"><a href="#">Rutinas</a>
              </li>
            </ul>
          </div>
        </div>    

        <div class="row">

          <div class="col-md-4 col-lg-4">
            <div id="cnt_esquemas" class="scroll-500">
              <div class="list-group">
                <a href="#" data-toggle="tooltip" data-placement="right" title="Esquemas" class="list-group-item active dicdb-tooltip" dicdb-type="0" tblId="0" dicdb-comment="Esquemas">Esquemas</a>
                <div id="pnl_esquemas">
                  <?php 
                    echo $data['esquemas'];
                  ?>
                </div>
              </div>
            </div>
          </div>

          <div id="opt_tablas">
            <div class="col-md-4 col-lg-4">
              <div id="cnt_tablas" class="scroll-500">
                <div class="list-group">
                  <a href="#" data-toggle="tooltip" data-placement="right" title="Tablas" class="list-group-item active dicdb-tooltip" dicdb-type="0" tblId="0" dicdb-comment="Tablas">Tablas & Vistas</a>
                  <div id="pnl_tablas">
                    
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-4 col-lg-4">
              <div id="cnt_campos" class="scroll-500">
                <div class="list-group">
                  <a href="#" data-toggle="tooltip" data-placement="right" title="Campos" class="list-group-item active dicdb-tooltip" dicdb-type="0" tblId="0" dicdb-comment="Campos">Campos</a>
                  <div id="pnl_campos">
                    
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div id="opt_rutinas">
            <div class="col-md-4 col-lg-4">
              <div id="cnt_procedimientos" class="scroll-500">
                <div class="list-group">
                  <a href="#" data-toggle="tooltip" data-placement="right" title="Tablas" class="list-group-item active dicdb-tooltip" dicdb-type="0" tblId="0" dicdb-comment="Procedimientos">Procedimientos</a>
                  <div id="pnl_procedimientos">
                    
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-4 col-lg-4">
              <div id="cnt_funciones" class="scroll-500">
                <div class="list-group">
                  <a href="#" data-toggle="tooltip" data-placement="right" title="Campos" class="list-group-item active dicdb-tooltip" dicdb-type="0" tblId="0" dicdb-comment="Funciones">Funciones</a>
                  <div id="pnl_funciones">
                    
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div> <!-- row -->
      </div> <!-- jumbotron -->
    </div> <!-- container -->

    <!-- Static Modal Update Description -->
    <div class="modal fade" id="window-update" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Actualizar Descripción</h4>
              </div>

              <div class="modal-body">
                <label for="txtDescription">Descripción:</label>
                <textarea id="txtDescription"class="form-control" rows="4" required></textarea>
                <br>
                <button id="btn_update" class="btn btn-lg btn-primary btn-block">Actualizar</button>
              </div>
            </div>
        </div>
    </div>

    <!-- Static Modal Credits -->
    <div class="modal fade" id="window-credits" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Créditos</h4>
                 </div>

                <div class="modal-body">
                    <center>
                        <p><h3>Jorge Alberto Ponce Turrubiates</h3></p>
                        <p><h5><a href="mailto:the.yorch@gmail.com<">the.yorch@gmail.com</a></h5></p>
                        <p><h5><a href="http://the-yorch.blogspot.mx/">Blog</a></h5></p>
                        <p><h5><a href="https://bitbucket.org/yorch81">BitBucket</a></h5></p>
                        <p><h5><a href="https://github.com/yorch81">GitHub</a></h5></p>
                        <p></p>
                    </center>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="./metro-bootstrap/bootstrap.min.js"></script>
    <script src="./metro-bootstrap/bootstrap-tooltip.js"></script>

    <script>
      $(document).ready(function(){
        // Aplicar ToolTip
        $(".dicdb-tooltip").tooltip();

        // Ocultar Rutinas
        $('#opt_rutinas').hide();

        // Obtener HTML Tablas
        function htmlTablas(esquema) {
          url = "./htmltablas/" + esquema;

          $.get(url, function(response, status){
                $("#pnl_tablas").html(response);
                $(".dicdb-tooltip").tooltip();
              }).error(
                    function(){
                        console.log('Application not responding');
                    });
        }

        // Obtener HTML Procedimientos
        function htmlProcedimientos(esquema) {
          url = "./htmlproc/" + esquema;

          $.get(url, function(response, status){
                $("#pnl_procedimientos").html(response);
                $(".dicdb-tooltip").tooltip();
              }).error(
                    function(){
                        console.log('Application not responding');
                    });
        }

        // Obtener HTML Funciones
        function htmlFunciones(esquema) {
          url = "./htmlfunc/" + esquema;

          $.get(url, function(response, status){
                $("#pnl_funciones").html(response);
                $(".dicdb-tooltip").tooltip();
              }).error(
                    function(){
                        console.log('Application not responding');
                    });
        }

        // Obtener HTML Campos
        function htmlCampos (esquema, tabla) {
          url = "./htmlcampos/" + esquema + "/" + tabla;

          $.get(url, function(response, status){
                $("#pnl_campos").html(response);
                $(".dicdb-tooltip").tooltip();
              }).error(
                    function(){
                        console.log('Application not responding');
                    });
        }

        // Actualizar Comentarios
        function actComentarios (esquema, tabla, campo, descripcion, tipo) {
          $.post('./actualizar', {esquema:esquema, tabla:tabla, campo:campo, descripcion:descripcion, tipo:tipo},
                        function(response) {
                          console.log(response);
                    }).error(
                        function(){
                            console.log('Error executing Post');
                        }
                    );
        }

        // Simple Click
        $(document).on('click', '.dicdb-tooltip', function(){
          tipo = $(this).attr("dicdb-type");
          objeto = $(this).attr("dicdb-name");
          arrObjeto = objeto.split('.');

          switch (tipo) {
            case '1': // Filtrar Tablas y Rutinas
              htmlTablas(arrObjeto[0]); 
              htmlProcedimientos(arrObjeto[0]); 
              htmlFunciones(arrObjeto[0]); 
              break;

            case '2': // Filtrar Campos
              htmlCampos(arrObjeto[0], arrObjeto[1]); 
              break;
          }
        });

        // Double Click
        $(document).on('dblclick', '.dicdb-tooltip', function(event){
          event.preventDefault();

          tipo = $(this).attr("dicdb-type");
          objeto = $(this).attr("dicdb-name");
          comentario = $(this).attr("dicdb-comment");

          arrObjeto = objeto.split('.');

          $('#txtDescription').val(comentario);
          $('#txtDescription').attr("dicdb-type", tipo); 
          $('#txtDescription').attr("dicdb-name", objeto); 

          $('#window-update').modal('toggle');

          $('#txtDescription').focus();                        
        });

        // Actualizar
        $("#btn_update").click(function() {
          tipo = $('#txtDescription').attr("dicdb-type");
          objeto = $('#txtDescription').attr("dicdb-name");
          arrObjeto = objeto.split('.');

          switch (tipo) {
            case '1': // Esquemas
              actComentarios (arrObjeto[0], '', '', $('#txtDescription').val(), 1);
              break;

            case '2': // Tablas
              actComentarios (arrObjeto[0], arrObjeto[1], '', $('#txtDescription').val(), 2);
              break;

            case '3': // Campos
              actComentarios (arrObjeto[0], arrObjeto[1], arrObjeto[2], $('#txtDescription').val(), 3);
              break;

            case '4': // Procedimientos
              actComentarios (arrObjeto[0], arrObjeto[1], '', $('#txtDescription').val(), 4);
              break;

            case '5': // Funciones
              actComentarios (arrObjeto[0], arrObjeto[1], '', $('#txtDescription').val(), 5);
              break;
          }

          $('#window-update').modal('hide');
        });

        // Créditos
        $("#btn_credits").click(function() {
          $('#window-credits').modal('toggle');
        });

        // Tab Tablas
        $("#tab_tablas").click(function() {
          $('#opt_tablas').show();
          $('#opt_rutinas').hide();

          $("#tab_tablas").addClass("active");
          $("#tab_rutinas").removeClass("active");
          
        });

        // Tab Rutinas
        $("#tab_rutinas").click(function() {
          $('#opt_tablas').hide();
          $('#opt_rutinas').show();

          $("#tab_rutinas").addClass("active");
          $("#tab_tablas").removeClass("active");
        });

      });
    </script>
  </body>
</html>