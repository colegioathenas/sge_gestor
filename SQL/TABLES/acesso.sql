CREATE TABLE `acesso` (
  `nCdAcesso` int(11) NOT NULL AUTO_INCREMENT,
  `cNmAcesso` varchar(100) DEFAULT NULL,
  `cTpAcesso` char(1) DEFAULT NULL,
  `cGrupo` varchar(100) DEFAULT NULL,
  `cId` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`nCdAcesso`)
) 
