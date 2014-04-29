CREATE TABLE `conta_corrente` (
  `nCdContaCorrente` int(11) NOT NULL AUTO_INCREMENT,
  `nCdBanco` int(11) DEFAULT NULL,
  `cNmConta` varchar(125) DEFAULT NULL,
  `cAgencia` varchar(255) DEFAULT NULL,
  `cConta` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`nCdContaCorrente`),
  KEY `FK_conta_corrente_banco` (`nCdBanco`),
  CONSTRAINT `FK_conta_corrente_banco` FOREIGN KEY (`nCdBanco`) REFERENCES `banco` (`nCdBanco`)
) 