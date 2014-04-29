CREATE TABLE `acordo_referencia` (
  `nCdReferencia` int(11) NOT NULL AUTO_INCREMENT,
  `nCdAcordo` int(11) DEFAULT NULL,
  `nCdBoleto` int(11) DEFAULT NULL,
  `cReferencia` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`nCdReferencia`),
  KEY `fk_referencia_acordo` (`nCdAcordo`),
  KEY `fk_referencia_boleto` (`nCdBoleto`)
)