CREATE TABLE `solicitacao_fase` (
  `nCdSolicitacaoFase` int(11) NOT NULL AUTO_INCREMENT,
  `nCdSolicitacao` int(11) DEFAULT NULL,
  `nCdFase` int(11) DEFAULT NULL,
  `dFase` datetime DEFAULT NULL,
  `nCdGrupoDestino` int(11) DEFAULT NULL,
  PRIMARY KEY (`nCdSolicitacaoFase`),
  KEY `fk_solicitacao_fase_solicitacao` (`nCdSolicitacao`),
  KEY `fk_solicitacao_fase_fase` (`nCdFase`),
  KEY `fk_solicitacao_fase_grupo` (`nCdGrupoDestino`)
);
