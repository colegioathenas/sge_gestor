CREATE TABLE `cursos` (
  `nCdCurso` int(11) NOT NULL AUTO_INCREMENT,
  `cNmCurso` varchar(255) DEFAULT NULL,
  `cTpCurso` char(1) DEFAULT NULL,
  `cOrdem` int(11) DEFAULT NULL,
  `nVlrCurso` double DEFAULT NULL,
  `nVlrMaterial` double DEFAULT NULL,
  `nVlrRematricula` double DEFAULT NULL,
  `nCursoPrazoMax` int(11) DEFAULT NULL,
  `nMaterialPrazoMax` int(11) DEFAULT NULL,
  PRIMARY KEY (`nCdCurso`)
)