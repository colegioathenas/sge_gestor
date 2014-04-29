CREATE TABLE `consulta_scpc` (
  `nCPF` decimal(11,0) NOT NULL DEFAULT '0',
  `cNome` varchar(255) DEFAULT NULL,
  `cNascimento` varchar(10) DEFAULT NULL,
  `bBloqueado` tinyint(1) DEFAULT NULL,
  `cObs` varchar(8000) DEFAULT NULL,
  PRIMARY KEY (`nCPF`)
)