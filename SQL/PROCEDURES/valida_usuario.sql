delimiter $$

CREATE  PROCEDURE `valida_usuario`(_login varchar(100), _senha varchar(100))
BEGIN
	Select Usuario.nCdUsuario,Usuario.cNmUsuario,Usuario.mudarsenha,cId, bVisualizar, bEditar, bIncluir,bExcluir, bAcessar
	  from usuario
			inner join acesso_perfil on acesso_perfil.nCdPerfil  = usuario.nCdPerfil
		    inner join acesso on acesso_perfil.nCdAcesso = acesso.nCdAcesso
     where cLogin = _login
       and cSenha = _senha;
END$$


