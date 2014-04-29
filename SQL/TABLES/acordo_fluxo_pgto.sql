CREATE TABLE `acordo_fluxo_pgto` (
  `nCdFluxo` int(11) NOT NULL AUTO_INCREMENT,
  `nCdAcordo` int(11) DEFAULT NULL,
  `dPagamento` datetime DEFAULT NULL,
  `nVlrPagamento` decimal(15,2) DEFAULT NULL,
  `nCdEspecie` int(11) DEFAULT NULL,
  PRIMARY KEY (`nCdFluxo`),
  KEY `fk_fluxo_acordo` (`nCdAcordo`)
)