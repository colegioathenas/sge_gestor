CREATE TABLE `escala` (
  `nCdEscala` int(11) NOT NULL AUTO_INCREMENT,
  `cNmEscala` varchar(100) DEFAULT NULL,
  `nCdHorarioDom` int(11) DEFAULT NULL,
  `nCdHorarioSeg` int(11) DEFAULT NULL,
  `nCdHorarioTer` int(11) DEFAULT NULL,
  `nCdHorarioQua` int(11) DEFAULT NULL,
  `nCdHorarioQui` int(11) DEFAULT NULL,
  `nCdHorarioSex` int(11) DEFAULT NULL,
  `nCdHorarioSab` int(11) DEFAULT NULL,
  PRIMARY KEY (`nCdEscala`)
)