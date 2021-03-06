USE [MAEAS]
GO
/****** Object:  StoredProcedure [dbo].[usp_ActDescripcion]    Script Date: 09/09/2014 16:05:33 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

/**
* Actualiza la descripcion de un Objeto de la BD
*
* @category   TSQL Stored Procedures
* @package    usp_ActDescripcion
* @copyright  Copyright 2014 Jorge Alberto Ponce Turrubiates
* @license    http://www.apache.org/licenses/LICENSE-2.0
* @version    1.0.0, 2014-09-01
* @author     Jorge Alberto Ponce Turrubiates (the.yorch@gmail.com)

* @param string @esquema Esquema
* @param string @tabla Objeto de BD (Tabla, Procedimiento, Funcion, Vista)
* @param string @campo Campo
* @param string @descripcion Nueva descripcion
* @param int @tipo Tipo de Objeto (1 Esquema, 2 Tabla, 3 Campo, 4 Procedimiento, 5 Funcion, 6 Vista, 7 Trigger)
* @return SQL Table
*/
ALTER PROCEDURE [dbo].[usp_ActDescripcion]
	@esquema NVARCHAR(255) = '', 
	@tabla NVARCHAR(255) = '',
	@campo NVARCHAR(255) = '',
	@descripcion NVARCHAR(255) = '', 
	@tipo INT = 0
AS
BEGIN
	SET NOCOUNT ON;

	DECLARE @cDescription sql_variant

	SET @cDescription = @descripcion

	IF @tipo = 1 BEGIN -- ESQUEMA
		IF EXISTS(SELECT [value] FROM fn_listextendedproperty (null,'SCHEMA',@esquema,NULL,NULL,NULL,NULL))  BEGIN
			EXECUTE sp_updateextendedproperty N'MS_Description', @cDescription, N'SCHEMA', @esquema, NULL, NULL, NULL, NULL
		END
		ELSE BEGIN
			EXECUTE sp_addextendedproperty N'MS_Description', @cDescription, N'SCHEMA', @esquema, NULL, NULL, NULL, NULL
		END
	END

	IF @tipo = 2 BEGIN -- TABLA
		IF EXISTS(SELECT [value] FROM fn_listextendedproperty (null,'SCHEMA',@esquema,'TABLE',@tabla,NULL,NULL))  BEGIN
			EXECUTE sp_updateextendedproperty N'MS_Description', @cDescription, N'SCHEMA', @esquema, N'TABLE', @tabla, NULL, NULL
		END
		ELSE BEGIN
			EXECUTE sp_addextendedproperty N'MS_Description', @cDescription, N'SCHEMA', @esquema, N'TABLE', @tabla, NULL, NULL
		END
	END

	IF @tipo = 3 BEGIN -- CAMPO
		IF EXISTS(SELECT [value] FROM fn_listextendedproperty (null,'SCHEMA',@esquema,'TABLE',@tabla,'COLUMN',@campo))  BEGIN
			EXECUTE sp_updateextendedproperty N'MS_Description', @cDescription, N'SCHEMA', @esquema, N'TABLE', @tabla, N'COLUMN', @campo
		END
		ELSE BEGIN
			EXECUTE sp_addextendedproperty N'MS_Description', @cDescription, N'SCHEMA', @esquema, N'TABLE', @tabla, N'COLUMN', @campo
		END
	END

	IF @tipo = 4 BEGIN -- PROCEDIMIENTO
		IF EXISTS(SELECT [value] FROM fn_listextendedproperty (null,'SCHEMA',@esquema,'PROCEDURE',@tabla,NULL,NULL))  BEGIN
			EXECUTE sp_updateextendedproperty N'MS_Description', @cDescription, N'SCHEMA', @esquema, N'PROCEDURE', @tabla, NULL, NULL
		END
		ELSE BEGIN
			EXECUTE sp_addextendedproperty N'MS_Description', @cDescription, N'SCHEMA', @esquema, N'PROCEDURE', @tabla, NULL, NULL
		END
	END

	IF @tipo = 5 BEGIN -- FUNCION
		IF EXISTS(SELECT [value] FROM fn_listextendedproperty (null,'SCHEMA',@esquema,'FUNCTION',@tabla,NULL,NULL))  BEGIN
			EXECUTE sp_updateextendedproperty N'MS_Description', @cDescription, N'SCHEMA', @esquema, N'FUNCTION', @tabla, NULL, NULL
		END
		ELSE BEGIN
			EXECUTE sp_addextendedproperty N'MS_Description', @cDescription, N'SCHEMA', @esquema, N'FUNCTION', @tabla, NULL, NULL
		END
	END

	IF @tipo = 6 BEGIN -- VISTA
		IF EXISTS(SELECT [value] FROM fn_listextendedproperty (null,'SCHEMA',@esquema,'VIEW',@tabla,NULL,NULL))  BEGIN
			EXECUTE sp_updateextendedproperty N'MS_Description', @cDescription, N'SCHEMA', @esquema, N'VIEW', @tabla, NULL, NULL
		END
		ELSE BEGIN
			EXECUTE sp_addextendedproperty N'MS_Description', @cDescription, N'SCHEMA', @esquema, N'VIEW', @tabla, NULL, NULL
		END
	END
	
	IF @tipo = 7 BEGIN -- TRIGGER		
		IF EXISTS(SELECT [value] FROM fn_listextendedproperty (null,'SCHEMA',@esquema,'TABLE',@tabla,'TRIGGER',@campo))  BEGIN
			EXECUTE sp_updateextendedproperty N'MS_Description', @cDescription, N'SCHEMA', @esquema, N'TABLE', @tabla, N'TRIGGER', @campo
		END
		ELSE BEGIN
			EXECUTE sp_addextendedproperty N'MS_Description', @cDescription, N'SCHEMA', @esquema, N'TABLE', @tabla, N'TRIGGER', @campo
		END
	END
	
	SELECT 'IMPLEMENTED' AS MSJ;
END
