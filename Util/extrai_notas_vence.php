<pre>
<?php
ini_set ( "display_errors", 1 );
include ('easy.curl.class.php');
include_once ('simple_html_dom.php');

$curl = new cURL ();
$html = $curl->get ( "http://www.vence.sp.gov.br/remt/av/Lancamento-de-Desempenho/Turma-1184/Modulo-2053/modulo-desempenho/aplicacao-mantida/", array (
		CURLOPT_COOKIEFILE => "ckvence.txt" 
) );

$dom = new simple_html_dom ();
$dom->load ( $html );
if (count ( $dom->find ( "input[name=username]" ) ) == 0) {
	echo "OK. Logado!";
	echo count ( $dom->find ( "#username" ) );
} else {
	echo "Não Logado!";
}
echo $html;

$curl->get ( "http://www.vence.sp.gov.br/remt/av/Logout/aplicacao-mantida/", array (
		CURLOPT_COOKIEFILE => "ckvence.txt" 
) );

$html = $curl->get ( "http://sge_gestor/Util/teste_vence.html" );
$dom = new simple_html_dom ();
$dom->load ( $html );

$disciplinas = $dom->find ( "div.frequencia" );
$lstDisciplina = array ();
foreach ( $disciplinas as $disciplina ) {
	$lstDisciplina [] = trim ( $disciplina->plaintext );
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
$resultado = array ();
foreach ( $notas as $nota ) {
	$idAlunoArray = explode ( "[", $nota->getAttribute ( "name" ) );
	$idAluno = substr ( $idAlunoArray [1], 0, strlen ( $idAlunoArray [1] ) - 1 );
	if ($idAlunoAnt != $idAluno) {
		if ($idxAluno >= 0) {
			$resultado [] = array (
					"Aluno" => $lstAlunos [$idxAluno],
					"Notas" => $lstNotas 
			);
		}
		$idAlunoAnt = $idAluno;
		$idxAluno ++;
		$idxDisciplina = 0;
		$lstNotas = array ();
	}
	$lstNotas [$lstDisciplina [$idxDisciplina]] = trim ( $nota->find ( 'option[selected]', 0 )->plaintext );
	$idxDisciplina ++;
}
print_r ( $resultado );

?>
</pre>