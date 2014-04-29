<?php
include ("../verifica_logado.php");
header ( 'Content-Type: text/html; charset=utf-8' );
include "login.php";
function consultar_curso_turma($idopcao, $opcao) {
	include_once ('../Util/easy.curl.class.php');
	include_once ('../Util/simple_html_dom.php');
	$curl = new cURL ();
	$url = "";
	if ($opcao == "curso") {
		$url = "http://www.vence.sp.gov.br/remt/av/Cursos-e-Turnos/modulo-curso/aplicacao-mantida/Items-por-pagina-100/";
	}
	if ($opcao == "turma") {
		$url = "http://www.vence.sp.gov.br/remt/av/Turmas/Curso-$idopcao/modulo-curso/aplicacao-mantida/";
	}
	if ($opcao == "modulo") {
		$url = "http://www.vence.sp.gov.br/remt/av/Padrao/Turma-$idopcao/modulo-desempenho//aplicacao-mantida/";
	}
	
	$html = $curl->get ( $url, array (
			CURLOPT_COOKIEFILE => "ckvence.txt" 
	) );
	
	$processar = false;
	if (verificaLogin ( $html )) {
		$processar = true;
	} else {
		logarVence ();
		$html = $curl->get ( $url, array (
				CURLOPT_COOKIEFILE => "ckvence.txt" 
		) );
		if (verificaLogin ( $html )) {
			$processar = $true;
		} else {
			$processar = false;
		}
	}
	$resultado = array ();
	if ($processar) {
		$dom = new simple_html_dom ();
		$dom->load ( $html );
		$linhas = $dom->find ( "table tbody tr" );
		foreach ( $linhas as $linha ) {
			if ($opcao == "curso") {
				if ((trim ( iconv ( "utf-8", "iso-8859-9", trim ( $linha->find ( "td", 0 )->plaintext ) ) ) == $idopcao) || ($idopcao == 0)) {
					
					$ed = iconv ( "utf-8", "iso-8859-9", trim ( $linha->find ( "td", 0 )->plaintext ) );
					$nm = iconv ( "iso-8859-9", "utf-8", trim ( $linha->find ( "td", 2 )->plaintext ) );
					$tr = iconv ( "utf-8", "iso-8859-9", trim ( $linha->find ( "td", 3 )->plaintext ) );
					$aux = explode ( "-", $linha->find ( "a[title=Turmas]", 0 )->href );
					$aux2 = explode ( "/", $aux [1] );
					$id = $aux2 [0];
					
					if ($ed != "") {
						$resultado [] = array (
								"edicao" => $ed,
								"turno" => $tr,
								"idcurso" => $id,
								"nome" => $nm 
						);
					}
				}
			}
			if ($opcao == "turma") {
				$nm = iconv ( "iso-8859-9", "utf-8", trim ( $linha->find ( "td", 0 )->plaintext ) );
				$aux = explode ( "-", $linha->find ( "a[title=Desempenho]", 0 )->href );
				$aux2 = explode ( "/", $aux [1] );
				$id = $aux2 [0];
				if ($nm != "") {
					$resultado [] = array (
							"nome" => $nm,
							"idturma" => $id 
					);
				}
			}
			if ($opcao == "modulo") {
				$nm = iconv ( "iso-8859-9", "utf-8", trim ( $linha->find ( "td", 0 )->plaintext ) );
				$aux = explode ( "-", $linha->find ( "a[title$=de Desempenho]", 0 )->href );
				$aux2 = explode ( "/", $aux [4] );
				$id = $aux2 [0];
				if ($nm != "") {
					$resultado [] = array (
							"nome" => $nm,
							"idmodulo" => $id 
					);
				}
			}
		}
	}
	return $resultado;
}

?>