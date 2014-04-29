<?php
$vlparcela = 1300;
// DADOS DO BOLETO PARA O SEU CLIENTE
$taxa_boleto = 0;
$data_venc = '22/10/2012'; // Prazo de X dias OU informe data: "13/04/2006" OU informe "" se Contra Apresentacao;
$valor_cobrado = "$vlparcela"; // Valor - REGRA: Sem pontos na milhar e tanto faz com "." ou "," ou com 1 ou 2 ou sem casa decimal
$valor_cobrado = str_replace ( ",", ".", $valor_cobrado );
$valor_boleto = number_format ( $valor_cobrado + $taxa_boleto, 2, ',', '' );

$dadosboleto ["inicio_nosso_numero"] = "80"; // Carteira SR: 80, 81 ou 82 - Carteira CR: 90 (Confirmar com gerente qual usar)
$dadosboleto ["nosso_numero"] = "159897"; // Nosso numero sem o DV - REGRA: Máximo de 8 caracteres!
$dadosboleto ["numero_documento"] = "100000020130101"; // Num do pedido ou do documento
$dadosboleto ["data_vencimento"] = $data_venc; // Data de Vencimento do Boleto - REGRA: Formato DD/MM/AAAA
$dadosboleto ["data_documento"] = date ( "d/m/Y" ); // Data de emissão do Boleto
$dadosboleto ["data_processamento"] = date ( "d/m/Y" ); // Data de processamento do boleto (opcional)
$dadosboleto ["valor_boleto"] = $valor_boleto; // Valor do Boleto - REGRA: Com vírgula e sempre com duas casas depois da virgula
$desconto = number_format ( $valor_cobrado * 0.05, 2, ',', '' );
// DADOS DO SEU CLIENTE
$dadosboleto ["sacado"] = "ANTONO CARLOS DA SILVA JUNIOR";
$dadosboleto ["endereco1"] = "Endereço do seu Cliente";
$dadosboleto ["endereco2"] = "Cidade - Estado -  CEP: 00000-000";

// INFORMACOES PARA O CLIENTE
$dadosboleto ["demonstrativo1"] = "Pagamento de Compra na Loja Nonononono";
$dadosboleto ["demonstrativo2"] = "Mensalidade referente a nonon nonooon nononon<br>Taxa bancária - R$ " . number_format ( $taxa_boleto, 2, ',', '' );
$dadosboleto ["demonstrativo3"] = "BoletoPhp - http://www.boletophp.com.br";

// INSTRUÇÕES PARA O CAIXA
$multa = number_format ( $valor_cobrado * 0.01, 2, ',', '' );
$juros = number_format ( $valor_cobrado * 0.003, 2, ',', '' );
$dadosboleto ["instrucoes1"] = "- MULTA DE  		R$:   $multa AP&Oacute;S $data_venc";
$dadosboleto ["instrucoes2"] = "- JUROS DE  		R$:   $juros AO DIA";
$dadosboleto ["instrucoes3"] = "- DESCONTO DE    R$    $desconto AT&Eacute; $data_venc OU PROXIMO DIA UTIL";
$dadosboleto ["instrucoes4"] = "NAO RECEBER APOS 30 DIAS DE ATRASO";

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
$dadosboleto ["identificacao"] = "BoletoPhp - Código Aberto de Sistema de Boletos";
$dadosboleto ["cpf_cnpj"] = "";
$dadosboleto ["endereco"] = "Coloque o endereço da sua empresa aqui";
$dadosboleto ["cidade_uf"] = "Cidade / Estado";
$dadosboleto ["cedente"] = "Coloque a Razão Social da sua empresa aqui";

// NÃO ALTERAR!
include ("include/bkpfuncoes_cef.php");
include ("include/layout_cef.php");
?>


