<?php
require ("../config.php");
include_once "../bd.php";
include_once "../geral.php";
ini_set ( "display_errors", 0 );

$curl = curl_init ( 'http://sge.colegioathenas.com.br/rh/espelhodeponto.php' );
curl_setopt ( $curl, CURLOPT_RETURNTRANSFER, true );

$dInicio = $_REQUEST ['inicio'];
$dFim = $_REQUEST ['fim'];

$query = "select funcionario.nCdPessoa from funcionario inner join pessoa on pessoa.nCdPessoa = funcionario.nCdPessoa order by nCdEmpresa,cNome";
$funcionarios = consulta ( "athenas", $query );

$html = "";
foreach ( $funcionarios as $func ) {
	$dados = array (
			'codigo' => $func ['nCdPessoa'],
			'inicio' => $dInicio,
			'fim' => $dFim 
	);
	// Iremos usar o método POST
	curl_setopt ( $curl, CURLOPT_POST, true );
	// Definimos quais informações serão enviadas pelo POST (array)
	curl_setopt ( $curl, CURLOPT_POSTFIELDS, $dados );
	
	$result = curl_exec ( $curl );
	
	// "$i = > reg = ". $reg ." pos = $pos <br/>"
	
	$html .= $result;
	
	$html .= '<br/><br/><img height="1" src="imagens/6.png" width="870" border="0" /><br/><br/>';
}

curl_close ( $curl );
// nossonumero
// valor
// vencimento
// documento

echo $html;

?>
