<?php
ini_set ( "display_errors", 1 );
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
<script src="/js/jquery.js" type="text/javascript"></script>
<script src="/js/jquery-ui.js" type="text/javascript"></script>
<script src="/js/consulta_inss_historico.js" type="text/javascript"></script>
<script src="/js/cadastro_consulta.js" type="text/javascript"></script>
<script src="/js/jquery_masc.js" type="text/javascript"></script>

<script>
	function selectitem(objecValuetId, value, objectTextId, text){
		document.forms[0][objecValuetId].value = value;
		document.forms[0][objectTextId].value = text;
		$( "#dialog" ).dialog("close");
		return false;
		
	}
	$(document).ready(function(){
		$( "#tabs" ).tabs();
		$("#dialog").dialog( {modal: true, autoOpen: false, width: 700, height: 400} );
		$("#data").mask('99/99/9999');
		$("#campos_cheque").hide();
		$("#forma_pgto").change(function(){
			if ($(this).val() == 'CH'){
				$("#campos_cheque").show();
			}else{
				$("#campos_cheque").hide();
			}
		});
		$( "#btnpesq" ).click(function(){
        	_cpf = $("#cpf").val();
        	if (_cpf == ""){
        		$( "#dialog" ).dialog("open");
        		
        	}else{
	        	$.ajax({
				  url: '../Secretaria/search.php',
				  dataType: 'json',
				  data: { consulta: 'pessoa',cpf:_cpf  },
				  
				  success: function(json){
				  	$("#pessoa_nome").val(json.cNome);
				 
				  
				  },
				  beforeSend:function(){
					$("#div_loading").show();
				  },
				  complete: function(data){
					$("#div_loading").hide();
				  }
				  
				});
        	}
        });
	});
	</script>
</head>

<body>
	<div id="container">
			<?php include "../loading.inc"?>
            <?php include "../header.inc"?>
            <div id="menu"><?php include "../menu.inc"; ?></div>


		<div id="content">
			<div id="dialog">
				<iframe src="../Pessoa/consultar_popup.php?popup=sim"
					frameborder="0" width="680" height="300"></iframe>
			</div>
			<form method="post" action="upload_file.php"
				enctype="multipart/form-data">
				<div id="tabs">
					<ul>
						<li><a href="#geral">Incluir Lancamento</a></li>

					</ul>
					<div id="geral" style='height: 415px'>
						<label style="margin-top: 5px">C. Corrente</label> <select
							name="conta_corrente" id="conta_corrente">
								
								<?php
								$query = "SELECT * FROM conta_corrente";
								$contas = consulta ( "athenas", $query );
								
								foreach ( $contas as $conta ) {
									$nome = $conta ['cNmConta'];
									$cAgencia = $conta ['cAgencia'];
									$cConta = $conta ['cConta'];
									$nCdBanco = $conta ['nCdBanco'];
									$nCdConta = $conta ['nCdContaCorrente'];
									
									echo "<option value='$nCdConta'>$nome - ($cAgencia - $cConta)</option>";
								}
								
								?>
								</select> <br /> <label style="margin-top: 5px">Data</label> <input
							id='data' type='text' size='10'
							value='<?php echo date('d/m/Y'); ?>' /> <br /> <label
							style="margin-top: 5px">C. Contabil</label> <select
							id='conta_contabil'>
                   				 <?php
																								$query = 'select * from conta_contabil order by cCodConta';
																								$contas = consulta ( 'athenas', $query );
																								
																								foreach ( $contas as $conta ) {
																									$lancamento = $conta ['bPermiteLancamento'];
																									$codigo = $conta ['nCdContaContabil'];
																									$nome = $conta ['cCodConta'] . " - " . $conta ['cNmConta'];
																									
																									if ($lancamento == 1) {
																										$html_conta_contabil .= '</optgroup">';
																										$html_conta_contabil .= "<option values='$codigo' codigo='$codigo' >$nome</option>";
																									} else {
																										$html_conta_contabil .= "<optgroup label='$nome'>";
																									}
																								}
																								
																								echo $html_conta_contabil;
																								
																								?>
                   				 </select> <br /> <label style="margin-top: 5px">Identifica&ccedil;&atilde;o</label>
						<input id='data' type='text' size='10' /> <br /> <label
							style="margin-top: 5px">Descri&ccedil;&atilde;o</label> <input
							id='data' type='text' size='82' /> <br /> <label
							style="margin-top: 5px">Valor</label> <input id='data'
							type='text' size='10' /> <br /> <label style="margin-top: 5px">Forma
							Pgto</label> <select id='forma_pgto'>
							<option value='ES'>Especie</option>
							<option value='CH'>Cheque</option>
							<option value='CC'>Cartao de Credito</option>
							<option value='CD'>Cartao de Debito</option>
						</select> <br />
						<div id='campos_cheque'>
							<label style="margin-top: 5px">CMC7</label> <input id='banco'
								type='text' size='8' /> <input id='banco' type='text' size='10' />
							<input id='banco' type='text' size='13' /> <br /> <label
								style="margin-top: 5px">CPF</label> <input type="text" size="15"
								name="cpf" id="cpf" /> <img src="../image/search-icon.png"
								name="btnpesq" id="btnpesq" height="15px"> <input type="text"
								size="40" name="pessoa_nome" id="pessoa_nome"
								readonly="readonly" /> <br />
						
						</div>
						<button style="margin-top: 30px;" id="btnIncluir">Incluir</button>
					</div>
				</div>
			</form>
		</div>
             
             <?php include "../footer.inc"?>
         	 
         </div>
</body>
</html>