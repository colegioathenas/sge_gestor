<?php

// include("../verifica_logado.php");
$data_venc = $_REQUEST ['data_venc']; // Prazo de X dias OU informe data: "13/04/2006" OU informe "" se Contra Apresentacao;
$valor_cobrado = $_REQUEST ['valor_cobrado']; // Valor - REGRA: Sem pontos na milhar e tanto faz com "." ou "," ou com 1 ou 2 ou sem casa decimal
$valor_cobrado = str_replace ( ",", ".", $valor_cobrado );
$valor_boleto = number_format ( $valor_cobrado, 2, ',', '' );

// $dadosboleto["inicio_nosso_numero"] = "80"; // Carteira SR: 80, 81 ou 82 - Carteira CR: 90 (Confirmar com gerente qual usar)
// 8000000001601840
$nossonumero = $_REQUEST ['nossonumero'];
$nnum = $_REQUEST ['codigoboleto'];
$dadosboleto ["nosso_numero"] = substr ( $nossonumero, 0, 15 ) . "-" . substr ( $nossonumero, - 1 ); // Nosso numero sem o DV - REGRA: Máximo de 8 caracteres!
$dadosboleto ["numero_documento"] = $_REQUEST ['numero_documento']; // Num do pedido ou do documento
$dadosboleto ["data_vencimento"] = $data_venc; // Data de Vencimento do Boleto - REGRA: Formato DD/MM/AAAA
$dadosboleto ["data_documento"] = date ( "d/m/Y" ); // Data de emissão do Boleto
$dadosboleto ["data_processamento"] = date ( "d/m/Y" ); // Data de processamento do boleto (opcional)
$dadosboleto ["valor_boleto"] = $valor_boleto; // Valor do Boleto - REGRA: Com vírgula e sempre com duas casas depois da virgula
$desconto = number_format ( $_REQUEST ['desconto'], 2, ',', '' );
// DADOS DO SEU CLIENTE
$dadosboleto ["sacado"] = $_REQUEST ['sacado'];
$dadosboleto ["endereco1"] = $_REQUEST ['endereco1'];
$dadosboleto ["endereco2"] = $_REQUEST ['endereco2'];

// INSTRUÇÕES PARA O CAIXA
$multa = number_format ( $valor_cobrado * 0.1, 2, ',', '' );
$juros = number_format ( $valor_cobrado * 0.0033, 2, ',', '' );
$dadosboleto ["instrucoes1"] = $_REQUEST ['msg1'];
$dadosboleto ["instrucoes2"] = $_REQUEST ['msg2'];
$dadosboleto ["instrucoes3"] = $_REQUEST ['msg3'];
$dadosboleto ["instrucoes4"] = $_REQUEST ['msg4'];
$dadosboleto ["instrucoes5"] = $_REQUEST ['msg5'];
$dadosboleto ["instrucoes6"] = $_REQUEST ['msg6'];

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
$dadosboleto ["cpf_cnpj"] = "11.150.789/0001-839";
$dadosboleto ["endereco"] = "ESTR. OURO FINO, 1000 - OURO FINO";
$dadosboleto ["cidade_uf"] = "SANTA ISABEL / SP";
$dadosboleto ["cedente"] = "Ouro Blocos Ind. e Com";

// NÃO ALTERAR!

include ("include/funcoes_cef.php");
if ($_REQUEST ['layout'] == "unico") {
	include ("include/layout_william.php");
} else {
	include ("include/layout_cef.php");
}
?>


