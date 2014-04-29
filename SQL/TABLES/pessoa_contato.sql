CREATE TABLE `pessoa_contato` (
  `nCdComunicacao` int(11) NOT NULL AUTO_INCREMENT,
  `nCdPessoa` decimal(14,0) DEFAULT NULL,
  `nCdUsuario` int(11) DEFAULT NULL,
  `dContato` datetime DEFAULT NULL,
  `nCdTpContato` int(11) DEFAULT NULL,
  `cMensagem` varchar(8000) DEFAULT NULL,
  PRIMARY KEY (`nCdComunicacao`),
  KEY `FK_Pessoa_Contato_Pessoa` (`nCdPessoa`),
  KEY `FK_Pessoa_Contato_Usuario` (`nCdUsuario`)
) 
