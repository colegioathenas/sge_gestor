<?php
ini_set ( "display_errors", 1 );
include ("../verifica_logado.php");
require ("../config.php");
include_once "../bd.php";

$curso = $_REQUEST ['curso'];

$query = "CALL lista_aluno_turma($curso);";

$registros = consulta ( 'athenas', $query );

?>

<table class="tbGrid">  
<?php
$i = 1;
$qtd = count ( $registros );
foreach ( $registros as $registro ) {
	$codigo = $registro ['nCdMatricula'];
	$numero = str_pad ( $registro ['nChamada'], 2, '0', STR_PAD_LEFT );
	$status = $registro ['nCdStatus'];
	$nome = $registro ['cNome'];
	$rm = str_pad ( $registro ['nCdPessoa'], 5, '0', STR_PAD_LEFT );
	;
	
	$selMatriculado = "";
	$selTransferido = "";
	$selDesistente = "";
	switch ($status) {
		case "1" :
			$selMatriculado = "selected='selected'";
			break;
		case "2" :
			$selTransferido = "selected='selected'";
			break;
		case "3" :
			$selDesistente = "selected='selected'";
			break;
	}
	
	echo "<tr>                    
                    <td width='40px'><a href='#' name=\"btnExcluir\" codigo='$codigo'><img src=\"/image/icon_delete.png\"></a></td>
                    <td width='40px'>$numero</td>
                    <td>$nome</td>
                    <td width='100px'>$rm</td>                               
			";
	if ($i == 1) {
		echo "<td width='10px'></td>";
	} else {
		echo "<td width='10px'><a href='#' name=\"btnUP\" codigo='$codigo'><img src=\"/image/arrow_up.png\" width='10px'></a></td>";
	}
	if ($i == $qtd) {
		echo "<td width='10px'></td>";
	} else {
		echo "<td width='10px'><a href='#' name=\"btnDown\" codigo='$codigo'><img src=\"/image/arrow_down.png\" width='10px'></a></td>";
	}
	echo "<td width='100px'><select name='atualiza_matricula' chamada='$numero' matricula='$codigo'>
                				      <option value='1' $selMatriculado >Matriuclado</option>
                					  <option value='2' $selTransferido >Transferido</option>
                					  <option value='3' $selDesistente >Desistente</option>
                				  </select> </td>";
	echo "</tr>";
	$i ++;
}
?>
</table>


