delimiter $$

CREATE PROCEDURE `baixar_titulo`( _nossonumero	varchar(16)
, _datapgto	datetime
, _vlrpgto		double
, _vlrdesc		double
, _vlracr		double
, _vlrjur		double
, _vlrmul		double
, _vlrcred		double
, _vlrtar		double
, _dtcred		datetime
, _dttar		datetime
, _canal		varchar(2)
, _forma		varchar(2)
, _float		varchar(2)
, _codBaixa	varchar(2)
, _codAcordo	int
)
begin

	DECLARE CheckExists int;
	DECLARE _vlrEsperado double;
	DECLARE _vlrMinimo double;
	DECLARE _vlrPagoReg double;
	DECLARE _encontrado varchar(16);
   
	SET _vlrMinimo  	= 0;  
	SET _vlrPagoReg 	= 0;
	SET _vlrEsperado  = 0;
	SET _encontrado	= '';
   
	
   SELECT nNossoNumero
		 , nVlrTitulo - nVlrDesconto
		 , nVlrPago
	 INTO _encontrado, _vlrMinimo, _vlrPagoReg 
	 FROM titulos 
    WHERE nNossoNumero	= _nossonumero ;

	IF (_vlrPagoReg > 0   ) THEN
		select 'TITULO JÁ BAIXADO.' as  resposta ,_vlrMinimo as minimo, _vlrpgto as pago;
	ELSE
		IF (_encontrado = ''  ) THEN
			select 'TITULO NAO ENCONTRADO' as  resposta ,_vlrMinimo as minimo, _vlrpgto as pago;
		ELSE
			IF ( (_vlrpgto < (_vlrMinimo - 1000) ) and (_codBaixa not in (98,93,92)) ) THEN	
				select 'VALOR DIVERGENTE - TITULO NAO BAIXADO' as resposta ,_vlrMinimo as minimo, _vlrpgto as pago;
			ELSE
				Update titulos
				   set TipDtOcorrencia = now()
					  , dPgto			 = _datapgto
					  , nVlrPago		 = _vlrpgto
					  , nVlrDesEf		 = _vlrdesc
					  , nVlrAcrEf		 = _vlracr
					  , nVlrJurEf		 = _vlrjur
					  , nVlrMulEf		 = _vlrmul
					  , nVlrCredEf	 	 = _vlrcred
					  , nVlrTarEf		 = _vlrtar
					  , dCredef		 = _dtcred
					  , dTarief		 = _dttar
					  , nCdCanalPgto	 = _canal
					  , nCdFormaPgto	 = _forma
					  , nCdFloatPgto	 = _float
					  , CodOcorRetorno = _codBaixa
					  , nCdAcordo		 = _codAcordo
				  where nNossoNumero	 = _nossonumero;

				  select 'Titulo liquidado' as  resposta ,_vlrMinimo as minimo, _vlrpgto as pago;
			END IF;
		END IF;
	END IF;
	

end$$


