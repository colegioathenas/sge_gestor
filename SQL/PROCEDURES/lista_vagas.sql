delimiter $$

CREATE PROCEDURE `lista_vagas`()
begin
Select Turma.nCdCurso,cNmCurso,sum(nVagas) as nVagas, (select count(*) from matriculado where serie = Cursos.nCdCurso) as nMatriculas
  from Turma 
       inner join cursos on Turma.nCdCurso = Cursos.nCdCurso
group by cNmCurso
order by cOrdem,cNmCurso;
end$$


