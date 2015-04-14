DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_upd_Esquemas`(pEsquema VARCHAR(255), pComentarios VARCHAR(255))
BEGIN
	IF (EXISTS(SELECT * FROM esquemas WHERE esquema = pEsquema)) THEN
		UPDATE esquemas SET comentarios = pComentarios WHERE esquema = pEsquema;
	ELSE
		INSERT INTO esquemas (esquema, comentarios) VALUES (pEsquema, pComentarios);
	END IF;
END$$
DELIMITER ;
