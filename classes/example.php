<?php
require '../vendor/autoload.php';
require_once('config.php');
require_once('DicDb.class.php');

$dic = DicDb::getInstance(DicDb::MSSQLSERVER, $hostname, $username, $password, $dbname);  

echo "ESQUEMAS \n";
print_r($dic->obtnEsquemas());

echo "TABLAS \n";
print_r($dic->obtnTablas('dbo'));

echo "PROCEDIMIENTOS \n";
print_r($dic->obtnProcedimientos('dbo'));

echo "FUNCIONES \n";
print_r($dic->obtnFunciones('dbo'));

echo "CAMPOS \n";
print_r($dic->obtnCampos('dbo', 'tabla'));

echo "TRIGGERS \n";
print_r($dic->obtnTriggers('Adquisicion', '*'));

echo "ACTUALIZAR COMENTARIOS \n";
$dic->actDescripcion('Adquisicion', 'Cat_Cancelaciones', '', 'desde DicDb', 2);

?>