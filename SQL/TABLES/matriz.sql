CREATE TABLE `matriz` (
  `nCdMatriz` int(11) NOT NULL AUTO_INCREMENT,
  `nCdCurso` int(11) DEFAULT NULL,
  `dValidade` datetime DEFAULT NULL,
  `cNmMatriz` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`nCdMatriz`)
)
