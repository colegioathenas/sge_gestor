<?php
include ("../verifica_logado.php");
require ("../config.php");
include_once "../bd.php";
include_once "../geral.php";
ini_set ( "display_errors", 0 );
session_start ();

?>
<html>
<head>
<meta charset="UTF-8" />

<style type="text/css" media="all">
body {
	font-family: "Times New Roman";
	font-size: 12;
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
	text-indent: 10mm;
	text-align: justify;
	font-family: "Times New Roman";
	font-size: 14;
	line-height: 150%;
}

table.tbassinatura {
	
}
</style>

</head>

<body>
	
	<?php
	$cpf = $_REQUEST ['cpf'];
	$cpf = preg_replace ( '#[^0-9]#', '', $cpf );
	$query = "SELECT Pessoa.cNome,titulos.* 
			 	    from titulos 
			 	    	  inner join Pessoa on titulos.nCdPessoa = Pessoa.nCdPessoa 
			 	   where dVcto < CURDATE() 
			 	     and TipDtOcorrencia is null
			 	     and Pessoa.nCdPessoa = $cpf";
	
	$resultados = consulta ( 'athenas', $query );
	$nome = $resultados [0] ['cNome'];
	?>
 
<div align="center" style="width: 800px">
		<p class='paragrafo'>
			Prezado Senhor (a): <b><?php echo $nome; ?></b>
		</p>
		<p class='paragrafo' style="font-family: Courier">
			Referente:<br />
		
		
		<table
			style="margin-left: 30px; border-style: solid; border-width: 1px">
			<thead>
				<tr>
					<td style="width: 200px">Duplicata</td>
					<td style="width: 100px">Vencimento</td>
					<td style="width: 200px; text-align: right">Valor</td>
				</tr>
			</thead>
		<?php
		$total = 0;
		foreach ( $resultados as $resultado ) {
			$total = $total + $resultado ['nVlrTitulo'];
			echo "<tr>";
			echo "<td>" . $resultado ['SeuNum'] . "</td>";
			echo "<td>" . date ( 'd/m/Y', strtotime ( $resultado ['dVcto'] ) ) . "</td>";
			echo "<td align='right'>" . number_format ( $resultado ['nVlrTitulo'], 2, ",", "." ) . "</td>";
			echo "</tr>";
		}
		echo "<tr><td colspan=2></td><td align='right'>" . number_format ( $total, 2, ",", "." ) . "</td></tr>";
		?>
		
	</table>
		</p>

		<p class='paragrafo'>Vimos por meio desta informar -lhe que
			encontra-se em nosso poder título de sua responsabilidade acusando
			falta de pagamento.</p>
		<p class='paragrafo'>Solicitamos seu comparecimento no prazo
			improrrogável de 48 (quarenta e oito) horas, para regularização desta
			pendência. Deram-nos amplos poderes de negociação e estamos certos
			que nada poderá impedir a solução desta pendência.</p>
		<p class='paragrafo'>
			Expediente: <br /> <b> <span style="margin-left: 10mm;"> Segunda a
					Quinta: Das 07h00min às 16h30min </span> <br /> <span
				style="margin-left: 10mm;"> Sexta-feira: Das 07h00min às 15h30min </b>
		</p>
		</p>
		<p class='paragrafo'>No intuito de evitar graves transtornos em sua
			ficha cadastral na praça, proporcionamos-lhes várias oportunidades
			para a regularização do débito referenciado, sem que V.S.a levassem
			na devida conta a gravidade do assunto.</p>
		<p class='paragrafo'>A falta de pagamento implicará o relacionamento
			de sua dívida para exame de nosso setor jurídico e posterior cobrança
			judicial executiva.</p>
		<p class='paragrafo'>
			<b>(Caso V.S.a já tenha efetuado o pagamento, favor contatar-nos pelo
				telefone (11) 4651-2729 para tornar este aviso sem efeito.)</b>
		</p>
		<p class='paragrafo'>Aguardando uma solução urgente para o assunto,
			subscrevemo-nos</p>
		<p class='paragrafo'>Atenciosamente,</p>
		<br /> <br />
		<p class='paragrafo'>
			<b>Elaine Santos</b><br /> <span style="margin-left: 36px;">Depto de
				cobrança</span><br /> <span style="margin-left: 36px;">Instituto
				Educacional JR LTDA</span>

		</p>
	</div>
</body>
</html>