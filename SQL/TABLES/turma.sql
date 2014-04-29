CREATE TABLE `turma` (
  `nCdTurma` int(11) NOT NULL AUTO_INCREMENT,
  `cNmTurma` varchar(125) DEFAULT NULL,
  `nCdCurso` int(11) DEFAULT NULL,
  `cTurno` char(1) DEFAULT NULL,
  `nVagas` int(11) DEFAULT NULL,
  `dInicio` datetime DEFAULT NULL,
  `dFim` datetime DEFAULT NULL,
  `nVlrCurso` double DEFAULT NULL,
  `nVlrMaterial` double DEFAULT NULL,
  `nVlrRematricula` double DEFAULT NULL,
  `bMatriculasAbertas` tinyint(1) DEFAULT NULL,
  `nVlrMatricula` double DEFAULT NULL,
  `bMatricula` bit(1) DEFAULT NULL,
  `nMes1vcto` int(11) DEFAULT NULL,
  `nVencProxMat` int(11) DEFAULT NULL,
  `nCursoPrazoMax` int(11) DEFAULT NULL,
  `nMaterialPrazoMax` int(11) DEFAULT NULL,
  `nCdMatriz` int(11) DEFAULT NULL,
  PRIMARY KEY (`nCdTurma`),
  KEY `fk_turma_curso` (`nCdCurso`)
) 