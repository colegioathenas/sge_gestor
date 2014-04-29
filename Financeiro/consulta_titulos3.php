<?php
require ("../config.php");
include_once "../bd.php";
include_once "../geral.php";
ini_set ( "display_errors", 0 );

$cpf = $_REQUEST ['cpf'];

$query = "SELECT Pessoa.cNome, Count(*) as qtdBol, Min(dVcto) as minVcto, Max(dVcto) as maxVcto, SUM(nVlrTitulo) as vlrTotal
			 	    from titulos  
			 	    	  inner join Pessoa on titulos.nCdPessoa = Pessoa.nCdPessoa 
			 	   where dVcto < CURDATE() 
			 	     and TipDtOcorrencia is null
			 	     and Pessoa.nCdPessoa = $cpf
			 Group by Pessoa.cNome";

$resultado = consulta ( "athenas", $query );

$retorno = array (
		"cNome" => $resultado [0] ['cNome'],
		"qtdBol" => $resultado [0] ['qtdBol'],
		"minVcto" => date ( 'd/m/Y', strtotime ( $resultado [0] ['minVcto'] ) ),
		"maxVcto" => date ( 'd/m/Y', strtotime ( $resultado [0] ['maxVcto'] ) ),
		"vlrTotal" => number_format ( $resultado [0] ['vlrTotal'], 2, ",", "." ) 
);

echo json_encode ( $retorno );

?>