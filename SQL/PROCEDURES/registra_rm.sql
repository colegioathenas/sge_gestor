delimiter $$

CREATE PROCEDURE `registra_rm`(_nome varchar(255))
BEGIN
	insert into RM (cNome) values (_nome);
	select @@identity AS aluno_mat;
END$$


