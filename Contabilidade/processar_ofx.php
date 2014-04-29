<?php
ini_set ( "display_errors", 0 );
include ("../verifica_logado.php");
include "../geral.php";
require ("../config.php");
include_once "../bd.php";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Dados Cadastrais</title>
<link href="/css/estilo.css" rel="stylesheet" type="text/css" />
<link href="/css/jquery-ui.css" rel="stylesheet" type="text/css" />
<link href="/css/flexigrid.pack.css" rel="stylesheet" type="text/css" />
<script src="/js/jquery.js" type="text/javascript"></script>
<script src="/js/jquery-ui.js" type="text/javascript"></script>
<script src="/js/consulta_inss_historico.js" type="text/javascript"></script>
<script src="/js/cadastro_consulta.js" type="text/javascript"></script>
<script src="/js/flexigrid.pack.js" type="text/javascript"></script>

<script>
	$(document).ready(function(){
		$( "#tabs" ).tabs();
		$("#tabela").flexigrid({height: '365'});
		$("#tabela_header").flexigrid({height: '0'
		,resizable:false
		,colModel : [
                        {display: 'Data Movimento', name : 'id', width : 80, sortable : true, align: 'left'},
                        {display: 'Descricao', name : 'first_name', width : 650, sortable : true, align: 'left'},
                        {display: 'Id Banco', name : 'surname', width : 150, sortable : true, align: 'left'},
                        {display: 'Valor', name : 'email', width : 250, sortable : true, align: 'left'}
                ]

		});
	});
	</script>
</head>

<body>
	<div id="container">
            <?php include "../header.inc"?>
            <div id="menu"><?php include "../menu.inc"; ?></div>

		<div id="content">

			<form method="post" action="processado_ofx.php">
				<div id="tabs">
					<ul>
						<li><a href="#geral">Importar OFX - Extrato Bancario</a></li>

					</ul>
					<div id="geral" style='height: 415px'>
						<table border="1px" id="tabela_header">

						</table>
						<div>
							<table border="1px" id="tabela">
                	
                	<?php
																	session_start ();
																	
																	$arquivo = $_SESSION ['filename'];
																	$data = ofxToxml ( $arquivo );
																	$xml = simplexml_load_string ( $data );
																	
																	$trans = $xml->BANKMSGSRSV1->STMTTRNRS->STMTRS->BANKTRANLIST->STMTTRN;
																	$nrconta = $xml->BANKMSGSRSV1->STMTTRNRS->STMTRS->BANKACCTFROM->ACCTID;
																	$nrbanco = $xml->BANKMSGSRSV1->STMTTRNRS->STMTRS->BANKACCTFROM->BANKID;
																	foreach ( $trans as $tran ) {
																		$trandate = trim ( $tran->DTPOSTED );
																		$tdate = date ( "Y-m-d", strtotime ( substr ( $trandate, 0, 8 ) ) );
																		$tranamt = $tran->MEMO;
																		$trancrdr = $tran->FITID;
																		$TRNAMT = $tran->TRNAMT;
																		
																		$TRNAMT = number_format ( floatval ( $TRNAMT ), 2, ",", "." );
																		$tdate = date ( "d/m/Y", strtotime ( $tdate ) );
																		echo "<tr><td style='width:90px' >$tdate</td>
						    		  <td  style='width:660px' > $tranamt</td>
						    		  <td  style='width:160px' > $trancrdr</td>
						    		  <td  style='width:150px;text-align:right' >$TRNAMT</td>
						    		 
						    		  </tr>";
																	}
																	$nrbanco = trim ( $nrbanco );
																	$nragencia = trim ( substr ( $nrconta, 0, 4 ) );
																	$nrconta = trim ( substr ( $nrconta, 4 ) );
																	
																	?>
                   </table>
						</div>
						<label style="margin-top: 5px">Conta</label> <select
							name="nCdConta" id="nCdConta">
						<?php
						$query = "SELECT * FROM conta_corrente";
						$contas = consulta ( "athenas", $query );
						
						foreach ( $contas as $conta ) {
							$nome = $conta ['cNmConta'];
							$cAgencia = $conta ['cAgencia'];
							$cConta = $conta ['cConta'];
							$nCdBanco = $conta ['nCdBanco'];
							$nCdConta = $conta ['nCdContaCorrente'];
							
							echo "<option $selected value='$nCdConta'>$nome - ($cAgencia - $cConta)</option>";
						}
						
						?>
						
					</select>
						<button>Processar</button>
					</div>
				</div>
				<input name='nome_arquivo' type='hidden'
					value='<?php echo $_SESSION['filename']?>' />
			</form>
		</div>
             
             <?php include "../footer.inc"?>
         	 
         </div>
</body>
</html>