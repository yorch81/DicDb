<?php
require "vendor/autoload.php";

require_once('classes/config.php');
require_once('classes/DicDb.class.php');
require_once('classes/Utils.class.php');

// Set Time Execution Limit
set_time_limit (600);

// Init Session
session_start();

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

// DicDb
$dicDb = null;

if ($dbtype == 'MSSQLSERVER') {
    $dicDb = DicDb::getInstance(DicDb::MSSQLSERVER, $hostname, $username, $password, $dbname, $port);
}
else {
    $dicDb = DicDb::getInstance(DicDb::MYSQL, $hostname, $username, $password, $dbname, $port);
}

// Root
$app->get(
    '/',
    function () use ($app, $dicDb) {
        $arrEsquemas = $dicDb->obtnEsquemas();
        $htmlEsquemas = Utils::getHtmlEsquemas($arrEsquemas);

        $app->view()->setData(array('esquemas' => $htmlEsquemas));

        if (isset($_SESSION["key"]))
            $app->render('vw_dicdb.php');
        else
            $app->redirect('./login');
    }
);

$app->get(
    '/exit',
    function () use ($app, $dicDb) {
        session_destroy();

        $app->redirect('./login');
    }
);

// Login View
$app->get("/login", 
    function () use ($app) {  
        if (isset($_SESSION["key"]))
            $app->redirect('./');

        $app->render('vw_login.php');
    }
);

// Login Post
$app->post(
    '/login',
    function () use ($app, $appUser, $appPassword) {
        $user = $app->request->post('txtUser');
        $password = $app->request->post('txtPassword');

        if ($user == $appUser && $password == $appPassword)
            $_SESSION["key"] = "DicDb";
        else
            $_SESSION["error"] = "User or Password is incorrect";

        if (isset($_SESSION["key"]))
            $app->redirect('./');
        else
            $app->redirect('./login');
    }
);

// Reporte PDF
$app->get(
    '/pdf/:esquema',
    function ($esquema) use ($app, $dicDb) {
        $app->response()->header('Content-Type', 'application/pdf');
        $app->response()->status(200);

        $dicDb->reporte($esquema, DicDb::PDF);
    }
);

// Reporte Excel
$app->get(
    '/excel/:esquema',
    function ($esquema) use ($app, $dicDb) {
        $app->response()->status(200);
        
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename=" ' . uniqid() . '.xls"');
        header('Cache-Control: max-age=0');

        $dicDb->reporte($esquema, DicDb::XLS);
    }
);

// Tablas HTML
$app->get("/htmltablas/:esquema", 
    function ($esquema) use ($app, $dicDb) {
        $arrTablas= $dicDb->obtnTablas($esquema);
        $htmlTablas= Utils::getHtmlTablas($arrTablas);

        echo $htmlTablas;
    }
);

// HTML Procedimientos
$app->get("/htmlproc/:esquema", 
    function ($esquema) use ($app, $dicDb) {
        $arrObjetos= $dicDb->obtnProcedimientos($esquema);
        $htmlObjetos= Utils::getHtmlProcedures($arrObjetos);

        echo $htmlObjetos;
    }
);

// HTML Funciones
$app->get("/htmlfunc/:esquema", 
    function ($esquema) use ($app, $dicDb) {
        $arrObjetos= $dicDb->obtnFunciones($esquema);
        $htmlObjetos= Utils::getHtmlFunctions($arrObjetos);

        echo $htmlObjetos;
    }
);

// Campos HTML
$app->get("/htmlcampos/:esquema/:tabla", 
    function ($esquema, $tabla) use ($app, $dicDb) {
        $arrCampos = $dicDb->obtnCampos($esquema, $tabla);
        $htmlCampos = Utils::getHtmlCampos($arrCampos);

        echo $htmlCampos;
    }
);

// API RESTFul
// Esquemas
$app->get(
    '/esquemas',
    function () use ($app, $dicDb){
        $app->response()->header('Content-Type', 'application/json');
        $app->response()->status(200);

        echo json_encode($dicDb->obtnEsquemas());
    }
);

