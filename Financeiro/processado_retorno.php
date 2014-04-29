<?php
include ("../verifica_logado.php");
ini_set ( "display_errors", 0 );
require ("../config.php");
include_once "../bd.php";

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

			<form method="post">
				<table border="1px" id="tabela">
					<tr>
						<td>Nosso Numero</td>
						<td>Status</td>
						<td>Valor Com Desconto</td>
						<td>Valor Pago</td>
					</tr>
                	<?php
																	session_start ();
																	$arquivo = fopen ( $_REQUEST ['nome_arquivo'], "r" );
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
																			
																			$juros = 0;
																			$multa = 0;
																			$forma = substr ( $codret, 4, 2 );
																			$canal = substr ( $codret, 0, 2 );
																			$float = 0;
																			
																			$valor = $valor / 100.00;
																			$tarifa = $tarifa / 100.00;
																			$vctosql = substr ( $vcto, - 4 ) . "-" . substr ( $vcto, 2, 2 ) . substr ( $vcto, 0, 2 );
																			$dtmovsql = substr ( $dtmov, - 4 ) . "/" . substr ( $dtmov, 2, 2 ) . "/" . substr ( $dtmov, 0, 2 );
																			$dtcreditosql = substr ( $dtcredito, - 4 ) . "/" . substr ( $dtcredito, 2, 2 ) . "/" . substr ( $dtcredito, 0, 2 );
																			$dttarifasql = substr ( $dttarifa, - 4 ) . "/" . substr ( $dttarifa, 2, 2 ) . "/" . substr ( $dttarifa, 0, 2 );
																			$acrescimos = $acrescimos / 100.00;
																			$desconto = $desconto / 100.00;
																			$abatimento = $abatimento / 100.00;
																			$pago = $pago / 100.00;
																			$liquido = $liquido / 100.00;
																			
																			$query = "call baixar_titulo('$nosso_numero','$dtmovsql',$pago,$desconto,$acrescimos
										 ,$juros,$multa,$liquido,$tarifa,'$dtcreditosql','$dttarifasql','$canal','$forma','$float','06',0)";
																			
																			$resultado = consulta ( 'athenas', $query );
																			
																			echo "<tr><td>$nosso_numero</td><td>" . $resultado [0] ['resposta'] . "</td><td>" . number_format ( $resultado [0] ['minimo'], "2", ",", "." ) . "</td><td>" . number_format ( $resultado [0] ['pago'], "2", ",", "." ) . "</td></tr>";
																		}
																	}
																	fclose ( $arquivo );
																	?>
                   </table>

			</form>
		</div>
             
             <?php include "../footer.inc"?>
         	 
         </div>
</body>