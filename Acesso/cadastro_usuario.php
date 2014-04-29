<?php
session_start ();
ini_set ( "display_errors", 1 );
setlocale ( LC_ALL, NULL );
setlocale ( LC_ALL, 'pt_BR' );
include ("../verifica_logado.php");
require ("../config.php");
include_once "../bd.php";

if (($_SESSION ['ACCADUSU'] == "") || ($_SESSION ['ACCADUSU'] == '000000')) {
	header ( "location:/acesso_negado.php" );
}

$nCdUsuario = $_REQUEST ['codigo'];
$query = "SELECT * FROM Usuario where nCdUsuario = $nCdUsuario;";

$registro = consulta ( 'athenas', $query );

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
						<input id="usuario_codigo" name="usuario_codigo" type="hidden"
							value="<?php echo $_REQUEST['codigo']; ?>" /> <label>Login</label>
						<input id="usuario_login" name="usuario_login" size="12"
							value="<?php echo $registro['cLogin']; ?>" /> <br /> <label
							style="margin-top: 5px">Nome</label> <input id="usuario_nome"
							name="usuario_nome" size="42"
							value="<?php echo $registro['cNmUsuario']; ?>" /> <br /> <label
							style="margin-top: 5px">Perfil</label> <select
							id="usuario_perfil" name="usuario_perfil">
							<option value="0">Selecione...</option>
          					<?php
															$query = "Select * from Perfil";
															$perfis = consulta ( "athenas", $query );
															
															foreach ( $perfis as $perfil ) {
																echo "echo <option value='" . $perfil ['nCdPerfil'] . "' ";
																if ($registro ['nCdPerfil'] == $perfil ['nCdPerfil']) {
																	echo "selected=\"selected\" ";
																}
																echo ">" . $perfil ['cNmPerfil'] . "</option>";
															}
															?>
          				</select> <br /> <label style="margin-top: 5px">Senha</label>
						<input id="usuario_senha" name="usuario_senha" type="password"
							size="12" /> <label style="margin-top: 5px">Confirmacao</label> <input
							id="usuario_confirmacao" name="usuario_confirmacao"
							type="password" size="12" /> <br />


						<button style="margin-top: 30px;" id="btnGravar">Gerar</button>
					</div>
				</div>
			</form>
		</div>
             
             <?php include "../footer.inc"?>
         	 
         </div>
</body>
</html>
