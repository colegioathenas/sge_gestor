<?php
ini_set ( "display_errors", 0 );

@header ( 'Content-Type: text/html; charset=utf-8' );
$fileXML = $_REQUEST ['processo'] . ".xml";
$xml = simplexml_load_file ( $fileXML );
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
			<script src="/js/flexigrid.pack.js" type="text/javascript"></script>

			<script>
	$(document).ready(function(){
		$("#div1").scroll(function(){
			_valor = $(this).scrollTop();
			$("#div2").scrollTop(_valor);
		});
		
	});
	</script>

</head>

<body>
	<div style="height: 200px; overflow: auto" id="div1">
		a <br />a <br />a <br />a <br />a <br />a <br />a <br />a <br />a <br />a
		<br />a <br />a <br />a <br />a <br />a <br />a <br />a <br />a <br />a
		<br />a <br />a <br />a <br /> a <br />a <br />a <br />a <br />a <br />a
		<br />a <br />a <br />a <br />a <br />a <br />a <br />a <br />a <br />a
		<br />a <br />a <br />a <br />a <br />a <br />a <br />a <br /> a <br />a
		<br />a <br />a <br />a <br />a <br />a <br />a <br />a <br />a <br />a
		<br />a <br />a <br />a <br />a <br />a <br />a <br />a <br />a <br />a
		<br />a <br />a <br />a <br />a <br />a <br /> a <br />a <br />a <br />a
		<br />a <br />a <br />a <br />a <br />a <br />a <br />a <br />a <br />a
		<br />a <br />a <br />a <br />a <br />a <br />a <br />a <br />a <br />a
		<br />a <br />a <br /> a <br />a <br />a <br />a <br />a <br />a <br />a
		<br />a <br />a <br />a <br />a <br />a <br />a <br />a <br />a <br />a
		<br />a <br />a <br />a <br />a <br />a <br />a <br />a <br /> a <br />a
		<br />a <br />a <br />a <br />a <br />a <br />a <br />a <br />a <br />a
		<br />a <br />a <br />a <br />a <br />a <br />a <br />a <br />a <br />a
		<br />a <br />a <br />


	</div>
	<div style="height: 200px; overflow: auto" id="div2">
		b1 <br />b1 <br />b3 <br />b4 <br />b5 <br />b6 <br />b7 <br />b8 <br />b9
		<br />b <br />b <br />b <br />b <br />b <br />b <br />b <br />b <br />b
		<br />b <br />b <br />b <br />b <br /> b <br />b <br />b <br />b <br />b
		<br />b <br />b <br />b <br />b <br />b <br />b <br />b <br />b <br />b
		<br />b <br />b <br />b <br />b <br />b <br />b <br />b <br />b <br />
		b <br />b <br />b <br />b <br />b <br />b <br />b <br />b <br />b <br />b
		<br />b <br />b <br />b <br />b <br />b <br />b <br />b <br />b <br />b
		<br />b <br />b <br />b <br />b <br />b <br />b <br /> b <br />b <br />b
		<br />b <br />b <br />b <br />b <br />b <br />b <br />b <br />b <br />b
		<br />b <br />b <br />b <br />b <br />b <br />b <br />b <br />b <br />b
		<br />b <br />b <br />b <br /> b <br />b <br />b <br />b <br />b <br />b
		<br />b <br />b <br />b <br />b <br />b <br />b <br />b <br />b <br />b
		<br />b <br />b <br />b <br />b <br />b <br />b <br />b <br />b <br />
		b <br />b <br />b <br />b <br />b <br />b <br />b <br />b <br />b <br />b
		<br />b <br />b <br />b <br />b <br />b <br />b <br />b <br />b <br />b
		<br />b <br />b <br />b <br />
	</div>
	<div id="div3"></div>
</body>
</html>
