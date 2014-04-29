delimiter $$

CREATE PROCEDURE `gerar_acordo`( _cpf			double
, _usuario		int
, _parcelas	int
, _valor		double
, _1vcto	    datetime
)
BEGIN

	DECLARE i int;
	DECLARE _codAcordo int(6) Zerofill;
	DECLARE _dVcto datetime;
	DECLARE _juros	 double;
	DECLARE _multa double;
	DECLARE _msg1 VARCHAR(255);
	DECLARE _msg2 VARCHAR(255);
	DECLARE _msg3 VARCHAR(255);
	DECLARE _msg4 VARCHAR(255);
	DECLARE _seuNum VARCHAR(255);

	INSERT INTO Acordo (dAcordo,nCdUsuario) values (now(), _usuario);

	SELECT @@identity into _codAcordo;

	SET _juros = _valor * 0.0033;
	SET _multa	= _valor * 0.1;

	SET i = 1;

	WHILE i <= _parcelas DO

		SET _dVcto = ADDDATE(_1vcto, INTERVAL (i-1) MONTH);
		
		SET _msg1 = CONCAT('- MULTA DE  		R$:   ',Replace(Replace(Format(_multa,2),',',''),'.',','),' APÓS ',DATE_FORMAT(_dVcto, '%d/%m/%Y'));
		SET _msg2 = CONCAT('- JUROS DE  		R$:   ',Replace(Replace(Format(_juros,2),',',''),'.',','),' AO DIA');
		SET _msg3 = '';
		SET _msg4 = 'NAO RECEBER APOS 30 DIAS DE ATRASO';
		SET _seuNum = CONCAT( '7'								-- indicacao de acrodo
							  , _codAcordo						-- codigo do acordo
							  , EXTRACT(YEAR FROM now())		-- ano do acordo
							  , SUBSTRING(CONCAT('00',i),-2)-- numero da parcela
							  , SUBSTRING(CONCAT('00',_parcelas),-2)-- quantidade de parcela
							  );	
		

		INSERT INTO Titulos (nCdPessoa, SeuNum, dVcto, dEmissao, nVlrTitulo, nVlrJuros, dDesconto, nVlrDesconto
							  ,dMulta, nVlrMulta, cMensagem1, cMensagem2, cMensagem3, cMensagem4,nCdAcordo)
				VALUES (_cpf,_seuNum,_dVcto,CURDATE(),_valor,_juros,_dVcto,0, _dVcto, _multa
						, _msg1,_msg2,_msg3,_msg4,_codAcordo);

		SET i = i + 1;
	END WHILE;
	Select _codAcordo as nCdAcordo;
END$$

