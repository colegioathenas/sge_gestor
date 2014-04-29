delimiter $$

CREATE PROCEDURE `Relatorio_Inadimplencia_Analitico`( _datainicio	datetime
, _datafim		datetime
)
BEGIN
	SELECT Pessoa.nCdPessoa, cNome, nNossoNumero, SeuNum, dVcto, dEmissao, nVlrTitulo
  FROM titulos 
	   inner join Pessoa  on titulos.nCdPessoa = Pessoa.nCdPessoa
 where (dVcto >= _datainicio  and dVcto <= _datafim)
   and dVcto < now()
   and TipDtOcorrencia is null 
   and CodOcorRetorno = '02'
order by cNome;
END$$


