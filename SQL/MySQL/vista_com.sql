DELIMITER $$
CREATE DEFINER=`root`@`localhost` FUNCTION `vista_com`(pEsquema VARCHAR(100), pVista VARCHAR(100)) RETURNS varchar(255) CHARSET latin1
    COMMENT 'Obtiene comentarios de Esquema'
BEGIN
	SET @comentario := (SELECT comentarios FROM vistas WHERE esquema = pEsquema AND vista = pVista);
	
	IF @comentario IS NULL THEN
		SET @comentario := '';
	END IF;

	RETURN @comentario;
END$$
DELIMITER ;
