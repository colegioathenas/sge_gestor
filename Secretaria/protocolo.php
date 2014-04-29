
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

ul {
	text-align: left;
	font-size: 14;
}
</style>
<meta charset="utf-8">

</head>

<body>

	<div align="center" style="width: 800px">
<?php
$nome = "JOSE MARTINS DA SILVA";
$cpf = "001.002.003-44";
$solicitacoes = "Dosimetro para 8 meses de estagio;Historico Escolar - 3.Ano Ensino Medio - JOSE MARTINS DA SILVA JUNIOR;Seguro de Vida - vigencia de 1 ano";
$solicitacoes = explode ( ';', $solicitacoes );

echo "<span style='font-family:\"Comic Sans MS\";font-weight: bold;font-size:12pt;font-style:italic'> SOLICITACAO </span>";

?>

<p class='paragrafo'>
	<?php echo "Eu $nome, portador(a) do cpf: $cpf, venho por meio desta solicitar: " ; ?>
</p>
		<p class='paragrafo'>
		
		
		<table width='100%'>
			<tr height="100px">
				<td>
					<ul>
		<?php
		foreach ( $solicitacoes as $solicitacao ) {
			echo "<li>$solicitacao</li>";
		}
		?>
		</ul>
				</td>
			</tr>
		</table>
		</p>
		<p class='paragrafo'>Declaro que fui informado(a) referente ao custo e
			ao prazo de cada solicitacao, no caso de solicitacao de documentos
			estou ciente da necessidade de apresentacao do comprovante de
			pagamento para retirada do(s) mesmo(s)</p>
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
					EDUCACIONAL JR LTDA</td>
				<td></td>
				<td width='300px'
					style="border-top-style: solid; border-top-color: black; border-top-width: 0.5"><?php echo $nome; ?></td>
			</tr>


			<tr>
				<td>CNPJ: 07.228.276/0001-70</td>
				<td></td>
				<td>CPF:<?php echo $cpf; ?></td>
			</tr>
		</table>
		<p style="font-size: 15px; text-align: left"> 
<?php
$protocolo = "201311121426120";
$usuario = "Antonio Carlos";
echo "Protocolado eletronicamente sob o numero $protocolo, por $usuario";
?>
</p>

</body>
</html>
