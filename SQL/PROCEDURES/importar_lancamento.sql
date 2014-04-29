delimiter $$

CREATE PROCEDURE `importar_lancamento`( _nCdConta		int
, _cIdBanco		varchar(255)
, _dLancamento		datetime
, _cDescricao		varchar(255)
, _nValor			double
)
BEGIN
	DECLARE CheckExists int;  
	SELECT count(*) INTO CheckExists from lancamento where nCdContaCorrente = _nCdConta and cIdBanco = _cIdBanco;
	IF (CheckExists = 0) THEN 
	
		INSERT INTO lancamento(nCdContaCorrente,cIdBanco,dLancamento,cDescricao,nValor) 
			VALUES (_nCdConta,_cIdBanco,_dLancamento,_cDescricao,_nValor) ;
	END IF;
	
END$$


