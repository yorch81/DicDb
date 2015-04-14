CREATE TABLE `esquemas` (
  `id_esquemas` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id Esqeumas',
  `esquema` varchar(50) NOT NULL COMMENT 'Esquema de Base de Datos',
  `comentarios` varchar(255) NOT NULL COMMENT 'Comentarios del Esquema',
  PRIMARY KEY (`id_esquemas`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COMMENT='Diccionario Esquemas';
