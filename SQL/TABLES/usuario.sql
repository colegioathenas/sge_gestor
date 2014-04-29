CREATE TABLE `usuario` (
  `nCdUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `cNmUsuario` varchar(100) DEFAULT NULL,
  `cLogin` varchar(100) DEFAULT NULL,
  `cSenha` varchar(50) DEFAULT NULL,
  `nCdPerfil` int(11) DEFAULT NULL,
  `mudarsenha` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`nCdUsuario`),
  KEY `fk_usuario_perfil` (`nCdPerfil`)
)