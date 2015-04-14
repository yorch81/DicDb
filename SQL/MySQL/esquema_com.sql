DELIMITER $$
CREATE DEFINER=`root`@`localhost` FUNCTION `esquema_com`(pEsquema VARCHAR(100)) RETURNS varchar(255) CHARSET latin1
    COMMENT 'obtener esquema'
BEGIN
	SET @comentario := (SELECT comentarios FROM esquemas WHERE esquema = pEsquema);
	
	IF @comentario IS NULL THEN
		SET @comentario := '';
	END IF;

	RETURN @comentario;
END$$
DELIMITER ;
