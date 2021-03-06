USE [MAEAS]
GO
/****** Object:  StoredProcedure [dbo].[usp_Obtn_Esquemas]    Script Date: 09/09/2014 16:05:04 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

/**
* Obtiene una tabla con los Esquemas de una BD
*
* @category   TSQL Stored Procedures
* @package    uusp_Obtn_Esquemas
* @copyright  Copyright 2014 Jorge Alberto Ponce Turrubiates
* @license    http://www.apache.org/licenses/LICENSE-2.0
* @version    1.0.0, 2014-09-01
* @author     Jorge Alberto Ponce Turrubiates (the.yorch@gmail.com)

* @param (No Parameters)
* @return SQL Table
*/
ALTER PROCEDURE [dbo].[usp_Obtn_Esquemas]
AS
BEGIN
	SET NOCOUNT ON;

	DECLARE @Tbl_Esquemas TABLE(
	   id INT IDENTITY(1,1) NOT NULL PRIMARY KEY
	  ,esquema NVARCHAR(255) NOT NULL
	  ,descripcion NVARCHAR(255) NOT NULL
	)

	DECLARE @I INT
	DECLARE @nRegistros INT
	DECLARE @cDescription sql_variant
	DECLARE @cSchema NVARCHAR(MAX)

	INSERT INTO @Tbl_Esquemas (esquema, descripcion)
	SELECT ESQUEMAS.NAME AS ESQUEMA
		  ,'' AS DESCRIPCION
	FROM SYS.OBJECTS TABLAS
		,SYS.SCHEMAS ESQUEMAS
	WHERE TABLAS.TYPE = 'U' 
	AND ESQUEMAS.SCHEMA_ID = TABLAS.SCHEMA_ID
	GROUP BY ESQUEMAS.NAME
	ORDER BY ESQUEMAS.NAME

	SELECT @nRegistros = MAX(id) FROM @Tbl_Esquemas

	SET @I = 1

	WHILE (@I <= @nRegistros) BEGIN
		SET @cDescription = NULL

		SELECT @cSchema = esquema FROM @Tbl_Esquemas WHERE id = @I 

		SELECT @cDescription = [value]
		FROM fn_listextendedproperty (null,'SCHEMA',@cSchema,NULL,NULL,NULL,NULL)

		IF @cDescription IS NOT NULL BEGIN
			UPDATE @Tbl_Esquemas SET descripcion = CONVERT(VARCHAR(255),@cDescription) WHERE id = @I 
		END

		SET @I = @I + 1
	END

	SELECT * FROM @Tbl_Esquemas ORDER BY id
END
