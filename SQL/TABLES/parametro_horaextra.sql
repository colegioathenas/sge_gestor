CREATE TABLE `parametro_horaextra` (
  `nCdParametrohora` int(11) NOT NULL AUTO_INCREMENT,
  `nCdParametro` int(11) DEFAULT NULL,
  `tQtdHorasUteis` time DEFAULT NULL,
  `nPercUteis` decimal(5,2) DEFAULT NULL,
  `tQtdHorasSabado` time DEFAULT NULL,
  `nPercSabado` decimal(5,2) DEFAULT NULL,
  `tQtdHorasDomingo` time DEFAULT NULL,
  `nPercDomingo` decimal(5,2) DEFAULT NULL,
  `tQtdHorasFeriado` time DEFAULT NULL,
  `nPercFeriado` decimal(5,2) DEFAULT NULL,
  PRIMARY KEY (`nCdParametrohora`),
  KEY `fk_parametro_horaextra` (`nCdParametro`)
);

