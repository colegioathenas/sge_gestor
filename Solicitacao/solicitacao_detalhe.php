<?php
include ("../verifica_logado.php");
include_once ("../config.php");
include_once "../bd.php";
include_once "../geral.php";
ini_set ( "display_errors", 0 );

$solicitacao = $_REQUEST ['solicitacao'];
$subfase = $_REQUEST ['subfase'];
$tipo = $_REQUEST ['tipo'];
$fase = $_REQUEST ['fase'];
$usuario = $_SESSION ['nCdUsuario'];

if ($subfase == "I") {
	/*
	 * consulta("athenas","UPDATE solicitacao_fluxo SET nCdUsuario = $usuario WHERE nCdSolicitacao = $solicitacao AND nCdFase = $fase AND cSubFase = 'I' AND dFluxo = ( SELECT * FROM ( SELECT MAX(dFluxo) FROM solicitacoa_fluxo WHERE nCdSolicitacao = $solicitacao AND nCdFase = $fase AND cSubFase = 'I' ) AS tbx ) ; ");
	 */
	consulta ( "athenas", "INSERT INTO solicitacao_fluxo VALUES ($solicitacao,NOW(),$fase,'A',$usuario,NULL);" );
}

$query = "SELECT dSolicitacao
			       , dPrazo
			       , cNmTpSolicitacao
			       , `cPaginaPHP`
			       , cNome
			       , solicitacao.nCdTpSolicitacao
			       , cID
 		 		FROM solicitacao 
       				 INNER JOIN tpsolicitacao ON tpsolicitacao.nCdTpSolicitacao = solicitacao.nCdTpSolicitacao
       				 INNER JOIN pessoa ON pessoa.nCdPessoa = solicitacao.nCdPessoa
 			   WHERE solicitacao.`nCdSolicitacao` = $solicitacao";
$registros = consulta ( "athenas", $query );
$registro = $registros [0];

