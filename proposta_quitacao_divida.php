<?php
ini_set ( "display_errors", 0 );
require ("config.php");
include_once "bd.php";
include_once "geral.php";

session_start ();

$nCdAcordo = $_REQUEST ['acordo'];

$query = "Select * from acordo inner join Pessoa on Pessoa.nCdPessoa = Acordo.nCPF where nCdAcordo = $nCdAcordo";

$resultado = consulta ( "athenas", $query );

$registro = $resultado [0];

$devedor_nome = $registro ['cNome'];
$devedor_rg = $registro ['cRG'];
$devedor_cpf = $registro ['nCPF'];
$devedor_endereco = $registro ['cLogradouro'] . "-" . $registro ['cComplemento'] . "-" . $registro ['cBairro'] . "-" . $registro ['cCidade'] . "-" . $registro ['cUF'] . "- CEP: " . $registro ['nCEP'];
$divida_valor = $registro ['nVlrDivida'];
$divida_desconto = $registro ['nVlrDesconto'];
$divida_valor_extenso = htmlentities ( trim ( extenso ( $divida_valor ) ), ENT_QUOTES, 'UTF-8' );

$query = "Select * from acordo_referencia where nCdAcordo = $nCdAcordo";
$resultado = consulta ( "athenas", $query );
$divida_referencia = "";

foreach ( $resultado as $referencia ) {
	$divida_referencia = $divida_referencia . $referencia ['cReferencia'] . ", ";
}
$divida_referencia = substr ( $divida_referencia, 0, strlen ( $divida_referencia ) - 2 );

?>
<html>
<head>

<style type="text/css" media="all">
body {
	font-family: "Times New Roman";
	font-size: 10;
}

.texto {
	font-family: "Times New Roman";
	font-size: 12;
}

.minititle {
	font-family: "Times New Roman";
	font-size: 8;
}

table.tabela {
	border-width: 0.3px;
	border-spacing: 0px;
	border-style: solid;
	border-color: black;
	border-collapse: collapse;
}

table.tabela th {
	border-width: 0.3px;
	padding: 5px;
	border-bottom: none;
	border-color: black;
	text-align: left;
}

table.tabela td {
	border-width: 0.5px;
	padding: 5px;
	padding-top: 0px;
	border-style: solid;
	border-top-style: none;
	border-color: black;
}

.paragrafo {
	text-align: justify;
	font-family: "Times New Roman";
	font-size: 14;
	line-height: 150%;
}

table.tbassinatura {
	
}

p.quebra {
	page-break-before: always;
}
</style>
<meta charset="utf-8">

</head>

<body>

	<div align="center" style="width: 800px">
<?php
echo "<span style='font-family:\"Comic Sans MS\";font-weight: bold;font-size:12pt;font-style:italic'> PROPOSTA DE QUITA&Ccedil;&Atilde;O DE D&Iacute;VIDA </span>";

?>


<table width='635' border='1px' class='tabela'>
			<tr style='background-color: black; color: white;'>
				<td colspan='4' style="text-align: center;"><b>Proposta</b></td>
			</tr>
			<tr>
				<td><b>Proposta Nr.</b></td>
				<td colspan='3' style='font-family: Courier New;'><?php echo str_pad($nCdAcordo, 6, '0', STR_PAD_LEFT)?></td>
			</tr>
			<tr>
				<td><b>Nome</b></td>
				<td colspan='3' style='font-family: Courier New;'><?php echo $devedor_nome;?></td>
			</tr>
			<tr>
				<td><b>Valor da Divida</b></td>
				<td style='font-family: Courier New;'>R$ <?php echo number_format($divida_valor,2,',','.');?></td>
				<td><b>Valor do Desconto</b></td>
				<td style='font-family: Courier New;'>R$ <?php echo number_format($divida_desconto,2,',','.');?></td>
			</tr>
			<tr style='background-color: black; color: white;'>
				<td colspan='4' style="text-align: center;"><b>Fluxo de Pagamento</b></td>
			</tr>
			<tr>
				<td><b>Data</b></td>
				<td><b>Valor</b></td>
				<td colspan='2'><b>Forma de Pagamento</b></td>
			</tr>
	<?php
	$query = "Select * from acordo_fluxo_pgto where nCdAcordo = $nCdAcordo";
	$resultado = consulta ( 'athenas', $query );
	foreach ( $resultado as $fluxo ) {
		$data = date ( "d/m/Y", strtotime ( $fluxo ['dPagamento'] ) );
		
		$valor = $fluxo ['nVlrPagamento'];
		$valor = number_format ( $valor, 2, ",", "." );
		
		$especie = $fluxo ['nCdEspecie'];
		
		switch ($especie) {
			case 1 :
				$especieStr = 'Especie';
				break;
			case 2 :
				$especieStr = 'Cheque';
				break;
			case 3 :
				$especieStr = 'Boleto';
				break;
		}
		
		echo "<tr>
				<td style='font-family:Courier New;'>$data</td>
				<td style='font-family:Courier New;'>$valor</td>
				<td colspan='2' style='font-family:Courier New;'>$especieStr</td>
			</tr>";
	}
	?>
</table>
		<p class='paragrafo'>
	Eu <?php echo $devedor_nome;?>, portador do CPF <?php echo $devedor_cpf;?>. Declaro estar ciente que:
	<br /> 1. Este documento &eacute; uma proposta, e requer
			aprova&ccedil;&atilde;o para ser efetivado <br /> 2. No caso de
			atraso em algum dos pagamentos descriminados acima, o acordo fica
			cancelado e a divida ser&aacute; recalculada. <br /> 3. Caso exista
			desconto, o mesmo sera dilu�do em cada boleto gerado;
		</p>
		<table width='300' border='0'>
			<tr style="height: 200px" />
			<tr>
				<td
					style="text-align: center; border-top-style: solid; border-top-color: black; border-top-width: 0.5"><?php echo $devedor_nome;?><br />CPF: <?php echo $devedor_cpf;?></td>
			</tr>
		</table>
	</div>
	<p class='quebra' />
</body>
</html>
