CREATE TABLE `horario` (
  `nCdHorario` int(11) NOT NULL DEFAULT '0',
  `cNmHorario` varchar(50) DEFAULT NULL,
  `tEntrada1` time DEFAULT NULL,
  `tSaida1` time DEFAULT NULL,
  `tEntrada2` time DEFAULT NULL,
  `tSaida2` time DEFAULT NULL,
  PRIMARY KEY (`nCdHorario`)
);
