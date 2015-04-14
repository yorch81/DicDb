# DicDb Maneja y actualiza comentarios de objetos en una BD SQL Server o MySQL #

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
Copiar directorio o clonar repositorio.
Ejecutar los scripts de los procedimientos almacenados para SQL Server y MySQL (directorio /SQL/).

## Basic Example ##
Ver example.php

## Notes ##
La conexión a SQL Server solo funciona en MS Windows.
Para MySQL ejecutar los scripts en la BD test.
MySQL no soporta comentarios para schemas para eso se 
usa la tabla esquemas del esquema dicdb.

## References ##
http://es.wikipedia.org/wiki/Singleton
http://msdn.microsoft.com/es-es/library/ms179853.aspx
http://msdn.microsoft.com/es-es/library/ms180047.aspx
http://msdn.microsoft.com/es-es/library/ms186885.aspx
http://dev.mysql.com/doc/refman/5.0/es/information-schema-tables.html




