/**
* Obtiene una tabla con los campos de una Tabla
*
* @category   SQL/PSM Stored Procedures
* @package    usp_Obtn_Campos
* @copyright  Copyright 2014 Jorge Alberto Ponce Turrubiates
* @license    http://www.apache.org/licenses/LICENSE-2.0
* @version    1.0.0, 2014-09-01
* @author     Jorge Alberto Ponce Turrubiates (the.yorch@gmail.com)

* @param string pEsquema Esquema o * para todos los Esquemas
* @param string pTabla Tabla o * para todas las Tablas
* @return SQL Table
*/
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_Obtn_Campos`(pEsquema varchar(255), pTabla varchar(255))
BEGIN
	SET @rownum := 0;

	IF (pEsquema = '*') THEN
		SELECT @rownum := @rownum + 1 AS id 
			,TABLE_SCHEMA AS esquema
			,TABLE_NAME AS tabla
			,COLUMN_NAME AS campo
			,COLUMN_TYPE AS tipo
			,COLUMN_COMMENT AS descripcion
		FROM INFORMATION_SCHEMA.COLUMNS
		WHERE TABLE_SCHEMA NOT IN ('information_schema', 'mysql', 'performance_schema', 'test')
		AND 1 = (CASE WHEN pTabla = '*' THEN 1
				 ELSE (CASE WHEN TABLE_NAME = pTabla THEN 1 ELSE 0 END)
				 END) 
		ORDER BY TABLE_NAME, ORDINAL_POSITION;
	ELSE
		SELECT @rownum := @rownum + 1 AS id 
			,TABLE_SCHEMA AS esquema
			,TABLE_NAME AS tabla
			,COLUMN_NAME AS campo
			,COLUMN_TYPE AS tipo
			,COLUMN_COMMENT AS descripcion
		FROM INFORMATION_SCHEMA.COLUMNS
		WHERE TABLE_SCHEMA = pEsquema
		AND 1 = (CASE WHEN pTabla = '*' THEN 1
				 ELSE (CASE WHEN TABLE_NAME = pTabla THEN 1 ELSE 0 END)
				 END) 
		ORDER BY TABLE_NAME, ORDINAL_POSITION;
	END IF;
END$$
DELIMITER ;