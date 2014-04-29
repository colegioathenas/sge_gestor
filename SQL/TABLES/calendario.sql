CREATE TABLE `calendario` (
  `nCdCalendario` int(11) NOT NULL AUTO_INCREMENT,
  `dCalendario` datetime DEFAULT NULL,
  `nCdProfessor` decimal(14,0) DEFAULT NULL,
  `nCdDisciplina` int(11) DEFAULT NULL,
  `nCdTurma` int(11) DEFAULT NULL,
  `cConteudo` varchar(8000) DEFAULT NULL,
  PRIMARY KEY (`nCdCalendario`),
  KEY `fk_calendario_professor` (`nCdProfessor`),
  KEY `fk_calendario_disciplina` (`nCdDisciplina`),
  KEY `fk_calendario_turma` (`nCdTurma`)
) 