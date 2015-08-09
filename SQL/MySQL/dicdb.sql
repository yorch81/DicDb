CREATE DATABASE `dicdb`;

-- MySQL dump 10.13  Distrib 5.5.44, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: dicdb
-- ------------------------------------------------------
-- Server version	5.5.44-0ubuntu0.14.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `esquemas`
--

DROP TABLE IF EXISTS `esquemas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `esquemas` (
  `id_esquemas` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id Consecutivo',
  `esquema` varchar(50) NOT NULL COMMENT 'Esquema de MySQL',
  `comentarios` varchar(255) NOT NULL COMMENT 'Comentarios del Esquema',
  PRIMARY KEY (`id_esquemas`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COMMENT='Comentarios de Esquemas (mysql not support)';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `esquemas`
--

LOCK TABLES `esquemas` WRITE;
/*!40000 ALTER TABLE `esquemas` DISABLE KEYS */;
INSERT INTO `esquemas` VALUES (4,'yorch','Esquema Yorch'),(5,'dicdb','Esquema DicDb (datos y rutinas de Aplicación)');
/*!40000 ALTER TABLE `esquemas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vistas`
--

DROP TABLE IF EXISTS `vistas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vistas` (
  `id_vistas` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id Consecutivo',
  `esquema` varchar(50) NOT NULL COMMENT 'Esquema al que pertenece la Vista',
  `vista` varchar(50) NOT NULL COMMENT 'Nombre de la Vista',
  `comentarios` varchar(255) NOT NULL COMMENT 'Comentarios de la Vista',
  PRIMARY KEY (`id_vistas`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COMMENT='Comentarios de Vistas (mysql not support)';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vistas`
--

