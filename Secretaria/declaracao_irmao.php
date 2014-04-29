<?php
include ("../verifica_logado.php");
require ("../config.php");
include_once "../bd.php";
include_once "../geral.php";
ini_set ( "display_errors", 0 );
session_start ();

$matricula = $_SESSION ['mat'];

$query = "SELECT * FROM matriculado WHERE aluno_mat = '$matricula'";

$resultado = consulta ( "athenas", $query );

$registro = $resultado [0];

switch ($registro ['serie']) {
	case 1 :
		$curso_name = 'ENSINO FUNDAMENTAL I -  1&deg; ANO';
		break;
	case 2 :
		$curso_name = 'ENSINO FUNDAMENTAL I -  2&deg; ANO';
		break;
	case 3 :
		$curso_name = 'ENSINO FUNDAMENTAL I -  3&deg; ANO';
		break;
	case 4 :
		$curso_name = 'ENSINO FUNDAMENTAL I -  4&deg; ANO';
		break;
	case 5 :
		$curso_name = 'ENSINO FUNDAMENTAL I -  5&deg; ANO';
		break;
	case 6 :
		$curso_name = 'ENSINO FUNDAMENTAL II -  6&deg; ANO';
		break;
	case 7 :
		$curso_name = 'ENSINO FUNDAMENTAL II -  7&deg; ANO';
		break;
	case 8 :
		$curso_name = 'ENSINO FUNDAMENTAL II -  8&deg; ANO';
		break;
	case 9 :
		$curso_name = 'ENSINO FUNDAMENTAL II -  9&deg; ANO';
		break;
	case 10 :
		$curso_name = 'ENSINO MEDIO -  1&deg; ANO';
		break;
	case 11 :
		$curso_name = 'ENSINO MEDIO -  2&deg; ANO';
		break;
	case 12 :
		$curso_name = 'ENSINO MEDIO -  3&deg; ANO';
		break;
}

$aluno_nome = $registro ['aluno_nome'];
$aluno_dtnasc = $registro ['aluno_dtnasc'];
$aluno_naturalidade = $registro ['aluno_naturalidade'];
;
$aluno_nacionalidade = $registro ['aluno_nacionalidade'];
;
$aluno_rgra = $registro ['aluno_rg'];
;
$aluno_curso = $curso_name;

$contratante_nome = $registro ['resp_nome'];
$contratante_grau_parentesco = $registro ['resp_parentesco'];
$contratante_nacionalidade = $registro ['resp_nacionalidade'];
$contratante_rg = $registro ['resp_rg'];
$contratante_cpf = $registro ['resp_cpf'];
$contratante_profissao = $registro ['resp_profissao'];
$contratante_end_residencial = $registro ['resp_end_res_end'] . " - " . $registro ['resp_end_res_bairro'] . " - " . $registro ['resp_end_res_cidade'] . " - " . $registro ['resp_end_res_uf'];
$contratante_end_comercial = $registro ['resp_end_com_end'] . " - " . $registro ['resp_end_com_bairro'] . " - " . $registro ['resp_end_com_cidade'] . " - " . $registro ['resp_end_com_uf'];
$contratante_tel_comercial = "(" . $registro ['resp_com_ddd'] . ")" . $registro ['resp_com_tel'];
$contratante_tel_residencial = "(" . $registro ['resp_res_ddd'] . ")" . $registro ['resp_res_tel'];
$contratante_tel_celular = "(" . $registro ['resp_cel_ddd'] . ")" . $registro ['resp_cel_tel'];
$contratante_naturalidade = $registro ['resp_naturalidade'];
$contratante_est_civil = $registro ['resp_est_civ'];

$irmao_nome = $registro ['cNomeIrmao'];
$irmao_serie = "";
switch ($registro ['nSerieIrmao']) {
	case 1 :
		$irmao_serie = 'ENSINO FUNDAMENTAL I -  1&deg; ANO';
		break;
	case 2 :
		$irmao_serie = 'ENSINO FUNDAMENTAL I -  2&deg; ANO';
		break;
	case 3 :
		$irmao_serie = 'ENSINO FUNDAMENTAL I -  3&deg; ANO';
		break;
	case 4 :
		$irmao_serie = 'ENSINO FUNDAMENTAL I -  4&deg; ANO';
		break;
	case 5 :
		$irmao_serie = 'ENSINO FUNDAMENTAL I -  5&deg; ANO';
		break;
	case 6 :
		$irmao_serie = 'ENSINO FUNDAMENTAL II -  6&deg; ANO';
		break;
	case 7 :
		$irmao_serie = 'ENSINO FUNDAMENTAL II -  7&deg; ANO';
		break;
	case 8 :
		$irmao_serie = 'ENSINO FUNDAMENTAL II -  8&deg; ANO';
		break;
	case 9 :
		$irmao_serie = 'ENSINO FUNDAMENTAL II -  9&deg; ANO';
		break;
	case 10 :
		$irmao_serie = 'ENSINO MEDIO -  1&deg; ANO';
		break;
	case 11 :
		$irmao_serie = 'ENSINO MEDIO -  2&deg; ANO';
		break;
	case 12 :
		$irmao_serie = 'ENSINO MEDIO -  3&deg; ANO';
		break;
}

$valor = $registro ['val_mensalidade'];
$qtd_parcela = $registro ['fpg_mensalidade'];

$valor_parcela = 490;

if ($qtd_parcela == 1) {
	$qtd_parcela = 12;
}

$valor_parcela = $valor / $qtd_parcela;

$vencimento = '5. DIA UTIL';
$valor_extenso = htmlentities ( extenso ( $valor ), ENT_QUOTES, 'UTF-8' );

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
</style>
<meta charset="UTF-8" />
</head>

<body>

	<div align="center" style="width: 800px">
<?php
echo "<span style='font-family:\"Comic Sans MS\";font-weight: bold;font-size:12pt;font-style:italic'> DECLARACAO DE CIENCIA </span>";

?>
<p>
		
		
		<p class='paragrafo'>
	Eu <?php echo $contratante_nome; ?>, portador do RG <?php echo $contratante_rg; ?>, e do CPF <?php echo $contratante_cpf; ?> declaro para os devidos fins que tenho conhecimento que o desconto
	de 5% (cinco por cento) concedido nas mensalidades do aluno <?php echo $aluno_nome ?>, estudante do <?php echo $curso_name; ?> é válida durante o ano de 2013 e 
	enquando o aluno <?php echo $irmao_serie; ?> estiver devidamente matriculado na série <?php echo $irmao_serie;?>
</p>
		<p class='paragrafo'>
	No caso de desistencia, trancamento ou transferencia do aluno <?php echo $irmao_nome; ?> os títulos emitidos em <?php date('d/m/Y'); ?> deveram ser
	trocados no setor financeiro da escola

		
		
		<p class='paragrafo'>Sem mais</p>
		<table width='100%'>
			<tr>
				<td colspan='3' align="center">ARUJA <?php setlocale(LC_ALL, "pt_BR"); echo strftime("%d de %B de %Y"); ?></td>
			</tr>
			<tr height="100px">

			</tr>
			<tr>
				<td width='300px'
					style="border-top-style: solid; border-top-color: black; border-top-width: 0.5">CONTRATANTE
				</td>

			</tr>
			<tr>
				<td><?php echo $contratante_nome; ?>
			<br />
			CPF:<?php echo $contratante_cpf; ?></td>
				<td></td>
				<td></td>
			</tr>
		</table>
	</div>
</body>
</html>