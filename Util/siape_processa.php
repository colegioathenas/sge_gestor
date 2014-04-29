<pre>
<?php
$arquivo_nome = "/home/antonio/Downloads/SIAPE.txt";
$arquivo = fopen ( $arquivo_nome, "r" );
$stroption = "";
$registros = array ();
$continua = false;
while ( ! feof ( $arquivo ) ) {
	// registro = array();
	$linha = fgets ( $arquivo );
	if (strpos ( $linha, "*** CONTINUA" )) {
		for($j = 1; $j <= 12; $j ++) {
			$linha = fgets ( $arquivo );
			while ( (substr ( trim ( $linha ), 0, 1 ) == "*") ) {
				$linha = fgets ( $arquivo );
			}
		}
	}
	
	if ((substr ( trim ( $linha ), 0, 1 ) == "*")) {
		// cho $linha;
		$linha = fgets ( $arquivo );
	}
	
	// cho $str_option."<br/>";
	// cho $str_option." - ".$linha."<br/>";
	
	if ($str_option == "rodape_3") {
		
		$registro ['RUBRICAS_RENDIMENTO'] = $rendimentos;
		$registro ['RUBRICAS_DESCONTO'] = $descontos;
		$registros [] = $registro;
		$rendimentos = array ();
		$descontos = array ();
		$str_option = "processando";
	}
	
	if ($str_option == "rodape_2") {
		$str_option = "rodape_3";
	}
	
	if ($str_option == "rodape_1") {
		$str_option = "rodape_2";
	}
	
	if ((substr ( trim ( $linha ), 0, 17 ) == "TOTAL RENDIMENTOS")) {
		$str_option = "rodape_1";
	}
	
	if ($str_option == "rubricas") {
		if (trim ( substr ( $linha, 5, 5 ) != "     " )) {
			$rendimento = array ();
			$rendimento ['TP_INCLUSAO'] = trim ( substr ( $linha, 5, 5 ) );
			$rendimento ['RUBRICA_COD'] = trim ( substr ( $linha, 12, 5 ) );
			$rendimento ['RUBRICA_DSC'] = trim ( substr ( $linha, 18, 30 ) );
			$rendimento ['SEQ'] = trim ( substr ( $linha, 47, 3 ) );
			$rendimento ['PRZ'] = trim ( substr ( $linha, 51, 2 ) );
			$rendimento ['VALOR'] = trim ( substr ( $linha, 59, 11 ) );
			$rendimentos [] = $rendimento;
		}
		
		if ((trim ( substr ( $linha, 71, 3 ) != "   " )) && (trim ( substr ( $linha, 71, 3 ) != "" ))) {
			$desconto = array ();
			$desconto ['TP_INCLUSAO'] = trim ( substr ( $linha, 71, 3 ) );
			$desconto ['RUBRICA_COD'] = trim ( substr ( $linha, 75, 5 ) );
			$desconto ['RUBRICA_DSC'] = trim ( substr ( $linha, 82, 30 ) );
			$desconto ['SEQ'] = trim ( substr ( $linha, 112, 2 ) );
			$desconto ['PRZ'] = trim ( substr ( $linha, 116, 2 ) );
			$desconto ['VALOR'] = trim ( substr ( $linha, 120 ) );
			$descontos [] = $desconto;
		}
	}
	
	if ($str_option == "cabecalho_2") {
		
		$registro ['MAT_SIAPE_INST'] = trim ( substr ( $linha, 5, 8 ) );
		$registro ['NOME_INSTITUIDOR'] = trim ( substr ( $linha, 16, 55 ) );
		$registro ['COTAS'] = trim ( substr ( $linha, 71, 9 ) );
		$registro ['CPF'] = trim ( substr ( $linha, 80, 12 ) );
		$registro ['DATA_TERM'] = trim ( substr ( $linha, 94, 10 ) );
		$registro ['IR'] = trim ( substr ( $linha, 105, 2 ) );
		$registro ['BANCO'] = trim ( substr ( $linha, 108, 3 ) );
		$registro ['AGENCIA'] = trim ( substr ( $linha, 112, 7 ) );
		$registro ['CONTA'] = trim ( substr ( $linha, 120 ) );
		$str_option = "rubricas";
	}
	
	if ($str_option == "cabecalho_1") {
		$registro ['MAT_SIAPE'] = trim ( substr ( $linha, 5, 8 ) );
		$registro ['NOME_BENEFICIARIO'] = trim ( substr ( $linha, 16, 55 ) );
		$registro ['AMPARO_LEGAL'] = trim ( substr ( $linha, 71, 52 ) );
		$registro ['NATUREZA'] = trim ( substr ( $linha, 120 ) );
		$str_option = "cabecalho_2";
	}
	
	if (($str_option == "processando") && (substr ( trim ( $linha ), 0, 5 ) == "-----")) {
		$str_option = "cabecalho_1";
	}
	
	if (($str_option == "cabecalho") && (substr ( trim ( $linha ), 0, 22 ) == "RUBRICAS DE RENDIMENTO")) {
		$str_option = "processando";
	}
	
	if ($str_option == "orgao") {
		$registro ['orgao'] = trim ( substr ( $linha, 19, 77 ) );
		$registro ['upag'] = trim ( substr ( $linha, 112, 23 ) );
		$str_option = "cabecalho";
	}
	
	if ($str_option == "data_rel") {
		$registro ['data_rel'] = substr ( $linha, 125, 9 );
		$str_option = "orgao";
	}
	
	if ($str_option == "mes_ref") {
		
		$registro ['mes_ref'] = substr ( $linha, 127, 7 );
		
		$str_option = "data_rel";
	}
	
	// cho trim(substr($linha, 5,63));
	if (trim ( substr ( $linha, 5, 63 ) ) == "SIAPE - SISTEMA INTEGRADO DE ADMINISTRACAO DE RECURSOS HUMANOS") {
		$str_option = "mes_ref";
	}
}
fclose ( $arquivo );

