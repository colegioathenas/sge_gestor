delimiter $$

CREATE  PROCEDURE `verifica_financeiro`(_anoletivo varchar(4),_matricula varchar(6),_cpfresp double)
BEGIN
Select acadesc.alunos.Mat, Nome, Responsavel, Cursos.Descri, Classe1.Serie, Classe1.Turma
     , acadesc.DadosResponsaveis.CPFResp
     , ( select count(*) from athenas.titulos where  (nCdPessoa = CPFResp or nCdPessoa = CPFPai or nCdPessoa = CPFMae or nCdPessoa = _cpfresp ) and nCdPessoa <> 0) as QtdBol
     , ( select count(*) from athenas.titulos where ((nCdPessoa = CPFResp or nCdPessoa = CPFPai or nCdPessoa = CPFMae or nCdPessoa = _cpfresp ) and nCdPessoa <> 0 ) and dVcto < CURDATE() and TipDtOcorrencia is null ) as QtdBolAbt
  from acadesc.Turmas 
       inner join acadesc.Classe1 on acadesc.Turmas.Codigo = acadesc.Classe1.Codigo and acadesc.Turmas.letivo = acadesc.Classe1.letivo
       inner join acadesc.Alunos  on acadesc.Turmas.Mat = acadesc.Alunos.Mat
       inner join acadesc.Cursos  on acadesc.Cursos.Codigo = acadesc.Classe1.Curso
       inner join acadesc.DadosResponsaveis on acadesc.alunos.Mat = acadesc.DadosResponsaveis.Mat
where Turmas.letivo = _anoletivo
  and acadesc.alunos.Mat = _matricula;

END$$

