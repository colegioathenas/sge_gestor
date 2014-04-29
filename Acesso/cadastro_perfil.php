<?php
session_start ();
ini_set ( "display_errors", 1 );
setlocale ( LC_ALL, NULL );
setlocale ( LC_ALL, 'pt_BR' );
include ("../verifica_logado.php");
require ("../config.php");
include_once "../bd.php";
/*
 * if (($_SESSION['ACCADUSU'] == "")||($_SESSION[ 'ACCADUSU'] == '000000')){ header("location:/acesso_negado.php"); } $nCdUsuario = $_REQUEST['codigo']; $query = "SELECT * FROM Usuario where nCdUsuario = $nCdUsuario;"; $registro = consulta('athenas', $query); $registro = $registro[0];
 */

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


<script>
	
	$(function() {
		
		$( "#tabs" ).tabs();
        $("#btnGravar").click(function(){
        	
        	if ($("#usuario_senha").val() != $("#usuario_confirmacao").val()){
        		alert("Confirmação de Senha Inválida");
        	}else{
        		$('#frm1').submit();
        	}
        	
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

			<form name="frm1" id="frm1" method="post" action="update_usuario.php">

				<div id="tabs">
					<ul>
						<li><a href="#geral">Cadastro de Usuario</a></li>

					</ul>


					<div id="geral"
						style='height: 415px; padding-left: 5px; overflow: auto'>
						<table>
							<thead>
								<tr>
									<td>Seguranca</td>
									<td>Cadastro</td>
									<td>Secretaria</td>
									<td>Financeiro</td>
									<td>Cobranca</td>
									<td>Contabilidade</td>
									<td>RH</td>
								</tr>
							</thead>
							<tr>
								<td><input type="checkbox" /> Alterar Senha</td>
								<td><input type="checkbox" /> Consultar</td>
								<td><input type="checkbox" /> Matricula</td>
								<td><input type="checkbox" /> Boletos</td>
								<td><input type="checkbox" /> Relatorio Inadimplencia</td>
								<td><input type="checkbox" /> Movimentacao</td>
								<td><input type="checkbox" /> Cadastro de Funcionarios</td>
							</tr>
						</table>

						<button style="margin-top: 30px;" id="btnGravar">Gerar</button>
					</div>
				</div>
			</form>
		</div>
             
             <?php include "../footer.inc"?>
         	 
         </div>
</body>
</html>