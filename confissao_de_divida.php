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
echo "<span style='font-family:\"Comic Sans MS\";font-weight: bold;font-size:12pt;font-style:italic'> INSTRUMENTO PARTICULAR DE CONFISS&Atilde;O DE D&Iacute;VIDA </span>";

?>

<p>
		
		
		<table width='635' border='1px' class='tabela'>
			<tr>
				<td colspan='3' align='center'><b>D E V E D O R</b></td>
			</tr>
			<tr>
				<th colspan='3' align="top" class='minititle'>Nome</th>

			</tr>
			<tr>
				<td colspan='3' class='texto'><?php echo $devedor_nome; ?></td>

			</tr>
			<tr>
				<th align="top" class='minititle'>RG</th>
				<th align="top" colspan='2' class='minititle'>CPF</th>

			</tr>
			<tr>
				<td class='texto'><?php echo $devedor_rg; ?></td>
				<td class='texto' colspan='2'><?php echo $devedor_cpf; ?></td>

			</tr>

			<tr>
				<th colspan='3' align="top" class='minititle'>Endere&ccedil;o</th>

			</tr>
			<tr>
				<td colspan='3' class='texto'><?php echo $devedor_endereco; ?></td>

			</tr>

		</table>
		</p>
		<p>
		
		
		<table width='635' border='1px' class='tabela'>
			<tr>
				<td colspan='3' align='center'><b>C R E D O R</b></td>
			</tr>
			<tr>
				<th colspan='2' align="top" class='minititle'>Nome</th>
				<th align="top" class='minititle'>CNPJ</th>
			</tr>
			<tr>
				<td colspan='2' class='texto'>INSTITUTO EDUCACIONAL JR LTDA</td>
				<td class='texto'>07.228.276/0001-70</td>
			</tr>
			<tr>
				<th colspan='3' align="top" class='minititle'>Endereco</th>

			</tr>
			<tr>
				<td colspan='3' class='texto'>PRACA NARCISO JOSE LOPES, 138</td>

			</tr>
			<tr>
				<th align="top" class='minititle'>Bairro</th>
				<th align="top" class='minititle'>Cidade</th>
				<th align="top" class='minititle'>Estado</th>
			</tr>
			<tr>
				<td class='texto'>CENTRO</td>
				<td class='texto'>ARUJA</td>
				<td class='texto'>SAO PAULO</td>
			</tr>
		</table>

		<p class='paragrafo'>
			<b>Cl&aacute;usula 1&ordf;</b>: . O (A) DEVEDOR(A) reconhece e confessa na melhor forma de direito dever ao CREDOR nesta data, a import&acirc;ncia l&iacute;quida, certa e exig&iacute;vel de R$ <?php echo number_format($divida_valor,2,",","."); ?> (<?php echo $divida_valor_extenso; ?>) referente &agrave;: <?php echo $divida_referencia?>.
