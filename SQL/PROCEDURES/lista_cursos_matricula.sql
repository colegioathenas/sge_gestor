delimiter $$

CREATE  PROCEDURE `lista_cursos_matricula`()
BEGIN
	SELECT Cursos.nCdCurso,Cursos.cNmCurso
	  FROM TURMA
			INNER JOIN Cursos ON Cursos.nCdCurso = Turma.nCdCurso
	 WHERE bMatriculasAbertas = 1
	Group by nCdCurso,cNmCurso;
END$$


