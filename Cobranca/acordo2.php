<?php
include ("../verifica_logado.php");
ini_set ( "display_errors", 0 );
require ("../config.php");
include_once "../bd.php";
include_once "../Util/gravar_comunicacao.php";

$cpf = $_REQUEST ['cpf'];
$_SESSION ['cpf'] = $cpf;
$boletos = $_REQUEST ['boletos'];
$boletos = substr ( $boletos, 0, strlen ( $boletos ) - 1 );

$query = "Select * from pessoa where nCdPessoa = $cpf";
$registro = consulta ( "athenas", $query );
$registro = $registro [0];

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Dados Cadastrais</title>
<link href="/css/estilo.css" rel="stylesheet" type="text/css" />
<link href="/css/jquery-ui.css" rel="stylesheet" type="text/css" />
<script src="/js/jquery.js" type="text/javascript"></script>
<script src="/js/jquery-ui.js" type="text/javascript"></script>
<script src="/js/jquery_masc.js" type="text/javascript"></script>
<script src="/js/pessoa_cadastro.js" type="text/javascript"></script>

<script>
  	$(function() {
  		$( "#tabs" ).tabs();
  		<?php include("../Pessoa/dados_gerais_script.inc")?>
  		<?php include("../Pessoa/comunicacao_script.inc")?>
  	});
  </script>

</head>


<body>
	<div id="container">
            <?php include "../header.inc"?>
            <div id="menu"><?php include "../menu.inc"; ?></div>

		<div id="content">
			<form id="frm1" action='incluir_acordo.php' target="_blank"
				method="post">
				<div id="tabs">
					<ul>
						<li><a href="#cadastro">Dados Cadastais</a></li>
						<li><a href="#referencia">Referencia</a></li>
						<li><a href="#comunicacao">Comunicacao</a></li>
					</ul>

					<div id="cadastro"
						style='height: 400px; padding-left: 5px; overflow: auto'>

						<input type='hidden' name='cpf'
							value='<?php echo  $_REQUEST['cpf'];?>'></input> <input
							type='hidden' name='boletos'
							value='<?php echo  $_REQUEST['boletos'];?>'></input> <input
							type='hidden' name='fluxo_pgto'
							value='<?php echo  $_REQUEST['fluxo_pgto'];?>'></input> <input
							type='hidden' name='vlrDivida'
							value='<?php echo  $_REQUEST['vlrDivida'];?>'></input> <input
							type='hidden' name='vlrDesconto'
							value='<?php echo  $_REQUEST['vlrDesconto'];?>'></input>
            				
            				
            					<?php include("../Pessoa/dados_gerais.php")?>
            				
            			</div>
					<div id="referencia"
						style='height: 385px; padding-left: 5px; overflow: auto'>
            			<?php
															$query = "select nNossoNumero,SeuNum,dVcto from titulos where nNossoNumero in ($boletos)";
															
															$resultado = consulta ( "athenas", $query );
															
															?>
            			<div id="geral"
							style='height: 385px; padding-left: 5px; overflow: auto'>

							<table>
								<thead>
									<tr>

										<td width='150px'>Nosso Numero</td>
										<td width='150px'>SeuNum</td>
										<td width='200px'>Referencia</td>

										<td></td>



									</tr>
								</thead>
							</table>
							<div id="titulos_resultado" style="height: 350px; overflow: auto">
								<table id='tbResultado'>
								<?php
								
								foreach ( $resultado as $registro ) {
									$nn = $registro ['nNossoNumero'];
									$seuNum = $registro ['SeuNum'];
									
									echo "<tr '>";
									
									echo "<td width='150px'>" . $nn . "<input name='nn" . $nn . "' size='10' type='hidden' value='" . $nn . "' /></td>";
									echo "<td width='150px'>$seuNum</td>";
									echo "<td width='200px'><input name='obs" . $nn . "'size='100' type='text' value='' /></td>";
									
									echo "</tr>";
								}
								?>
							</table>
							</div>
						</div>
					</div>
					<div id="comunicacao"
						style='height: 400px; padding-left: 5px; overflow: auto'>
                     		<?php
																							
																							include ("../Pessoa/comunicacao_dialog.php");
																							include ("../Pessoa/comunicacao.php");
																							?>
                     	</div>
				</div>
				<button id="btnEfetivar">Efetivar</button>
			</form>
		</div>
            <?php include "../footer.inc" ?>	
     </div>
</body>
</html>