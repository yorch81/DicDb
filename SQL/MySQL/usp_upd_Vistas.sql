DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_upd_Vistas`(pEsquema VARCHAR(255), pVista VARCHAR(255), pComentarios VARCHAR(255))
BEGIN
	IF (EXISTS(SELECT * FROM vistas WHERE esquema = pEsquema AND vista = pVista)) THEN
		UPDATE vistas SET comentarios = pComentarios WHERE esquema = pEsquema AND vista = pVista;
	ELSE
		INSERT INTO vistas (esquema, vista, comentarios) VALUES (pEsquema, pVista, pComentarios);
	END IF;
END$$
DELIMITER ;
