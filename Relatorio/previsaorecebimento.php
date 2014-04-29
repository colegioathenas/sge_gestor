<?php
ini_set ( "display_errors", 0 );
include ("../verifica_logado.php");
setlocale ( LC_TIME, 'ptb', 'pt_BR', 'portuguese-brazil', 'bra', 'brazil', 'pt_BR.utf-8', 'pt_BR.iso-8859-1', 'br' );
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
			<script src="/js/jquery_masc.js" type="text/javascript"></script>

			<script>
	$(document).ready(function(){
		$( "#tabs" ).tabs();
		$("#data_inicio").mask("99/99/9999");
		$("#data_fim").mask("99/99/9999");
	});
	</script>

</head>

<body>
	<div id="container">
            <?php include "../header.inc"?>
            <div id="menu"><?php include "../menu.inc"; ?></div>

		<div id="content">
			<h2>Relatorio de Previsao de Recebimento</h2>
			<form method="post" action="previsaoderecebimento_rel.php"
				target="_blank">

				<legend style="margin-left: 10px">M&ecirc;s de Refer&ecirc;ncia</legend>
				<select name="mes_referencia">
	             	   		<?php
																				$mes = date ( 'm' );
																				$ano = date ( 'Y' );
																				for($i = 0; $i <= 12; $i ++) {
																					$vcto = mktime ( 0, 0, 0, $mes + $i, 1, $ano );
																					$value = date ( 'Ym', $vcto );
																					$display = strftime ( "%B/%Y", $vcto );
																					echo "<option  value='$value'>$display</option>";
																				}
																				
																				?>          	   
	             	   </select>


				<button id="btnProcessar">Processar</button>

			</form>
		</div>
             
             <?php include "../footer.inc"?>
         	 
         </div>
</body>