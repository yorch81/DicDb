/**
* Obtiene una tabla con los Procedimientos Almacenados de un Esquema
*
* @category   SQL/PSM Stored Procedures
* @package    usp_Obtn_Procedimientos
* @copyright  Copyright 2014 Jorge Alberto Ponce Turrubiates
* @license    http://www.apache.org/licenses/LICENSE-2.0
* @version    1.0.0, 2014-09-01
* @author     Jorge Alberto Ponce Turrubiates (the.yorch@gmail.com)

* @param string pEsquema Esquema o * para todos los Esquemas
* @return SQL Table
*/
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_Obtn_Procedimientos`(pEsquema varchar(255))
BEGIN
	SET @rownum := 0;

	IF (pEsquema = '*') THEN
		SELECT @rownum := @rownum + 1 AS id 
			,ROUTINE_SCHEMA AS esquema
			,ROUTINE_NAME AS objeto
			,ROUTINE_COMMENT AS descripcion
		FROM INFORMATION_SCHEMA.ROUTINES
		WHERE ROUTINE_TYPE = 'PROCEDURE'
		AND ROUTINE_SCHEMA NOT IN ('information_schema', 'mysql', 'performance_schema', 'test');
	ELSE
		SELECT @rownum := @rownum + 1 AS id 
			,ROUTINE_SCHEMA AS esquema
			,ROUTINE_NAME AS objeto
			,ROUTINE_COMMENT AS descripcion
		FROM INFORMATION_SCHEMA.ROUTINES
		WHERE ROUTINE_TYPE = 'PROCEDURE'
		AND ROUTINE_SCHEMA = pEsquema;
	END IF;
END$$
DELIMITER ;

