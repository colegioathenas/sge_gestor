<?php
session_start ();
require ("../config.php");
include_once "../bd.php";
include_once "../geral.php";
ini_set ( "display_errors", 0 );
include_once ('../Util/fpdf.php');
class PDF_i25 extends FPDF {
	function i25($xpos, $ypos, $code, $basewidth = 1, $height = 10) {
		$wide = $basewidth;
		$narrow = $basewidth / 3;
		
		// wide/narrow codes for the digits
		$barChar ['0'] = 'nnwwn';
		$barChar ['1'] = 'wnnnw';
		$barChar ['2'] = 'nwnnw';
		$barChar ['3'] = 'wwnnn';
		$barChar ['4'] = 'nnwnw';
		$barChar ['5'] = 'wnwnn';
		$barChar ['6'] = 'nwwnn';
		$barChar ['7'] = 'nnnww';
		$barChar ['8'] = 'wnnwn';
		$barChar ['9'] = 'nwnwn';
		$barChar ['A'] = 'nn';
		$barChar ['Z'] = 'wn';
		
		// add leading zero if code-length is odd
		if (strlen ( $code ) % 2 != 0) {
			$code = '0' . $code;
		}
		
		$this->SetFont ( 'Arial', '', 10 );
		// this->Text($xpos, $ypos + $height + 4, $code);
		$this->SetFillColor ( 0 );
		
		// add start and stop codes
		$code = 'AA' . strtolower ( $code ) . 'ZA';
		
		for($i = 0; $i < strlen ( $code ); $i = $i + 2) {
			// choose next pair of digits
			$charBar = $code [$i];
			$charSpace = $code [$i + 1];
			// check whether it is a valid digit
			if (! isset ( $barChar [$charBar] )) {
				$this->Error ( 'Invalid character in barcode: ' . $charBar );
			}
			if (! isset ( $barChar [$charSpace] )) {
				$this->Error ( 'Invalid character in barcode: ' . $charSpace );
			}
			// create a wide/narrow-sequence (first digit=bars, second digit=spaces)
			$seq = '';
			for($s = 0; $s < strlen ( $barChar [$charBar] ); $s ++) {
				$seq .= $barChar [$charBar] [$s] . $barChar [$charSpace] [$s];
			}
			for($bar = 0; $bar < strlen ( $seq ); $bar ++) {
				// set lineWidth depending on value
				if ($seq [$bar] == 'n') {
					$lineWidth = $narrow;
				} else {
					$lineWidth = $wide;
				}
				// draw every second value, because the second digit of the pair is represented by the spaces
				if ($bar % 2 == 0) {
					$this->Rect ( $xpos, $ypos, $lineWidth, $height, 'F' );
				}
				$xpos += $lineWidth;
			}
		}
	}
	function WordWrap(&$text, $maxwidth) {
		$text = trim ( $text );
		if ($text === '')
			return 0;
		$space = $this->GetStringWidth ( ' ' );
		$lines = explode ( "\n", $text );
		$text = '';
		$count = 0;
		
		foreach ( $lines as $line ) {
			$words = preg_split ( '/ +/', $line );
			$width = 0;
			
			foreach ( $words as $word ) {
				$wordwidth = $this->GetStringWidth ( $word );
				if ($wordwidth > $maxwidth) {
					// Word is too long, we cut it
					for($i = 0; $i < strlen ( $word ); $i ++) {
						$wordwidth = $this->GetStringWidth ( substr ( $word, $i, 1 ) );
						if ($width + $wordwidth <= $maxwidth) {
							$width += $wordwidth;
							$text .= substr ( $word, $i, 1 );
						} else {
							$width = $wordwidth;
							$text = rtrim ( $text ) . "\n" . substr ( $word, $i, 1 );
							$count ++;
						}
					}
				} elseif ($width + $wordwidth <= $maxwidth) {
					$width += $wordwidth + $space;
					$text .= $word . ' ';
				} else {
					$width = $wordwidth + $space;
					$text = rtrim ( $text ) . "\n" . $word . ' ';
					$count ++;
				}
			}
			$text = rtrim ( $text ) . "\n";
			$count ++;
		}
		$text = rtrim ( $text );
		return $count;
	}
}
function digitoVerificador_barra($numero) {
	$resto2 = modulo_11 ( $numero, 9, 1 );
	if ($resto2 == 0 || $resto2 == 1 || $resto2 == 10) {
		$dv = 1;
	} else {
		$dv = 11 - $resto2;
	}
	return $dv;
}
function esquerda($entra, $comp) {
	return substr ( $entra, 0, $comp );
}
function direita($entra, $comp) {
	return substr ( $entra, strlen ( $entra ) - $comp, $comp );
}
function fator_vencimento($data) {
	if ($data != "") {
		$data = explode ( "/", $data );
		$ano = $data [2];
		$mes = $data [1];
		$dia = $data [0];
		return (abs ( (_dateToDays ( "1997", "10", "07" )) - (_dateToDays ( $ano, $mes, $dia )) ));
	} else {
		return "0000";
	}
}
function _dateToDays($year, $month, $day) {
	$century = substr ( $year, 0, 2 );
	$year = substr ( $year, 2, 2 );
	if ($month > 2) {
		$month -= 3;
	} else {
		$month += 9;
		if ($year) {
			$year --;
		} else {
			$year = 99;
			$century --;
		}
	}
	return (floor ( (146097 * $century) / 4 ) + floor ( (1461 * $year) / 4 ) + floor ( (153 * $month + 2) / 5 ) + $day + 1721119);
}
function monta_linha_digitavel($codigo) {
	
	// Posi��o Conte�do
	// 1 a 3 N�mero do banco
	// 4 C�digo da Moeda - 9 para Real
	// 5 Digito verificador do C�digo de Barras
	// 6 a 9 Fator de Vencimento
	// 10 a 19 Valor (8 inteiros e 2 decimais)
	// 20 a 44 Campo Livre definido por cada banco (25 caracteres)
	
	// 1. Campo - composto pelo c�digo do banco, c�digo da mo�da, as cinco primeiras posi��es
	// do campo livre e DV (modulo10) deste campo
	$p1 = substr ( $codigo, 0, 4 );
	$p2 = substr ( $codigo, 19, 5 );
	$p3 = modulo_10 ( "$p1$p2" );
	$p4 = "$p1$p2$p3";
	$p5 = substr ( $p4, 0, 5 );
	$p6 = substr ( $p4, 5 );
	$campo1 = "$p5.$p6";
	
	// 2. Campo - composto pelas posi�oes 6 a 15 do campo livre
	// e livre e DV (modulo10) deste campo
	$p1 = substr ( $codigo, 24, 10 );
	$p2 = modulo_10 ( $p1 );
	$p3 = "$p1$p2";
	$p4 = substr ( $p3, 0, 5 );
	$p5 = substr ( $p3, 5 );
	$campo2 = "$p4.$p5";
	
	// 3. Campo composto pelas posicoes 16 a 25 do campo livre
	// e livre e DV (modulo10) deste campo
	$p1 = substr ( $codigo, 34, 10 );
	$p2 = modulo_10 ( $p1 );
	$p3 = "$p1$p2";
	$p4 = substr ( $p3, 0, 5 );
	$p5 = substr ( $p3, 5 );
	$campo3 = "$p4.$p5";
	
	// 4. Campo - digito verificador do codigo de barras
	$campo4 = substr ( $codigo, 4, 1 );
	
	// 5. Campo composto pelo fator vencimento e valor nominal do documento, sem
	// indicacao de zeros a esquerda e sem edicao (sem ponto e virgula). Quando se
	// tratar de valor zerado, a representacao deve ser 000 (tres zeros).
	$p1 = substr ( $codigo, 5, 4 );
	$p2 = substr ( $codigo, 9, 10 );
	$campo5 = "$p1$p2";
	
	return "$campo1 $campo2 $campo3 $campo4 $campo5";
}
function geraCodigoBanco($numero) {
	$parte1 = substr ( $numero, 0, 3 );
	$parte2 = modulo_11 ( $parte1 );
	return $parte1 . "-" . $parte2;
}

