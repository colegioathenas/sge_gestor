CREATE TABLE `professor_disciplina` (
  `nCPF` decimal(14,0) NOT NULL DEFAULT '0',
  `nCdDisciplina` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`nCPF`,`nCdDisciplina`),
  KEY `pk_professor_disciplina_disciplina` (`nCdDisciplina`)
)
