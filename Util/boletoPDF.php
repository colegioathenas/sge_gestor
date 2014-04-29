<?php
// DADOS DO BOLETO PARA O SEU CLIENTE
require ('fpdf.php');
ini_set ( "display_errors", 1 );
class Boleto extends FPDF {
	var $ipath = ""; // caminho das imagens
	                 // var $ipath = "/www/fw/img/"; // caminho das imagens BASE QUENTE
	var $desc = 3; // tamanho célula descrição
	var $cell = 4; // tamanho célula dado
	var $fdes = 6; // tamanho fonte descrição
	var $fcel = 8; // tamanho fonte célula
	var $small = 0.1; // tamanho barra fina
	var $large = 0.6; // tamanho barra larga
	function Boleto() {
		$this->ipath = dirname ( __FILE__ ) . "/img/";
		parent::FPDF (); // construtor da classe FPDF
		$this->Open ();
		$this->SetAutoPageBreak ( 1, 0 );
		$this->SetTopMargin ( 5 );
	}
	function Add($info) {
		// formatando entradas
		$info ['cedente'] = ereg_replace ( "([0-9]{4})([0-9]{3})([0-9]{8})(.*)", "\\1.\\2.\\3-\\4", $info ['cedente'] );
		$info ['valor_documento'] = str_replace ( ".", ",", $info ['valor_documento'] );
		$info ['nosso_numero'] = ereg_replace ( "(.*)([0-9]{1})", "\\1-\\2", $info ['nosso_numero'] );
		
		$this->AddPage ();
		$this->SetLineWidth ( $this->small ); // borda fina em tudooooooooooooo
		
		/*
		 * // caixa de protocolo $this->SetFont('Arial', 'B', 16); $this->Cell(0, 30, "protocolo", 1, 1, 'C'); // linha $this->SetFont('Arial','B', $this->fcel); $this->Cell(0, 6, ' - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - ', 0, 0, 'C'); $this->ln();
		 */
		
		// caixa de histórico
		$this->SetFont ( 'Arial', '', 14 );
		// $this->Image($this->ipath."logo_iesde_branco.jpg", 12, 7, 22, 22); // logo
		// $this->Image($this->ipath."logo_ulbra.png", 175, 7, 19, 22); // logo
		$this->Cell ( 0, 7, "", "RTL", 1, 'C' );
		$this->Cell ( 0, 0, "COMPROVANTE DE INSCRIÇÃO", "RL", 1, 'C' );
		$this->Cell ( 0, 10, "PARA PROCESSO SELETIVO", "RL", 1, 'C' );
		$this->Cell ( 0, 1, "", "RL", 1, 'C' );
		$this->SetFont ( 'Arial', 'BU', 14 );
		$this->Cell ( 0, 9, "CURSO DE GRADUAÇÃO", "RL", 1, 'C' );
		$this->SetFont ( 'Arial', 'B', 11 );
		$this->Cell ( 0, 4, "", "RL", 1, 'C' );
		$this->Cell ( 0, 9, "N.º TERMO DE INSCRIÇÃO: " . ereg_replace ( "[^0-9]", "", $info ['nosso_numero'] ) . "   ", "RL", 1, 'R' );
		
		$this->SetFont ( 'Arial', '', 9 );
		$this->Cell ( 0, 2, "", "RL", 1, 'C' );
		$ValorEscrito = Number2String ( $info ['valor_documento'], "reais" );
		$this->Cell ( 0, 5, '      Através do pagamento deste "boleto" bancário, no valor de R$ ' . $info ['valor_documento'] . ' (' . $ValorEscrito . '), o candidato propõe sua', "RL", 1 );
		$this->Cell ( 0, 5, '      inscrição ao processo seletivo de acordo com edital disponibilizado em www.ulbra.br e www.iesde.com.br conforme', "RL", 1 );
		$this->Cell ( 0, 5, '      com as seguintes instruções:', "RL", 1 );
		
		$this->Cell ( 0, 4, "", "RL", 1, 'C' );
		$this->SetLineWidth ( $this->small );
		
		$this->Line ( 15, 66, 15, 104 ); // linha esquerda
		$this->Line ( 195, 66, 195, 104 ); // linha direita
		$this->Line ( 15, 66, 195, 66 ); // linha cima
		$this->Line ( 15, 74, 195, 74 ); // linha meio "prus ladu"
		$this->Line ( 15, 86, 195, 86 ); // linha baixo
		$this->Line ( 15, 96, 195, 96 ); // linha baixo
		$this->Line ( 15, 104, 195, 104 ); // linha baixo
		$this->Line ( 140, 66, 140, 86 ); // linha meio 1
		$this->Line ( 115, 96, 115, 104 ); // linha meio 4
		$this->Line ( 150, 96, 150, 104 ); // linha meio 4
		
		$this->Cell ( 120, 8, '          Taxa de inscrição R$ ' . $info ['valor_documento'] . " (" . Number2String ( $info ['valor_documento'] ) . ")", "L", 0 );
		
		$this->SetFont ( 'Arial', '', 8 );
		$this->Cell ( 0, 8, '            Data da Prova: ' . dateDesc ( $info ['DtProva'] ), "R", 1 );
		$this->SetFont ( 'Arial', '', 9 );
		
		$this->Cell ( 0, 2, '', "RL", 1 );
		$this->Cell ( 120, 4, '          Local da prova: ' . $info ['Conveniado'], "L", 0 );
		$this->Cell ( 0, 4, '            Horário: 10:00 às 14:00 horas     ', "R", 1 );
		$this->Cell ( 120, 4, '          Endereço: ' . $info ['LEndereco'] . ', ' . $info ['LNumero'] . ' - ' . $info ['LBairro'], "L", 0 );
		$this->Cell ( 0, 4, '           Fechamento dos portões: 10:00 horas', "R", 1 );
		
		$this->Cell ( 0, 3, '', "RL", 1 );
		
		$this->Cell ( 0, 4, '          Cidade: ' . $info ['LCidade'] . ' / ' . $info ['LEstado'], "LR", 1 );
		$this->Cell ( 0, 4, '          Curso: ' . $info ['Habilitacao'], "LR", 1 );
		$this->Cell ( 0, 4, '', "LR", 1 );
		
		$this->Cell ( 105, 3, '          Nome: ' . $info ['Nome'], "L", 0 );
		$this->Cell ( 35, 3, 'CPF: ' . $info ['CPF'], 0, 0 );
		$this->Cell ( 50, 3, 'RG: ' . $info ['RG'], "R", 1 );
		
		$this->Cell ( 0, 5, "", "RL", 1, 'C' );
		$this->SetFont ( 'Arial', 'B', 9 );
		$this->Cell ( 0, 5, '      Obrigatoriamente no dia da prova o candidato deve comparecer ao local discriminado acima portando um documento', "RL", 1 );
		$this->Cell ( 0, 5, '      com foto e o comprovante de pagamento desta taxa de inscrição. Deverá também estar munido de caneta esferográfica', "RL", 1 );
		$this->Cell ( 0, 5, '      azul ou preta.', "RL", 1 );
		// $this->Cell(0, 5, ' NO DIA DA PROVA O CANDIDATO DEVE COMPARECER AO LOCAL DISCRIMINADO PORTANDO UM DOCUMENTO COM FOTO E ESTE', "RL", 1);
		// $this->Cell(0, 5, ' COMPROVANTE DE PAGAMENTO DA TAXA DE INSCRIÇÃO. DEVERÁ TAMBÉM ESTAR MUNIDO DE CANETA ESFEROGRÁFICA AZUL OU PRETA.', "RL", 1);
		$this->Cell ( 0, 2, "", "RBL", 1, 'C' );
		// $this->Cell(0, 5, ' A identificação do candidato será através do seu número de inscrição designado neste "boleto" bancário e no Termo', "RL", 1);
		// $this->Cell(0, 5, ' de Inscrição.', "RL", 1);
		// $this->Cell(0, 2, "", "RBL", 1, 'C');
		
		// linha
		$this->SetFont ( 'Arial', 'B', $this->fcel );
		$this->Cell ( 0, 3, '', 0, 0, 'C' );
		$this->ln ();
		
		// recibo sacado
		// {{{ linha 1
		$this->Image ( $this->ipath . "caixa.png", 11, 128, 25, 8 ); // logo
		$this->SetLineWidth ( $this->large );
		$this->Line ( 10, 137, 200, 137 ); // linha baixo
		$this->Line ( 37, 127, 37, 137 ); // linha esquerda Banco
		$this->Line ( 57, 127, 57, 137 ); // linha esquerda Banco
		$this->SetLineWidth ( $this->small );
		
		$this->SetFont ( 'Arial', 'B', 16 );
		$this->Cell ( 27, 10, "", "BR", 0, "C" ); // logo
		                                       // $this->Cell(20, 10, $info['codigo_banco'], "LBR", 0, "C"); // logo
		$this->Cell ( 20, 10, "104-0", "LBR", 0, "C" ); // logo
		$this->SetFont ( 'Arial', 'B', 14 );
		$this->Cell ( 0, 10, "RECIBO DO SACADO", "LB", 1, "R" );
		// }}}
		// {{{ linha 2
		$this->SetFont ( 'Arial', 'B', $this->fdes );
		$this->Cell ( 0, $this->desc, "Cedente", 0, 1 );
		$this->SetFont ( 'Arial', 'B', $this->fcel );
		$this->Cell ( 0, $this->cell, $info ['NomeCedente'], "B", 1 );
		// }}}
		// {{{ linha 3
		$this->SetFont ( 'Arial', 'B', $this->fdes );
		$this->Cell ( 45, $this->desc, "Vencimento", "R", 0 );
		$this->Cell ( 50, $this->desc, "Agência/Código Cedente", "RL", 0 );
		$this->Cell ( 50, $this->desc, "Nosso Número", "RL", 0 );
		$this->Cell ( 50, $this->desc, "Número do Documento", "L", 1 );
		
		$this->SetFont ( 'Arial', 'B', 10 );
		$this->Cell ( 45, $this->cell, $info ['vencimento'], "BR", 0, "R" );
		$this->SetFont ( 'Arial', 'B', $this->fcel );
		$this->Cell ( 50, $this->cell, $info ['cedente'], "BRL", 0, "C" );
		$this->Cell ( 50, $this->cell, $info ['nosso_numero'], "BRL", 0, "C" );
		$this->Cell ( 0, $this->cell, $info ['NumeroDocumento'], "BL", 1, "C" );
		// }}}
		// {{{ linha 4
		$this->SetLineWidth ( $this->large );
		$this->Line ( 10, 158, 200, 158 ); // linha baixo
		$this->SetLineWidth ( $this->small );
		
		$this->SetFont ( 'Arial', 'B', $this->fdes );
		$this->Cell ( 45, $this->desc, "(=) Valor do Documento", "R", 0 );
		$this->Cell ( 50, $this->desc, "(-) Desconto", "RL", 0 );
		$this->Cell ( 50, $this->desc, "(+) Acréscimos", "RL", 0 );
		$this->Cell ( 50, $this->desc, "(=) Valor Cobrado", "L", 1 );
		
		$this->SetFont ( 'Arial', 'B', $this->fcel );
		$this->Cell ( 45, $this->cell, $info ['valor_documento'], "BR", 0, "R" );
		$this->Cell ( 50, $this->cell, '', "BRL", 0 );
		$this->Cell ( 50, $this->cell, '', "BRL", 0 );
		$this->Cell ( 0, $this->cell, '', "BL", 1 );
		// }}}
		// {{{ linha 5/6
		$this->SetLineWidth ( $this->large );
		// $this->Line(10, 165, 130, 165); // linha baixo
		$this->Line ( 130, 158, 130, 183 ); // linha direita
		$this->SetLineWidth ( $this->small );
		
		$this->SetFont ( 'Arial', 'B', $this->fdes );
		// $this->Cell(100, $this->desc, "Sacado", 0, 2);
		$this->Cell ( 100, $this->desc, "Instruções (Texto de exclusiva responsabilidade do Cedente)", 0, 0 );
		// Instruções (Texto de exclusiva responsabilidade do Cedente)
		$this->Cell ( 20, $this->desc, "", "R", 0 );
		$this->Cell ( 0, $this->desc, '------------------------------- Autenticação Mecânica -------------------------------', "L", 1 );
		
		$this->SetFont ( 'Arial', 'B', $this->fcel );
		$this->Cell ( 100, $this->cell, $info ['linha1'], 0, 2 );
		$this->Cell ( 100, $this->cell, $info ['linha2'], 0, 2 );
		$this->Cell ( 100, $this->cell, $info ['linha3'], 0, 1 );
		$this->Cell ( 100, $this->cell, $info ['Instrucao1'], 0, 2 );
		$this->Cell ( 100, $this->cell, $info ['Instrucao2'], 0, 1 );
		$this->Cell ( 120, 2, '', "R", 1 );
		// }}}
		
		// linha
		$this->SetFont ( 'Arial', 'B', $this->fcel );
		$this->Cell ( 0, 6, ' - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - ', 0, 0, 'C' );
		$this->ln ();
		
		// boleto
		// {{{ linha 1
		$this->Image ( $this->ipath . "caixa.png", 11, 190, 25, 8 ); // boleto
		$this->SetLineWidth ( $this->large );
		$this->Line ( 10, 199, 200, 199 ); // linha baixo
		$this->Line ( 37, 189, 37, 199 ); // linha esquerda Banco
		$this->Line ( 57, 189, 57, 199 ); // linha esquerda Banco
		$this->SetLineWidth ( $this->small );
		
		$this->SetFont ( 'Arial', 'B', 16 );
		$this->Cell ( 27, 10, "", "BR", 0, "C" ); // logo
		                                       // $this->Cell(20, 10, $info['codigo_banco'], "LBR", 0, "C"); // logo
		$this->Cell ( 20, 10, "104-0", "LBR", 0, "C" ); // logo
		$this->SetFont ( 'Arial', 'B', 14 );
		$this->Cell ( 0, 10, $info ['linha_digitavel'], "LB", 1, "C" );
		// }}}
		// {{{ linha 2
		$this->SetFont ( 'Arial', 'B', $this->fdes );
		$this->Cell ( 150, $this->desc, "Local de Pagamento", "R", 0 );
		$this->Cell ( 0, $this->desc, "Vencimento", "L", 1 );
		$this->SetFont ( 'Arial', 'B', $this->fcel );
		$this->Cell ( 150, $this->cell, 'PAGÁVEL PREF. NAS CASAS LOTÉRICAS, AG. CEF E REDE BANCÁRIA', "RB", 0 );
		$this->Cell ( 0, $this->cell, $info ['vencimento'], "LB", 1, "R" );
		// }}}
		// {{{ linha 3
		$this->SetFont ( 'Arial', 'B', $this->fdes );
		$this->Cell ( 150, $this->desc, "Cedente", "R", 0 );
		$this->Cell ( 0, $this->desc, "Agência/Código Cedente", "L", 1 );
		$this->SetFont ( 'Arial', 'B', $this->fcel );
		$this->Cell ( 150, $this->cell, $info ['NomeCedente'], "RB", 0 );
		$this->Cell ( 0, $this->cell, $info ['cedente'], "LB", 1, "R" );
		// }}}
		// {{{ linha 4
		$this->SetFont ( 'Arial', 'B', $this->fdes );
		$this->Cell ( 40, $this->desc, "Data do Documento", "R", 0 );
		$this->Cell ( 35, $this->desc, "Número do Documento", "RL", 0 );
		$this->Cell ( 25, $this->desc, "Espécie do Documento", "RL", 0 );
		$this->Cell ( 20, $this->desc, "Aceite", "RL", 0 );
		$this->Cell ( 30, $this->desc, "Data do Processamento", "RL", 0 );
		$this->Cell ( 0, $this->desc, "Nosso Número", "L", 1 );
		$this->SetFont ( 'Arial', 'B', $this->fcel );
		$this->Cell ( 40, $this->cell, $info ['DtCad'], "RB", 0, "C" );
		$this->Cell ( 35, $this->cell, $info ['NumeroDocumento'], "RB", 0, "C" );
		$this->Cell ( 25, $this->cell, '', "RB", 0, "C" );
		$this->Cell ( 20, $this->cell, 'N', "RB", 0, "C" );
		$this->Cell ( 30, $this->cell, $info ['DtCad'], "RB", 0, "C" );
		$this->Cell ( 0, $this->cell, $info ['nosso_numero'], "LB", 1, "R" );
		// }}}
		// {{{ linha 5
		$this->SetFont ( 'Arial', 'B', $this->fdes );
		$this->Cell ( 40, $this->desc, "Uso do Banco", "R", 0 );
		$this->Cell ( 17, $this->desc, "Cedente", "RL", 0 );
		$this->Cell ( 18, $this->desc, "Espécie", "RL", 0 );
		$this->Cell ( 40, $this->desc, "Quantidade", "RL", 0 );
		$this->Cell ( 35, $this->desc, "Valor", "RL", 0 );
		$this->Cell ( 0, $this->desc, "(=) Valor do Documento", "L", 1 );
		$this->SetFont ( 'Arial', 'B', $this->fcel );
		$this->Cell ( 40, $this->cell, '', "RB", 0, "C" );
		$this->Cell ( 17, $this->cell, 'SR', "RB", 0, "C" );
		$this->Cell ( 18, $this->cell, 'R$', "RB", 0, "C" );
		$this->Cell ( 40, $this->cell, '', "RB", 0, "C" );
		$this->Cell ( 35, $this->cell, "", "BRL", 0 );
		$this->Cell ( 0, $this->cell, $info ['valor_documento'], "LB", 1, "R" );
		// }}}
		// {{{ linha 6
		$this->SetLineWidth ( $this->large );
		$this->Line ( 160, 199, 160, 262 ); // linha direita
		$this->SetLineWidth ( $this->small );
		
		$this->SetFont ( 'Arial', 'B', $this->fdes );
		$this->Cell ( 150, $this->desc, "Instruções (Texto de exclusiva responsabilidade do Cedente)", "R", 0 );
		$this->Cell ( 0, $this->desc, "(-) Desconto/Abatimento", "L", 1 );
		$this->SetFont ( 'Arial', 'B', $this->fcel );
		$this->Cell ( 150, $this->cell, $info ['linha1'], "R", 0 );
		$this->Cell ( 0, $this->cell, '', "LB", 1 );
		
		$this->SetFont ( 'Arial', 'B', $this->fcel );
		$this->Cell ( 150, $this->desc, $info ['linha2'], "R", 0 );
		$this->SetFont ( 'Arial', 'B', $this->fdes );
		$this->Cell ( 0, $this->desc, '(-) Outras Deduções', "L", 1 );
		$this->SetFont ( 'Arial', 'B', $this->fcel );
		$this->Cell ( 150, $this->cell, $info ['linha3'], "R", 0 );
		$this->Cell ( 0, $this->cell, '', "LB", 1 );
		
		$this->SetFont ( 'Arial', 'B', $this->fcel );
		$this->Cell ( 150, $this->desc, $info ['Instrucao1'], "R", 0 );
		$this->SetFont ( 'Arial', 'B', $this->fdes );
		$this->Cell ( 0, $this->desc, '(+) Mora/Multa', "L", 1 );
		$this->SetFont ( 'Arial', 'B', $this->fcel );
		$this->Cell ( 150, $this->cell, $info ['Instrucao2'], "R", 0 );
		$this->Cell ( 0, $this->cell, '', "LB", 1 );
		
		$this->SetFont ( 'Arial', 'B', $this->fdes );
		$this->Cell ( 150, $this->desc, '', "R", 0 );
		$this->Cell ( 0, $this->desc, '(+) Outros Acréscimos', "L", 1 );
		$this->SetFont ( 'Arial', 'B', $this->fcel );
		$this->Cell ( 150, $this->cell, '', "R", 0 );
		$this->Cell ( 0, $this->cell, '', "LB", 1 );
		
		$this->SetFont ( 'Arial', 'B', $this->fdes );
		$this->Cell ( 150, $this->desc, '', "R", 0 );
		$this->Cell ( 0, $this->desc, '(+) Valor Cobrado', "L", 1 );
		$this->SetFont ( 'Arial', 'B', $this->fcel );
		$this->Cell ( 150, $this->cell, '', "R", 0 );
		$this->Cell ( 0, $this->cell, '', "LB", 1 );
		// }}}
		// {{{ linha 7
		$this->SetFont ( 'Arial', 'B', $this->fdes );
		$this->Cell ( 0, $this->desc, "Sacado", "T", 1 );
		
		$this->SetFont ( 'Arial', 'B', 7 );
		$this->Cell ( 55, $this->desc, substr ( $info ['Nome'], 0, 35 ) ); // CELI ALBINO DE LIMA
		$this->Cell ( 33, $this->desc, 'CPF: ' . $info ['CPF'] );
		$this->Cell ( 33, $this->desc, ($info ['TurmaID'] ? 'TURMA: ' . str_pad ( $info ['TurmaID'], 6, "0", STR_PAD_LEFT ) : '') ); // TURMA: 000012
		$this->Cell ( 55, $this->desc, $info ['Turma'], 0, 1 ); // CND/PE - PMC E.M. LEONEL MORO PR
		
		$this->Cell ( 55, $this->desc, $info ['Endereco'] . ($info ['Numero'] ? ", " : "") . $info ['Numero'] ); // RUA BEIJA FLOR, 610
		$this->Cell ( 33, $this->desc, ($info ['CEP'] ? 'CEP: ' . $info ['CEP'] : '') ); // CEP 11.111-11
		$this->Cell ( 33, $this->desc, ($info ['TutorID'] ? 'TUTOR: ' . str_pad ( $info ['TutorID'], 6, "0", STR_PAD_LEFT ) : '') ); // TUTOR: 000010
		$this->Cell ( 55, $this->desc, $info ['Tutor'], 0, 1 ); // ELZA GONÇALVES
		
		$this->Cell ( 55, $this->desc, $info ['Cidade'] ); // CURITIBA
		$this->Cell ( 33, $this->desc, $info ['Estado'] ); // PR
		$this->Cell ( 93, $this->desc, $info ['Curso'], 0, 1 ); // CURSO: CND - CND PE - CURSO NORMAL PROGRAMA ESPECIAL
		
		$this->SetFont ( 'Arial', 'B', $this->fdes );
		$this->Cell ( 150, $this->desc, 'Sacador/Avalista' );
		$this->Cell ( 50, $this->desc, 'Código da Baixa', 0, 1 );
		
		$this->SetLineWidth ( $this->large );
		$this->Line ( 10, 277, 200, 277 ); // linha baixo
		$this->SetLineWidth ( $this->small );
		
		$this->Cell ( 0, $this->desc, 'Autenticação Mecânica - Ficha de Compensação', 0, 1, "R" );
		// }}}
		
		// {{{ barcode
		$this->Image ( $info ['codigo_barras'], 10, 280, 150, 14 ); // boleto
			                                                        // }}}
	}
}

$pdf = new Boleto ();
$info = array ();
$info ['cedente'] = "87000000168";
$info ['valor_documento'] = 150.30;
$info ['nosso_numero'] = "800000000169598";
$pdf->Add ( $info );
$pdf->Output ();

?>
