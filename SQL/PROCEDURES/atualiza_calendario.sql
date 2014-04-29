delimiter $$

CREATE  PROCEDURE `atualiza_calendario`( _dCalendario  	datetime
, _nCdProfessor 	decimal(14,0)
, _nCdDisciplina  int
, _nCdTurma		int
)
BEGIN
	IF EXISTS(select 1 from calendario where dCalendario = _dCalendario and nCdTurma = _nCdTurma) THEN
		UPDATE calendario
		   SET dCalendario = _dCalendario
			 , nCdProfessor = _nCdProfessor
			 , nCdDisciplina = _nCdDisciplina
			 , nCdTurma	  = _nCdTurma
		 WHERE dCalendario = _dCalendario and nCdTurma = _nCdTurma;
	ELSE
		INSERT INTO calendario (dCalendario,nCdProfessor,nCdDisciplina, nCdTurma) 
			  values (_dCalendario, _nCdProfessor, _nCdDisciplina, _nCdTurma);
	END IF;
END$$

