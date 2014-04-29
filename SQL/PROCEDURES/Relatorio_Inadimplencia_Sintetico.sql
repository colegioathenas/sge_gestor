delimiter $$

CREATE PROCEDURE `Relatorio_Inadimplencia_Sintetico`( _datainicio	datetime
, _datafim		datetime
)
BEGIN
	SELECT Pessoa.nCdPessoa, cNome, count(*) as nQtdTitulo, Min(dVcto) as dMenorVcto, Max(dVcto) as dMaiorVcto , sum(nVlrTitulo) as nVlrTitulo
  FROM titulos 
	   inner join Pessoa  on titulos.nCdPessoa = Pessoa.nCdPessoa
 where (dVcto >= _datainicio  and dVcto <= _datafim)
   and dVcto < now()
   and TipDtOcorrencia is null 
   and CodOcorRetorno = '02'
group by Pessoa.nCdPessoa, cNome
order by cNome;
END$$


