<?php
include_once ('../Util/easy.curl.class.php');
include_once ('../Util/simple_html_dom.php');
include_once "cursos_turma.php";
include_once "login.php";
ini_set ( "display_errors", 0 );

$curl = new cURL ();
$edicao = $_REQUEST ['edicao'];
$idcurso = $_REQUEST ['idcurso'];
$idturma = $_REQUEST ['idturma'];

$cursoIDs = array ();
$turmaIDs = array ();
if ($idturma != "0") {
	$turmaIDs [] = $idturma;
} else {
	if ($idcurso != "0") {
		$cursoIDs [] = $idcurso;
	} else {
		$cursos = consultar_curso_turma ( $edicao, "curso" );
		foreach ( $cursos as $curso ) {
			$cursoIDs [] = $curso ["idcurso"];
		}
	}
	foreach ( $cursoIDs as $cursoID ) {
		$turmas = consultar_curso_turma ( $cursoID, "turma" );
		foreach ( $turmas as $turma ) {
			$turmaIDs [] = $turma ["idturma"];
		}
	}
}

$resultado = array ();
$AllDisciplinas = array ();
foreach ( $turmaIDs as $turmaID ) {
	$modulos = consultar_curso_turma ( $turmaID, "modulo" );
	
	foreach ( $modulos as $modulo ) {
		$url = "http://www.vence.sp.gov.br/remt/av/Lancamento-de-Desempenho/Turma-$turmaID/Modulo-" . $modulo ["idmodulo"] . "/modulo-desempenho/aplicacao-mantida/";
		$processar = false;
		$html = $curl->get ( $url, array (
				CURLOPT_COOKIEFILE => "ckvence.txt" 
		) );
		if (verificaLogin ( $html )) {
			$processar = true;
		} else {
			logarVence ();
			$html = $curl->get ( $url, array (
					CURLOPT_COOKIEFILE => "ckvence.txt" 
			) );
		}
		
		$dom = new simple_html_dom ();
		$dom->load ( $html );
		
		$disciplinas = $dom->find ( "div.frequencia" );
		$lstDisciplina = array ();
		foreach ( $disciplinas as $disciplina ) {
			$lstDisciplina [] = $modulo ["nome"] . " - " . iconv ( "iso-8859-9", "utf-8//IGNORE", trim ( $disciplina->plaintext ) );
			$AllDisciplinas [] = $modulo ["nome"] . " - " . iconv ( "iso-8859-9", "utf-8//IGNORE", trim ( $disciplina->plaintext ) );
		}
		
		$nomes = $dom->find ( "div.nome" );
		$lstAlunos = array ();
		foreach ( $nomes as $nome ) {
			$nm = trim ( $nome->plaintext );
			$rm = trim ( $nome->parent ()->parent ()->find ( "td", 0 )->plaintext );
			$lstAlunos [] = array (
					"RA" => $rm,
					"Nome" => $nm 
			);
		}
		$notas = $dom->find ( "select[name^=idNotaAlu]" );
		$idxAluno = - 1;
		$idxDisciplina = - 1;
		$idAlunoAnt = "";
		
		foreach ( $notas as $nota ) {
			$idAlunoArray = explode ( "[", $nota->getAttribute ( "name" ) );
			$idAluno = substr ( $idAlunoArray [1], 0, strlen ( $idAlunoArray [1] ) - 1 );
			if ($idAlunoAnt != $idAluno) {
				if ($idxAluno >= 0) {
					if (array_key_exists ( $lstAlunos [$idxAluno] ["RA"], $resultado )) {
						
						$resultado [$lstAlunos [$idxAluno] ["RA"]] ["Notas"] = array_merge ( $resultado [$lstAlunos [$idxAluno] ["RA"]] ["Notas"], $lstNotas );
					} else {
						$resultado [$lstAlunos [$idxAluno] ["RA"]] = array (
								"Aluno" => $lstAlunos [$idxAluno],
								"Notas" => $lstNotas 
						);
					}
				}
				$idAlunoAnt = $idAluno;
				$idxAluno ++;
				$idxDisciplina = 0;
				$lstNotas = array ();
			}
			$aux = explode ( "-", trim ( $nota->find ( 'option[selected]', 0 )->plaintext ) );
			$aluno_nota = trim ( $aux [0] );
			$lstNotas [$lstDisciplina [$idxDisciplina]] = $aluno_nota;
			$idxDisciplina ++;
		}
	}
	//
}

$linha = "RM;Nome";
foreach ( $AllDisciplinas as $disciplina ) {
	$linha .= ";" . $disciplina;
}
$linha .= "\r\n";
foreach ( $resultado as $registro ) {
	$linha .= $registro ["Aluno"] ["RA"] . ";";
	$linha .= $registro ["Aluno"] ["Nome"];
	foreach ( $registro ["Notas"] as $nota ) {
		$linha .= ";" . $nota;
	}
	$linha .= "\r\n";
}
$fileName = "file" . date ( "YmdHis" ) . "txt";
file_put_contents ( $fileName, $linha );
header ( 'Content-Type: text/csv' );
header ( 'Content-Disposition: attachment; filename=notas.csv' );
header ( 'Pragma: no-cache' );
readfile ( $fileName );
?>
