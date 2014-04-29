<?php
include ("../verifica_logado.php");
include_once "../Pessoa/pessoa_funcoes.php";
include_once "../geral.php";
ini_set ( "display_errors", 1 );

// incluir_solicitação
$id = $_REQUEST ['ID'];
$tipo = $_REQUEST ['tipo'];
$rm = getRequest ( "rm", "0" );
$valor = getRequest ( "valor", "0" );
$qtdParc = getRequest ( "qtdParc", "0" );
$idBol = getRequest ( "IDBOL", "0" );
$nmTpSolicitacao = getRequest ( "nmsol", "" );
$prazo = getRequest ( "prazo", 10 );
$senha = substr ( md5 ( uniqid ( rand (), true ) ), 0, 8 );

$nmAluno = getRequest ( "aluno_nome", "" );
$nmCurso = getRequest ( "curso_nome", "" );
$nmTurma = getRequest ( "turma_nome", "" );
$nmDisciplina = getRequest ( "disciplina_nome", "" );
$CID = getRequest ( "cid", "" );

if (($_REQUEST ['req_codigo'] == "") || ($_REQUEST ['req_codigo'] == "0")) {
	$req_codigo = ereg_replace ( "[^0-9]", "", $_REQUEST ['req_cpf'] );
	$incluir_requerente = true;
} else {
	$req_codigo = $_REQUEST ['req_codigo'];
	$incluir_requerente = false;
}
atualiza_pessoa ( null, $_REQUEST ['req_nome'], $_REQUEST ['req_endereco_res'], $_REQUEST ['req_endereco_complemento_res'], $_REQUEST ['req_cep_res'], $_REQUEST ['req_cidade'], $_REQUEST ['req_bairro'], $_REQUEST ['req_uf'], $_REQUEST ['req_rg'], $_REQUEST ['req_cpf'], $_REQUEST ['req_dt_nasc'], $_REQUEST ['req_naturalidade'], $_REQUEST ['req_naturalidade_uf'], $_REQUEST ['req_nacionalidade'], $_REQUEST ['req_email'], $_REQUEST ['req_pai'], $_REQUEST ['req_mae'], $_REQUEST ['req_cpf'], $_REQUEST ['req_profissao'], $_REQUEST ['req_estcivil'], $_REQUEST ['req_cep_com'], $_REQUEST ['req_endereco_com'], $_REQUEST ['req_bairro_com'], $_REQUEST ['req_cidade_com'], $_REQUEST ['req_uf_com'], $req_codigo, $incluir_requerente );
$usuario = $_SESSION ['nCdUsuario'];

$dPrazo = date ( 'Y-m-d', mktime ( 0, 0, 0, date ( "m" ), date ( "d" ) + $prazo, date ( "Y" ) ) );

$query_criar = "call solicitacao_incluir($tipo, $req_codigo,$usuario,'$dPrazo','$senha')";
$regsolicitacao = consulta ( "athenas", $query_criar );
$nCdSolicitacao = $regsolicitacao [0] ['nCdSolicitacao'];
$query_detalhes = array ();

switch ($id) {
	case "SUBCATT" :
		$query_detalhes [] = "INSERT INTO SUBCATT values ($nCdSolicitacao,'$nmAluno','$nmTurma','$nmDisciplina','$CID')";
		break;
	case "SUBSATT" :
		$query_detalhes [] = "INSERT INTO SUBSATT values ($nCdSolicitacao,'$nmAluno','$nmTurma','$nmDisciplina')";
		break;
	case "HISTREG" :
		$query_detalhes [] = "INSERT INTO HISTREG values ($nCdSolicitacao,'$nmAluno','$nmCurso','$nmTurma')";
		break;
	case "COMPRA" :
		foreach ( array_keys ( $_REQUEST ) as $chave ) {
			
			if (substr ( $chave, 0, 14 ) == "lista_detalhe_") {
				$item_qtd = explode ( "|", $_REQUEST [$chave] );
				$item = $item_qtd [0];
				$qtd = $item_qtd [1];
				$query_detalhes [] = "INSERT INTO compra(nCdSolicitacao, cItem, nQtd,cFase) values ($nCdSolicitacao,'$item',$qtd,'A'); ";
			}
		}
		break;
}
foreach ( $query_detalhes as $query_detalhe ) {
	consulta ( "athenas", $query_detalhe );
}

