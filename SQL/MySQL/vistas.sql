CREATE TABLE `vistas` (
  `id_vistas` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id Consecutivo',
  `esquema` varchar(50) NOT NULL,
  `vista` varchar(50) NOT NULL,
  `comentarios` varchar(255) NOT NULL,
  PRIMARY KEY (`id_vistas`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COMMENT='Comentarios de Vistas';