$matricula = isset ( $_SESSION ['mat'] ) ? $_SESSION ['mat'] : "";
$nCdPessoa = isset ( $_SESSION ['responsavel_cpf'] ) ? $_SESSION ['responsavel_cpf'] : "";
$nCdBoleto = $_REQUEST ['nCdBoleto'];

$nCdPessoa = str_replace ( "-", "", $nCdPessoa );
$nCdPessoa = str_replace ( ".", "", $nCdPessoa );

$pdf = new PDF_i25 ();

$pdf->Open ();
$pdf->SetAutoPageBreak ( 1, 10 );
$pdf->SetTitle ( "Boleto" );
$pdf->SetDisplayMode ( 'fullwidth', 'continuous' );
$pdf->SetFillColor ( 190, 190, 190 );

if ($nCdBoleto != "") {
	$nCdBoleto = split ( ";", $nCdBoleto );
	if (count ( $nCdBoleto ) == 1) {
		$query = "SELECT Titulos.*, Pessoa.cNome, Pessoa.nCEP,Pessoa.cLogradouro,  Pessoa.cComplelemnto, Pessoa.cCidade,
			Pessoa.cBairro,Pessoa.cUF FROM Titulos inner join Pessoa on Titulos.nCdPessoa = Pessoa.nCdPessoa
			WHERE nNossoNumero = $nCdBoleto[0] ";
		$layout = "unico";
	} else {
		$query = "SELECT Titulos.*, Pessoa.cNome, Pessoa.nCEP,Pessoa.cLogradouro,  Pessoa.cComplelemnto, Pessoa.cCidade,
					  Pessoa.cBairro,Pessoa.cUF FROM Titulos inner join Pessoa on Titulos.nCdPessoa = Pessoa.nCdPessoa
					  WHERE nNossoNumero IN (";
		foreach ( $nCdBoleto as $nnum ) {
			if ($nnum != "") {
				$query .= "'$nnum',";
			}
		}
		$query = substr ( $query, 0, strlen ( $query ) - 1 ) . ")  order by dVcto";
		$layout = "multiplo";
	}
} else {
	$query = "SELECT Titulos.*, Pessoa.cNome, Pessoa.nCEP,Pessoa.cLogradouro,  Pessoa.cComplelemnto, Pessoa.cCidade,
			Pessoa.cBairro,Pessoa.cUF FROM Titulos inner join Pessoa on Titulos.nCdPessoa = Pessoa.nCdPessoa
			WHERE Titulos.nCdPessoa = $nCdPessoa and Titulos.SeuNum like '%" . $matricula . "2013%' order by dVcto";
	$layout = "multiplo";
}
$resultado = consulta ( "athenas", $query );

// Gerar carne
$i = 0;
$qtd_bol = count ( $resultado ); // Qtd. Boletos.
$qtd_pag = ceil ( $qtd_bol / 3 ); // Qtd. Paginas - Arredonda fração pra cima

$pos = 0;
$idxReg = 1; // Indice do Registro
$coefReg = 0; // Coef. do Registro - Usado para o Calculo do Indice

for($nPagina = 1; $nPagina <= $qtd_pag; $nPagina ++) {
	$pdf->AddPage ( "P" );
	for($nPos = 1; $nPos <= 3; $nPos ++) {
		if ($idxReg <= $qtd_bol) {
			
			$registro = $resultado [$idxReg - 1];
			
			$vencimento = $registro ['dVcto'];
			$vencimento = substr ( $vencimento, 0, 10 );
			$vencimento = explode ( "-", $vencimento );
			
			$data_venc = $vencimento; // Prazo de X dias OU informe data: "13/04/2006" OU informe "" se Contra Apresentacao;
			$valor_cobrado = $registro ['nVlrTitulo']; // Valor - REGRA: Sem pontos na milhar e tanto faz com "." ou "," ou com 1 ou 2 ou sem casa decimal
			$valor_cobrado = str_replace ( ",", ".", $valor_cobrado );
			$valor_boleto = number_format ( $valor_cobrado, 2, ',', '' );
			$nossonumero = $registro ['nNossoNumero'];
			$nnum = $registro ['nCdBoleto'];
			$dadosboleto ["nosso_numero"] = substr ( $nossonumero, 0, 15 ) . "-" . substr ( $nossonumero, - 1 ); // Nosso numero sem o DV - REGRA: Máximo de 8 caracteres!
			$dadosboleto ["numero_documento"] = $registro ['SeuNum']; // Num do pedido ou do documento
			$dadosboleto ["data_vencimento"] = $vencimento [2] . "/" . $vencimento [1] . "/" . $vencimento [0]; // Data de Vencimento do Boleto - REGRA: Formato DD/MM/AAAA
			$dadosboleto ["data_documento"] = date ( "d/m/Y" ); // Data de emissão do Boleto
			$dadosboleto ["data_processamento"] = date ( "d/m/Y" ); // Data de processamento do boleto (opcional)
			$dadosboleto ["valor_boleto"] = $valor_boleto; // Valor do Boleto - REGRA: Com vírgula e sempre com duas casas depois da virgula
			$desconto = number_format ( $registro ['nVlrDesconto'], 2, ',', '' );
			
			// DADOS DO SEU CLIENTE
			$dadosboleto ["sacado"] = $registro ['cNome'];
			$dadosboleto ["endereco1"] = $registro ['cLogradouro'] . " - " . $registro ['cComplemento'] . " - " . $registro ['cBairro'];
			$dadosboleto ["endereco2"] = $registro ['cCidade'] . " - " . $registro ['cUF'] . " - " . $registro ['nCEP'];
			
			// INSTRUÇÕES PARA O CAIXA
			$multa = number_format ( $valor_cobrado * 0.1, 2, ',', '' );
			$juros = number_format ( $valor_cobrado * 0.0033, 2, ',', '' );
			$dadosboleto ["mensagem1"] = $registro ['cMensagem1'];
			$dadosboleto ["mensagem2"] = $registro ['cMensagem2'];
			$dadosboleto ["mensagem3"] = $registro ['cMensagem3'];
			$dadosboleto ["mensagem4"] = $registro ['cMensagem4'];
			$dadosboleto ["mensagem5"] = $registro ['cMensagem5'];
			$dadosboleto ["mensagem6"] = $registro ['cMensagem6'];
			$dadosboleto ["mensagem7"] = $registro ['cMensagem7'];
			$dadosboleto ["mensagem8"] = $registro ['cMensagem8'];
			
			// DADOS OPCIONAIS DE ACORDO COM O BANCO OU CLIENTE
			$dadosboleto ["quantidade"] = "";
			$dadosboleto ["valor_unitario"] = "";
			$dadosboleto ["aceite"] = "";
			$dadosboleto ["especie"] = "R$";
			$dadosboleto ["especie_doc"] = "";
			
			// ---------------------- DADOS FIXOS DE CONFIGURAÇÃO DO SEU BOLETO --------------- //
			
			// DADOS DA SUA CONTA - CEF
			$dadosboleto ["agencia"] = "1187"; // Num da agencia, sem digito
			$dadosboleto ["conta"] = "291"; // Num da conta, sem digito
			$dadosboleto ["conta_dv"] = "2"; // Digito do Num da conta
			                                    
			// DADOS PERSONALIZADOS - CEF
			$dadosboleto ["conta_cedente"] = "87000000168"; // ContaCedente do Cliente, sem digito (Somente Números)
			$dadosboleto ["conta_cedente_dv"] = "9"; // Digito da ContaCedente do Cliente
			$dadosboleto ["carteira"] = "SR"; // Código da Carteira: pode ser SR (Sem Registro) ou CR (Com Registro) - (Confirmar com gerente qual usar)
			                                    
			// SEUS DADOS
			$dadosboleto ["identificacao"] = "";
			$dadosboleto ["cpf_cnpj"] = "07.228.276/0001-70";
			$dadosboleto ["endereco"] = "PRACA NARCIO JOSE LOPES, 138";
			$dadosboleto ["cidade_uf"] = "ARUJA / SP";
			$dadosboleto ["cedente"] = "INSTITUTO EDUCACIONAL JR LTDA";
			
			// nicio_funcoes_cef
			$codigobanco = "104";
			$codigo_banco_com_dv = geraCodigoBanco ( $codigobanco );
			$nummoeda = "9";
			$fator_vencimento = fator_vencimento ( $dadosboleto ["data_vencimento"] );
			$valor = formata_numero ( $dadosboleto ["valor_boleto"], 10, 0, "valor" );
			$agencia = formata_numero ( $dadosboleto ["agencia"], 4, 0 );
			$conta = formata_numero ( $dadosboleto ["conta"], 5, 0 );
			$conta_dv = formata_numero ( $dadosboleto ["conta_dv"], 1, 0 );
			$carteira = $dadosboleto ["carteira"];
			$conta_cedente = substr ( $dadosboleto ["conta_cedente"], - 5 );
			$conta_cedente_dv = formata_numero ( $dadosboleto ["conta_cedente_dv"], 1, 0 );
			$agencia_codigo = $agencia . " / " . $conta_cedente . "-" . $conta_cedente_dv;
			
			$nnum = formata_numero ( $nnum, 14, 0 );
			$constante = 87;
			$dv = digitoVerificador_barra ( "$codigobanco$nummoeda$fator_vencimento$valor$conta_cedente$agencia$constante$nnum", 9, 0 );
			$linha = "$codigobanco$nummoeda$dv$fator_vencimento$valor$conta_cedente$agencia$constante$nnum";
			
			$dadosboleto ["codigo_barras"] = $linha;
			$dadosboleto ["linha_digitavel"] = monta_linha_digitavel ( $linha );
			$dadosboleto ["agencia_codigo"] = $agencia_codigo;
			$dadosboleto ["codigo_banco_com_dv"] = $codigo_banco_com_dv;
			
			// im_funcoes_cef
			
			$pdf->SetTopMargin ( $layout == "unico" ? 5 : 8 );
			
			if ($layout == "unico") {
				
				$pdf->SetFont ( 'Arial', 'B', 8 );
				$pdf->Cell ( 0, 4, iconv ( "utf-8", "iso-8859-9", "Instruções de Impressão" ), 0, 1, 'C' );
				$pdf->Cell ( 0, 4, iconv ( "utf-8", "iso-8859-9", "Imprima em impressora jato de tinta (ink jet) ou laser em qualidade normal ou alta (Não use modo econômico)." ), 0, 1, 'J' );
				$pdf->Cell ( 0, 4, iconv ( "utf-8", "iso-8859-9", "Utilize folha A4 (210 x 297 mm) ou Carta (216 x 279 mm) e margens mínimas à esquerda e à direita do formulário." ), 0, 1, 'J' );
				$pdf->Cell ( 0, 4, iconv ( "utf-8", "iso-8859-9", "Corte na linha indicada. Não rasure, risque, fure ou dobre a região onde se encontra o código de barras" ), 0, 1, 'J' );
				$pdf->Cell ( 0, 4, iconv ( "utf-8", "iso-8859-9", "Caso não apareça o código de barras no final, clique em F5 para atualizar esta tela." ), 0, 1, 'J' );
				$pdf->Cell ( 0, 4, iconv ( "utf-8", "iso-8859-9", "Caso tenha problemas ao imprimir, copie a seqüencia numérica abaixo e pague no caixa eletrônico ou no internet banking:" ), 0, 1, 'J' );
				$pdf->Cell ( 0, 4, "", 0, 1, 'J' );
				$pdf->SetFont ( 'Arial', 'B', 8 );
				$pdf->Cell ( 26, 3, iconv ( "utf-8", "iso-8859-9", "Linha Digitavel: " ), 0, 0, 'J' );
				$pdf->Cell ( 0, 3, $dadosboleto ["linha_digitavel"], 0, 1, 'J' );
				$pdf->Cell ( 26, 3, "Valor", 0, 0, 'J' );
				$pdf->Cell ( 0, 3, $dadosboleto ["valor_boleto"], 0, 1, 'J' );
				$pdf->SetFont ( 'courier', '', 10 );
				$pdf->SetX ( 5 );
				$pdf->Cell ( 0, 3, "---------------------------------------------------------------------------------------------", 0, 1, 'J' );
				$pdf->SetFont ( 'Arial', 'B', 6 );
				$pdf->Cell ( 0, 3, "Recibo do Sacado", 0, 1, 'R' );
				// get current X and Y
				$start_x = $pdf->GetX ();
				$start_y = $pdf->GetY ();
				
				$pdf->Image ( '../image/LOGO_ATHENAS.jpg', $pdf->GetX (), $pdf->GetY (), 40 );
				$pdf->SetFont ( 'Arial', '', 8 );
				$pdf->SetXY ( $pdf->GetX () + 50, $pdf->GetY () );
				$pdf->Cell ( 0, 4, iconv ( "utf-8", "iso-8859-9", "CNPJ: 07.228.276/0001-70" ), 0, 1, 'L' );
				$pdf->SetXY ( $pdf->GetX () + 50, $pdf->GetY () );
				$pdf->Cell ( 0, 4, iconv ( "utf-8", "iso-8859-9", "PRAÇA NARCISO JOSE LOPES, 136" ), 0, 1, 'L' );
				$pdf->SetXY ( $pdf->GetX () + 50, $pdf->GetY () );
				$pdf->Cell ( 0, 4, iconv ( "utf-8", "iso-8859-9", "ARUJA - SP - 07401-795" ), 0, 1, 'L' );
				$pdf->SetXY ( $pdf->GetX () + 50, $pdf->GetY () );
				$pdf->Cell ( 0, 4, iconv ( "utf-8", "iso-8859-9", "http://www.colegioathenas.com.br" ), 0, 1, 'L' );
				
				$pdf->SetXY ( $start_x + 60, $start_y + 25 );
				
				// place image and move cursor to proper place. "+ 5" added for buffer
				$pdf->Image ( '../Boleto/imagens/logocaixa.jpg', $start_x, $pdf->GetY (), 40 );
				$pdf->SetXY ( $start_x + 40, $start_y + 25 );
				$pdf->SetFont ( 'Arial', 'B', 18 );
				$pdf->Cell ( 20, 10, $dadosboleto ["codigo_banco_com_dv"], "RL", 0, 'C' );
				
				$pdf->Cell ( 20, 10, "", "", 0, 'L' );
				$pdf->SetFont ( 'Arial', 'B', 12 );
				$pdf->Cell ( 110, 10, $dadosboleto ["linha_digitavel"], "", 1, "R" );
				$pdf->SetFont ( 'Arial', '', 8 );
				
				$pdf->Cell ( 190, 0, '', "T", 1, 'L' );
				
				$pdf->Cell ( 80, 4, 'Cedente', "LR", 0, 'L' );
				$pdf->Cell ( 40, 4, iconv ( "utf-8", "iso-8859-9", "Agência/Código do Cedente" ), "R", 0, 'L' );
				$pdf->Cell ( 15, 4, iconv ( "utf-8", "iso-8859-9", "Espécie" ), "R", 0, 'L' );
				$pdf->Cell ( 20, 4, 'Quantidade', "R", 0, 'L' );
				$pdf->Cell ( 35, 4, iconv ( "utf-8", "iso-8859-9", "Nosso número" ), "R", 1 );
				
				$pdf->SetFont ( 'Arial', 'B', 8 );
				$pdf->Cell ( 80, 4, $dadosboleto ["cedente"], "RL", 0, 'L' );
				$pdf->Cell ( 40, 4, $dadosboleto ["agencia_codigo"], "R", 0, 'L' );
				$pdf->Cell ( 15, 4, $dadosboleto ["especie"], "LR", 0, 'L' );
				$pdf->Cell ( 20, 4, $dadosboleto ["quantidade"], "LR", 0, 'L' );
				$pdf->Cell ( 35, 4, $dadosboleto ["nosso_numero"], "R", 1 );
				$pdf->SetFont ( 'Arial', '', 8 );
				
				$pdf->Cell ( 40, 4, iconv ( "utf-8", "iso-8859-9", "Número do documento" ), "LRT", 0, 'L' );
				$pdf->Cell ( 40, 4, 'CPF/CNPJ', "LRT", 0, 'L' );
				$pdf->Cell ( 40, 4, '	Vencimento', "LRT", 0, 'L' );
				$pdf->Cell ( 70, 4, '	Valor documento', "LRT", 1, 'L' );
				
				$pdf->SetFont ( 'Arial', 'B', 8 );
				$pdf->Cell ( 40, 4, $dadosboleto ["numero_documento"], "LR", 0, 'L' );
				$pdf->Cell ( 40, 4, $dadosboleto ["cpf_cnpj"], "R", 0, 'L' );
				$pdf->Cell ( 40, 4, $dadosboleto ["data_vencimento"], "R", 0, 'L' );
				$pdf->Cell ( 70, 4, $dadosboleto ["valor_boleto"], "R", 1, 'R' );
				$pdf->SetFont ( 'Arial', '', 8 );
				$pdf->Cell ( 40, 4, iconv ( "utf-8", "iso-8859-9", "(-)Desconto/Abatimento" ), "LRT", 0, 'L' );
				$pdf->Cell ( 35, 4, iconv ( "utf-8", "iso-8859-9", "(-)Outras Deduções" ), "LRT", 0, 'L' );
				$pdf->Cell ( 35, 4, iconv ( "utf-8", "iso-8859-9", "(+)Mora/Multa" ), "LRT", 0, 'L' );
				$pdf->Cell ( 40, 4, iconv ( "utf-8", "iso-8859-9", "(+)Outros Acrescimos" ), "LRT", 0, 'L' );
				$pdf->Cell ( 40, 4, iconv ( "utf-8", "iso-8859-9", "(=)Valor Cobrado" ), "LRT", 1, 'L' );
				
				$pdf->Cell ( 40, 4, "", "LR", 0, 'L' );
				$pdf->Cell ( 35, 4, "", "LR", 0, 'L' );
				$pdf->Cell ( 35, 4, "", "LR", 0, 'L' );
				$pdf->Cell ( 40, 4, "", "LR", 0, 'L' );
				$pdf->Cell ( 40, 4, "", "LR", 1, 'L' );
				
				$pdf->Cell ( 190, 4, "Sacado", "LTR", 1, 'L' );
				$pdf->SetFont ( 'Arial', 'B', 8 );
				$pdf->Cell ( 190, 4, iconv ( "utf-8", "iso-8859-9", $dadosboleto ["sacado"] ), "LR", 1, 'L' );
				$pdf->SetFont ( 'Arial', '', 8 );
				$pdf->Cell ( 150, 4, "Demonstrativo", "T", 0, 'L' );
				$pdf->Cell ( 40, 4, iconv ( "utf-8", "iso-8859-9", "Autenticação Mecânica" ), "T", 1, 'L' );
				$pdf->Cell ( 190, 20, "", "", 1, "L" );
				$pdf->SetFont ( 'courier', '', 10 );
				$pdf->SetX ( 5 );
				$pdf->Cell ( 0, 3, "---------------------------------------------------------------------------------------------", 0, 1, 'J' );
				
				$start_x = $pdf->GetX ();
				$start_y = $pdf->GetY ();
				
				// place image and move cursor to proper place. "+ 5" added for buffer
				$pdf->Image ( '../Boleto/imagens/logocaixa.jpg', $pdf->GetX (), $pdf->GetY () + 5, 40 );
				$pdf->SetXY ( $start_x + 40, $start_y + 5 );
				$pdf->SetFont ( 'Arial', 'B', 18 );
				$pdf->Cell ( 20, 10, $dadosboleto ["codigo_banco_com_dv"], "RL", 0, 'C' );
				
				$pdf->SetFont ( 'Arial', 'B', 12 );
				
				$pdf->Cell ( 130, 10, $dadosboleto ["linha_digitavel"], "", 1, 'R' );
				$pdf->SetFont ( 'Arial', '', 8 );
				$pdf->Cell ( 190, 0, '', "T", 1, 'L' );
				$pdf->Cell ( 140, 4, "Local de Pagamento", "LTR", 0, 'L' );
				$pdf->Cell ( 50, 4, "Vencimento", "LTR", 1, 'L', 1 );
				$pdf->SetFont ( 'Arial', 'B', 8 );
				$pdf->Cell ( 140, 4, iconv ( "utf-8", "iso-8859-9", "PREFERENCIALMENTE NAS CASAS LOTERICAS ATÉ O VENCIMENTO" ), "LR", 0, 'L' );
				$pdf->Cell ( 50, 4, $dadosboleto ["data_vencimento"], "LR", 1, 'R', 1 );
				
				$pdf->SetFont ( 'Arial', '', 8 );
				$pdf->Cell ( 105, 4, "Cedente", "LTR", 0, 'L' );
				$pdf->Cell ( 35, 4, "CPF/CNPJ", "LTR", 0, 'L' );
				$pdf->Cell ( 50, 4, "Agencia/Codigo do Cedente", "LTR", 1, 'L' );
				$pdf->SetFont ( 'Arial', 'B', 8 );
				$pdf->Cell ( 105, 4, $dadosboleto ["cedente"], "RL", 0, 'LR' );
				$pdf->Cell ( 35, 4, $dadosboleto ["cpf_cnpj"], "RL", 0, 'LR' );
				$pdf->Cell ( 50, 4, $dadosboleto ["agencia_codigo"], "LR", 1, 'R' );
				
				$pdf->SetFont ( 'Arial', '', 8 );
				$pdf->Cell ( 30, 4, iconv ( "utf-8", "iso-8859-9", "Data do Documento" ), "LTR", 0, 'L' );
				$pdf->Cell ( 35, 4, iconv ( "utf-8", "iso-8859-9", "Nº do Documento" ), "LTR", 0, 'L' );
				$pdf->Cell ( 30, 4, iconv ( "utf-8", "iso-8859-9", "Espécie de docto." ), "LTR", 0, 'L' );
				$pdf->Cell ( 10, 4, iconv ( "utf-8", "iso-8859-9", "Aceite" ), "LTR", 0, 'L' );
				$pdf->Cell ( 35, 4, iconv ( "utf-8", "iso-8859-9", "Data do processamento" ), "LTR", 0, 'L' );
				$pdf->Cell ( 50, 4, iconv ( "utf-8", "iso-8859-9", "Nosso Número" ), "LTR", 1, 'L' );
				$pdf->SetFont ( 'Arial', 'B', 8 );
				$pdf->Cell ( 30, 4, iconv ( "utf-8", "iso-8859-9", $dadosboleto ["data_documento"] ), "LR", 0, 'L' );
				$pdf->Cell ( 35, 4, iconv ( "utf-8", "iso-8859-9", $dadosboleto ["numero_documento"] ), "LR", 0, 'L' );
				$pdf->Cell ( 30, 4, iconv ( "utf-8", "iso-8859-9", "R$" ), "LR", 0, 'L' );
				$pdf->Cell ( 10, 4, iconv ( "utf-8", "iso-8859-9", "N" ), "LR", 0, 'L' );
				$pdf->Cell ( 35, 4, iconv ( "utf-8", "iso-8859-9", date ( "d/m/Y" ) ), "LR", 0, 'L' );
				$pdf->Cell ( 50, 4, iconv ( "utf-8", "iso-8859-9", $dadosboleto ["nosso_numero"] ), "LR", 1, 'R' );
				
				$pdf->SetFont ( 'Arial', '', 8 );
				$pdf->Cell ( 30, 4, iconv ( "utf-8", "iso-8859-9", "Uso do Banco" ), "LTR", 0, 'L' );
				$pdf->Cell ( 20, 4, iconv ( "utf-8", "iso-8859-9", "Carteira" ), "LTR", 0, 'L' );
				$pdf->Cell ( 15, 4, iconv ( "utf-8", "iso-8859-9", "Moeda" ), "LTR", 0, 'L' );
				$pdf->Cell ( 40, 4, iconv ( "utf-8", "iso-8859-9", "Quantidade" ), "LTR", 0, 'L' );
				$pdf->Cell ( 35, 4, iconv ( "utf-8", "iso-8859-9", "Valor" ), "LTR", 0, 'L' );
				$pdf->Cell ( 50, 4, iconv ( "utf-8", "iso-8859-9", "(=) Valor do Documento" ), "LTR", 1, 'L', 1 );
				$pdf->SetFont ( 'Arial', 'B', 8 );
				
				$pdf->Cell ( 30, 4, "", "LR", 0, 'L' );
				$pdf->Cell ( 20, 4, "SR", "LR", 0, 'L' );
				$pdf->Cell ( 15, 4, iconv ( "utf-8", "iso-8859-9", "R$" ), "LR", 0, 'L' );
				$pdf->Cell ( 40, 4, "", "LR", 0, 'L' );
				$pdf->Cell ( 35, 4, "", "LR", 0, 'L' );
				$pdf->Cell ( 50, 4, iconv ( "utf-8", "iso-8859-9", $dadosboleto ["valor_boleto"] ), "LR", 1, 'R', 1 );
				
				$pdf->SetFont ( 'Arial', '', 8 );
				$pdf->Cell ( 140, 4, iconv ( "utf-8", "iso-8859-9", "Instruções (Texto de Responsabilidade do Cedente)" ), "LTR", 0, 'L' );
				$pdf->Cell ( 50, 4, "(-) Desconto", "LTR", 1, 'L' );
				$pdf->SetFont ( 'Arial', 'B', 8 );
				$pdf->Cell ( 140, 6, iconv ( "utf-8", "iso-8859-9", $dadosboleto ["mensagem1"] ), "LR", 0 );
				$pdf->SetFont ( 'Arial', '', 8 );
				$pdf->Cell ( 50, 4, "", "LR", 1 );
				$pdf->SetFont ( 'Arial', 'B', 8 );
				$pdf->Cell ( 140, 6, iconv ( "utf-8", "iso-8859-9", $dadosboleto ["mensagem2"] ), "LR", 0 );
				$pdf->SetFont ( 'Arial', '', 8 );
				$pdf->Cell ( 50, 4, iconv ( "utf-8", "iso-8859-9", "(-)Outras Deduções" ), "LRT", 1 );
				
				$pdf->SetFont ( 'Arial', 'B', 8 );
				$pdf->Cell ( 140, 6, iconv ( "utf-8", "iso-8859-9", $dadosboleto ["mensagem3"] ), "LR", 0 );
				$pdf->SetFont ( 'Arial', '', 8 );
				$pdf->Cell ( 50, 4, "", "LR", 1 );
				$pdf->SetFont ( 'Arial', 'B', 8 );
				$pdf->Cell ( 140, 6, iconv ( "utf-8", "iso-8859-9", $dadosboleto ["mensagem4"] ), "LR", 0 );
				$pdf->SetFont ( 'Arial', '', 8 );
				$pdf->Cell ( 50, 4, iconv ( "utf-8", "iso-8859-9", "(+) Mora/Multa/Juros" ), "LRT", 1 );
				
				$pdf->SetFont ( 'Arial', 'B', 8 );
				$pdf->Cell ( 140, 6, iconv ( "utf-8", "iso-8859-9", $dadosboleto ["mensagem5"] ), "LR", 0 );
				$pdf->SetFont ( 'Arial', '', 8 );
				$pdf->Cell ( 50, 4, "", "LR", 1 );
				$pdf->SetFont ( 'Arial', 'B', 8 );
				$pdf->Cell ( 140, 6, iconv ( "utf-8", "iso-8859-9", $dadosboleto ["mensagem6"] ), "LR", 0 );
				$pdf->SetFont ( 'Arial', '', 8 );
				$pdf->Cell ( 50, 4, iconv ( "utf-8", "iso-8859-9", "(+) Outros Acrescimos" ), "LRT", 1 );
				
				$pdf->SetFont ( 'Arial', 'B', 8 );
				$pdf->Cell ( 140, 4, iconv ( "utf-8", "iso-8859-9", $dadosboleto ["mensagem7"] ), "LR", 0 );
				$pdf->SetFont ( 'Arial', '', 8 );
				$pdf->Cell ( 50, 4, "", "LR", 1 );
				$pdf->SetFont ( 'Arial', 'B', 8 );
				$pdf->Cell ( 140, 4, iconv ( "utf-8", "iso-8859-9", $dadosboleto ["mensagem8"] ), "LR", 0 );
				$pdf->SetFont ( 'Arial', '', 8 );
				$pdf->Cell ( 50, 4, iconv ( "utf-8", "iso-8859-9", "(=) Valor Cobrado" ), "LRT", 1 );
				$pdf->Cell ( 140, 4, "", "LRB", 0 );
				$pdf->Cell ( 50, 4, "", "LRB", 1 );
				$pdf->Cell ( 190, 4, "Sacado", "LR", 1, 'L' );
				$pdf->SetFont ( 'Arial', 'B', 8 );
				$pdf->Cell ( 190, 4, iconv ( "utf-8", "iso-8859-9", $dadosboleto ["sacado"] ), "LR", 1, 'L' );
				$pdf->Cell ( 190, 4, iconv ( "utf-8", "iso-8859-9", $dadosboleto ["endereco1"] ), "LR", 1, 'L' );
				$pdf->Cell ( 190, 4, iconv ( "utf-8", "iso-8859-9", $dadosboleto ["endereco2"] ), "LR", 1, 'L' );
				
				$pdf->Cell ( 110, 4, "", "TL", 0, 'L' );
				$start_x = $pdf->GetX ();
				$start_y = $pdf->GetY ();
				// place image and move cursor to proper place. "+ 5" added for buffer
				$pdf->i25 ( 12, $pdf->GetY () + 1, $dadosboleto ['codigo_barras'], 0.77, 10.3 );
				$pdf->SetXY ( $start_x, $start_y );
				$pdf->SetFont ( 'Arial', '', 7 );
				$pdf->Cell ( 50, 4, iconv ( "utf-8", "iso-8859-9", "Autenticação Mecânica" ), "T", 0, 'R' );
				$pdf->SetFont ( 'Arial', 'B', 7 );
				$pdf->Cell ( 30, 4, iconv ( "utf-8", "iso-8859-9", "Ficha de Compensação" ), "TR", 1, 'R' );
				$pdf->Cell ( 190, 10, "", "LR", 1, 'L' );
				$pdf->SetFont ( 'courier', '', 10 );
				$pdf->SetX ( 5 );
				$pdf->Cell ( 0, 3, "---------------------------------------------------------------------------------------------", 0, 1, 'J' );
			} else { // end_layout = unico
				$pdf->SetFillColor ( 190, 190, 190 );
				$start_x = $pdf->GetX ();
				$start_y = $pdf->GetY ();
				
				// place image and move cursor to proper place. "+ 5" added for buffer
				$pdf->Image ( '../Boleto/imagens/logocaixa.jpg', $pdf->GetX (), $pdf->GetY () + 3, 30 );
				$pdf->Image ( '../Boleto/imagens/logocaixa.jpg', $pdf->GetX () + 40, $pdf->GetY () + 3, 30 );
				$pdf->SetXY ( $start_x + 70, $start_y + 7 );
				$pdf->SetFont ( 'Arial', 'B', 15 );
				$pdf->Cell ( 15, 4, $dadosboleto ["codigo_banco_com_dv"], "RL", 0, 'C' );
				
				$pdf->SetFont ( 'Arial', 'B', 10 );
				$pdf->Cell ( 105, 4, $dadosboleto ["linha_digitavel"], "", 1, 'R' );
				
				$pdf->SetFont ( 'Arial', '', 7 );
				$pdf->Cell ( 38, 3, "Documento", "L", 0, 'L' );
				$pdf->Cell ( 2, 3, "", "", 0, 'L' );
				$pdf->Cell ( 115, 3, "Local de Pagamento", "LTR", 0, 'L' );
				$pdf->Cell ( 35, 3, "Vencimento", "LTR", 1, 'L', 1 );
				
				$pdf->SetFont ( 'Arial', 'B', 7 );
				$pdf->Cell ( 38, 3, $dadosboleto ["numero_documento"], "L", 0, 'L' );
				$pdf->Cell ( 2, 3, "", "", 0, 'L' );
				$pdf->Cell ( 115, 3, iconv ( "utf-8", "iso-8859-9", "PREFERENCIALMENTE NAS CASAS LOTERICAS ATÉ O VENCIMENTO" ), "LR", 0, 'L' );
				$pdf->Cell ( 35, 3, $dadosboleto ["data_vencimento"], "LR", 1, 'R', 1 );
				
				$pdf->SetFont ( 'Arial', '', 7 );
				$pdf->Cell ( 38, 3, "Nosso Numero", "TL", 0, 'L' );
				$pdf->Cell ( 2, 3, "", "", 0, 'L' );
				$pdf->Cell ( 90, 3, "Cedente", "LTR", 0, 'L' );
				$pdf->Cell ( 25, 3, "CPF/CNPJ", "LTR", 0, 'L' );
				$pdf->Cell ( 35, 3, "Agencia/Codigo do Cedente", "LTR", 1, 'L' );
				
				$pdf->SetFont ( 'Arial', 'B', 7 );
				$pdf->Cell ( 38, 3, $dadosboleto ["nosso_numero"], "L", 0, 'L' );
				$pdf->Cell ( 2, 3, "", "", 0, 'L' );
				$pdf->Cell ( 90, 3, $dadosboleto ["cedente"], "RL", 0, 'LR' );
				$pdf->Cell ( 25, 3, $dadosboleto ["cpf_cnpj"], "RL", 0, 'LR' );
				$pdf->Cell ( 35, 3, $dadosboleto ["agencia_codigo"], "LR", 1, 'R' );
				
				$pdf->SetFont ( 'Arial', '', 7 );
				$pdf->Cell ( 38, 3, "Vl. Documento", "TL", 0, 'L' );
				$pdf->Cell ( 2, 3, "", "", 0, 'L' );
				$pdf->Cell ( 25, 3, iconv ( "utf-8", "iso-8859-9", "Data do Documento" ), "LTR", 0, 'L' );
				$pdf->Cell ( 25, 3, iconv ( "utf-8", "iso-8859-9", "Nº do Documento" ), "LTR", 0, 'L' );
				$pdf->Cell ( 15, 3, iconv ( "utf-8", "iso-8859-9", "Espécie" ), "LTR", 0, 'L' );
				$pdf->Cell ( 15, 3, iconv ( "utf-8", "iso-8859-9", "Aceite" ), "LTR", 0, 'L' );
				$pdf->Cell ( 35, 3, iconv ( "utf-8", "iso-8859-9", "Data do processamento" ), "LTR", 0, 'L' );
				$pdf->Cell ( 35, 3, iconv ( "utf-8", "iso-8859-9", "Nosso Número" ), "LTR", 1, 'L' );
				
				$pdf->SetFont ( 'Arial', 'B', 7 );
				$pdf->Cell ( 38, 3, $dadosboleto ["valor_boleto"], "L", 0, 'L' );
				$pdf->Cell ( 2, 3, "", "", 0, 'L' );
				$pdf->Cell ( 25, 3, iconv ( "utf-8", "iso-8859-9", $dadosboleto ["data_documento"] ), "LR", 0, 'L' );
				$pdf->Cell ( 25, 3, iconv ( "utf-8", "iso-8859-9", $dadosboleto ["numero_documento"] ), "LR", 0, 'L' );
				$pdf->Cell ( 15, 3, iconv ( "utf-8", "iso-8859-9", "R$" ), "LR", 0, 'L' );
				$pdf->Cell ( 15, 3, iconv ( "utf-8", "iso-8859-9", "N" ), "LR", 0, 'L' );
				$pdf->Cell ( 35, 3, iconv ( "utf-8", "iso-8859-9", date ( "d/m/Y" ) ), "LR", 0, 'L' );
				$pdf->Cell ( 35, 3, iconv ( "utf-8", "iso-8859-9", $dadosboleto ["nosso_numero"] ), "LR", 1, 'R' );
				
				$pdf->SetFont ( 'Arial', '', 7 );
				$pdf->Cell ( 38, 3, "Vl. Desconto", "TL", 0, 'L' );
				$pdf->Cell ( 2, 3, "", "", 0, 'L' );
				$pdf->Cell ( 25, 3, iconv ( "utf-8", "iso-8859-9", "Uso do Banco" ), "LTR", 0, 'L' );
				$pdf->Cell ( 25, 3, iconv ( "utf-8", "iso-8859-9", "Carteira" ), "LTR", 0, 'L' );
				$pdf->Cell ( 15, 3, iconv ( "utf-8", "iso-8859-9", "Moeda" ), "LTR", 0, 'L' );
				$pdf->Cell ( 15, 3, iconv ( "utf-8", "iso-8859-9", "Quantidade" ), "LTR", 0, 'L' );
				$pdf->Cell ( 35, 3, iconv ( "utf-8", "iso-8859-9", "Valor" ), "LTR", 0, 'L' );
				$pdf->Cell ( 35, 3, iconv ( "utf-8", "iso-8859-9", "(=) Valor do Documento" ), "LTR", 1, 'L', 1 );
				
				$pdf->SetFont ( 'Arial', 'B', 7 );
				$pdf->Cell ( 38, 3, "", "L", 0, 'L' );
				$pdf->Cell ( 2, 3, "", "", 0, 'L' );
				$pdf->Cell ( 25, 3, "", "LR", 0, 'L' );
				$pdf->Cell ( 25, 3, "SR", "LR", 0, 'L' );
				$pdf->Cell ( 15, 3, iconv ( "utf-8", "iso-8859-9", "R$" ), "LR", 0, 'L' );
				$pdf->Cell ( 15, 3, "", "LR", 0, 'L' );
				$pdf->Cell ( 35, 3, "", "LR", 0, 'L' );
				$pdf->Cell ( 35, 3, iconv ( "utf-8", "iso-8859-9", $dadosboleto ["valor_boleto"] ), "LR", 1, 'R', 1 );
				
				$pdf->SetFont ( 'Arial', '', 7 );
				$pdf->Cell ( 38, 3, "Outros Abatimentos", "TL", 0, 'L' );
				$pdf->Cell ( 2, 3, "", "", 0, 'L' );
				$pdf->Cell ( 115, 3, iconv ( "utf-8", "iso-8859-9", "Instruções (Texto de Responsabilidade do Cedente)" ), "LTR", 0, 'L' );
				$pdf->Cell ( 35, 3, "(-) Desconto", "LTR", 1, 'L' );
				
				$pdf->SetFont ( 'Arial', 'B', 7 );
				$pdf->Cell ( 38, 3, "", "L", 0, 'L' );
				$pdf->Cell ( 2, 3, "", "", 0, 'L' );
				$pdf->Cell ( 115, 3, iconv ( "utf-8", "iso-8859-9", $dadosboleto ["mensagem1"] ), "LR", 0 );
				$pdf->Cell ( 35, 3, "", "LR", 1 );
				
				$pdf->SetFont ( 'Arial', '', 7 );
				$pdf->Cell ( 38, 3, "Mora / Multa", "TL", 0, 'L' );
				$pdf->Cell ( 2, 3, "", "", 0, 'L' );
				$pdf->SetFont ( 'Arial', 'B', 7 );
				$pdf->Cell ( 115, 3, iconv ( "utf-8", "iso-8859-9", $dadosboleto ["mensagem2"] ), "LR", 0 );
				$pdf->SetFont ( 'Arial', '', 7 );
				$pdf->Cell ( 35, 3, iconv ( "utf-8", "iso-8859-9", "(-)Outras Deduções" ), "LRT", 1 );
				
				$pdf->SetFont ( 'Arial', 'B', 7 );
				$pdf->Cell ( 38, 3, "", "L", 0, 'L' );
				$pdf->Cell ( 2, 3, "", "", 0, 'L' );
				$pdf->Cell ( 115, 3, iconv ( "utf-8", "iso-8859-9", $dadosboleto ["mensagem3"] ), "LR", 0 );
				$pdf->Cell ( 35, 3, "", "LR", 1 );
				
				$pdf->SetFont ( 'Arial', 'B', 7 );
				$pdf->Cell ( 38, 3, "Outros Acrescimos", "TL", 0, 'L' );
				$pdf->Cell ( 2, 3, "", "", 0, 'L' );
				$pdf->Cell ( 115, 3, iconv ( "utf-8", "iso-8859-9", $dadosboleto ["mensagem4"] ), "LR", 0 );
				$pdf->SetFont ( 'Arial', '', 7 );
				$pdf->Cell ( 35, 3, iconv ( "utf-8", "iso-8859-9", "(+) Mora/Multa/Juros" ), "LRT", 1 );
				
				$pdf->Cell ( 38, 3, "", "L", 0, 'L' );
				$pdf->Cell ( 2, 3, "", "", 0, 'L' );
				$pdf->SetFont ( 'Arial', 'B', 7 );
				$pdf->Cell ( 115, 3, iconv ( "utf-8", "iso-8859-9", $dadosboleto ["mensagem5"] ), "LR", 0 );
				$pdf->SetFont ( 'Arial', '', 7 );
				$pdf->Cell ( 35, 3, "", "LR", 1 );
				
				$pdf->Cell ( 38, 3, "Valor Cobrado", "TL", 0, 'L' );
				$pdf->Cell ( 2, 3, "", "", 0, 'L' );
				$pdf->SetFont ( 'Arial', 'B', 7 );
				$pdf->Cell ( 115, 3, iconv ( "utf-8", "iso-8859-9", $dadosboleto ["mensagem6"] ), "LR", 0 );
				$pdf->SetFont ( 'Arial', '', 7 );
				$pdf->Cell ( 35, 3, iconv ( "utf-8", "iso-8859-9", "(+) Outros Acrescimos" ), "LRT", 1 );
				
				$pdf->Cell ( 38, 3, "", "L", 0, 'L' );
				$pdf->Cell ( 2, 3, "", "", 0, 'L' );
				$pdf->SetFont ( 'Arial', 'B', 7 );
				$pdf->Cell ( 115, 3, iconv ( "utf-8", "iso-8859-9", $dadosboleto ["mensagem7"] ), "LR", 0 );
				$pdf->SetFont ( 'Arial', '', 7 );
				$pdf->Cell ( 35, 3, "", "LR", 1 );
				
				$pdf->Cell ( 38, 3, "Sacado", "TL", 0, 'L' );
				$pdf->Cell ( 2, 3, "", "", 0, 'L' );
				$pdf->SetFont ( 'Arial', 'B', 7 );
				$pdf->Cell ( 115, 3, iconv ( "utf-8", "iso-8859-9", $dadosboleto ["mensagem8"] ), "LR", 0 );
				$pdf->SetFont ( 'Arial', '', 7 );
				$pdf->Cell ( 35, 3, iconv ( "utf-8", "iso-8859-9", "(=) Valor Cobrado" ), "LRT", 1 );
				
				$pdf->SetFont ( 'Arial', 'B', 7 );
				$nome_sacado = iconv ( "utf-8", "iso-8859-9", $dadosboleto ["sacado"] );
				
				$pdf->WordWrap ( $nome_sacado, 38 );
				$pdf->Cell ( 38, 3, "", "L", 0, 'L' );
				$start_x = $pdf->GetX ();
				$start_y = $pdf->GetY ();
				$pdf->SetX ( 10 );
				
				$pdf->Write ( 3, $nome_sacado );
				
				$pdf->SetXY ( $start_x, $start_y );
				
				$pdf->Cell ( 2, 3, "", "", 0, 'L' );
				$pdf->Cell ( 115, 3, "", "LRB", 0 );
				$pdf->Cell ( 35, 3, "", "LRB", 1 );
				
				$pdf->Cell ( 38, 3, "", "L", 0, 'L' );
				$pdf->Cell ( 2, 3, "", "", 0, 'L' );
				$pdf->Cell ( 150, 3, "Sacado", "LR", 1, 'L' );
				
				$pdf->SetFont ( 'Arial', 'B', 7 );
				$pdf->Cell ( 38, 3, "", "L", 0, 'L' );
				$pdf->Cell ( 2, 3, "", "", 0, 'L' );
				$pdf->Cell ( 150, 3, iconv ( "utf-8", "iso-8859-9", $dadosboleto ["sacado"] ), "LR", 1, 'L' );
				
				$pdf->Cell ( 38, 3, "", "L", 0, 'L' );
				$pdf->Cell ( 2, 3, "", "", 0, 'L' );
				$pdf->Cell ( 150, 3, iconv ( "utf-8", "iso-8859-9", $dadosboleto ["endereco1"] ), "LR", 1, 'L' );
				
				$pdf->Cell ( 38, 3, "", "L", 0, 'L' );
				$pdf->Cell ( 2, 3, "", "", 0, 'L' );
				$pdf->Cell ( 150, 3, iconv ( "utf-8", "iso-8859-9", $dadosboleto ["endereco2"] ), "LR", 1, 'L' );
				
				$pdf->Cell ( 38, 3, "", "L", 0, 'L' );
				$pdf->Cell ( 2, 3, "", "", 0, 'L' );
				$pdf->Cell ( 70, 3, "", "TL", 0, 'L' );
				
				$start_x = $pdf->GetX ();
				$start_y = $pdf->GetY ();
				
				// place image and move cursor to proper place. "+ 5" added for buffer
				$pdf->i25 ( 52, $pdf->GetY () + 1, $dadosboleto ['codigo_barras'], 0.77, 10.3 );
				
				$pdf->SetXY ( $start_x, $start_y );
				$pdf->SetFont ( 'Arial', '', 7 );
				$pdf->Cell ( 80, 3, iconv ( "utf-8", "iso-8859-9", "Autenticação Mecânica" ), "TR", 1, 'R' );
				
				$pdf->SetFont ( 'Arial', 'B', 7 );
				$pdf->Cell ( 40, 8, "", "LR", 0, 'L' );
				$pdf->Cell ( 150, 3, iconv ( "utf-8", "iso-8859-9", "Ficha de Compensação" ), "RL", 1, 'R' );
				
				$pdf->Cell ( 40, 8, "", "LR", 0, 'L' );
				$pdf->Cell ( 150, 8, "", "LR", 1, 'L' );
				
				$pdf->SetFont ( 'courier', '', 10 );
				$pdf->SetX ( 5 );
				$pdf->Cell ( 0, 1, "---------------------------------------------------------------------------------------------", 0, 1, 'J' );
				$i ++;
			} // end_ layout = multiplo
		} // end $reg <= $qtd_bol
		
		if ($nPos >= 3) {
			$coefReg = 3 * $qtd_pag - 1;
		} else {
			$coefReg = 0;
		}
		$idxReg += $qtd_pag - $coefReg;
	} // end for pos
} // end for pag
$pdf->Output ( "boleto.pdf", "I" );
?>