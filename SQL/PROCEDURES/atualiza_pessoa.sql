delimiter $$

CREATE PROCEDURE `atualiza_pessoa`( _cpf decimal(11,0)
, _nome varchar(200)
, _endereco varchar(200)
, _nr	int
, _complemento varchar(50)
, _cep decimal(11,0)
, _cidade varchar(50)
, _bairro varchar(50)
, _uf varchar(2)
, _cRG varchar(50)
)
BEGIN
	IF EXISTS (SELECT * FROM Pessoa WHERE nCdPessoa = _cpf) THEN
	
		UPDATE Pessoa 
		   SET cNome = _nome
			 , cLogradouro = _endereco
			 , nLogradouroNr = _nr
			 , cComplelemnto = _complemento
			 , nCEP	= _cep
			 , cCidade = _cidade
			 , cBairro = _bairro
			 , cUF = _uf
			 , cRG	= _cRG
			WHERE nCdPessoa = _cpf;
	ELSE
		INSERT INTO Pessoa VALUES ( _cpf, _nome, _endereco, _nr, _complemento, _cep, _cidade, _bairro, _uf, _cRG);
	END IF;
END$$


