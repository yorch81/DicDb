/**
* Obtiene una tabla con los Esquemas de una BD
*
* @category   SQL/PSM Stored Procedures
* @package    uusp_Obtn_Esquemas
* @copyright  Copyright 2014 Jorge Alberto Ponce Turrubiates
* @license    http://www.apache.org/licenses/LICENSE-2.0
* @version    1.0.0, 2014-09-01
* @author     Jorge Alberto Ponce Turrubiates (the.yorch@gmail.com)

* @param (No Parameters)
* @return SQL Table
*/
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_Obtn_Esquemas`()
BEGIN
	SET @rownum := 0;

	SELECT @rownum := @rownum + 1 AS id
		,SCHEMA_NAME AS esquema
		,esquema_com(SCHEMA_NAME) AS descripcion
	FROM INFORMATION_SCHEMA.SCHEMATA
	WHERE SCHEMA_NAME NOT IN ('information_schema', 'mysql', 'performance_schema', 'test')
	ORDER BY SCHEMA_NAME;
END$$
DELIMITER ;