<br /> <b>Cl&aacute;usula 2&ordf;</b>: Em decorr&ecirc;ncia da
			d&iacute;vida ora confessada, o DEVEDOR(A) compromete-se a
			quit&aacute;-la conforme anexo proposta de quita&ccedil;&atilde;o de
			divida em anexo; <br /> <b>Cl&aacute;usula 3&ordf;</b>: O n&atilde;o
			pagamento de quaisquer das parcelas, descritas na proposta de
			quita&ccedil;&atilde;o de divida em anexo, implicar&aacute; no
			VENCIMENTO ANTECIPADO DA D&Iacute;VIDA, podendo o CREDOR exigi-la do
			(a) DEVEDOR(A) independentemente de notifica&ccedil;&atilde;o par
			este fim; <br /> <b>PAR&Aacute;GRAFO &Uacute;NICO.</b> O CREDOR
			poder&aacute;, por mera liberalidade, receber os valores das parcelas
			em atraso, por&eacute;m devidamente atualizadas em conformidade com o
			IGPM e acrescidas de juros legais, al&eacute;m da multa equivalente a
			2% (dois por cento) do valor do d&eacute;bito em aberto, acrescido
			por sua vez de honor&aacute;rios advocat&iacute;cios em
			id&ecirc;ntico percentual, n&atilde;o implicando esses recebimentos
			em nova&ccedil;&atilde;o ou modifica&ccedil;&atilde;o do ajustado,
			inclusive quanto aos encargos decorrentes de eventual mora. <br /> <b>Cl&aacute;usula
				4&ordf;</b>: A assinatura do presente Instrumento Particular importa
			em confiss&atilde;o definitiva e irretrat&atilde;vel do d&acute;bito,
			sem que isso implique em nova&ccedil;&atilde;o ou
			transa&ccedil;&atilde;o da d&iacute;vida, configurando ainda, por sua
			natureza,confiss&atilde;o extrajudicial nos termos da
			legisla&ccedil;&atilde;o em vigor, em especial os artigos 348, 353 e
			354 do C&oacute;digo de Processo Civil Brasileiro; <br /> <b>Cl&aacute;usula
				5&ordf;</b>: O presente Instrumento Particular possui for&ccedil;a
			de t&iacute;tulo executivo extrajudicial, nos exatos termos do artigo
			585, I, do C&oacute;digo de Processo Civil Brasileiro, podendo ser
			livremente executado na forma do artigo 580, do referido diploma
			legal, ap&oacute;s, constatada inadimpl&ecirc;ncia por parte do (a)
			DEVEDOR(A) preenchidos ou requisitos processuais necess&aacute;rios
			para tanto. <br />
			<b>PAR&Aacute;GRAFO &Uacute;NICO</b>. No caso do CREDOR ser obrigado
			a socorrer-se dos meios judiciais cab&iacute;veis para o recebimento
			da d&iacute;vida ora confessada, o(a) DEVEDOR(A) suportar&aacute;,
			al&eacute;m das custas e despesas judiciais e extraordin&aacute;rias(
			c&oacute;pias, autentica&ccedil;&otilde;es, reconhecimento de
			firmas,etc.) os honor&aacute;rios advocat&iacute;cios, desde
			j&aacute; arbitrados em 20% (vinte por cento) do valor da
			d&iacute;vida. <br /> <b>Cl&aacute;usula 6&ordf;</b>:O presente
			Instrumento Particular &eacute; firmado em car&aacute;ter
			irrevog&aacute;vel e irretrat&aacute;vel, obrigando-se as partes por
			si e seus sucessores. <br /> <b>Cl&aacute;usula 7&ordf;</b>:As partes
			elegem o foro da Vara Distrital de Aruj&aacute;, da Comarca de Santa
			Isabel como &uacute;nico, para dirimir quaisquer d&uacute;vidas
			porventura alu&iacute;das no presente Instrumento Particular. <br />E
			por estarem assim de acordo, justas e contratadas, <b>DEVEDOR(A)</b>
			e <b>CREDOR</b>, assinam o presente instrumento particular,firmando-o
			juntamente com as 02 (duas) testemunhas abaixo qualificadas, na
			melhor forma de direito, e em 02 (duas) vias de igual teor e
			conte&uacute;do.
		</p>
		<table width='100%'>
			<tr>
				<td colspan='3' align="center">ARUJA <?php
				
setlocale ( LC_TIME, 'ptb', 'pt_BR', 'portuguese-brazil', 'bra', 'brazil', 'pt_BR.utf-8', 'pt_BR.iso-8859-1', 'br' );
				echo strftime ( "%d de %B de %Y" );
				?></td>
			</tr>
			<tr height="50px">

			</tr>
			<tr>
				<td width='300px'
					style="border-top-style: solid; border-top-color: black; border-top-width: 0.5;">INSTITUTO
					EDUCACIONAL JR LTDA<br />CNPJ: 07.228.276/0001-70<br />(CREDOR)
				</td>
				<td></td>
				<td width='300px'
					style="border-top-style: solid; border-top-color: black; border-top-width: 0.5">Testemunha</td>
			</tr>
			<tr height="50px">

			</tr>
			<tr>
				<td width='300px'
					style="border-top-style: solid; border-top-color: black; border-top-width: 0.5"><?php echo $devedor_nome; ?><br />CPF:<?php echo $devedor_cpf; ?><br />DEVEDOR(A)
				</td>
				<td></td>
				<td width='300px'
					style="border-top-style: solid; border-top-color: black; border-top-width: 0.5;"
					align="top">Testemunha</td>
			</tr>

		</table>
	</div>
	<p class='quebra' />
</body>
</html>