if ($valor > 0) {
	$reg_respfin = consulta ( "athenas", "SELECT CASE WHEN IFNULL(nCdRespFin,0) = 0 THEN nCdPessoa ELSE nCdRespFin  END as respfin FROM pessoa WHERE nCdPessoa = $req_codigo" );
	$respfin_codigo = $reg_respfin [0] ['respfin'];
	$valor_parc = $valor / $qtdParc;
	for($parcAtual = 1; $parcAtual <= $qtdParc; $parcAtual ++) {
		$SeuNum = $idBol . str_pad ( $rm, 4, "0", STR_PAD_LEFT ) . date ( "Y" ) . str_pad ( $parcAtual, 2, "0", STR_PAD_LEFT ) . str_pad ( $qtdParc, 2, "0", STR_PAD_LEFT );
		$dVctosql = date ( 'Y-m-d', mktime ( 0, 0, 0, date ( "m" ) + $i - 1, date ( "d" ) + 10, date ( "Y" ) ) );
		$dVcto = date ( 'd/m/Y', mktime ( 0, 0, 0, date ( "m" ) + $i - 1, date ( "d" ) + 10, date ( "Y" ) ) );
		$dEmissao = date ( 'Y-m-d' );
		
		$nVlrDescontoSql = 0;
		$nVlrMultaSql = $valor_parc * 0.02;
		$nVlrJurosSql = $valor_parc * 0.000333;
		
		$nVlrMulta = number_format ( $nVlrMultaSql, 2, ",", "." );
		$nVlrJuros = number_format ( $nVlrJurosSql, 2, ",", "." );
		$nVlrDesconto = number_format ( $nVlrDescontoSql, 2, ",", "." );
		
		$cMensagem1 = "- MULTA DE  		R$:   $nVlrMulta APÓS $dVcto";
		$cMensagem2 = "- JUROS DE  		R$:   $nVlrJuros AO DIA";
		$cMensagem3 = "- DESCONTO DE    R$    $nVlrDesconto ATÉ O VENCIMENTO";
		$cMensagem4 = "NAO RECEBER APOS 30 DIAS DE ATRASO";
		$cMensagem5 = "REF: $nmTpSolicitacao";
		
		$query = "INSERT INTO Titulos (nCdPessoa, SeuNum, dVcto, dEmissao, nVlrTitulo, nVlrJuros, dDesconto, nVlrDesconto
				, dMulta, nVlrMulta, cMensagem1, cMensagem2, cMensagem3, cMensagem4,cMensagem5)
				VALUES ('$respfin_codigo','$SeuNum','$dVctoSql','$dEmissao','$valor_parc','$nVlrJurosSql','$dVctoSql','$nVlrDescontoSql'
				,'$dVctoSql','$nVlrMultaSql','$cMensagem1','$cMensagem2','$cMensagem3','$cMensagem4','$cMensagem5')";
		
		consulta ( "athenas", $query );
	}
	
	$query = "SELECT * FROM Titulos where nCdPessoa = $respfin_codigo and nNossoNumero is null";
	$resultado = consulta ( 'athenas', $query );
	foreach ( $resultado as $registro ) {
		$nCdBoleto = $registro ['nCdBoleto'];
		$nosso_numero = gerarNossoNumero ( $nCdBoleto );
		
		$query = "UPDATE Titulos set nNossoNumero = '$nosso_numero' where nCdBoleto = $nCdBoleto";
		$nBoletos .= $nosso_numero . ";";
		// echo $nCdBoleto." - ".$nosso_numero."<br/>";
		consulta ( 'athenas', $query );
	}
}
// imprimir_protocolo

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
<script src="/js/pessoa_cadastro.js" type="text/javascript"></script>


<script>

	$(document).ready(function(){
		$( "#tabs" ).tabs();
		$("#protocolo").click(function(){					
			var width = 850;
			    var height = 600;
			    var left = parseInt((screen.availWidth/2) - (width/2));
			    var top = parseInt((screen.availHeight/2) - (height/2));
			    var windowFeatures = "width=" + width + ",height=" + height + ",scrollbars=yes,status,resizable,left=" + left + ",top=" + top + "screenX=" + left + ",screenY=" + top;			   
			    window.open("../Relatorio/protocolo.php?solicitacao=<?php echo $nCdSolicitacao?>", "Boletos", windowFeatures);
			return false;
			
		});
		$("#carne").click(function(){					
			var width = 850;
			    var height = 600;
			    var left = parseInt((screen.availWidth/2) - (width/2));
			    var top = parseInt((screen.availHeight/2) - (height/2));
			    var windowFeatures = "width=" + width + ",height=" + height + ",scrollbars=yes,status,resizable,left=" + left + ",top=" + top + "screenX=" + left + ",screenY=" + top;
			   
			    window.open("../Boleto/boletopdf2.php?nCdBoleto=<?php echo $nBoletos?>", "Boletos", windowFeatures);
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
			<form method="post">


				<div id="tabs">
					<ul>
						<li><a href="#geral"><img src="../image/procurar_pessoa_icon.jpg"
								height="30px" />&nbsp;Incluir Solicitação</a></li>
					</ul>

					<div id="consulta"
						style='height: 350px; padding-left: 5px; overflow: auto'>
						<table style="width: 100%; text-align: center">
							<tr style="height: 200px; vertical-align: bottom">
								<td><a href="#" id="protocolo"><img
										src="/image/icon_contrato_serv.png" width="100px" /> <br />
										Protocolo </a></td>
								<td><a href="#" id="carne"><img
										src="/image/icon_boleto_imprimir.png" /> <br /> Boletos </a></td>
							</tr>
						</table>
					</div>


				</div>

			</form>
		</div>
             
             <?php include "../footer.inc"?>
         	 
         </div>
</body>
</html>
