CREATE TABLE `professor` (
  `nCPF` decimal(14,0) NOT NULL DEFAULT '0',
  `bTecnico` tinyint(1) DEFAULT NULL,
  `bInfantil` tinyint(1) DEFAULT NULL,
  `bFundI` tinyint(1) DEFAULT NULL,
  `bFundII` tinyint(1) DEFAULT NULL,
  `bMedio` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`nCPF`)
)
