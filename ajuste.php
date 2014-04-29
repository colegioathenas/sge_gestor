<pre>
<?php
require ("config.php");
include_once "bd.php";
include_once "geral.php";
ini_set ( "display_errors", 0 );

$mes_inicio = 1;
$query_refazer = "SELECT refazer.* FROM refazer inner join matriculado on refazer.aluno_mat  = matriculado.aluno_mat  where matriculado.aluno_mat = '001844' order by resp_nome";

$refazers = consulta ( "athenas", $query_refazer );

foreach ( $refazers as $refazer ) {
	print_r ( $refazer );
	
	$resp_cpf = $refazer ['resp_cpf'];
	$fpg_material = $refazer ['fpg_material'];
	$fpg_mensalidade = $refazer ['fpg_mensalidade'];
	$fpg_uniforme = $refazer ['fpg_uniforme'];
	$val_uniforme = $refazer ['val_uniforme'];
	$serie = $refazer ['serie'];
	$irmao_mat = $refazer ['irmao_mat'];
	$aluno_mat = $refazer ['aluno_mat'];
	$aluno_nome = $refazer ['aluno_nome'];
	
	echo "<br/>call acadesc.listaNomes('$aluno_nome%');<br/>";
	
	$val_material = 0;
	$val_mensalidade = 0;
	
	if ($serie >= - 2 && $serie <= 0) {
		$val_material = 352.93;
		$val_mensalidade = 4323.30;
	}
	
	if ($serie >= 1 && $serie <= 5) {
		$val_material = 593.28;
		$val_mensalidade = 4323.30;
	}
	if ($serie >= 6 && $serie <= 9) {
		$val_material = 861.47;
		$val_mensalidade = 4439.10;
	}
	if ($serie >= 10 && $serie <= 12) {
		$val_material = 1383.92;
		$val_mensalidade = 5187.90;
	}
	if ($serie == 13) {
		$val_material = 1208.42;
	}
	
	if ($irmao_mat != "") {
		$percentual_desconto = 0.05;
	} else {
		$percentual_desconto = 0.1;
	}
	
	$val_mensalidade = $val_mensalidade / $fpg_mensalidade;
	
	for($i = 1; $i <= $fpg_mensalidade; $i ++) {
		
		$SeuNum = "1" . $aluno_mat . "2013" . str_pad ( $i, 2, "0", STR_PAD_LEFT ) . str_pad ( $fpg_mensalidade, 2, "0", STR_PAD_LEFT );
		$dVctoSql = date ( 'Y-m-d', f5diautil ( ($mes_inicio + $i - 1), 2013 ) );
		$dVcto = date ( 'd/m/Y', f5diautil ( ($mes_inicio + $i - 1), 2013 ) );
		$dEmissao = date ( 'Y-m-d' );
		
		$nVlrDescontoSql = $val_mensalidade * $percentual_desconto;
		$nVlrMultaSql = $val_mensalidade * 0.1;
		$nVlrJurosSql = $val_mensalidade * 0.0033;
		
		$nVlrMulta = number_format ( $nVlrMultaSql, 2, ",", "." );
		$nVlrJuros = number_format ( $nVlrJurosSql, 2, ",", "." );
		$nVlrDesconto = number_format ( $nVlrDescontoSql, 2, ",", "." );
		
		$cMensagem1 = "- MULTA DE  		R$:   $nVlrMulta APOS $dVcto";
		$cMensagem2 = "- JUROS DE  		R$:   $nVlrJuros AO DIA";
		$cMensagem3 = "- DESCONTO DE    R$    $nVlrDesconto ATE $dVcto OU PROXIMO DIA UTIL";
		$cMensagem4 = "NAO RECEBER APOS 30 DIAS DE ATRASO";
		$cMensagem5 = "REF: Mensalidade " . str_pad ( $i, 2, "0", STR_PAD_LEFT ) . "/" . str_pad ( $fpg_mensalidade, 2, "0", STR_PAD_LEFT ) . " - Aluno $aluno_nome";
		
		$query = "INSERT INTO Titulos (nCdPessoa, SeuNum, dVcto, dEmissao, nVlrTitulo, nVlrJuros, dDesconto, nVlrDesconto
					, dMulta, nVlrMulta, cMensagem1, cMensagem2, cMensagem3, cMensagem4,cMensagem5)
					VALUES ('$resp_cpf','$SeuNum','$dVctoSql','$dEmissao','$val_mensalidade','$nVlrJurosSql','$dVctoSql','$nVlrDescontoSql'
					,'$dVctoSql','$nVlrMultaSql','$cMensagem1','$cMensagem2','$cMensagem3','$cMensagem4','$cMensagem5');";
		
		echo $query . "<br/>";
		// consulta("athenas", $query);
	}
	
	// ************************* M A T E R I A L **************************************//
	$val_material = $val_material / $fpg_material;
	for($i = 1; $i <= $fpg_material; $i ++) {
		
		$SeuNum = "2" . $aluno_mat . "2013" . str_pad ( $i, 2, "0", STR_PAD_LEFT ) . str_pad ( $fpg_material, 2, "0", STR_PAD_LEFT );
		
		if ($fpg_material == 1) {
			$nVlrDescontoSql = $val_material * 0.05;
		} else {
			$nVlrDescontoSql = 0;
		}
		$dVctoSql = date ( 'Y-m-d', f5diautil ( ($mes_inicio + $i - 1), 2013 ) );
		$dVcto = date ( 'd/m/Y', f5diautil ( ($mes_inicio + $i - 1), 2013 ) );
		$dEmissao = date ( 'Y-m-d' );
		
		$nVlrMultaSql = $val_material * 0.1;
		$nVlrJurosSql = $val_material * 0.0033;
		
		$nVlrMulta = number_format ( $nVlrMultaSql, 2, ",", "." );
		$nVlrJuros = number_format ( $nVlrJurosSql, 2, ",", "." );
		$nVlrDesconto = number_format ( $nVlrDescontoSql, 2, ",", "." );
		
		$cMensagem1 = "- MULTA DE  		R$:   $nVlrMulta APOS $dVcto";
		$cMensagem2 = "- JUROS DE  		R$:   $nVlrJuros AO DIA";
		$cMensagem3 = "- DESCONTO DE    R$    $nVlrDesconto ATE $dVcto OU PROXIMO DIA UTIL";
		$cMensagem4 = "NAO RECEBER APOS 30 DIAS DE ATRASO";
		$cMensagem5 = "REF: Material Didatico " . str_pad ( $i, 2, "0", STR_PAD_LEFT ) . "/" . str_pad ( $fpg_material, 2, "0", STR_PAD_LEFT ) . " - Aluno $aluno_nome";
		;
		
		$query = "INSERT INTO Titulos (nCdPessoa, SeuNum, dVcto, dEmissao, nVlrTitulo, nVlrJuros, dDesconto, nVlrDesconto
					, dMulta, nVlrMulta, cMensagem1, cMensagem2, cMensagem3, cMensagem4,cMensagem5)
					VALUES ('$resp_cpf','$SeuNum','$dVctoSql','$dEmissao','$val_material','$nVlrJurosSql','$dVctoSql','$nVlrDescontoSql'
					,'$dVctoSql','$nVlrMultaSql','$cMensagem1','$cMensagem2','$cMensagem3','$cMensagem4','$cMensagem5');";
		
		echo $query . "<br/>";
		// consulta("athenas", $query);
	}
	// ************************* U N I F O R M E **************************************//
	$val_uniforme = $val_uniforme / $fpg_uniforme;
	for($i = 1; $i <= $fpg_uniforme; $i ++) {
		$mesvcto = $mes_inicio + $i - 1;
		$SeuNum = "3" . $aluno_mat . "2013" . str_pad ( $i, 2, "0", STR_PAD_LEFT ) . str_pad ( $fpg_uniforme, 2, "0", STR_PAD_LEFT );
		$dVctoSql = date ( 'Y-m-d', f5diautil ( ($mes_inicio + $i - 1), 2013 ) );
		$dVcto = date ( 'd/m/Y', f5diautil ( ($mes_inicio + $i - 1), 2013 ) );
		$dEmissao = date ( 'Y-m-d' );
		
		$nVlrDescontoSql = 0;
		$nVlrMultaSql = $val_uniforme * 0.1;
		$nVlrJurosSql = $val_uniforme * 0.0033;
		
		$nVlrMulta = number_format ( $nVlrMultaSql, 2, ",", "." );
		$nVlrJuros = number_format ( $nVlrJurosSql, 2, ",", "." );
		$nVlrDesconto = number_format ( $nVlrDescontoSql, 2, ",", "." );
		
		$cMensagem1 = "- MULTA DE  		R$:   $nVlrMulta APOS $dVcto";
		$cMensagem2 = "- JUROS DE  		R$:   $nVlrJuros AO DIA";
		$cMensagem3 = "- DESCONTO DE    R$    $nVlrDesconto ATE $dVcto OU PROXIMO DIA UTIL";
		$cMensagem4 = "NAO RECEBER APOS 30 DIAS DE ATRASO";
		$cMensagem5 = "REF: Uniforme " . str_pad ( $i, 2, "0", STR_PAD_LEFT ) . "/" . str_pad ( $fpg_uniforme, 2, "0", STR_PAD_LEFT ) . " - Aluno $aluno_nome";
		;
		
		$query = "INSERT INTO Titulos (nCdPessoa, SeuNum, dVcto, dEmissao, nVlrTitulo, nVlrJuros, dDesconto, nVlrDesconto
					, dMulta, nVlrMulta, cMensagem1, cMensagem2, cMensagem3, cMensagem4,cMensagem5)
					VALUES ('$resp_cpf','$SeuNum','$dVctoSql','$dEmissao','$val_uniforme','$nVlrJurosSql','$dVctoSql','$nVlrDescontoSql'
					,'$dVctoSql','$nVlrMultaSql','$cMensagem1','$cMensagem2','$cMensagem3','$cMensagem4','$cMensagem5');";
		
		echo $query . "<br/>";
		// consulta("athenas", $query);
	}
}

// rotina para atualizar NossoNumero
$query = "SELECT * FROM Titulos where nNossoNumero is null";
$resultado = consulta ( 'athenas', $query );
foreach ( $resultado as $registro ) {
	$nCdBoleto = $registro ['nCdBoleto'];
	$nosso_numero = gerarNossoNumero ( $nCdBoleto );
	
	$query = "UPDATE Titulos set nNossoNumero = '$nosso_numero' where nCdBoleto = $nCdBoleto";
	
	echo "$nCdBoleto => $nosso_numero <br/>";
	
	// consulta("athenas",$query);
}
?>
</pre>