// *
echo 'mes_ref' . ";" . 'data_rel' . ";" . 'orgao' . ";" . 'upag' . ";" . 'CPF' . ";" . 'MAT_SIAPE' . ";" . 'NOME_BENEFICIARIO' . ";" . 'MAT_SIAPE_INST' . ";" . 'NOME_INSTITUIDOR' . ";" . 'BANCO' . ";" . 'AGENCIA' . ";" . 'CONTA' . ";" . 'COTAS' . ";" . 'DATA_TERM' . ";" . 'IR' . ";" . 'AMPARO_LEGAL' . ";" . 'NATUREZA' . ";" . 'TP_INCLUSAO' . ";" . 'RUBRICA_COD' . ";" . 'RUBRICA_DSC' . ";" . 'SEQ' . ";" . 'PRZ' . ";" . 'VALOR' . ";" . "<br/>";
foreach ( $registros as $registro ) {
	// rint_r($registro);
	foreach ( $registro ['RUBRICAS_RENDIMENTO'] as $rendimento ) {
		$str = $registro ['mes_ref'] . ";" . $registro ['data_rel'] . ";" . $registro ['orgao'] . ";" . $registro ['upag'] . ";" . $registro ['CPF'] . ";" . $registro ['MAT_SIAPE'] . ";" . $registro ['NOME_BENEFICIARIO'] . ";" . $registro ['MAT_SIAPE_INST'] . ";" . $registro ['NOME_INSTITUIDOR'] . ";" . $registro ['BANCO'] . ";" . $registro ['AGENCIA'] . ";" . $registro ['CONTA'] . ";" . $registro ['COTAS'] . ";" . $registro ['DATA_TERM'] . ";" . $registro ['IR'] . ";" . $registro ['AMPARO_LEGAL'] . ";" . $registro ['NATUREZA'] . ";" . $rendimento ['TP_INCLUSAO'] . ";" . $rendimento ['RUBRICA_COD'] . ";" . $rendimento ['RUBRICA_DSC'] . ";" . $rendimento ['SEQ'] . ";" . $rendimento ['PRZ'] . ";" . $rendimento ['VALOR'] . ";";
		echo $str . "<br/>";
	}
	foreach ( $registro ['RUBRICAS_DESCONTO'] as $desconto ) {
		$str = $registro ['mes_ref'] . ";" . $registro ['data_rel'] . ";" . $registro ['orgao'] . ";" . $registro ['upag'] . ";" . $registro ['CPF'] . ";" . $registro ['MAT_SIAPE'] . ";" . $registro ['NOME_BENEFICIARIO'] . ";" . $registro ['MAT_SIAPE_INST'] . ";" . $registro ['NOME_INSTITUIDOR'] . ";" . $registro ['BANCO'] . ";" . $registro ['AGENCIA'] . ";" . $registro ['CONTA'] . ";" . $registro ['COTAS'] . ";" . $registro ['DATA_TERM'] . ";" . $registro ['IR'] . ";" . $registro ['AMPARO_LEGAL'] . ";" . $registro ['NATUREZA'] . ";" . $desconto ['TP_INCLUSAO'] . ";" . $desconto ['RUBRICA_COD'] . ";" . $desconto ['RUBRICA_DSC'] . ";" . $desconto ['SEQ'] . ";" . $desconto ['PRZ'] . ";" . "-" . $desconto ['VALOR'] . ";";
		echo $str . "<br/>";
	}
}
?>
</pre>