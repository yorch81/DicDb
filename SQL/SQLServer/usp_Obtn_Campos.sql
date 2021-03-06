USE [MAEAS]
GO
/****** Object:  StoredProcedure [dbo].[usp_Obtn_Campos]    Script Date: 09/09/2014 16:04:47 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

/**
* Obtiene una tabla con los campos de una Tabla
*
* @category   TSQL Stored Procedures
* @package    usp_Obtn_Campos
* @copyright  Copyright 2014 Jorge Alberto Ponce Turrubiates
* @license    http://www.apache.org/licenses/LICENSE-2.0
* @version    1.0.0, 2014-09-01
* @author     Jorge Alberto Ponce Turrubiates (the.yorch@gmail.com)

* @param string @esquema Esquema o * para todos los Esquemas
* @param string @tabla Tabla o * para todas las Tablas
* @return SQL Table
*/
ALTER PROCEDURE [dbo].[usp_Obtn_Campos]
	@esquema NVARCHAR(255) = '', 
	@tabla NVARCHAR(255) = '' 
AS
BEGIN
	SET NOCOUNT ON;

	DECLARE @Tbl_Campos TABLE(
	   id INT IDENTITY(1,1) NOT NULL PRIMARY KEY
	  ,esquema NVARCHAR(255) NOT NULL
	  ,tabla NVARCHAR(255) NOT NULL
	  ,campo NVARCHAR(255) NOT NULL
	  ,tipo NVARCHAR(255) NOT NULL
	  ,descripcion NVARCHAR(255) NOT NULL
	)

	DECLARE @I INT
	DECLARE @nRegistros INT
	DECLARE @cDescription sql_variant
	DECLARE @cField NVARCHAR(MAX)

	INSERT INTO @Tbl_Campos (esquema, tabla, campo, descripcion, tipo)
	SELECT COL.TABLE_SCHEMA, COL.TABLE_NAME, COLUMN_NAME, '', 
		   ISNULL(CASE WHEN CHARACTER_MAXIMUM_LENGTH IS NULL AND NUMERIC_PRECISION IS NULL THEN DATA_TYPE 
		   ELSE (CASE WHEN CHARACTER_MAXIMUM_LENGTH IS NULL THEN DATA_TYPE + '(' + LTRIM(STR(NUMERIC_PRECISION)) + ',' + LTRIM(STR(NUMERIC_SCALE)) + ')'  ELSE DATA_TYPE + '(' + LTRIM(STR(CHARACTER_MAXIMUM_LENGTH)) + ')' END) 
		   END,'real')
	FROM Information_Schema.Columns COL
		,Information_Schema.TABLES  TAB
	WHERE 1 = (CASE WHEN @esquema = '*' THEN 1
			   ELSE CASE WHEN COL.TABLE_SCHEMA = @esquema THEN 1 ELSE 0 END
			   END) 
	AND 1 = (CASE WHEN @tabla = '*' THEN 1
			   ELSE CASE WHEN COL.TABLE_NAME = @tabla THEN 1 ELSE 0 END
			   END)
	AND TAB.TABLE_TYPE = 'BASE TABLE' -- SOLO TABLAS
	AND TAB.TABLE_NAME = COL.TABLE_NAME
	AND TAB.TABLE_SCHEMA = COL.TABLE_SCHEMA
	ORDER BY TABLE_SCHEMA, TABLE_NAME, ORDINAL_POSITION

	--SELECT @esquema, @tabla, COLUMN_NAME, '', DATA_TYPE, CHARACTER_MAXIMUM_LENGTH, NUMERIC_PRECISION, NUMERIC_SCALE
	--FROM Information_Schema.Columns
	--WHERE TABLE_SCHEMA = @esquema
	--AND TABLE_NAME = @tabla
	--ORDER BY ORDINAL_POSITION

	SELECT @nRegistros = MAX(id) FROM @Tbl_Campos

	SET @I = 1

	WHILE (@I <= @nRegistros) BEGIN
		SET @cDescription = NULL

		SELECT @esquema = esquema, @tabla = tabla, @cField = campo FROM @Tbl_Campos WHERE id = @I 

		SELECT @cDescription = [value]
		FROM fn_listextendedproperty (null,'SCHEMA',@esquema,'TABLE',@tabla,'COLUMN',@cField)

		IF @cDescription IS NOT NULL BEGIN
			UPDATE @Tbl_Campos SET descripcion = CONVERT(VARCHAR(255),@cDescription) WHERE id = @I 
		END

		SET @I = @I + 1
	END

	SELECT * FROM @Tbl_Campos ORDER BY id
END
