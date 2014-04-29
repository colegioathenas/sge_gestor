delimiter $$

CREATE  PROCEDURE `consulta_matriculados`(_serie int,_nome varchar(50))
BEGIN
    SELECT aluno_mat, aluno_nome, serie from matriculado where serie = _serie and aluno_nome like _nome;
    
END$$


