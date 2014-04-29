<?php
session_start ();
ini_set ( "display_errors", 0 );
include ("../verifica_logado.php");
require ("../config.php");
include_once "../bd.php";

setlocale ( LC_TIME, 'ptb', 'pt_BR', 'portuguese-brazil', 'bra', 'brazil', 'pt_BR.utf-8', 'pt_BR.iso-8859-1', 'br' );

$login = $_SESSION ['nCdUsuario'];
$ch = $_REQUEST ['ch'];
$turma = $_REQUEST ['turma'];
$divisao = $_REQUEST ['divisao'];
$disciplina = $_REQUEST ['disciplina'];

$query_planejamento = "Select * from planejamento where nCdTurma = $turma and nCdDivisao = $divisao and nCdDisciplina = $disciplina";
$registros_planejamento = consulta ( "athenas", $query_diarios );

$planejamentos = array ();
foreach ( $planejamentos as $planejamento ) {
	
	$$planejamentos [$planejamento ["nAula"]] = $planejamento;
}

$nAulas = $ch / 5;
for($nAula = 1; $nAula <= $nAula; $nAula ++) {
	$nmAula = $planejamentos [$nAula] ["cNmAula"];
	$objetivo = $planejamentos [$nAula] ["cObjetivo"];
	$conteudo = $planejamentos [$nAula] ["cConteudo"];
	$html .= "<tr>";
	$html .= "<td>$nAula</td>        			  
        			  <td width='100px'><input name='aula$nAula' aula='$nAula' value='$nmAula'/></td>
        			  <td ><textarea name='objetivo$nAula'>$objetivo</textarea></td>
        			  <td ><textarea name='conteudo$nAula' >$conteudo</textarea></td>
        			  ";
	$html .= "</tr>";
}
echo "<table class='tBody'> 
                $html
             </table>";

?>

