/**
* Obtiene una tabla con las Tablas de un Esquema
*
* @category   SQL/PSM Stored Procedures
* @package    usp_Obtn_Tablas
* @copyright  Copyright 2014 Jorge Alberto Ponce Turrubiates
* @license    http://www.apache.org/licenses/LICENSE-2.0
* @version    1.0.0, 2014-09-01
* @author     Jorge Alberto Ponce Turrubiates (the.yorch@gmail.com)

* @param string pEsquema Esquema o * para todos los Esquemas
* @return SQL Table
*/
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_Obtn_Tablas`(pEsquema varchar(255))
BEGIN
	SET @rownum := 0;

	IF (pEsquema = '*') THEN
		SELECT @rownum := @rownum + 1 AS id 
			,TABLE_SCHEMA AS esquema
			,TABLE_NAME AS tabla
	        ,(CASE WHEN TABLE_TYPE = 'BASE TABLE' THEN 'T' ELSE 'V' END) AS tipo
			,TABLE_COMMENT AS descripcion
		FROM INFORMATION_SCHEMA.TABLES
		WHERE TABLE_SCHEMA NOT IN ('information_schema', 'mysql', 'performance_schema', 'test')
		/*AND TABLE_TYPE = 'BASE TABLE'*/;
	ELSE
		SELECT @rownum := @rownum + 1 AS id 
			,TABLE_SCHEMA AS esquema
			,TABLE_NAME AS tabla
	        ,(CASE WHEN TABLE_TYPE = 'BASE TABLE' THEN 'T' ELSE 'V' END) AS tipo
			,TABLE_COMMENT AS descripcion
		FROM INFORMATION_SCHEMA.TABLES
		WHERE TABLE_SCHEMA = pEsquema
		/*AND TABLE_TYPE = 'BASE TABLE'*/;
	END IF;
END$$
DELIMITER ;

