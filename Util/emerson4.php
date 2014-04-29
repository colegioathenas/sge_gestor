<?php
?>



<?php

ini_set ( "display_errors", "On" );

include ('easy.curl.class.php');

include_once ('simple_html_dom.php');

$search = array (
		"'<script[^>]*?>.*?</script>'si", // Strip out javascript
		
		"'<[/!]*?[^<>]*?>'si", // Strip out HTML tags
		                       
		// "'([rn])[s]+'", // Strip out white space
		
		"'&(quot|#34);'i", // Replace HTML entities
		
		"'&(amp|#38);'i",
		
		"'&(lt|#60);'i",
		
		"'&(gt|#62);'i",
		
		"'&(nbsp|#160);'i",
		
		"'&(iexcl|#161);'i",
		
		"'&(cent|#162);'i",
		
		"'&(pound|#163);'i",
		
		"'&(copy|#169);'i",
		
		"'&#(d+);'e" 
); // evaluate as php

$replace = array (
		"",
		
		"",
		
		// "\1",
		
		"\"",
		
		"&",
		
		"<",
		
		">",
		
		" ",
		
		chr ( 161 ),
		
		chr ( 162 ),
		
		chr ( 163 ),
		
		chr ( 169 ),
		
		"chr(\1)" 
);

$nb = $_REQUEST ['nb'];

$data = $_REQUEST ['data'];

$tipo = "html";

$curl = new cURL ();

$parametro = array (
		'C_1' => 'BPV00.23',
		
		'C_2' => '',
		
		'C_3' => $nb,
		
		'C4' => str_replace ( '/', '', $data ),
		
		'layout' => '8,69,10,8,1' 
)
;

$url = "http://www010.dataprev.gov.br/cws/bin/CWS91.asp?COMS_BIN/D.HISCNS";

$html = $curl->post ( $url, $parametro, 

array (
		CURLOPT_HTTPHEADER => array (
				"User-Agent: Mozilla/5.0 (Windows NT 5.1) AppleWebKit/534.57.2 (KHTML, like Gecko) Version/5.1.7 Safari/534.57.2",
				"Origin: http://www010.dataprev.gov.br",
				"Referer: http://www010.dataprev.gov.br/cws/bin/CWS91.asp?COMS_BIN/D.HISCNS",
				"Connection: keep-alive" 
		),
		CURLOPT_SSL_VERIFYPEER => false,
		CURLOPT_TIMEOUT => 20 
) );

$resultado = preg_replace ( $search, $replace, $html );

