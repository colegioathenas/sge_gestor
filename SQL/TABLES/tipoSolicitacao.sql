CREATE TABLE `tipoSolicitacao` (
  `nCdTpSolicitacao` int(11) NOT NULL AUTO_INCREMENT,
  `cNmTpSolicitacao` varchar(50) DEFAULT NULL,
  `nCdGrupoDestino` int(11) DEFAULT NULL,
  PRIMARY KEY (`nCdTpSolicitacao`),
  KEY `pk_tpSolicitacao` (`nCdGrupoDestino`)
);
