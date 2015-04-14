# DicDb #

## Description ##
Maneja Diccionario de Datos para SQL Server y MySQL, mediante una clase abstracta
y usando el Patrón de Diseño Singleton.

## Requirements ##
* [PHP 5.4.1 or higher](http://www.php.net/)
* [mysqli extension](http://www.php.net/)
* [sqlsrv extension](http://msdn.microsoft.com/en-us/sqlserver/ff657782.aspx/)
* [Metro Bootstrap](http://talkslab.github.io/metro-bootstrap/)
* [Slim Framework](http://www.slimframework.com/)

## Developer Documentation ##
En el código con phpDoc.

## Installation ##
Clonar repositorio de Github, crear la base de datos dicdb, para crear las tablas donde se
guardaran los comentarios de Esquemas y Vistas ejecutando los scripts del directorio SQL para
MySQL y SQL Server respectivamente.

Ejecutar composer.phar install para instalar las dependencias necesarias.

Crear en el directorio clases un script config.php, con la siguiente estructura:

<?php
$dbtype   = 'MYSQL'; // 'MSSQLSERVER'
$hostname = 'localhost';
$username = 'myuser';
$password = 'mypassword';
$dbname   = 'dicdb';
?>

## Basic Example ##
Ver example.php

## Notes ##
La conexión a SQL Server solo funciona en MS Windows.
Para MySQL ejecutar los scripts en la BD dicdb.
MySQL no soporta comentarios para schemas, ni vistas.

## References ##
http://es.wikipedia.org/wiki/Singleton
http://msdn.microsoft.com/es-es/library/ms179853.aspx
http://msdn.microsoft.com/es-es/library/ms180047.aspx
http://msdn.microsoft.com/es-es/library/ms186885.aspx
http://dev.mysql.com/doc/refman/5.0/es/information-schema-tables.html

P.D. Let's go play !!!




