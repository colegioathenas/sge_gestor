CREATE TABLE `parametro` (
  `nCdParametro` int(11) NOT NULL AUTO_INCREMENT,
  `cNmParametro` varchar(255) DEFAULT NULL,
  `nTolAtrasoEntrada` int(11) DEFAULT NULL,
  `nTolAtrasoIntervalo` int(11) DEFAULT NULL,
  `nTolSaidaAntecipada1` int(11) DEFAULT NULL,
  `nTolSaidaAntecipada2` int(11) DEFAULT NULL,
  `nMinHoraExtraEntrada` int(11) DEFAULT NULL,
  `nMinHoraExtraSaida` int(11) DEFAULT NULL,
  `tNoturnoIni` time DEFAULT NULL,
  `tNoturnoFim` time DEFAULT NULL,
  `tDSRSabado` time DEFAULT NULL,
  `tDSRDomingo` time DEFAULT NULL,
  `tDSRFeriado` time DEFAULT NULL,
  `tDSRFolga` time DEFAULT NULL,
  PRIMARY KEY (`nCdParametro`)
);

