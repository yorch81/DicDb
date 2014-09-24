<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Jorge Alberto Ponce Turrubiates">
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
      padding-top: 20px;
      padding-bottom: 20px;
    }

    .navbar {
      margin-bottom: 10px;
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
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">DicDb</a>
          </div>
        </div><!--/.container-fluid -->
      </div>

      <div class="jumbotron">      
        <div class="row">
          <div class="col-md-4 col-lg-4">
            <div id="cnt_esquemas">
              <div class="list-group">
                <a href="#" data-toggle="tooltip" title="Esquemas" class="list-group-item active tbl_esquemas" tbltype= "1" tblId="0" tblComment="Esquemas">Esquemas</a>
                <?php 
                  $arrEsquemas = $data['esquemas'];
                  $total = count($arrEsquemas);

                  for($i=0; $i<$total; $i++){
                    echo '<a href="#" data-toggle="tooltip" class="list-group-item tbl_esquemas" tbltype= "1" tblId="'.  $arrEsquemas[$i]["id"] . 
                    '" title="'.  $arrEsquemas[$i]["descripcion"] . '" ' . '" tblComment="'.  $arrEsquemas[$i]["descripcion"] . '">'  . $arrEsquemas[$i]["esquema"] . "</a>";
                  }
                ?>
              </div>
            </div>
          </div>

          <div class="col-md-4 col-lg-4">
            <div id="tab_tablas">
              <div class="list-group">
                <a href="#" class="list-group-item active">
                  Tablas
                </a>
                <a href="#" class="list-group-item">Dapibus ac facilisis in</a>
                <a href="#" class="list-group-item">Morbi leo risus</a>
                <a href="#" class="list-group-item">Porta ac consectetur ac</a>
                <a href="#" class="list-group-item">Vestibulum at eros</a>
              </div>
            </div>
          </div>

          <div class="col-md-4 col-lg-4">
            <div id="tab_tablas">
              <div class="list-group">
                <a href="#" class="list-group-item active">
                  Tablas
                </a>
                <a href="#" class="list-group-item">Dapibus ac facilisis in</a>
                <a href="#" class="list-group-item">Morbi leo risus</a>
                <a href="#" class="list-group-item">Porta ac consectetur ac</a>
                <a href="#" class="list-group-item">Vestibulum at eros</a>
              </div>
            </div>
          </div>
        </div>

    </div> <!-- /container -->

    <div class="modal modal-static fade" id="processing-modal" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="text-center">
                        <button type="button" class="close" style="float: none;" data-dismiss="modal" aria-hidden="true">×</button>
                        <h5 id="label-process">Procesando...</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="./metro-bootstrap/bootstrap.min.js"></script>
    <script src="./metro-bootstrap/bootstrap-tooltip.js"></script>

    <script>
      $(document).ready(function(){
        $(".tbl_esquemas").tooltip();

        $(".tbl_esquemas").click(function(){
          alert($(this).attr("tblComment"));

          $('#processing-modal').modal('toggle');
        });
      });
    </script>
  </body>
</html>