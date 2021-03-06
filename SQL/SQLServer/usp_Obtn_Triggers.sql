USE [MAEAS]
GO
/****** Object:  StoredProcedure [dbo].[usp_Obtn_Triggers]    Script Date: 09/09/2014 16:06:29 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

/**
* Obtiene una tabla con los triggers de una Tabla
*
* @category   TSQL Stored Procedures
* @package    usp_Obtn_Triggers
* @copyright  Copyright 2014 Jorge Alberto Ponce Turrubiates
* @license    http://www.apache.org/licenses/LICENSE-2.0
* @version    1.0.0, 2014-09-01
* @author     Jorge Alberto Ponce Turrubiates (the.yorch@gmail.com)

* @param string @esquema Esquema o * para todos los Esquemas
* @param string @tabla Tabla o * para todas las Tablas
* @return SQL Table
*/
ALTER PROCEDURE [dbo].[usp_Obtn_Triggers]
	@esquema NVARCHAR(255) = '', 
	@tabla NVARCHAR(255) = '' 
AS
BEGIN
	SET NOCOUNT ON;

	DECLARE @Tbl_Triggers TABLE(
	   id INT IDENTITY(1,1) NOT NULL PRIMARY KEY
	  ,esquema NVARCHAR(255) NOT NULL
	  ,tabla NVARCHAR(255) NOT NULL
	  ,disparador NVARCHAR(255) NOT NULL
	  ,descripcion NVARCHAR(255) NOT NULL
	)

	DECLARE @I INT
	DECLARE @nRegistros INT
	DECLARE @cDescription sql_variant
	DECLARE @cField NVARCHAR(MAX)

	INSERT INTO @Tbl_Triggers (esquema, tabla, disparador, descripcion)
	SELECT ESQUEMAS.NAME AS ESQUEMA
		  ,TABLAS.NAME AS TABLA
		  ,DISPARADOR.NAME
		  ,''
	FROM SYS.OBJECTS TABLAS
		,SYS.SCHEMAS ESQUEMAS
		,SYS.OBJECTS DISPARADOR
	WHERE 1 = (CASE WHEN @esquema = '*' THEN 1
			   ELSE CASE WHEN ESQUEMAS.NAME = @esquema THEN 1 ELSE 0 END
			   END) 
	AND 1 = (CASE WHEN @tabla = '*' THEN 1
			   ELSE CASE WHEN TABLAS.NAME = @tabla THEN 1 ELSE 0 END
			   END)
	AND TABLAS.TYPE = 'U' 
	AND DISPARADOR.TYPE = 'TR'
	AND ESQUEMAS.SCHEMA_ID = TABLAS.SCHEMA_ID
	AND TABLAS.object_id =  DISPARADOR.parent_object_id
	ORDER BY ESQUEMAS.NAME, TABLAS.NAME

	SELECT @nRegistros = MAX(id) FROM @Tbl_Triggers

	SET @I = 1

	WHILE (@I <= @nRegistros) BEGIN
		SET @cDescription = NULL

		SELECT @esquema = esquema, @tabla = tabla, @cField = disparador FROM @Tbl_Triggers WHERE id = @I 

		SELECT @cDescription = [value]
		FROM fn_listextendedproperty (null,'SCHEMA',@esquema,'TABLE',@tabla,'TRIGGER',@cField)

		IF @cDescription IS NOT NULL BEGIN
			UPDATE @Tbl_Triggers SET descripcion = CONVERT(VARCHAR(255),@cDescription) WHERE id = @I 
		END

		SET @I = @I + 1
	END

	SELECT * FROM @Tbl_Triggers ORDER BY id
END

