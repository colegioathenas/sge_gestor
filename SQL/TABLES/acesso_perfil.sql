CREATE TABLE `acesso_perfil` (
  `nCdAcesso` int(11) NOT NULL DEFAULT '0',
  `nCdPerfil` int(11) NOT NULL DEFAULT '0',
  `bVisualizar` tinyint(1) DEFAULT NULL,
  `bEditar` tinyint(1) DEFAULT NULL,
  `bIncluir` tinyint(1) DEFAULT NULL,
  `bExcluir` tinyint(1) DEFAULT NULL,
  `bAcessar` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`nCdAcesso`,`nCdPerfil`),
  KEY `PK_ACESSO_PERFIL_PERFIL` (`nCdPerfil`)
)