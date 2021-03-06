USE [MAEAS]
GO
/****** Object:  StoredProcedure [dbo].[usp_Obtn_Procedimientos]    Script Date: 09/09/2014 16:06:11 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

/**
* Obtiene una tabla con los Procedimientos Almacenados de un Esquema
*
* @category   TSQL Stored Procedures
* @package    usp_Obtn_Procedimientos
* @copyright  Copyright 2014 Jorge Alberto Ponce Turrubiates
* @license    http://www.apache.org/licenses/LICENSE-2.0
* @version    1.0.0, 2014-09-01
* @author     Jorge Alberto Ponce Turrubiates (the.yorch@gmail.com)

* @param string @esquema Esquema o * para todos los Esquemas
* @return SQL Table
*/
ALTER PROCEDURE [dbo].[usp_Obtn_Procedimientos]
	@esquema NVARCHAR(255) = '' 
AS
BEGIN
	SET NOCOUNT ON;

	DECLARE @Tbl_Tablas TABLE(
	   id INT IDENTITY(1,1) NOT NULL PRIMARY KEY
	  ,esquema NVARCHAR(255) NOT NULL
	  ,objeto NVARCHAR(255) NOT NULL
	  ,descripcion NVARCHAR(255) NOT NULL
	)

	DECLARE @I INT
	DECLARE @nRegistros INT
	DECLARE @cDescription sql_variant
	DECLARE @cTable NVARCHAR(MAX)

	INSERT INTO @Tbl_Tablas (esquema, objeto, descripcion)
	SELECT ESQUEMAS.NAME AS ESQUEMA
			,TABLAS.NAME AS TABLA
			,''
	FROM SYS.OBJECTS TABLAS
		,SYS.SCHEMAS ESQUEMAS
	WHERE TABLAS.TYPE = 'P' 
	AND ESQUEMAS.SCHEMA_ID = TABLAS.SCHEMA_ID
	AND 1 = (CASE WHEN @esquema = '*' THEN 1 
			 ELSE CASE WHEN ESQUEMAS.name = @esquema THEN 1 ELSE 0 END
			 END) 
	ORDER BY ESQUEMAS.NAME, TABLAS.NAME

	SELECT @nRegistros = MAX(id) FROM @Tbl_Tablas

	SET @I = 1

	WHILE (@I <= @nRegistros) BEGIN
		SET @cDescription = NULL

		SELECT @cTable = objeto, @esquema = esquema FROM @Tbl_Tablas WHERE id = @I 

		SELECT @cDescription = [value]
		FROM fn_listextendedproperty (null,'SCHEMA',@esquema,'PROCEDURE',@cTable,NULL,NULL)

		IF @cDescription IS NOT NULL BEGIN
			UPDATE @Tbl_Tablas SET descripcion = CONVERT(VARCHAR(255),@cDescription) WHERE id = @I 
		END

		SET @I = @I + 1
	END

	SELECT * FROM @Tbl_Tablas ORDER BY id
END
