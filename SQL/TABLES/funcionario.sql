CREATE TABLE `funcionario` (
  `nCdPessoa` decimal(14,0) NOT NULL DEFAULT '0',
  `nMatricula` int(11) DEFAULT NULL,
  `nPis` decimal(12,0) DEFAULT NULL,
  `cCategoria` varchar(50) DEFAULT NULL,
  `nCdSetor` int(11) DEFAULT NULL,
  `nCdParametro` int(11) DEFAULT NULL,
  `nCdEscala` int(11) DEFAULT NULL,
  `nCdCargo` int(11) DEFAULT NULL,
  `dAdmissao` datetime DEFAULT NULL,
  `dDemissao` datetime DEFAULT NULL,
  PRIMARY KEY (`nCdPessoa`),
  KEY `fk_funcionario_setor` (`nCdSetor`),
  KEY `fk_funcionario_escala` (`nCdEscala`),
  KEY `fk_funcionario_cargo` (`nCdCargo`)
) ;
