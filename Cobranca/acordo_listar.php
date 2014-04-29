<?php
ini_set ( "display_errors", 0 );
include ("../verifica_logado.php");
require ("../config.php");
include_once "../bd.php";

$value = $_REQUEST ['valor'];
$popup = $_REQUEST ['popup'];
$query = "select acordo.*,cNome from acordo inner join pessoa on acordo.nCPF = pessoa.nCdPessoa where cNome like '%$value%' or nCdPessoa = '$value' order by dAcordo DESC";

$registros = consulta ( 'athenas', $query );
?>

<table style='width: 100%'>
	<thead>
		<tr>
			<td></td>
			<td>Numero</td>
			<td>CPF</td>
			<td>Nome</td>
			<td>Status</td>
		</tr>
	</thead>
	
<?php
$i = 0;
foreach ( $registros as $registro ) {
	$i ++;
	if ($i % 2 == 0) {
		$color = 'white';
	} else {
		$color = 'gray';
	}
	$numero = str_pad ( $registro ['nCdAcordo'], 6, '0', STR_PAD_LEFT ) . "/" . date ( "Y", strtotime ( $registro ['dAcordo'] ) );
	$codigo = $registro ['nCdAcordo'];
	$nome = $registro ['cNome'];
	$status = $registro ['nCdStatus'];
	$cpf = $registro ['nCdPessoa'];
	switch ($status) {
		case 1 :
			$statusStr = 'Pendente';
			break;
		case 2 :
			$statusStr = 'Aprovado';
			break;
		case 99 :
			$statusStr = 'Reprovado';
			break;
	}
	
	echo "<tr style='background-color: $color'>";
	if ($popup == "sim") {
		echo "<td><a href='#' name='selecionar' codigo='$codigo' nome='$nome' >Acessar</a></td>";
	} else {
		echo "<td><a href='acordo_detalhe.php?acordo=$codigo' >Acessar</a></td>";
	}
	echo "<td>$numero</td>";
	echo "<td>$cpf</td>";
	echo "<td>$nome</td>";
	echo "<td>$statusStr</td>";
	
	echo "</tr>";
}

?>

</table>
