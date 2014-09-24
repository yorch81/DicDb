<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Jorge Alberto Ponce Turrubiates">
    <title>DicDb Data Dictionary</title>

    <!-- Bootstrap 
    <link href="./bootstrap-3.2.0-dist/css/bootstrap.min.css" rel="stylesheet">
    -->

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
      margin-bottom: 5px;
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
            <div id="tlb_esquemas">
              <div class="list-group">
                <a href="#" class="list-group-item active" tbltype= "1" tblId="0" tblComment="Esquemas">Esquemas</a>
                <?php 
                  $arrEsquemas = $data['esquemas'];
                  $total = count($arrEsquemas);

                  for($i=0; $i<$total; $i++){
                    echo '<a href="#" class="list-group-item" tbltype= "1" tblId="'.  $arrEsquemas[$i]["id"] . 
                    '" tblComment="'.  $arrEsquemas[$i]["descripcion"] . '">'  . $arrEsquemas[$i]["esquema"] . "</a>";
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
            <div id="esquemas">
              <ul class="nav nav-pills nav-stacked">
                <li class="active"><a href="#">Home</a></li>
                <li><a href="#">Profile</a></li>
                <li><a href="#">Messages</a></li>
              </ul>
            </div>
          </div>
        </div>

    </div> <!-- /container -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="./bootstrap-3.2.0-dist/js/bootstrap.min.js"></script>
  </body>
</html>