/**
* Actualiza la descripcion de un Objeto de la BD
*
* @category   SQL/PSM Stored Procedures
* @package    usp_ActDescripcion
* @copyright  Copyright 2014 Jorge Alberto Ponce Turrubiates
* @license    http://www.apache.org/licenses/LICENSE-2.0
* @version    1.0.0, 2014-09-01
* @author     Jorge Alberto Ponce Turrubiates (the.yorch@gmail.com)

* @param string pEsquema Esquema
* @param string pTabla Objeto de BD (Tabla, Procedimiento, Funcion, Vista)
* @param string pCampo Campo
* @param string pDescripcion Nueva descripcion
* @param int pTipo Tipo de Objeto (1 Esquema, 2 Tabla, 3 Campo, 4 Procedimiento, 5 Funcion, 6 Vista, 7 Trigger)
* @return SQL Table
*/
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_ActDescripcion`(pEsquema varchar(255), pTabla varchar(255), pCampo varchar(255), pDescripcion varchar(255), pTipo int(11))
BEGIN
	IF (pTipo = 1) THEN -- ESQUEMAS
		SELECT 'NOT IMPLEMENTED' AS MSJ;
	ELSEIF (pTipo = 2) THEN -- TABLAS
		SET @vDynSQL :=  CONCAT('ALTER TABLE `', pEsquema, '`.`', pTabla, '` COMMENT = \'', pDescripcion, '\'');
		
		PREPARE stmt FROM @vDynSQL;
		EXECUTE stmt;
		DEALLOCATE PREPARE stmt;

		SELECT 'IMPLEMENTED' AS MSJ;
	ELSEIF (pTipo = 3) THEN -- CAMPOS
		SET @vDynSQL := '';

		SELECT @vDynSQL := CONCAT('ALTER TABLE `',
			table_schema,
			'`.`',
			table_name,
			'` CHANGE `',
			column_name,
			'` `',
			column_name,
			'` ',
			column_type,
			' ',
			IF(is_nullable = 'YES', '' , 'NOT NULL '),
			IF(column_default IS NOT NULL, concat('DEFAULT ', IF(column_default = 'CURRENT_TIMESTAMP', column_default, CONCAT('\'',column_default,'\'') ), ' '), ''),
			IF(column_default IS NULL AND is_nullable = 'YES' AND column_key = '' AND column_type = 'timestamp','NULL ', ''),
			IF(column_default IS NULL AND is_nullable = 'YES' AND column_key = '','DEFAULT NULL ', ''),
			extra,
			' COMMENT \'',
			pDescripcion,
			'\' ;') as script
		FROM information_schema.columns
		WHERE table_schema = pEsquema
		AND table_name = pTabla
		AND column_name = pCampo
		ORDER BY table_name , column_name;

		PREPARE stmt FROM @vDynSQL;
		EXECUTE stmt;
		DEALLOCATE PREPARE stmt;

		SELECT 'IMPLEMENTED' AS MSJ;
	ELSEIF (pTipo = 4) THEN -- PROCEDIMIENTOS
		SELECT 'NOT IMPLEMENTED' AS MSJ;

		/*SELECT CONCAT('DROP PROCEDURE IF EXISTS `', pEsquema, '`.`', pTabla, '`') AS DROP_OBJECT;

		SET @vDynSQL := CONCAT('CREATE PROCEDURE ', '`', pEsquema, '`.`', pTabla, '`');
		SET @vBody := '';

		SET @vBody := (SELECT ROUTINE_DEFINITION
			FROM INFORMATION_SCHEMA.ROUTINES
			WHERE ROUTINE_TYPE = 'PROCEDURE'
			AND ROUTINE_SCHEMA = pEsquema
			AND ROUTINE_NAME = pTabla);

		SET @vDynSQL := CONCAT(@vDynSQL, '\n(', obtn_params (pEsquema,pTabla), ')\n COMMENT \'', pDescripcion, '\'\n');

		SET @vDynSQL := CONCAT(@vDynSQL,@vBody);

		SELECT @vDynSQL AS CREATE_OBJECT;
		*/
	ELSEIF (pTipo = 5) THEN -- FUNCIONES
		SELECT 'NOT IMPLEMENTED' AS MSJ;

		/*SELECT CONCAT('DROP FUNCTION IF EXISTS `', pEsquema, '`.`', pTabla, '`') AS DROP_OBJECT;

		SET @vDynSQL := CONCAT('CREATE FUNCTION ', '`', pEsquema, '`.`', pTabla, '` ');
		SET @vBody := '';
		SET @vReturn := '';

		SET @vBody := (SELECT ROUTINE_DEFINITION
			FROM INFORMATION_SCHEMA.ROUTINES
			WHERE ROUTINE_TYPE = 'FUNCTION'
			AND ROUTINE_SCHEMA = pEsquema
			AND ROUTINE_NAME = pTabla);
		
		SELECT CONCAT(DATA_TYPE, CASE WHEN CHARACTER_MAXIMUM_LENGTH IS NULL THEN '' ELSE CONCAT('(',CHARACTER_MAXIMUM_LENGTH,')') END) INTO @vReturn
		FROM INFORMATION_SCHEMA.ROUTINES
		WHERE ROUTINE_TYPE = 'FUNCTION'
		AND ROUTINE_SCHEMA = pEsquema
		AND ROUTINE_NAME = pTabla;

		SET @vDynSQL := CONCAT(@vDynSQL, '\n(', obtn_params (pEsquema,pTabla), ') RETURNS ', @vReturn);

		SET @vDynSQL := CONCAT(@vDynSQL, '\nCOMMENT \'', pDescripcion, '\'\n');

		SET @vDynSQL := CONCAT(@vDynSQL, @vBody);

		SELECT @vDynSQL AS CREATE_OBJECT;
		*/
	ELSEIF (pTipo = 6) THEN -- VISTAS
		SELECT 'NOT IMPLEMENTED' AS MSJ;
	ELSEIF (pTipo = 7) THEN -- TRIGGERS
		SELECT 'NOT IMPLEMENTED' AS MSJ;
	ELSE
		SELECT 'NOT IMPLEMENTED' AS MSJ;
	END IF;
END$$
DELIMITER ;

