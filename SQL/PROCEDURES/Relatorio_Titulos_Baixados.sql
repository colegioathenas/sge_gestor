delimiter $$

CREATE PROCEDURE `Relatorio_Titulos_Baixados`(_dInicio datetime, _dFim datetime)
BEGIN
SELECT CASE CodocorRetorno
			 WHEN '06' THEN 'Liquidacao Bancaria'
			 WHEN '09' THEN 'Baixa do COBCAIXA'
			 WHEN '93' THEN 'Bolsa'
			 WHEN '94' THEN 'Recebido Escola - A Vista'
			 WHEN '95' THEN 'Recebido Escola - Cheque'
			 WHEN '96' THEN 'Recebido Escola - C. Debito'
			 WHEN '97' THEN 'Recebido Escola - C. Credito'
			 WHEN '98' THEN 'Acordo'
			 WHEN '99' THEN 'Cancelado'
			 ELSE CodocorRetorno
	  END AS cTpBaixa
	  , Count(*) AS nQtd
	  , SUM(nVlrTitulo) AS nVlrTitulo
	  , SUM(CASE CodocorRetorno
			 WHEN '06' THEN nVlrPago
			 WHEN '09' THEN 0
			 WHEN '93' THEN 0
			 WHEN '94' THEN nVlrPago
			 WHEN '95' THEN nVlrPago
			 WHEN '96' THEN nVlrPago
			 WHEN '97' THEN nVlrPago
			 WHEN '98' THEN 0
			 WHEN '99' THEN 0
			 ELSE nVlrPago END) as nVlrPago
	  , SUM(CASE CodocorRetorno
			 WHEN '06' THEN nVlrCredEf
			 WHEN '09' THEN 0
			 WHEN '93' THEN 0
			 WHEN '94' THEN nVlrCredEf
			 WHEN '95' THEN nVlrCredEf
			 WHEN '96' THEN nVlrCredEf
			 WHEN '97' THEN nVlrCredEf
			 WHEN '98' THEN 0
			 WHEN '99' THEN 0
			 ELSE nVlrPago END) as nVlrCredEf
	  
	  , SUM(CASE CodocorRetorno
			 WHEN '06' THEN nVlrTarEf
			 WHEN '09' THEN 0
			 WHEN '93' THEN 0
			 WHEN '94' THEN nVlrTarEf
			 WHEN '95' THEN nVlrTarEf
			 WHEN '96' THEN nVlrTarEf
			 WHEN '97' THEN nVlrTarEf
			 WHEN '98' THEN 0
			 WHEN '99' THEN 0
			 ELSE nVlrTarEf END) as nVlrTarifa
  FROM titulos
 WHERE 
(IFNULL(dCredef,TipDtOcorrencia) between _dInicio and _dFim )
or ( dCredef is null and dPgto between _dInicio and _dFim )

GROUP BY CodOcorRetorno ;

END$$

