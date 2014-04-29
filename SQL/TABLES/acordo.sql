CREATE TABLE `acordo` (
  `nCdAcordo` int(11) NOT NULL AUTO_INCREMENT,
  `nCPF` decimal(14,0) DEFAULT NULL,
  `dAcordo` datetime DEFAULT NULL,
  `nCdUsuario` int(11) DEFAULT NULL,
  `nVlrDivida` decimal(15,2) DEFAULT NULL,
  `nVlrDesconto` decimal(15,2) DEFAULT NULL,
  `nCdStatus` int(11) DEFAULT NULL,
  PRIMARY KEY (`nCdAcordo`),
  KEY `fk_acordo_usuario` (`nCdUsuario`),
  KEY `fk_acordo_pessoa` (`nCPF`)
)