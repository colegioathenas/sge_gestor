<?php
ini_set ( "display_errors", 1 );
include ('easy.curl.class.php');
include_once ('../geral.php');
include_once ('simple_html_dom.php');
include_once ("../verifica_logado.php");
include_once ("../config.php");
include_once ("../bd.php");
function consulta_scpc($cpf) {
	$query = "SELECT * FROM Consulta_SCPC where nCPF = $cpf";
	$resultado_sql = consulta ( "athenas", $query );
	
	if (count ( $resultado_sql ) == 1) {
		if ($resultado_sql [0] ['bBloqueado'] == '1') {
			$resultado = array (
					'nome' => $resultado_sql [0] ['cNome'],
					'dtNasc' => $resultado_sql [0] ['cNascimento'],
					'situacao' => 'COM RESTRICAO' 
			);
		} else {
			$resultado = array (
					'nome' => $resultado_sql [0] ['cNome'],
					'dtNasc' => $resultado_sql [0] ['cNascimento'],
					'situacao' => 'NADA CONSTA' 
			);
		}
	} else {
		
		$cpf = str_replace ( ".", "", $cpf );
		$cpf = str_replace ( "-", "", $cpf );
		$cpf = str_pad ( $cpf, 11, "0", STR_PAD_LEFT );
		
		$cpf = mask ( $cpf, '###.###.###-##' );
		
		$curl = new cURL ();
		
		$parametro = array (
				'edtcodigo' => '52070393',
				'entidade' => 'SP294',
				'edtsenha' => 'V67TCX' 
		);
		
		$url = "http://app.scpc-online.com.br/login.php";
		
		$curl->post ( $url, $parametro );
		
		$entidade = $curl->info ['url'];
		
		$entidade = explode ( '?', $entidade );
		$entidade = $entidade [1];
		
		$entidade = explode ( '=', $entidade, 2 );
		$entidade = $entidade [1];
		
		$parametro = array (
				'modresposta' => 'htm',
				'csdoccpf' => $cpf,
				'csdocrg' => '',
				'csdocufemirg' => '',
				'cddatanasc' => '',
				'cifoneddd' => '',
				'cifonenumero' => '',
				'cfvalorcredito' => '',
				'cetipocredito' => 'tcNaoGravar',
				'entidade' => $entidade,
				'consulta' => '1' 
		);
		
		$url = "http://ws1.scpc-online.com.br/web2tpc/scripts/pscpc.exe/consulta";
		
		$html = str_get_html ( $curl->post ( $url, $parametro ) );
		
		$cpf = str_replace ( ".", "", $cpf );
		$cpf = str_replace ( "-", "", $cpf );
		
		file_put_contents ( "/var/www/sisescolar/consultas/scpc/$cpf.htm", $html );
		
		$nome = $html->find ( 'div[id=sintesecadastral]', 0 )->find ( 'td', 0 )->plaintext;
		$data_nascimento = $html->find ( 'div[id=sintesecadastral]', 0 )->find ( 'td', 2 )->plaintext;
		$situacao = $html->find ( 'div[id=resumoconsulta]', 0 )->find ( 'tr', 0 )->find ( 'td', 1 )->plaintext;
		
		$resultado = array (
				'nome' => $nome,
				'dtNasc' => $data_nascimento,
				'situacao' => $situacao 
		);
		$bBloqueado = 1;
		if ($situacao == 'NADA CONSTA') {
			$bBloqueado = 0;
		}
		
		$query = "Insert into Consulta_SCPC values ('$cpf','$nome','$data_nascimento', $bBloqueado, 'CONSULTA SCPC');";
		consulta ( "athenas", $query );
		
		$url = "http://ws1.scpc-online.com.br/web2tpc/scripts/pscpc.exe/logout?entidade=$entidade=2";
		$curl->get ( $url );
	}
	
	return $resultado;
}

?>
