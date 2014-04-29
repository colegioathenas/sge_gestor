CREATE TABLE `cursos_disciplina` (
  `nCdCurso` int(11) NOT NULL DEFAULT '0',
  `nCdDisciplina` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`nCdCurso`,`nCdDisciplina`),
  KEY `FK_Curso_Disciplina_Disciplina` (`nCdDisciplina`)
)