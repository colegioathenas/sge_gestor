<?php
include ("../verifica_logado.php");
require ("../config.php");
include_once "../bd.php";
include_once "../geral.php";
ini_set ( "display_errors", 0 );
session_start ();

$cpf = ereg_replace ( "[^0-9]", "", $_REQUEST ['cpf'] );

$query = "select disciplina.* from professor_disciplina inner join disciplina on professor_disciplina.nCdDisciplina = disciplina.nCdDisciplina where nCPF = $cpf";
$registros = consulta ( "athenas", $query );
?>
<table id="tbProfessorDisciplina">
<?php
$total = 0;
foreach ( $registros as $registro ) {
	$codigo = $registro ['nCdDisciplina'];
	$nome = $registro ['cNmDisciplina'];
	$sigla = $registro ['cSigla'];
	
	echo "<tr>";
	echo "<td  width='20px'><img src='../image/remove_icon.png' name='disciplina_remover' url='professor_disciplina_remover.php?disciplina=$codigo' height='15px' title='Excluir Disciplina'/></td>
			  <td width='250px' valing='top'>$nome</td>
			  <td width='150px' valing='top'>$sigla</td>
			  <td><input type='hidden' name='disciplina_action' codigo='$codigo' value='' ></td>";
	echo "</tr>";
}

?>
</table>