delimiter $$

CREATE PROCEDURE `verifica_vaga`(_nCdCurso int, _cTurno char(1))
BEGIN
	Declare _nVagas int;
	Declare _nMatriculas int;

	Select count(*) into _nMatriculas from matriculado where serie = _nCdCurso and matriculado.cTurno = _cTurno;

	select Sum(nVagas) into _nVagas  from Turma where nCdCurso = _nCdCurso and cTurno = _cTurno;

	Select _nVagas - _nMatriculas as QtdVaga;

END$$


