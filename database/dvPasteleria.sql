
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

DROP TABLE IF EXISTS `categoria`;
CREATE TABLE IF NOT EXISTS `categoria` (
  `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;


INSERT INTO `categoria` (`id`, `nombre`) VALUES
(1, 'postres'),
(2,'galletas'),
(3,'tortas'),
(4,'velas'),


DROP TABLE IF EXISTS `producto`;
CREATE TABLE IF NOT EXISTS `producto` (
  `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `precio` float NOT NULL,
  `fecha_de_vencimiento` date,
  `descripcion` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `imagen` varchar(200) NOT NULL,
  `categoria_id` tinyint(3) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `categoria` (`categoria_id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;


INSERT INTO `producto` (`id`, `nombre`, `precio`, `descripcion`, `imagen`, `categoria_id`) VALUES
(1,'milhojas' 5000, 'merengon tropical' 7000, 'leche asada' 5500, 'oreo' 5500, 'tiramisú'7500, 'natas'6000, 'cheeesecake'7500),
(2,'oreo'2500, 'galleta rellena' 5000, 'colaciones'2500, 'avena'2000,'red velvet' 3000, '3 ojos'4000, ),
(3,'6 porciones'25000,'10 porciones' 35000, '20 porciones'45000, '30 porciones' 70000),
(4,'vela volcan' 3000, 'vela americana' 3500, 'botella' 3500,'vela magica' 4000),

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `clave` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `rol` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

INSERT INTO `usuario` (`id`, `nombre`, `apellido`, `email`, `clave`, `rol`) VALUES
(7, 'luis', 'ovalle', 'lucho_ov@gmail.com', '$2y$10$aos9BUmBqWVIHEB2yaqvA.q29PG3FLBfeb/hy/y9onGSyPjSoU4Fu', 'admin');

ALTER TABLE `producto`
  ADD CONSTRAINT `categoria` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`id`);
COMMIT;