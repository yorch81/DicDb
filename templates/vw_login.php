<!DOCTYPE html>
<html lang="en">
  <head>
    <title>DicDb Login</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Login for DicDb">
    <meta name="author" content="Jorge Alberto Ponce Turrubiates">
  
    <link rel="shortcut icon" type="image/x-icon" href="./img/favicon.ico">
    
    <link href="./metro-bootstrap/dist/css/metro-bootstrap.min.css" rel="stylesheet">   

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
      
    <style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #fff;
      }
      
      .form-signin {
        max-width: 330px;
        padding: 15px;
        margin: 0 auto;
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin .checkbox {
        font-weight: normal;
      }
      .form-signin .form-control {
        position: relative;
        height: auto;
        -webkit-box-sizing: border-box;
           -moz-box-sizing: border-box;
                box-sizing: border-box;
        padding: 10px;
        font-size: 16px;
      }
      .form-signin .form-control:focus {
        z-index: 2;
      }
      .form-signin input[type="email"] {
        margin-bottom: -1px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
      }
      .form-signin input[type="password"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
      }
    </style>
  </head>

  <body>
    <div class="container">
      <form class="form-signin" role="form" action="./login" method="POST">
        <h2 class="form-signin-heading">DicDb Login</h2>
        <input type="text" class="form-control" placeholder="Application User" name="txtUser" required autofocus>
        <input type="password" class="form-control" placeholder="Application Password" name="txtPassword" required>
      
        <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
      </form>
    </div>    
  </body>
</html>