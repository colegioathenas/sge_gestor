CREATE TABLE `conta_contabil` (
  `nCdContaContabil` int(11) NOT NULL AUTO_INCREMENT,
  `nCdContaPAI` int(11) DEFAULT NULL,
  `cCodConta` varchar(50) DEFAULT NULL,
  `cNmConta` varchar(255) DEFAULT NULL,
  `bPermiteLancamento` tinyint(1) DEFAULT NULL,
  `bAtivo` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`nCdContaContabil`),
  KEY `FK_conta_contabil_conta_pai` (`nCdContaPAI`),
  CONSTRAINT `FK_conta_contabil_conta_pai` FOREIGN KEY (`nCdContaPAI`) REFERENCES `conta_contabil` (`nCdContaContabil`)
)