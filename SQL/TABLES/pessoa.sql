CREATE TABLE `pessoa` (
  `nCdPessoa` decimal(14,0) NOT NULL DEFAULT '0',
  `cNome` varchar(200) DEFAULT NULL,
  `cLogradouro` varchar(200) DEFAULT NULL,
  `nLogradouroNr` int(11) DEFAULT NULL,
  `cComplelemnto` varchar(50) DEFAULT NULL,
  `nCEP` decimal(8,0) DEFAULT NULL,
  `cCidade` varchar(50) DEFAULT NULL,
  `cBairro` varchar(50) DEFAULT NULL,
  `cUF` varchar(2) DEFAULT NULL,
  `cRG` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`nCdPessoa`)
)
