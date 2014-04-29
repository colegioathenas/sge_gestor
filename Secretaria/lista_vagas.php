<?php
include ("../verifica_logado.php");
ini_set ( "display_errors", 0 );
require ("../config.php");
include_once "../bd.php";
include_once "../geral.php";
ini_set ( "display_errors", 0 );
$query = "call lista_vagas()";

$registros = consulta ( 'athenas', $query );
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
			<script src="/js/flexigrid.pack.js" type="text/javascript"></script>
			<script>
	$(document).ready(function(){
		//$( "#tabs" ).tabs();
		$("#tabela").flexigrid({height: '460', singleSelect: true});
		$("tr").click(function(){
			$("#serie").val($(this).attr('serie'));
			$("#frm1").submit();
		});
	});
	</script>

</head>

<body>
	<div id="container">
            <?php include "../header.inc"?>
            <div id="menu"><?php include "../menu.inc"; ?></div>

		<div id="content">

			<form name="frm1" id="frm1" method="post"
				action="../Relatorio/relacao_matricula.php" target="_blank">

				<div style="height: 485px">
					<table id="tabela">

						<tr>
							<td>Serie</td>
							<td>Vagas Liberadas</td>
							<td>Matriculadas</td>
							<td>Vagas Disponiveis</td>
						</tr>
                     		
                     	
                 	 	<?php
																				foreach ( $registros as $registro ) {
																					echo "<tr serie='" . $registro ['nCdCurso'] . "' >";
																					echo "<td>" . $registro ['cNmCurso'] . "</td>";
																					echo "<td>" . $registro ['nVagas'] . "</td>";
																					echo "<td>" . $registro ['nMatriculas'] . "</td>";
																					echo "<td>" . ($registro ['nVagas'] - $registro ['nMatriculas']) . "</td>";
																					echo "</tr>";
																				}
																				?>
                 	 	</table>
				</div>
				<input type="hidden" name="serie" id="serie" />
			</form>
		</div>
             
             <?php include "../footer.inc"?>
         	 
         </div>
</body>
</html>