$formulario = "./Formularios/" . $registro ['cPaginaPHP'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SGE - Sistema de Gestão Escolar [Solicitações]</title>
<link href="/css/estilo.css" rel="stylesheet" type="text/css" />
<link href="/css/jquery-ui.css" rel="stylesheet" type="text/css" />
<script src="/js/jquery.js" type="text/javascript"></script>
<script src="/js/jquery-ui.js" type="text/javascript"></script>
<script src="/js/jquery_masc.js" type="text/javascript"></script>
<script>
	
	$(document).ready(function(){
		$( "#tabs" ).tabs();
		$("#observacao_dialog").dialog({modal: true, autoOpen: false,width: 500, heigth: 800} );
		$("button[name=proxima_fase]").click(function(){
			$("#fase_atual").val($(this).attr("fase_atual"));
			$("#subfase_atual").val($(this).attr("subfase_atual"));
			$("#fase_proxima").val($(this).attr("fase_proxima"));
			$("#subfase_concluido").val($(this).attr("subfase_concluido"));
			$("#processo").val($(this).attr("processo"));					
			$("#observacao_dialog").dialog("open");
			$("#solicitacao_processar").text($(this).text());
			return false;
		});		
		$("#solicitacao_processar").click(function(){
			var _lista = "";
			$("input[name^=compra_]").each(function(){
				_lista = _lista + ';' + $(this).attr("codigo") + "|" + $(this).val();
			});
			$.ajax({
				  url: 'solicitacao_processar.php',
				  
				  data: { solicitacao 		: <?php echo $_REQUEST['solicitacao'];?>
				  	    , fase_atual  	    : $("#fase_atual").val()
				  		, subfase_atual  	: $("#subfase_atual").val()
				  		, observacao		: $("#observacao_texto").val()
				  		, fase_proxima 	    : $("#fase_proxima").val()
				  		, subfase_concluido : $("#subfase_concluido").val()
				  		, processo			: $("#processo").val()
				  		, id				: <?php echo "'".$registro['cID']."'";?>
				  		, lista				: _lista				  						  		
				  		},
				  
				  complete: function(){
				  	$( "#comunicacao_dialog" ).dialog("close");
				  	window.location.replace("consulta.php");	
				  }
				});

			$("#observacao_dialog").dialog("close");
			
		});
	});
	</script>
</head>

<body>
	<div id="container">
            <?php include "../header.inc"?>
            <div id="menu"><?php include "../menu.inc"; ?></div>

		<div id="content">
			<form method="post">
				<div id="observacao_dialog" title="Observação">
					<label style='margin-top: 5px; width: 100px'>Observação (Opcional)</label>
					<br />
					<textarea name="observacao_texto" id="observacao_texto"
						style="width: 460px; height: 180px"></textarea>
					<br />
					<button id="solicitacao_processar" class='sbtn2'
						style='margin-top: 15px'>Gravar</button>
				</div>
				<div id="tabs">
					<ul>
						<li><a href="#geral"><img src="../image/procurar_pessoa_icon.jpg"
								height="30px" />&nbsp;Incluir Solicitação</a></li>
					</ul>

					<div id="consulta"
						style='height: 350px; padding-left: 5px; overflow: auto'>
						<label style="margin-top: 5px; width: 120px">Data</label> <input
							id="data" name="data" size="11" readonly="readonly"
							value="<?php echo date("d/m/Y",strtotime($registro['dSolicitacao'])); ?>" />
						<label style="margin-top: 10px">Prazo</label> <input id="prazo"
							name="prazo" size="11" readonly="readonly"
							value="<?php echo date("d/m/Y",strtotime($registro['dPrazo'])); ?>" />
						<br /> <label style="margin-top: 5px; width: 120px">Tipo de
							Solicitação</label> <input id="tpSolicitacao" name="Solicitacao"
							size="50" readonly="readonly"
							value="<?php echo $registro['cNmTpSolicitacao']; ?>" /> <br /> <label
							style="margin-top: 5px; width: 120px">Requerente: </label> <input
							id="requerente" size="50" readonly="readonly"
							value="<?php echo $registro['cNome']; ?>" /> <br />
   					 	  <?php include $formulario; ?>
						  
						  <div id="formulario" style='height: 150px; overflow: auto'>
							<table class="tbGrid">
								<thead>
									<tr>
										<td width="120px">Data</td>
										<td width="120px">Usuario</td>
										<td width="200px">Fase</td>
										<td>Observação</td>
										<td></td>
									</tr>
								</thead>
										
						  	<?php
									$query_fases = "SELECT dFluxo 
												     , tpsolicitacao_fase.`cTpFase`
												     , solicitacao_fluxo.cSubFase
												     , CASE IFNULL(solicitacao_fluxo.cSubFase,'I')
														    WHEN 'I' THEN tpsolicitacao_fase.cNmFaseInicial
														    WHEN 'A' THEN tpsolicitacao_fase.cNmFaseAndamento
														    WHEN 'F' THEN tpsolicitacao_fase.cNmFaseConcluido
														END AS cNmFase
													 , CASE WHEN IFNULL(cNmFaseConcluido,'') = '' THEN 'X' ELSE 'F' END as subfase_concluido
												     , tpsolicitacao_fase.nCdGrupo
												     , solicitacao_fluxo.cObservacao
												     , solicitacao_fluxo.nCdFase			
												     , CASE WHEN (SELECT COUNT(*) FROM usuario_grupo WHERE usuario_grupo.nCdUsuario = 1 AND usuario_grupo.nCdGrupo =  solicitacao_fluxo.nCdFase) = 0 THEN 0 ELSE 1 END AS acesso_nxt_fase									
												     , usuario.cLogin
												  FROM solicitacao_fluxo
												       INNER JOIN tpsolicitacao_fase ON tpsolicitacao_fase.nCdTpSolicitacaoFase = solicitacao_fluxo.nCdFase
												       left JOIN usuario ON usuario.nCdUsuario = solicitacao_fluxo.nCdusuario
												 WHERE solicitacao_fluxo.nCdSolicitacao = $solicitacao      
												ORDER BY dFluxo DESC       ";
									$registros_fluxo = consulta ( "athenas", $query_fases );
									$i = 0;
									foreach ( $registros_fluxo as $regfluxo ) {
										echo "<tr>";
										echo "<td>" . date ( "d/m/Y H:i", strtotime ( $regfluxo ['dFluxo'] ) ) . "</td>";
										echo "<td>" . $regfluxo ['cLogin'] . "</td>";
										echo "<td>" . $regfluxo ['cNmFase'] . "</td>";
										echo "<td>" . $regfluxo ['cObservacao'] . "</td>";
										echo "<td>";
										if ($i == 0) {
											if (($regfluxo ["cTpFase"] != "F") && ($regfluxo ["acesso_nxt_fase"] == 1)) {
												$query_prox_fase = "
																SELECT tpsolicitacao_fase.nCdTpSolicitacaoFase, cNmFaseInicial, nCdFaseProxima, tpsolicitacao_fluxo.cNmProcesso																     
																  FROM tpsolicitacao_fluxo 
																       INNER JOIN tpsolicitacao_fase ON tpsolicitacao_fase.nCdTpSolicitacaoFase = nCdFaseProxima
																 WHERE tpsolicitacao_fluxo.nCdTpSolicitacao = " . $registro ['nCdTpSolicitacao'] . " 
																   AND tpsolicitacao_fluxo.nCdFaseAtual = " . $regfluxo ["nCdFase"];
												
												$registros_prox_fase = consulta ( 'athenas', $query_prox_fase );
												foreach ( $registros_prox_fase as $reg_prox_fase ) {
													$fase_atual = $regfluxo ["nCdFase"];
													$subfase_atual = $regfluxo ["cSubFase"];
													$fase_proxima = $reg_prox_fase ["nCdFaseProxima"];
													$subfase_concluido = $regfluxo ['subfase_concluido'];
													$processo = $reg_prox_fase ["cNmProcesso"];
													
													echo "<button name='proxima_fase' class='sbtn2' subfase_concluido='$subfase_concluido' fase_proxima='$fase_proxima' fase_atual='$fase_atual' subfase_atual='$subfase_atual' processo='$processo'>" . $reg_prox_fase ['cNmFaseInicial'] . "</button>  ";
												}
											}
										}
										echo "</td>";
										echo "</tr>";
										$i ++;
									}
									?>
						  	</table>
						</div>
					</div>


				</div>
				<input id="fase_atual" type="hidden" /> <input id="subfase_atual"
					type="hidden" /> <input id="fase_proxima" type="hidden" /> <input
					id="subfase_concluido" type="hidden" /> <input id="processo"
					type="hidden" />
			</form>
		</div>
             
             <?php include "../footer.inc"?>
         	 
         </div>
</body>
</html>
