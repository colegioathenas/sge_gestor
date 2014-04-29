CREATE TABLE `solicitacao` (
  `nCdSolicitacao` int(11) NOT NULL AUTO_INCREMENT,
  `nCdTpSolicitacao` int(11) DEFAULT NULL,
  `cDscSolicitacao` varchar(125) DEFAULT NULL,
  `nCdUsuarioSolicitante` int(11) DEFAULT NULL,
  `dSolicitacao` datetime DEFAULT NULL,
  `bFechado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`nCdSolicitacao`),
  KEY `fk_solicitacao_tipo` (`nCdTpSolicitacao`)
);
