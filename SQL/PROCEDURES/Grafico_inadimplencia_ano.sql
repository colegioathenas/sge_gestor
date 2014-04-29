delimiter $$

CREATE PROCEDURE `Grafico_inadimplencia_ano`(_ano int)
BEGIN

SELECT MONTH(dVcto) as mes, SUM(CASE WHEN 
    ( dVcto < now()
   and TipDtOcorrencia is null 
   and CodOcorRetorno = '02')
					 	or ( DATE_FORMAT(dVcto, '%Y%m') < DATE_FORMAT(TipDtOcorrencia, '%Y%m')  )
			 THEN nVlrTitulo 
			 ELSE 0 END) as nVlrInadimplencia
, SUM(CASE WHEN 
     dVcto < now()
   and TipDtOcorrencia is null 
   and CodOcorRetorno = '02'
					 	
			 THEN nVlrTitulo 
			 ELSE 0 END) as nVlrInadimplenciaAbt
		, ( SELECT SUM(CASE CodocorRetorno
						 WHEN '06' THEN nVlrPago
						 WHEN '09' THEN 0
						 WHEN '93' THEN 0
						 WHEN '94' THEN nVlrPago
						 WHEN '95' THEN nVlrPago
						 WHEN '96' THEN nVlrPago
						 WHEN '97' THEN nVlrPago
						 WHEN '98' THEN 0
						 WHEN '99' THEN 0
						 ELSE nVlrPago END )
				 FROM titulos bx Where (YEAR(IFNULL(bx.dCredef,bx.TipDtOcorrencia))= _ano  and MONTH(IFNULL(bx.dCredef,bx.TipDtOcorrencia))= MONTH(titulos.dVcto))
				or ( bx.dCredef is null and YEAR(bx.dPgto) = _ano  AND MONTH(bx.dPgto) = MONTH(titulos.dVcto) ) ) as nVlrLiquidado
	, ( SELECT SUM(CASE CodocorRetorno
						 WHEN '06' THEN nVlrTitulo - nVlrPago
						 WHEN '09' THEN 0
						 WHEN '93' THEN 0
						 WHEN '94' THEN  nVlrTitulo - nVlrPago
						 WHEN '95' THEN  nVlrTitulo - nVlrPago
						 WHEN '96' THEN  nVlrTitulo - nVlrPago
						 WHEN '97' THEN  nVlrTitulo - nVlrPago
						 WHEN '98' THEN 0
						 WHEN '99' THEN 0
						 ELSE nVlrPago END )
				 FROM titulos bx Where (YEAR(IFNULL(bx.dCredef,bx.TipDtOcorrencia))= _ano  and MONTH(IFNULL(bx.dCredef,bx.TipDtOcorrencia))= MONTH(titulos.dVcto))
				or ( bx.dCredef is null and YEAR(bx.dPgto) = _ano  AND MONTH(bx.dPgto) = MONTH(titulos.dVcto) ) ) as nVlrDescTar
	, ( SELECT SUM(CASE CodocorRetorno
			 WHEN '06' THEN 0
			 WHEN '09' THEN nVlrPago
			 WHEN '93' THEN nVlrPago
			 WHEN '94' THEN 0
			 WHEN '95' THEN 0
			 WHEN '96' THEN 0
			 WHEN '97' THEN 0
			 WHEN '98' THEN nVlrPago
			 WHEN '99' THEN nVlrPago
			 ELSE nVlrPago END )
			FROM titulos can Where (YEAR(IFNULL(can.dCredef,can.TipDtOcorrencia))= _ano  and MONTH(IFNULL(can.dCredef,can.TipDtOcorrencia))= MONTH(titulos.dVcto))
				or ( can.dCredef is null and YEAR(can.dPgto) = _ano  AND MONTH(can.dPgto) = MONTH(titulos.dVcto) ) ) as nVlrBaixado
	, SUM( nVlrTitulo   ) as nVlrTitulos
from titulos
where YEAR(dVcto) = _ano
GROUP BY MONTH(dVcto);


END$$


