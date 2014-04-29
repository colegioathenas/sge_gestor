delimiter $$

CREATE PROCEDURE `verifica_financeiro_matricula`(_cpfresp double)
BEGIN
	select count(*) as QtdBolAbt
     from athenas.titulos 
    where (nCdPessoa = _cpfresp )
	  and dVcto < CURDATE() and TipDtOcorrencia is null ;

END$$


