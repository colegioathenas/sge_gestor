delimiter $$

CREATE PROCEDURE `lista_turnos_matricula`(_nCdCurso int)
BEGIN
	Select Turma.nCdTurma
	  , cNmTurma
	  , (nVagas - (select count(*) from matriculado where matriculado.nCdTurma = Turma.nCdTurma)) as nVagas
	  , CONCAT( CASE cTurno WHEN 'M' THEN 'Manha' WHEN 'T' THEN 'Tarde' When 'N' THEN 'Noite' END, ' (',cNmTurma,' - ', CAST(nVagas - (select count(*) from matriculado where matriculado.nCdTurma = Turma.nCdTurma) AS CHAR),' Vagas )') as cTurnoDescr
  from Turma 
       inner join cursos on Turma.nCdCurso = Cursos.nCdCurso
where Turma.nCdCurso = _nCdCurso;
END$$


