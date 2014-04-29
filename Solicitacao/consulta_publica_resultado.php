<?php
ini_set ( "display_errors", 0 );
require ("../config.php");
include_once "../bd.php";

$solicitacao = $_REQUEST ['protocolo'];
$senha = $_REQUEST ['autenticacao'];

$query = "SELECT  CASE IFNULL(solicitacao_fluxo.cSubFase,'I')
				    WHEN 'I' THEN tpsolicitacao_fase.cNmFaseInicial
				    WHEN 'A' THEN tpsolicitacao_fase.cNmFaseAndamento
				    WHEN 'F' THEN tpsolicitacao_fase.cNmFaseConcluido
				END AS cNmFase		
	  FROM  solicitacao 
	       INNER JOIN `solicitacao_fluxo`ON solicitacao.nCdSolicitacao = solicitacao_fluxo.nCdSolicitacao
	       INNER JOIN tpsolicitacao_fase ON tpsolicitacao_fase.`nCdTpSolicitacaoFase` = solicitacao_fluxo.`nCdFase`				    
	WHERE solicitacao.nCdSolicitacao = $solicitacao and cSenha = '$senha'
	  AND solicitacao_fluxo.dFluxo = (SELECT MAX(dFluxo) FROM solicitacao_fluxo WHERE nCdSOlicitacao = $solicitacao)";

$registros = consulta ( "athenas", $query );
if (count ( $registros ) == 0) {
	$msg = "Protocolo / Autorização inexistente";
} else {
	$msg = $registros [0] ['cNmFase'];
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Acesso ao Sistema</title>
<link href="/css/estilo.css" rel="stylesheet" type="text/css" />
<link href="/css/jquery-ui.css" rel="stylesheet" type="text/css" />
<script src="/js/jquery.js" type="text/javascript"></script>
<script src="/js/jquery-ui.js" type="text/javascript"></script>

</head>

<body style="background-color: #bbb; height: 95%">

	<div id="box"
		style="text-align: center; border-radius: 20px; box-shadow: 1px 2px 6px rgba(0, 0, 0, 0.5); -moz-box-shadow: 1px 2px 6px rgba(0, 0, 0, 0.5); -webkit-box-shadow: 1px 2px 6px rgba(0, 0, 0, 0.5); padding: 2 0px; background-color: white; height: 300px; left: 50%; margin: -100px 0 0 -160px; position: absolute; top: 40%; width: 350px;">



		<form name="frm1" id="frm1" method="post" action="verifica_login.php">
			<img src="/image/logo_sge.png" /> <br /> <span
				style="font-size: 20px; font-weight: bold;">Consulta Protocolo</span>
			<br />
			<br />
			<br />                     	 
                 	 	<?php echo $msg; ?>
						
					
   				</form>
	</div>   
             <?php
													include ("../footer.inc");
													?>
</body>
</html>