// Tablas
$app->get(
    '/tablas/:esquema',
    function ($esquema) use ($app, $dicDb){
        try{
            if ($esquema){
                $app->response()->header('Content-Type', 'application/json');
                $app->response()->status(200);

                echo json_encode($dicDb->obtnTablas($esquema));
            }
            else {
                throw new ResourceNotFoundException();
            }
        }
        catch (ResourceNotFoundException $e) {
            $app->response()->status(404);
        } 
        catch (Exception $e) {
            $app->response()->status(400);
            $app->response()->header('X-Status-Reason', $e->getMessage());
        }
    }
);

// Procedimientos
$app->get(
    '/procedimientos/:esquema',
    function ($esquema) use ($app, $dicDb){
        try{
            if ($esquema){
                $app->response()->header('Content-Type', 'application/json');
                $app->response()->status(200);

                echo json_encode($dicDb->obtnProcedimientos($esquema));
            }
            else {
                throw new ResourceNotFoundException();
            }
        }
        catch (ResourceNotFoundException $e) {
            $app->response()->status(404);
        } 
        catch (Exception $e) {
            $app->response()->status(400);
            $app->response()->header('X-Status-Reason', $e->getMessage());
        }
    }
);

// Procedimientos
$app->get(
    '/funciones/:esquema',
    function ($esquema) use ($app, $dicDb){
        try{
            if ($esquema){
                $app->response()->header('Content-Type', 'application/json');
                $app->response()->status(200);

                echo json_encode($dicDb->obtnFunciones($esquema));
            }
            else {
                throw new ResourceNotFoundException();
            }
        }
        catch (ResourceNotFoundException $e) {
            $app->response()->status(404);
        } 
        catch (Exception $e) {
            $app->response()->status(400);
            $app->response()->header('X-Status-Reason', $e->getMessage());
        }
    }
);

// Campos
$app->get(
    '/campos/:esquema/:tabla',
    function ($esquema, $tabla) use ($app, $dicDb){
        try{
            if (!$esquema){
                throw new ResourceNotFoundException();
            }

            if (!$tabla){
                throw new ResourceNotFoundException();
            }

            $app->response()->header('Content-Type', 'application/json');
            $app->response()->status(200);

            echo json_encode($dicDb->obtnCampos($esquema, $tabla));
        }
        catch (ResourceNotFoundException $e) {
            $app->response()->status(404);
        } 
        catch (Exception $e) {
            $app->response()->status(400);
            $app->response()->header('X-Status-Reason', $e->getMessage());
        }
    }
);

// Triggers
$app->get(
    '/triggers/:esquema/:tabla',
    function ($esquema, $tabla) use ($app, $dicDb){
        try{
            if (!$esquema){
                throw new ResourceNotFoundException();
            }

            if (!$tabla){
                throw new ResourceNotFoundException();
            }

            $app->response()->header('Content-Type', 'application/json');
            $app->response()->status(200);

            echo json_encode($dicDb->obtnTriggers($esquema, $tabla));
        }
        catch (ResourceNotFoundException $e) {
            $app->response()->status(404);
        } 
        catch (Exception $e) {
            $app->response()->status(400);
            $app->response()->header('X-Status-Reason', $e->getMessage());
        }
    }
);

// Actualizar Comentarios de Objeto
$app->post(
    '/actualizar',
    function () use ($app, $dicDb) {
        $esquema = $app->request->post('esquema');
        $tabla = $app->request->post('tabla');
        $campo = $app->request->post('campo');
        $descripcion = $app->request->post('descripcion');
        $tipo = $app->request->post('tipo');

        try{
            if (!$esquema){
                throw new ResourceNotFoundException();
            }
            /*
            if (!$tabla){
                throw new ResourceNotFoundException();
            }

            if (!$campo){
                throw new ResourceNotFoundException();
            }
            */
            if (!$descripcion){
                throw new ResourceNotFoundException();
            }

            if (!$tipo){
                throw new ResourceNotFoundException();
            }

            $app->response()->status(200);
            
            $dicDb->actDescripcion($esquema, $tabla, $campo, $descripcion, $tipo);
        }
        catch (ResourceNotFoundException $e) {
            $app->response()->status(404);
        } 
        catch (Exception $e) {
            $app->response()->status(400);
            $app->response()->header('X-Status-Reason', $e->getMessage());
        }
    }
);

$app->run();
