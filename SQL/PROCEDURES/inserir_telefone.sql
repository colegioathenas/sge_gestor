delimiter $$

CREATE PROCEDURE `inserir_telefone`(_cpf decimal(14,0), _ddd int, _telefone int)
BEGIN
	IF NOT EXISTS (select * from pessoa_telefone where nCdPessoa = _cpf and nTelefone = _telefone) THEN
		INSERT INTO Pessoa_Telefone VALUES (_cpf,_ddd,_telefone);
	END IF;
END$$

