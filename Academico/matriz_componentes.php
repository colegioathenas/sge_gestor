<?php
include ("../verifica_logado.php");
require ("../config.php");
include_once "../bd.php";
include_once "../geral.php";
ini_set ( "display_errors", 0 );
session_start ();

$codigo = $_SESSION ['cpf'];

$query = "select disciplina.cNmDisciplina,matriz_disciplina.* from matriz_disciplina inner join disciplina on matriz_disciplina.nCdDisciplina = disciplina.nCdDisciplina where nCdMatriz = $codigo order by nModulo,cNmDisciplina";
$registros = consulta ( "athenas", $query );
?>
<table class="tbGrid" id="tbComponentes">
	<thead>
		<tr>
			<td width='40px'></td>
			<td width='40px'></td>
			<td width='300px'>Disciplina</td>
			<td width='150px'>Divisão</td>
			<td width='90px'>TP</td>
			<td width='90px'>E</td>
			<td></td>
		</tr>
	</thead>
<?php
$total = 0;
foreach ( $registros as $registro ) {
	$codigo = $registro ['nCdComponente'];
	$disciplina = $registro ['cNmDisciplina'];
	$disciplina_cod = $registro ['nCdDisciplina'];
	$modulo = $registro ['nModulo'];
	$tp = $registro ['nCHTeoricoPratico'];
	$e = $registro ['nCHEstagio'];
	
	if ($modulo == 0) {
		$modulotxt = "TODAS";
	} else {
		$modulotxt = $modulo . "º Divisão";
	}
	
	echo "<tr>";
	
	echo "  <td><a href='' name='btnEditar' codigo='$codigo' ><img src='/image/icon_edit.png' /></a></td>
                        <td><a href='' name='btnExcluir'  codigo='$codigo'><img src='/image/icon_delete.png'/></a></td>
			  <td valing='top'>$disciplina</td>
			  <td valing='top'>$modulotxt</td>
		 	  <td valing='top'>$tp</td>
			  <td valing='top'>$e</td>
                        <td><input type='hidden' name='action' codigo='$codigo' disciplina='$disciplina_cod' chtp='$tp' che='$e'  modulo='$modulo'/></td>";
	echo "</tr>";
}

?>
</table>