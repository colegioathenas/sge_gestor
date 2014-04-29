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

			<form method="post" action="carta_cobranca_lote_rel.php"
				target="_blank">
				<div id="tabs">
					<ul>
						<li><a href="#geral">Carta de Cobran&ccedil;a em Lote</a></li>

					</ul>


					<div id="geral"
						style='height: 415px; padding-left: 5px; overflow: auto'>
						<fieldset
							style="padding-top: 15px; padding-left: 5px; padding-bottom: 15px">
							<legend style="margin-left: 10px">Titulos abertos no Periodo</legend>
							<label>Data Inicio</label> <input id="data_inicio"
								name="data_inicio" type="text" size='12' value='' /> <label
								style="margin-top: 5px">Data Inicio</label> <input id="data_fim"
								name="data_fim" type="text" size='12' value='' />
						</fieldset>
						<fieldset
							style="padding-top: 15px; padding-left: 5px; padding-bottom: 15px">
							<legend style="margin-left: 10px">Valores em aberto entre</legend>
							<label>Valor Inicio</label> <input style="text-align: right"
								id="valor_inicio" name="valor_inicio" type="text" size='12'
								value='' /> <label style="margin-top: 5px">Valor Fim</label> <input
								style="text-align: right" id="valor_fim" name="valor_fim"
								type="text" size='12' value='' />
						</fieldset>
						<br />
						<button id="btnProcessar">Processar</button>
					</div>
				</div>
			</form>
		</div>
             
             <?php include "../footer.inc"?>
         	 
         </div>
</body>
</html>
