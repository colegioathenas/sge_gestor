CREATE TABLE `faltas` (
  `dFalta` datetime DEFAULT NULL,
  `nCdTurma` int(11) DEFAULT NULL,
  `nCdDisciplina` int(11) DEFAULT NULL,
  `aluno_mat` varchar(6) DEFAULT NULL,
  `aula1` tinyint(1) DEFAULT NULL,
  `aula2` tinyint(1) DEFAULT NULL,
  `aula3` tinyint(1) DEFAULT NULL,
  `aula4` tinyint(1) DEFAULT NULL,
  `aula5` tinyint(1) DEFAULT NULL,
  `aula6` tinyint(1) DEFAULT NULL,
  `aula7` tinyint(1) DEFAULT NULL
) 