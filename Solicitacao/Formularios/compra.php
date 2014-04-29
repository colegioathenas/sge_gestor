<?php
include_once ("../verifica_logado.php");
include_once ("../../config.php");
include_once "../../bd.php";
include_once "../../geral.php";
ini_set ( "display_errors", 0 );

$registro_form = array ();
$solicitacao = getRequest ( "solicitacao", 0 );
if ($solicitacao != 0) {
	$query = "select * from compra where nCdSolicitacao = $solicitacao";
	$registros_form = consulta ( "athenas", $query );
}
?>
<?php if ($solicitacao == 0) {?>
<label style="margin-top: 5px; width: 120px">Item</label>
<input id="lista_item" type="text" size="50" title="Item" value="" />
<label style="margin-top: 5px; width: 120px">Quantidade</label>
<input id="lista_quantidade" type="text" size="3" title="Qtd" value="" />
<button id="lista_adicionar" class='sbtn2' style='margin-top: 15px'>Adicionar</button>
<br />
<?php }?>
<div id="formulario"
	style='border-style: solid; height: 200px; overflow: auto'>
	<table class="tbGrid" id="tbLista">
		<thead>
			<tr>
				<td></td>
				<td>Item</td>
				<td>Qtd</td>
				<td>QtdApr</td>
				<td>QtdComp</td>
			</tr>
		</thead>
		<tbody>
			<tr nr='0'></tr>
<?php
foreach ( $registros_form as $registro_form ) {
	$codigo = $registro_form ['nCdCompra'];
	echo "<tr>";
	echo "<td></td>";
	echo "<td>" . $registro_form ['cItem'] . "</td>";
	echo "<td>" . $registro_form ['nQtd'] . "</td>";
	if ($registro_form ['cFase'] == "A") {
		echo "<td><input size='3' id='compra_$codigo' name='compra_$codigo' codigo='$codigo' /></td>";
	} else {
		echo "<td>" . $registro_form ['nQtdApr'] . "</td>";
	}
	if ($registro_form ['cFase'] == "C") {
		echo "<td><input size='3' id='compra_$codigo' name='compra_$codigo' codigo='$codigo' /></td>";
	} else {
		echo "<td>" . $registro_form ['nQtdCpr'] . "</td>";
	}
	echo "</tr>";
}
?>
	</tbody>
	</table>
</div>