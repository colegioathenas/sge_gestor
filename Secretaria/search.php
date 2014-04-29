<?php
include ("../verifica_logado.php");
require ("../config.php");
include_once "../bd.php";
ini_set ( "display_errors", 0 );
header ( 'Content-Type: text/html; charset=iso-8859-1' );

$q = $_GET ['term'];
$my_data = mysql_real_escape_string ( $q );

$consulta = $_REQUEST ['consulta'];
if ($consulta == 'lista') {
	$query = "call listaNomes('%$my_data%');";
	$resultado = consulta ( "acadesc", $query );
	foreach ( $resultado as $row ) {
		$names [] = array (
				'id' => $row ['Classe'],
				'label' => $row ['Nome'],
				'value' => $row ['Nome'],
				'info' => $row ['Mat'],
				'cpfresp' => $row ['CPFResp'] 
		);
	}
	
	echo json_encode ( $names );
}
if ($consulta == 'matricula') {
	
	$serie = $_REQUEST ['serie'];
	$query = "call consulta_matriculados($serie,'%$my_data%');";
	$resultado = consulta ( "athenas", $query );
	foreach ( $resultado as $row ) {
		$names [] = array (
				'id' => $row ['aluno_mat'],
				'label' => $row ['aluno_nome'],
				'value' => $row ['Nome'] 
		);
	}
	echo json_encode ( $names );
}
if ($consulta == 'pessoa') {
	
	$cpf = $_REQUEST ['cpf'];
	$cpf = preg_replace ( '#[^0-9]#', '', $cpf );
	$query = "SELECT *, INSERT(INSERT(INSERT( RIGHT( CONCAT(REPEAT(\"0\",11), nCPF), 11),4,0,\".\"),8,0,\".\"),12,0,\"-\") AS nCPFFormatado 
     , INSERT( RIGHT( CONCAT(REPEAT(\"0\",8), nCEP), 8),6,0,\"-\") AS nCEPFormatado
     , DATE_FORMAT( dNasc , '%d/%m/%Y' ) AS dNascFormatado
     , INSERT( RIGHT( CONCAT(REPEAT(\"0\",8), cEnd_com_cep), 8),6,0,\"-\") AS cEnd_com_cepFormatado
 		 FROM pessoa where (nCdPessoa = $cpf) or (nCpf = $cpf) and $cpf != 0";
	$resultado = consulta ( "athenas", $query );
	if (count ( $resultado ) == 0) {
		echo json_encode ( array (
				"cNome" => "" 
		) );
	} else {
		echo json_encode ( $resultado [0] );
	}
}
if ($consulta == 'dependente') {
	
	$cpf = $_REQUEST ['cpf'];
	$cpf = preg_replace ( '#[^0-9]#', '', $cpf );
	$query = "SELECT nCdPessoa,cNome
				FROM pessoa where nCdRespFin = $cpf and $cpf != 0";
	$resultado = consulta ( "athenas", $query );
	if (count ( $resultado ) == 0) {
		echo json_encode ( array (
				"cNome" => "" 
		) );
	} else {
		echo json_encode ( $resultado );
	}
}

?>