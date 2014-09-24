<?php
require 'Slim/Slim.php';
require_once('../classes/config.php');
require_once('../classes/DicDb.class.php');

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

$dicDb = DicDb::getInstance(DicDb::MSSQLSERVER, $hostname, $username, $password, $dbname);  

// Root
$app->get(
    '/',
    function () use ($app) {
        $app->redirect('./dicdb');
    }
);

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

            if (!$tabla){
                throw new ResourceNotFoundException();
            }

            if (!$campo){
                throw new ResourceNotFoundException();
            }

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

// DicDb
$app->get("/dicdb", 
    function () use ($app, $dicDb) {
        $arrEsquemas = $dicDb->obtnEsquemas();

        $app->view()->setData(array('esquemas' => $arrEsquemas));
        
        $app->render('vw_dicdb.php');
    }
);

$app->run();