LOCK TABLES `vistas` WRITE;
/*!40000 ALTER TABLE `vistas` DISABLE KEYS */;
INSERT INTO `vistas` VALUES (5,'dicdb','vw_esquemas','Vista para Esquemas DicDb'),(6,'dicdb','vista_com','Obtiene comentarios de Vistas');
/*!40000 ALTER TABLE `vistas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'dicdb'
--
/*!50003 DROP FUNCTION IF EXISTS `esquema_com` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `esquema_com`(pEsquema VARCHAR(100)) RETURNS varchar(255) CHARSET latin1
    COMMENT 'Obtiene comentarios de Esquema'
BEGIN
	SET @comentario := (SELECT comentarios FROM esquemas WHERE esquema = pEsquema);
	
	IF @comentario IS NULL THEN
		SET @comentario := '';
	END IF;

	RETURN @comentario;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `vista_com` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `vista_com`(pEsquema VARCHAR(100), pVista VARCHAR(100)) RETURNS varchar(255) CHARSET latin1
    COMMENT 'Obtiene comentarios de Vistas'
BEGIN
	SET @comentario := (SELECT comentarios FROM vistas WHERE esquema = pEsquema AND vista = pVista);
	
	IF @comentario IS NULL THEN
		SET @comentario := '';
	END IF;

	RETURN @comentario;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `usp_ActDescripcion` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_ActDescripcion`(pEsquema varchar(255), pTabla varchar(255), pCampo varchar(255), pDescripcion varchar(255), pTipo int(11))
    COMMENT 'Actualiza Comentarios de los Objetos de la Base de Datos'
BEGIN
	IF (pTipo = 1) THEN -- ESQUEMAS
		CALL usp_upd_Esquemas(pEsquema, pDescripcion);

		SELECT 'IMPLEMENTED' AS MSJ;
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

	ELSEIF (pTipo = 5) THEN -- FUNCIONES
		SELECT 'NOT IMPLEMENTED' AS MSJ;

	ELSEIF (pTipo = 6) THEN -- VISTAS
		CALL usp_upd_Vistas(pEsquema, pTabla, pDescripcion);

		SELECT 'IMPLEMENTED' AS MSJ;
	ELSEIF (pTipo = 7) THEN -- TRIGGERS
		SELECT 'NOT IMPLEMENTED' AS MSJ;
	ELSE
		SELECT 'NOT IMPLEMENTED' AS MSJ;
	END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `usp_Obtn_Campos` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_Obtn_Campos`(pEsquema varchar(255), pTabla varchar(255))
    COMMENT 'Obtiene los campos de una tabla con sus comentarios'
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
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `usp_Obtn_Esquemas` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_Obtn_Esquemas`()
    COMMENT 'Obtiene Esquemas de MySQL'
BEGIN
	SET @rownum := 0;

	SELECT @rownum := @rownum + 1 AS id
		,SCHEMA_NAME AS esquema
		,esquema_com(SCHEMA_NAME) AS descripcion
	FROM INFORMATION_SCHEMA.SCHEMATA
	WHERE SCHEMA_NAME NOT IN ('information_schema', 'mysql', 'performance_schema', 'test')
	ORDER BY SCHEMA_NAME;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `usp_Obtn_Funciones` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_Obtn_Funciones`(pEsquema varchar(255))
    COMMENT 'Obtiene Funciones por Esquema'
BEGIN
	SET @rownum := 0;

	IF (pEsquema = '*') THEN
		SELECT @rownum := @rownum + 1 AS id 
			,ROUTINE_SCHEMA AS esquema
			,ROUTINE_NAME AS objeto
			,ROUTINE_COMMENT AS descripcion
		FROM INFORMATION_SCHEMA.ROUTINES
		WHERE ROUTINE_TYPE = 'FUNCTION'
		AND ROUTINE_SCHEMA NOT IN ('information_schema', 'mysql', 'performance_schema', 'test');
	ELSE
		SELECT @rownum := @rownum + 1 AS id 
			,ROUTINE_SCHEMA AS esquema
			,ROUTINE_NAME AS objeto
			,ROUTINE_COMMENT AS descripcion
		FROM INFORMATION_SCHEMA.ROUTINES
		WHERE ROUTINE_TYPE = 'FUNCTION'
		AND ROUTINE_SCHEMA = pEsquema;
	END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `usp_Obtn_Procedimientos` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_Obtn_Procedimientos`(pEsquema varchar(255))
    COMMENT 'Obtiene Procedimientos Almacenados por Esquema'
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
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `usp_Obtn_Tablas` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_Obtn_Tablas`(pEsquema varchar(255))
    COMMENT 'Obtener Tablas por Esquema'
BEGIN
	SET @rownum := 0;

	IF (pEsquema = '*') THEN
		SELECT @rownum := @rownum + 1 AS id 
			,TABLE_SCHEMA AS esquema
			,TABLE_NAME AS tabla
	        ,(CASE WHEN TABLE_TYPE = 'BASE TABLE' THEN 'T' ELSE 'V' END) AS tipo
			,(CASE WHEN TABLE_TYPE = 'BASE TABLE' THEN TABLE_COMMENT ELSE vista_com(TABLE_SCHEMA, TABLE_NAME) END) AS descripcion
		FROM INFORMATION_SCHEMA.TABLES
		WHERE TABLE_SCHEMA NOT IN ('information_schema', 'mysql', 'performance_schema', 'test')
		/*AND TABLE_TYPE = 'BASE TABLE'*/;
	ELSE
		SELECT @rownum := @rownum + 1 AS id 
			,TABLE_SCHEMA AS esquema
			,TABLE_NAME AS tabla
	        ,(CASE WHEN TABLE_TYPE = 'BASE TABLE' THEN 'T' ELSE 'V' END) AS tipo
			,(CASE WHEN TABLE_TYPE = 'BASE TABLE' THEN TABLE_COMMENT ELSE vista_com(TABLE_SCHEMA, TABLE_NAME) END) AS descripcion
		FROM INFORMATION_SCHEMA.TABLES
		WHERE TABLE_SCHEMA = pEsquema
		/*AND TABLE_TYPE = 'BASE TABLE'*/;
	END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `usp_Obtn_Triggers` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_Obtn_Triggers`(pEsquema varchar(255), pTabla varchar(255))
    COMMENT 'Obtiene Triggers por Esquema'
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
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `usp_upd_Esquemas` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_upd_Esquemas`(pEsquema VARCHAR(255), pComentarios VARCHAR(255))
    COMMENT 'Actualiza Descripcion de Esquemas'
BEGIN
	IF (EXISTS(SELECT * FROM esquemas WHERE esquema = pEsquema)) THEN
		UPDATE esquemas SET comentarios = pComentarios WHERE esquema = pEsquema;
	ELSE
		INSERT INTO esquemas (esquema, comentarios) VALUES (pEsquema, pComentarios);
	END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `usp_upd_Vistas` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_upd_Vistas`(pEsquema VARCHAR(255), pVista VARCHAR(255), pComentarios VARCHAR(255))
    COMMENT 'Actualiza Comentarios de Vista'
BEGIN
	IF (EXISTS(SELECT * FROM vistas WHERE esquema = pEsquema AND vista = pVista)) THEN
		UPDATE vistas SET comentarios = pComentarios WHERE esquema = pEsquema AND vista = pVista;
	ELSE
		INSERT INTO vistas (esquema, vista, comentarios) VALUES (pEsquema, pVista, pComentarios);
	END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-08-08 22:54:53