if (strpos ( $resultado, 'ULTCRENET' ) === false) {
	
	echo trim ( substr ( $resultado, 9 ) );
} else {
	
	$aux = split ( "\n", $resultado );
	
	$nb = trim ( substr ( $aux [4], 4, 13 ) );
	
	$nome = trim ( substr ( $aux [4], 19 ) );
	
	$codEspecie = trim ( substr ( $aux [5], 10, 2 ) );
	
	$dscEspecie = trim ( substr ( $aux [5], 14, 40 ) );
	
	$observacao = trim ( substr ( $aux [5], 56 ) );
	
	$cmpt = trim ( substr ( $aux [6], 8, 7 ) );
	
	$perIni = trim ( substr ( $aux [6], 26, 10 ) );
	
	$perFim = trim ( substr ( $aux [6], 38, 10 ) );
	
	$meioPgto = trim ( substr ( $aux [6], 60 ) );
	
	$vldIni = trim ( substr ( $aux [7], 26, 10 ) );
	
	$vldFim = trim ( substr ( $aux [7], 38, 10 ) );
	
	$conta = trim ( substr ( $aux [7], 67 ) );
	
	$banco = trim ( substr ( $aux [10], 7, 18 ) );
	
	$agencia = split ( '-', trim ( substr ( $aux [10], 29 ) ), 2 );
	
	$codAgencia = trim ( $agencia [0] );
	
	$dscAgencia = trim ( $agencia [1] );
	
	$endAgencia = trim ( $aux [11] );
	
	$vb = "";
	
	$vd = "";
	
	$vl = "";
	
	$dscMeioPgto = "";
	
	$creditos = array ();
	
	$debitos = array ();
	
	$valorA = 0;
	
	$valorB = 0;
	
	switch ($meioPgto) 

	{
		
		case "CMG" :
			
			$dscMeioPgto = "CARTAO MAGNETICO";
			
			break;
		
		case "APB" :
			
			$dscMeioPgto = "CUPOM";
			
			break;
		
		case "CCF" :
		
		case "CCL" :
			
			$dscMeioPgto = "CONTA CORRENTE";
			
			break;
		
		case "PAB" :
			
			$dscMeioPgto = "ALTERNATIVO";
			
			break;
		
		case "CPB" :
			
			$dscMeioPgto = "CHEQUE";
			
			break;
		
		case "OPB" :
			
			$dscMeioPgto = "ORDEM DE PAGTO";
			
			break;
		
		case "RPB" :
			
			$dscMeioPgto = "RECIBO DE PAGTO";
			
			break;
		
		case "AP" :
			
			$dscMeioPgto = "AUTORIZACAO";
			
			break;
	}
	
	$meioPgto = $dscMeioPgto;
	
	$fim = false;
	
	$idx = 12;
	
	$lancamentos = array ();
	
	while ( $fim == false ) 

	{
		
		if (substr ( $aux [$idx], 0, 2 ) == "VB") 

		{
			
			$vb = trim ( substr ( $aux [$idx], 11, 10 ) );
			
			$vd = trim ( substr ( $aux [$idx], 34, 10 ) );
			
			$vl = trim ( substr ( $aux [$idx], 57, 10 ) );
			
			$fim = true;
		} else {
			
			if (strpos ( substr ( $aux [$idx], 37, 1 ), "+-" ) >= 0) 

			{
				
				array_push ( $lancamentos, array (
						'Nome' => trim ( substr ( $aux [$idx], 5, 20 ) ),
						
						'Valor' => trim ( substr ( $aux [$idx], 27, 10 ) ),
						
						'Sinal' => trim ( substr ( $aux [$idx], 37, 1 ) ),
						
						'Codigo' => trim ( substr ( $aux [$idx], 1, 4 ) ) 
				)
				 )

				;
			}
			
			if (strpos ( substr ( $aux [$idx], 77, 1 ), "+-" ) >= 0) 

			{
				
				array_push ( $lancamentos, array (
						'Nome' => trim ( substr ( $aux [$idx], 45, 20 ) ),
						
						'Valor' => trim ( substr ( $aux [$idx], 66, 10 ) ),
						
						'Sinal' => trim ( substr ( $aux [$idx], 77, 1 ) ),
						
						'Codigo' => trim ( substr ( $aux [$idx], 1, 4 ) ) 
				)
				 )

				;
			}
		}
		
		$idx ++;
	}
	
	foreach ( $lancamentos as $lcred ) {
		
		if ($lcred ['Sinal'] == '+') {
			
			array_push ( $creditos, array (
					'Descricao' => $lcred ['Nome'],
					
					'Valor' => $lcred ['Valor'] 
			)
			 )

			;
			
			if (strpos ( '_mens. reajustada_compl. da m.r._salario familia_grat. ex-comb._rffsa nao trib._compl. acompan._outras vantagens_outras vantagens_plansfer rffsa_dupla atividade_grat.produt. ect_adic. talidomida_', strtolower ( $lcred ['Nome'] ) ) > 0) {
				
				$valorA += floatval ( str_replace ( ',', '.', str_replace ( '.', '', $lcred ['Valor'] ) ) );
			}
		}
	}
	
	foreach ( $lancamentos as $ldeb ) {
		
		if ($ldeb ['Sinal'] == '-') {
			
			array_push ( $debitos, array (
					'Descricao' => $ldeb ['Nome'],
					
					'Valor' => "-" . $ldeb ['Valor'] 
			)
			 )

			;
			
			if (strpos ( '_consignacao_i.r. ret.  fonte_deb. pens. alim._decis&atilde;o judicial_i.r. no exterior_contr.forca sind_debito dif. i.r._desconto inss_contrib. cobap_contrib. contag_contrib. stferj_contrib. astre_contrib. forca sind_contrib. cut_contrib. unidas_contrib. cgt_contrib. sindapb_contrib. asbapi_"', strtolower ( $ldeb ['Nome'] ) ) > 0) {
				
				$valorB += floatval ( str_replace ( ',', '.', str_replace ( '.', '', $ldeb ['Valor'] ) ) );
			}
		}
	}
	
	if ($tipo == 'html') {
		
		echo "<pre>";
		
		echo "</pre>";
		
		echo "<HTML>";
		
		echo "<BODY  background=fnada.gif aLink=#0000ff link=#004080 topMargin=0 bgColor=#ffffff text=#000000 vLink=#ff0000 marginwidth='0' marginheight='0'>";
		
		echo "<TABLE border=0 cellSpacing=0 cellPadding=0 width='100%' height=70 name='topo'>";
		
		echo "<TBODY>";
		
		echo "<TR bgColor=#065ca5>";
		
		echo "<TD vAlign=top align=left>";
		
		echo "<TABLE border=0 cellSpacing=0 cellPadding=0>";
		
		echo "<TBODY>";
		
		echo "<TR>";
		
		echo "<TD vAlign=top align=left><A href='http://www.mpas.gov.br/'><IMG border=0 src='KO.gif' width=94 height=70></A></TD>";
		
		echo "<TD vAlign=top align=left><BR><A href='http://www.mpas.gov.br/'><IMG border=0 src='previdencia.gif' width=290 height=41></A></TD></TR></TBODY></TABLE></TD>";
		
		echo "<TD vAlign=top align=right><A href='http://www.redegoverno.gov.br/'><IMG border=0 hspace=0 src='prevnet.gif' width=139 height=70></A></TD></TR></TBODY></TABLE>";
		
		echo "<CENTER><FONT color=#065ca5 face='Trebuchet MS'>";
		
		echo "<H2 align=center>Detalhamento de Cr&eacutedito</H2>";
		
		echo "<TABLE border=1 width='69%' height=1>";
		
		echo "<TBODY>";
		
		echo "<TR>";
		
		echo "<TD bgColor=#c0c0c0 height=1 vAlign=top width='30%' align=middle>";
		
		echo "<P align=left><SMALL><SMALL><FONT face='Trebuchet MS'>N&uacute;mero do Benef&iacutecio</FONT></SMALL></SMALL></P></TD>";
		
		echo "<TD bgColor=#c0c0c0 height=1 vAlign=top width='70%' align=middle>";
		
		echo "<P align=left><SMALL><SMALL><FONT face='Trebuchet MS'>Nome do Segurado</FONT></SMALL></SMALL></P></TD></TR></TBODY></TABLE>";
		
		echo "<TABLE border=1 width='69%'>";
		
		echo "<TBODY>";
		
		echo "<TR>";
		
		echo "<TD height=24 width='30%' align=middle>";
		
		echo "<P align=center><STRONG><FONT face='Trebuchet MS'>" . $nb . "</FONT></STRONG></P></TD>";
		
		echo "<TD height=24 width='70%' align=middle>";
		
		echo "<P align=left><STRONG><FONT face='Trebuchet MS'>" . $nome . "</FONT></STRONG></P></TD></TR></TBODY></TABLE>";
		
		echo "<TABLE border=1 width='69%' height=1>";
		
		echo "<TBODY>";
		
		echo "<TR>";
		
		echo "<TD bgColor=#c0c0c0 height=1 vAlign=top width='16%'><SMALL><SMALL><FONT face='Trebuchet MS'>Compet&ecirc;ncia</FONT></SMALL></SMALL></TD>";
		
		echo "<TD bgColor=#c0c0c0 height=1 vAlign=top width='42%'><SMALL><SMALL><FONT face='Trebuchet MS'>Per&iacuteodo a que se refere o cr&eacutedito :</FONT></SMALL></SMALL></TD>";
		
		echo "<TD bgColor=#c0c0c0 height=1 vAlign=top width='38%'><SMALL><SMALL><FONT face='Trebuchet MS'>Pagamento atrav&eacutes de :</FONT></SMALL></SMALL></TD></TR></TBODY></TABLE>";
		
		echo "<TABLE border=1 width='69%'>";
		
		echo "<TBODY>";
		
		echo "<TR>";
		
		echo "<TD height=22 width='16%'>";
		
		echo "<P align=center><STRONG><FONT face='Trebuchet MS'>" . $cmpt . "</FONT></STRONG></P></TD>";
		
		echo "<TD height=22 width='18%'>";
		
		echo "<P align=center><STRONG><FONT face='Trebuchet MS'>" . $perIni . "</FONT></STRONG></P></TD>";
		
		echo "<TD height=22 width='5%'>";
		
		echo "<P align=center><FONT face='Trebuchet MS'>a</FONT></P></TD>";
		
		echo "<TD height=22 width='20%'>";
		
		echo "<P align=center><STRONG><FONT face='Trebuchet MS'>" . $perFim . "</FONT></STRONG></P></TD>";
		
		echo "<TD height=22 vAlign=top width='42%'>";
		
		echo "<P align=left><STRONG><FONT face='Trebuchet MS'>" . $dscMeioPgto . "</FONT></STRONG></P></TD></TR></TBODY></TABLE>";
		
		echo "<TABLE border=1 width='69%' height=23>";
		
		echo "<TBODY>";
		
		echo "<TR>";
		
		echo "<TD bgColor=#c0c0c0 height=6 vAlign=top width='100%' align=left checked='false'><SMALL><FONT face='Trebuchet MS'><SMALL>Esp&eacutecie</SMALL></FONT></SMALL></TD></TR></TBODY></TABLE>";
		
		echo "<TABLE border=1 width='69%'>";
		
		echo "<TBODY>";
		
		echo "<TR>";
		
		echo "<TD height=9 width='10%'>";
		
		echo "<P align=left><STRONG><FONT face='Trebuchet MS'>" . $codEspecie . "</FONT></STRONG></P></TD>";
		
		echo "<TD height=9 width='70%'><STRONG><FONT face='Trebuchet MS'>" . $dscEspecie . "</FONT></STRONG></TD>";
		
		echo "<TD height=9 width='20%'>";
		
		echo "<P align=center><STRONG><FONT face='Trebuchet MS'>" . $observacao . "</FONT></STRONG></P></TD></TR></TBODY></TABLE>";
		
		echo "<TABLE border=1 width='69%' height=14>";
		
		echo "<TBODY>";
		
		echo "<TR>";
		
		echo "<TD bgColor=#c0c0c0 height=2 vAlign=top width='21%'>";
		
		echo "<P align=left><SMALL><SMALL><FONT face='Trebuchet MS'>Banco</FONT></SMALL></SMALL></P></TD>";
		
		echo "<TD bgColor=#c0c0c0 height=2 vAlign=top width='54%'><SMALL><SMALL><FONT face='Trebuchet MS'>Ag&ecirc;ncia banc&aacuteria</FONT></SMALL></SMALL></TD>";
		
		echo "<TD bgColor=#c0c0c0 height=2 vAlign=top width='25%'>";
		
		echo "<P align=center><SMALL><SMALL><FONT face='Trebuchet MS'>C&oacutedigo do Banco</FONT></SMALL></SMALL></P></TD></TR></TBODY></TABLE>";
		
		echo "<TABLE border=1 width='69%'>";
		
		echo "<TBODY>";
		
		echo "<TR>";
		
		echo "<TD height=9 width='21%'>";
		
		echo "<P align=left><STRONG><FONT face='Trebuchet MS'>" . $banco . "</FONT></STRONG></P></TD>";
		
		echo "<TD height=9 width='54%'><STRONG><FONT face='Trebuchet MS'>" . $dscAgencia . "</FONT></STRONG></TD>";
		
		echo "<TD height=9 width='25%'>";
		
		echo "<P align=center><STRONG><FONT face='Trebuchet MS'>" . $codAgencia . "</FONT></STRONG></P></TD></TR></TBODY></TABLE>";
		
		echo "<TABLE border=1 width='69%' height=23>";
		
		echo "<TBODY>";
		
		echo "<TR>";
		
		echo "<TD bgColor=#c0c0c0 height=6 vAlign=top width='64%' align=left checked='false'><SMALL><FONT face='Trebuchet MS'><SMALL>Endere&ccedil;o do banco</SMALL></FONT></SMALL></TD>";
		
		echo "<TD bgColor=#c0c0c0 height=6 vAlign=top width='36%' align=left checked='false'><SMALL><FONT face='Trebuchet MS'><SMALL>Dispon&iacutevel para recebimento de :</SMALL></FONT></SMALL></TD></TR></TBODY></TABLE>";
		
		echo "<TABLE border=1 width='69%'>";
		
		echo "<TBODY>";
		
		echo "<TR>";
		
		echo "<TD height=5 width='65%'><SMALL><STRONG><FONT face='Trebuchet MS'>" . $endAgencia . "</FONT></STRONG></SMALL></TD>";
		
		echo "<TD style='BORDER-BOTTOM: 1px solid; BORDER-LEFT: 1px solid; BORDER-TOP: 1px solid; BORDER-RIGHT: 1px solid' height=5 width='15%'>";
		
		echo "<P align=center><STRONG><FONT face='Trebuchet MS'>" . $vldIni . "</FONT></STRONG></P></TD>";
		
		echo "<TD style='BORDER-BOTTOM: 1px solid; BORDER-LEFT: 1px solid; BORDER-TOP: 1px solid; BORDER-RIGHT: 1px solid' height=5 width='5%'><FONT face='Trebuchet MS'>";
		
		echo "<P align=center>a</FONT></P></TD>";
		
		echo "<TD style='BORDER-BOTTOM: 1px solid; BORDER-LEFT: 1px solid; BORDER-TOP: 1px solid; BORDER-RIGHT: 1px solid' height=5 width='17%'><FONT face='Trebuchet MS'>";
		
		echo "<P align=center><STRONG>" . $vldFim . "</STRONG></FONT></P></TD></TR></TBODY></TABLE><SMALL><FONT face='Trebuchet MS'>";
		
		echo "<TABLE border=1 width='69%'>";
		
		echo "<TBODY>";
		
		echo "<TR>";
		
		echo "<TD bgColor=#c0c0c0 height=18 colSpan=2>";
		
		echo "<P align=center><SMALL><STRONG><FONT face='Trebuchet MS'>C R &Eacute D I T O S </FONT></STRONG></SMALL></P></TD></TR>";
		
		echo "<TR>";
		
		echo "<TD height=18 width=366>";
		
		echo "<P align=center><FONT face='Trebuchet MS'><STRONG>Descri&ccedil;&atilde;o das Rubricas</STRONG></FONT></P></TD>";
		
		echo "<TD height=18 width=145>";
		
		echo "<P align=center><FONT face='Trebuchet MS'><STRONG>Valor</FONT></STRONG></P></TD></TR>";
		
		foreach ( $lancamentos as $lcred ) {
			
			if ($lcred ['Sinal'] == '+') {
				
				echo "<TR>";
				
				echo "<TD><SMALL>" . $lcred ['Nome'] . "</SMALL></TD>";
				
				echo "<TD align=right><SMALL>" . $lcred ['Valor'] . "</SMALL></TD></TR>";
			}
		}
		
		echo "<TR>";
		
		echo "<TD bgColor=#c0c0c0 height=18 colSpan=2>";
		
		echo "<P align=center><STRONG><FONT face='Trebuchet MS'><SMALL>D &Eacute B I T O S</SMALL></STRONG></FONT></P></TD></TR>";
		
		foreach ( $lancamentos as $ldeb ) {
			
			if ($ldeb ['Sinal'] == '-') {
				
				echo "<TR>";
				
				echo "<TD><SMALL>" . $ldeb ['Nome'] . "</SMALL></TD>";
				
				echo "<TD align=right><SMALL>" . $ldeb ['Valor'] . "</SMALL></TD></TR>";
			}
		}
		
		echo "</TBODY></TABLE></FONT></SMALL>";
		
		echo "<TABLE border=1 cellPadding=2 width='69%'>";
		
		echo "<TBODY>";
		
		echo "<TR>";
		
		echo "<TD style='FONT-FAMILY: Trebuchet MS' bgColor=#c0c0c0 width='33%' align=middle><STRONG>Valor Bruto </STRONG></TD>";
		
		echo "<TD style='FONT-FAMILY: Trebuchet MS' bgColor=#c0c0c0 width='33%' align=middle><STRONG>Valor&nbsp; dos Descontos</STRONG></TD>";
		
		echo "<TD style='FONT-FAMILY: Trebuchet MS' bgColor=#c0c0c0 width='34%' align=middle><STRONG>Valor L&iacutequido</STRONG></TD></TR>";
		
		echo "<TR>";
		
		echo "<TD width='33%' align=right><STRONG><FONT face='Trebuchet MS'>" . $vb . "</FONT></STRONG></TD>";
		
		echo "<TD width='33%' align=right><STRONG><FONT face='Trebuchet MS'>" . $vd . "</FONT></STRONG></TD>";
		
		echo "<TD width='34%' align=right><STRONG><FONT face='Trebuchet MS'>" . $vl . "</FONT></STRONG></TD></TR></TBODY></TABLE>";
		
		echo "<TABLE border=0 width='69%'>";
		
		echo "<TBODY>";
		
		echo "<TR>";
		
		echo "<TD width='100%'>";
		
		echo "<P align=center><U><STRONG><FONT color=#065ca5 face='Trebuchet MS'>Este extrato vale para simples confer&ecirc;ncia</FONT></STRONG></U></P></TD></TR></TBODY></TABLE><A href='JavaScript:location.href='../contexto/' + parent.link'><IMG border=0 src='ante.gif' width=120 height=38></A></CENTER>";
		
		echo "<TABLE border=0 cellSpacing=0 cellPadding=0 width='100%' bgColor=#065ca5 height=35>";
		
		echo "<TBODY>";
		
		echo "<TR>";
		
		echo "<TD vAlign=top width='1%' align=left><IMG border=0 src='esquerda3b.gif' width=70 height=62></TD>";
		
		echo "<TD width='60%' align=left><IMG border=0 src='rodape_dtp.gif' width=93 height=34><BR><IMG alt='bluebottom2.gif (971 bytes)' src='bluebottom2.gif' width=42 height=10><IMG border=0 src='dtpextenso2d.gif'><BR></TD>";
		
		echo "<TD width='40%' align=right><A title='Fale com a DATAPREV' href='mailto:webmaster.dtp@rjo.dataprev.gov.br'><IMG border=0 src='mailslot.gif' width=36 height=25></A></TD>";
		
		echo "<TD vAlign=top width='1%' align=right><IMG border=0 src='padrao1girado.gif' width=70 height=62></TD></TR></TBODY></TABLE></FONT></BODY></HTML>";
		
		echo "<input name='creditos' id='creditos' type='hidden' value='" . $valorA . "' />";
		
		echo "<input name='debitos' id='creditos' type='hidden' value='" . $valorB . "' />";
	}
	
	$detalhamento = array (
			'NB' => $nb,
			
			'Nome' => $nome,
			
			'CodEspecie' => $codEspecie,
			
			'DscEspecie' => $dscEspecie,
			
			'Observacao' => $observacao,
			
			'Competencia' => $cmpt,
			
			'Ref_DtInicio' => $perIni,
			
			'Ref_DtFim' => $perFim,
			
			'Meio_Pgto' => $dscMeioPgto,
			
			'Validade_Ini' => $vldIni,
			
			'Validade_Fim' => $vldFim,
			
			'ContaCorrente' => $conta,
			
			'Banco' => $banco,
			
			'CodBanco' => $codAgencia,
			
			'Agencia' => $dscAgencia,
			
			'EndAgencia' => $endAgencia,
			
			'Creditos' => $creditos,
			
			'Debitos' => $debitos,
			
			'ValorBruto' => $vb,
			
			'ValorDesconto' => $vd,
			
			'ValorLiquido' => $vl 
	)
	;
	
	if ($tipo == 'array') {
		
		echo '<pre>';
		
		print_r ( $detalhamento );
		
		echo '</pre>';
	}
	
	if ($tipo == 'json') {
		
		echo json_encode ( $detalhamento );
	}
}

?>
