/**
* Obtiene una tabla con los triggers de una Tabla
*
* @category   SQL/PSM Stored Procedures
* @package    usp_Obtn_Triggers
* @copyright  Copyright 2014 Jorge Alberto Ponce Turrubiates
* @license    http://www.apache.org/licenses/LICENSE-2.0
* @version    1.0.0, 2014-09-01
* @author     Jorge Alberto Ponce Turrubiates (the.yorch@gmail.com)

* @param string pEsquema Esquema o * para todos los Esquemas
* @param string pTabla Tabla o * para todas las Tablas
* @return SQL Table
*/
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_Obtn_Triggers`(pEsquema varchar(255), pTabla varchar(255))
BEGIN
	SET @rownum := 0;

	IF (pEsquema = '*') THEN
		SELECT @rownum := @rownum + 1 AS id 
			,TRIGGER_SCHEMA AS esquema
			,EVENT_OBJECT_TABLE AS tabla
			,TRIGGER_NAME AS disparador
			,'' AS descripcion
		FROM INFORMATION_SCHEMA.TRIGGERS
		WHERE TRIGGER_SCHEMA NOT IN ('information_schema', 'mysql', 'performance_schema', 'test')
		AND 1 = (CASE WHEN pTabla = '*' THEN 1
				 ELSE (CASE WHEN EVENT_OBJECT_TABLE = pTabla THEN 1 ELSE 0 END)
				 END) 
		ORDER BY EVENT_OBJECT_TABLE;
	ELSE
		SELECT @rownum := @rownum + 1 AS id 
			,TRIGGER_SCHEMA AS esquema
			,EVENT_OBJECT_TABLE AS tabla
			,TRIGGER_NAME AS disparador
			,'' AS descripcion
		FROM INFORMATION_SCHEMA.TRIGGERS
		WHERE TRIGGER_SCHEMA = pEsquema
		AND 1 = (CASE WHEN pTabla = '*' THEN 1
				 ELSE (CASE WHEN EVENT_OBJECT_TABLE = pTabla THEN 1 ELSE 0 END)
				 END) 
		ORDER BY EVENT_OBJECT_TABLE;
	END IF;
END$$
DELIMITER ;