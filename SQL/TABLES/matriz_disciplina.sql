CREATE TABLE `matriz_disciplina` (
  `nCdComponente` int(11) NOT NULL AUTO_INCREMENT,
  `nCdMatriz` int(11) DEFAULT NULL,
  `nCdDisciplina` int(11) DEFAULT NULL,
  `nModulo` int(11) DEFAULT NULL,
  `nCHTeoricoPratico` int(11) DEFAULT NULL,
  `nCHEstagio` int(11) DEFAULT NULL,
  PRIMARY KEY (`nCdComponente`),
  KEY `fk_matriz_disciplina_matriz` (`nCdMatriz`),
  KEY `fk_matriz_disciplina_disciplina` (`nCdDisciplina`)
)
