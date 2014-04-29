<?php
ini_set ( "display_errors", 0 );
include ("../verifica_logado.php");
require ("../config.php");
include_once "../bd.php";

$value = $_REQUEST ['valor'];
$opcao = $_REQUEST ['opcao'];
$grupo = $_SESSION ['nCdGrupo'];
$usuario = $_SESSION ['nCdUsuario'];

$popup = $_REQUEST ['popup'];
$query = "SELECT solicitacao.nCdSolicitacao 
		 , dSolicitacao
	     , tpsolicitacao.`cNmTpSolicitacao`
	     , cNome
	     , dPrazo
	     , CASE IFNULL(solicitacao_fluxo.cSubFase,'I')
		    WHEN 'I' THEN tpsolicitacao_fase.cNmFaseInicial
		    WHEN 'A' THEN tpsolicitacao_fase.cNmFaseAndamento
		    WHEN 'F' THEN tpsolicitacao_fase.cNmFaseConcluido
		END AS cNmFase
		, cNmFaseAndamento
		, nCdFase
		, tpsolicitacao.nCdTpSolicitacao		
		, solicitacao_fluxo.cSubFase
	     , CASE WHEN `tpsolicitacao_fase`.`cTpFase` = 'F' THEN 'Finalizado' ELSE 'ANDAMENTO' END AS cStatus
	  FROM solicitacao 
	       INNER JOIN pessoa ON solicitacao.nCdPessoa = pessoa.nCdPessoa
	       INNER JOIN tpsolicitacao ON tpsolicitacao.nCdTpSolicitacao = solicitacao.`nCdTpSolicitacao`
	       INNER JOIN `solicitacao_fluxo` ON solicitacao_fluxo.nCdSolicitacao = solicitacao.`nCdSolicitacao`
	       INNER JOIN tpsolicitacao_fase ON tpsolicitacao_fase.`nCdTpSolicitacaoFase` = solicitacao_fluxo.`nCdFase`				    
	WHERE solicitacao_fluxo.`dFluxo` = (SELECT MAX(dFluxo) FROM solicitacao_fluxo WHERE nCdSolicitacao = solicitacao.`nCdSolicitacao`)       
	  AND (cNome like '%$value%' or solicitacao.nCdSolicitacao = '$value' )";
if ($opcao == "ABT") {
	$query .= "AND `tpsolicitacao_fase`.`cTpFase` != 'F' ";
}
if ($opcao == "FLA") {
	$query .= "AND tpsolicitacao_fase.`nCdGrupo` in (select nCdGrupo from usuario_grupo where usuario_grupo.nCdUsuario = $usuario)";
}

$registros = consulta ( 'athenas', $query );
?>

<table class="tbGrid">
	<thead>
		<tr>
			<td></td>
			<td>Data</td>
			<td>Tipo de Solicitacao</td>
			<td>Requerente</td>
			<td>Prazo</td>
			<td>Fase Atual</td>
			<td>Status</td>
		</tr>
	</thead>
	
<?php
$i = 0;
foreach ( $registros as $registro ) {
	
	$solicitacao = $registro ['nCdSolicitacao'];
	$data = date ( "d/m/Y", strtotime ( $registro ['dSolicitacao'] ) );
	$tipo = $registro ['cNmTpSolicitacao'];
	$requerente = $registro ['cNome'];
	$prazo = date ( "d/m/Y", strtotime ( $registro ['dPrazo'] ) );
	$fase = $registro ['cNmFase'];
	$status = $registro ['cStatus'];
	$subfase = $registro ['cSubFase'];
	$cdfase = $registro ['nCdFase'];
	$cdtipo = $registro ['nCdTpSolicitacao'];
	if ($registro ['cNmFaseAndamento'] == "") {
		$subfase = "X";
	}
	
	echo "<tr>";
	echo "<td><a href='solicitacao_detalhe.php?solicitacao=$solicitacao&subfase=$subfase&fase=$cdfase&tipo=$cdtipo' >Acessar</a></td>";
	echo "<td>$data</td>";
	echo "<td>$tipo</td>";
	echo "<td>$requerente</td>";
	echo "<td>$prazo</td>";
	echo "<td>$fase</td>";
	echo "<td>$status</td>";
	echo "</tr>";
}

?>

</table>
