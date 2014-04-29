<?php
ini_set ( "display_errors", 0 );
include ("../verifica_logado.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Dados Cadastrais</title>
<link href="/css/estilo.css" rel="stylesheet" type="text/css">
	</script>
	<link href="/css/jquery-ui.css" rel="stylesheet" type="text/css">
		</script>
		<link href="/css/flexigrid.pack.css" rel="stylesheet" type="text/css">
			</script>
			<script src="/js/jquery.js" type="text/javascript"></script>
			<script src="/js/jquery-ui.js" type="text/javascript"></script>
			<script src="/js/consulta_inss_historico.js" type="text/javascript"></script>
			<script src="/js/cadastro_consulta.js" type="text/javascript"></script>
			<script src="/js/flexigrid.pack.js" type="text/javascript"></script>

			<script>
	$(document).ready(function(){
		$( "#tabs" ).tabs();
		$("#tabela").flexigrid({height: '460'});
	});
	</script>

</head>

<body>
	<div id="container">
            <?php include "../header.inc"?>
            <div id="menu"><?php include "../menu.inc"; ?></div>

		<div id="content">

			<form method="post" action="processado_retorno.php">
				<table border="1px" id="tabela">
					<tr>
						<td>nosso_numero</td>
						<td>Vencimento</td>
						<td>Movimento</td>
						<td>valor</td>
						<td>Local Pagamento</td>
						<td>Forma Pagamento</td>
						</td>
						<td>Vlr Pago</td>
						<td>Acrescimos</td>
						<td>Descontos</td>
						<td>Abatimentos</td>
						<td>Vlr Tarifa</td>
						<td>Vlr Liquido</td>
					</tr>
                	<?php
																	session_start ();
																	
																	$arquivo = fopen ( $_SESSION ['filename'], "r" );
																	while ( ! feof ( $arquivo ) ) {
																		$linha = fgets ( $arquivo, 242 );
																		if (substr ( $linha, 13, 1 ) == "T") {
																			$idcaixa = substr ( $linha, 46, 11 );
																			$vcto = substr ( $linha, 73, 8 );
																			$valor = substr ( $linha, 81, 15 );
																			$bco_recebedor = substr ( $linha, 96, 3 );
																			$age_recebedor = substr ( $linha, 99, 6 );
																			$nosso_numero = substr ( $linha, 105, 25 );
																			$tarifa = substr ( $linha, 198, 15 );
																			$codret = substr ( $linha, 213, 10 );
																			
																			$valor = number_format ( $valor / 100.00, 2, ',', '' );
																			$tarifa = number_format ( $tarifa / 100.00, 2, ',', '' );
																			$vcto = substr ( $vcto, 0, 2 ) . "/" . substr ( $vcto, 2, 2 ) . "/" . substr ( $vcto, - 4 );
																			
																			switch (substr ( $codret, 0, 2 )) {
																				case '02' :
																					$local = 'Casas Lotericas';
																					break;
																				case '03' :
																					$local = 'Liquidação no próprio Banco';
																					break;
																				case '04' :
																					$local = 'Compensação Eletrônica';
																					break;
																				case '05' :
																					$local = 'Compensação Convencional';
																					break;
																				case '06' :
																					$local = 'Outros Canais';
																					break;
																				case '07' :
																					$local = 'Correspondente Não Bancário';
																					break;
																				case '08' :
																					$local = 'Em Cartório';
																					break;
																			}
																			switch (substr ( $codret, 4, 2 )) {
																				case '01' :
																					$formaPgto = 'Dinheiro';
																					break;
																				case '02' :
																					$formaPgto = 'Cheque';
																					break;
																			}
																		}
																		if (substr ( $linha, 13, 1 ) == "U") {
																			$codmov = substr ( $linha, 15, 2 );
																			$acrescimos = substr ( $linha, 17, 15 );
																			$desconto = substr ( $linha, 32, 15 );
																			$abatimento = substr ( $linha, 47, 15 );
																			$pago = substr ( $linha, 77, 15 );
																			$liquido = substr ( $linha, 92, 15 );
																			$dtmov = substr ( $linha, 137, 8 );
																			$dtcredito = substr ( $linha, 145, 8 );
																			$dttarifa = substr ( $linha, 153, 8 );
																			
																			$dtmov = substr ( $dtmov, 0, 2 ) . "/" . substr ( $dtmov, 2, 2 ) . "/" . substr ( $dtmov, - 4 );
																			$acrescimos = number_format ( $acrescimos / 100.00, 2, ',', '' );
																			$desconto = number_format ( $desconto / 100.00, 2, ',', '' );
																			$abatimento = number_format ( $abatimento / 100.00, 2, ',', '' );
																			$pago = number_format ( $pago / 100.00, 2, ',', '' );
																			$liquido = number_format ( $liquido / 100.00, 2, ',', '' );
																			
																			echo "<tr><td>$nosso_numero</td><td>$vcto</td><td>$dtmov</td><td>$valor</td><td>$local</td><td>$formaPgto</td><td>$pago</td><td>$acrescimos</td><td>$desconto</td><td>$abatimento</td><td>$tarifa</td><td>$liquido</td></tr>";
																		}
																	}
																	fclose ( $arquivo );
																	?>
                   </table>
				<button>Processar</button>
				<input name='nome_arquivo' type='hidden'
					value='<?php echo $_SESSION['filename']?>' />
			</form>
		</div>
             
             <?php include "../footer.inc"?>
         	 
         </div>
</body>