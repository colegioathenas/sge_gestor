delimiter $$

CREATE PROCEDURE `acordo_inclui`( _cpf	decimal(14,0)
, _usuario int
, _vlrDivida decimal(15,2)
, _nVlrDesconto decimal(15,2)
)
BEGIN
	insert into acordo (nCPF,dAcordo,nCdUsuario,nVlrDivida,nVlrDesconto,nCdStatus) values (_cpf,CURDATE(),_usuario,_vlrDivida,_nVlrDesconto,1); 
	Select @@identity as codigo;
END$$


