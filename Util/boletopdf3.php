<?php
require ('fpdf.php');
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

$dadosboleto ["nome"] = "ANTONIO CARLOS DA SILVA JUNIOR";
$dadosboleto ["endereco"] = "RUA FERNANDES CARDOSO, 26";
$dadosboleto ["cidade"] = "SANTA ISABEL - SP - 07500.000";
$dadosboleto ["codigo_banco_com_dv"] = "104-0";
$dadosboleto ["linha_digitavel"] = "10490.01686 11878.700001 00001.695980 2 55890000016800";
$dadosboleto ["cedente"] = "INSTITUTO EDUCACIONAL JR LTDA";
$dadosboleto ["agencia_codigo"] = "1187 / 00168-9";
$dadosboleto ["especie"] = "R$";
$dadosboleto ["quantidade"] = "";
$dadosboleto ["nosso_numero"] = "800000000169598-5";
$dadosboleto ["numero_documento"] = "300000020130101";
$dadosboleto ["cpf_cnpj"] = "07.228.276/0001-70";
$dadosboleto ["data_vencimento"] = "10/10/2013";
$dadosboleto ["data_documento"] = "10/01/2013";
$dadosboleto ["valor_boleto"] = "150,00";
$dadosboleto ["sacado"] = "ANTONIO CARLOS DA SILVA JÚNIOR";

$dadosboleto ["mensagem1"] = "- MULTA DE R$ 16,80 APOS 25/01/2013";
$dadosboleto ["mensagem2"] = "- JUROS DE R$ 0,55 AO DIA";
$dadosboleto ["mensagem3"] = "- DESCONTO DE R$ 0,00 ATE 25/01/2013";
$dadosboleto ["mensagem4"] = "- NÃO RECEBER APOS 30 DIAS DE ATRASO";
$dadosboleto ["mensagem5"] = "- REF. UNIFORMES";

$dadosboleto ["codigo_barras"] = '10492558900000168000016811878700000000169598';

$pdf = new PDF_i25 ();
$pdf->Open ();
10 / $pdf->SetAutoPageBreak ( 1, 10 );
$pdf->SetTopMargin ( 5 );

$pdf->AddPage ( "P" );
$pdf->SetTitle ( "Boleto" );
$pdf->SetDisplayMode ( fullwidth, continuous );

for($i = 1; $i <= 3; $i ++) {
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
	$nome_sacado = iconv ( "utf-8", "iso-8859-9", $dadosboleto ["nome"] );
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
	$pdf->Cell ( 150, 3, iconv ( "utf-8", "iso-8859-9", $dadosboleto ["nome"] ), "LR", 1, 'L' );
	
	$pdf->Cell ( 38, 3, "", "L", 0, 'L' );
	$pdf->Cell ( 2, 3, "", "", 0, 'L' );
	$pdf->Cell ( 150, 3, iconv ( "utf-8", "iso-8859-9", $dadosboleto ["endereco"] ), "LR", 1, 'L' );
	
	$pdf->Cell ( 38, 3, "", "L", 0, 'L' );
	$pdf->Cell ( 2, 3, "", "", 0, 'L' );
	$pdf->Cell ( 150, 3, iconv ( "utf-8", "iso-8859-9", $dadosboleto ["cidade"] ), "LR", 1, 'L' );
	
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
}

$pdf->Output ();
?>