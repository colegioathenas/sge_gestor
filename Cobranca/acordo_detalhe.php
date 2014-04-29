<?php
include ("../verifica_logado.php");
ini_set ( "display_errors", 0 );
require ("../config.php");
include_once "../bd.php";
include_once "../Util/gravar_comunicacao.php";

$acordo = $_REQUEST ['acordo'];

$query = "SELECT * from acordo where nCdAcordo = $acordo";

$registro_acordo = consulta ( "athenas", $query );
$registro_acordo = $registro_acordo [0];
switch ($registro_acordo ['nCdStatus']) {
	case 1 :
		$statusStr = 'Pendente';
		break;
	case 2 :
		$statusStr = 'Aprovado';
		break;
	case 99 :
		$statusStr = 'Reprovado';
		break;
}

$cpf = $registro_acordo ['nCPF'];
$_SESSION ['cpf'] = $cpf;

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
  		<?php
				
include ("../Pessoa/dados_gerais_script.inc");
				include ("../Pessoa/comunicacao_script.inc");
				include ("acordo_aprova_reprova.inc");
				?>
		 $("#btnImprimir").click(function(){
	            var width = 850;
			    var height = 600;
			    var left = parseInt((screen.availWidth/2) - (width/2));
			    var top = parseInt((screen.availHeight/2) - (height/2));
			    var windowFeatures = "width=" + width + ",height=" + height + ",scrollbars=yes,status,resizable,left=" + left + ",top=" + top + "screenX=" + left + ",screenY=" + top;
			    var acordo = <?php echo $_REQUEST['acordo']; ?>;
			    window.open("acordo_imprimir.php?acordo="+acordo, "Contrato", windowFeatures);
	        	//window.open("../contrato.php", "Contrato", "width=850,height=600,scrollbars=yes");
	 
	        	return false;
	        });
		
	    
	   
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
						<li><a href="#cadastro">Dados Cadastrais</a></li>
						<li><a href="#referencia">Detalhes do Acordo</a></li>
						<li><a href="#observacao">Observacoes</a></li>

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
							value='<?php echo  $_REQUEST['vlrDivida'];?>'></input>
            				
            				
            					<?php include("../Pessoa/dados_gerais.php")?>
            				
            			</div>
					<div id="referencia"
						style='height: 385px; padding-left: 5px; overflow: auto'>
						<label style="width: 150px; margin-left: 5px">Status da Proposta</label><label
							id='lblStatus'><?php echo $statusStr; ?></label> <br /> <label
							style="width: 150px; margin-left: 5px">Valor da Divida</label><label><?php echo number_format($registro_acordo['nVlrDivida'],2,",",".");?></label>
						<label style="width: 150px;">Valor do Desconto</label><label><?php echo number_format($registro_acordo['nVlrDesconto'],2,",",".");?></label>

						<div id="geral"
							style='height: 385px; padding-left: 5px; overflow: auto'>
							<span style='font-size: large; font-weight: bold'>Titulos
								Atrasados</span>
							<table>
								<thead>
									<tr style='background-color: black; color: white'>

										<td width='150px'>Nosso Numero</td>
										<td width='150px'>SeuNum</td>
										<td width='600px'>Referencia</td>

										<td></td>



									</tr>
								</thead>
							</table>
							<div id="boletos" style="height: 150px; overflow: auto">
								<table id='tbResultado'>
								<?php
								
								$query = "select acordo_referencia.*,nNossoNumero,SeuNum from acordo_referencia inner join titulos on acordo_referencia.nCdBoleto = titulos.nCdboleto  where acordo_referencia.nCdAcordo = $acordo";
								
								$resultado = consulta ( "athenas", $query );
								
								foreach ( $resultado as $registro ) {
									$nn = $registro ['nNossoNumero'];
									$seuNum = $registro ['SeuNum'];
									$referencia = $registro ['cReferencia'];
									
									echo "<tr '>";
									
									echo "<td width='150px'>$nn</td>";
									echo "<td width='150px'>$seuNum</td>";
									echo "<td width='600px'>$referencia</td>";
									
									echo "</tr>";
								}
								?>
							</table>


							</div>
							<span style='font-size: large; font-weight: bold'>Fluxo de
								Pagamento</span>
							<table>
								<thead>

									<tr style='background-color: black; color: white'>

										<td width='100px'>Data</td>
										<td width='200px'>Valor</td>
										<td width='600px'>Forma</td>
									</tr>




								</thead>
							</table>
							<div id="boletos" style="height: 150px; overflow: auto">
								<table id='tbResultado'>
								<?php
								
								$query = "select * from acordo_fluxo_pgto where nCdAcordo = $acordo";
								
								$resultado = consulta ( "athenas", $query );
								
								foreach ( $resultado as $registro ) {
									$data = date ( "d/m/Y", strtotime ( $registro ['dPagamento'] ) );
									
									$valor = $registro ['nVlrPagamento'];
									$valor = number_format ( $valor, 2, ",", "." );
									
									$especie = $registro ['nCdEspecie'];
									
									switch ($especie) {
										case 1 :
											$especieStr = 'Especie';
											break;
										case 2 :
											$especieStr = 'Cheque';
											break;
										case 3 :
											$especieStr = 'Boleto';
											break;
									}
									
									echo "<tr '>";
									
									echo "<td width='150px'>$data</td>";
									echo "<td width='150px'>$valor</td>";
									echo "<td width='600px'>$especieStr</td>";
									
									echo "</tr>";
								}
								?>
							</table>
							</div>

						</div>

					</div>
					<div id="observacao"
						style='height: 400px; padding-left: 5px; overflow: auto'>
                     		<?php
																							
include ("../Pessoa/comunicacao_dialog.php");
																							include ("../Pessoa/comunicacao.php");
																							?>
                     	</div>
				</div>
				<button id="btnImprimir">Imprimir</button>
           	<?php include("acordo_aprova_reprova.php");?>
           
            </form>
		</div>
            <?php include "../footer.inc" ?>	
     </div>
</body>
</html>