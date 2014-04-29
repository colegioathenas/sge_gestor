<?php
include ("../verifica_logado.php");
ini_set ( "display_errors", 0 );
require ("../config.php");
include_once "../bd.php";
include_once "../Util/gravar_comunicacao.php";

$cpf = $_REQUEST ['cpf'];
$cpf = preg_replace ( '#[^0-9]#', '', $cpf );
$_SESSION ['cpf'] = $cpf;
$query = "Select p.*,rf.cNome as cNmRespFin from pessoa p left join pessoa rf on rf.nCPF = p.nCdRespFin  AND p.`nCdRespFin` != 0  where p.nCdPessoa = $cpf";
$registro = consulta ( "athenas", $query );
$registro = $registro [0];

$query_dependentes = "SELECT * FROM pessoa where nCdRespFin = $cpf and nCdRespFin != nCdPessoa";
$dependentes = consulta ( "athenas", $query_dependentes );

$isFuncionario = count ( consulta ( "athenas", "select * from funcionario where nCdPessoa = $cpf" ) ) == 0 ? false : true;

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SGE - Sistema de Gestão Escolar [Cadastro]</title>
<link href="/css/estilo.css" rel="stylesheet" type="text/css" />
<link href="/css/jquery-ui.css" rel="stylesheet" type="text/css" />
<script src="/js/jquery.js" type="text/javascript"></script>
<script src="/js/jquery-ui.js" type="text/javascript"></script>
<script src="/js/jquery_masc.js" type="text/javascript"></script>


<script>
	
	$(document).ready(function(){
		<?php include "dados_gerais_script.inc"; ?>
		<?php include "comunicacao_script.inc"; ?>
		
		
		$("#enviaboleto").dialog({modal: true, autoOpen: false,width: 500} );
        $("#apontamento_dialog").dialog({modal: true, autoOpen: false,width: 300} );
        $("#loading").dialog({modal: true, autoOpen: false,width: 120,height:80} );
        $("#envia_sms_dialog").dialog({modal: true, autoOpen: false,width: 520 } );
		
		$( "#tabs" ).tabs();
		
		$("#tbApontamento tbody td[name=es]").live('click',function(){
                    $("#apontamento_inclusao").hide();
                    $("#apontamento_movimento").hide();
                    $("#apontamento_ocorencia").hide();
                    $("#apontamento_esatual").val($(this).attr("valor"));
                    $("#apontamento_marcacao").val($(this).attr("marcacao"));
                    $("#apontamento_data").val($(this).attr("data"));
                    $("#apontamento_horario").val($(this).attr("horario"));
                    $("#apontamento_acao").val("0");
                    
                    
                    $("#apontamento_dialog").dialog("open");
                });
		
		$("input[name=tpConsulta]").click(function(){
			_tpConsulta = $("input[name=tpConsulta]:checked").val();
			_cpf = $("#nCdPessoa").val();
			$.ajax({
			  url: '../Financeiro/consulta_titulos.php',
			 
			  data: { tpConsulta:_tpConsulta ,cpf:_cpf  },
			  
			  success: function(html){
			 	$("#financeiro_resultado").html(html); 
			  }
			  
			});
		});
		$(".mail").live('click', function(){
			$("#boleto_mail_codigo").val($(this).attr('codigo'));
			$("#boleto_mail_chave").val($(this).attr('chave'));
			$("#enviaboleto").dialog("open");
			
			
		});
		
		
		$("#boleto_email_enviar").click(function(){
			$.ajax({
				  url: '../Util/boleto2email.php',
				  
				  data: { codigo: $("#boleto_mail_codigo").val()
				  		,  email: $("#boleto_mail_email").val()
				  		, chave:  $("#boleto_mail_chave").val()
				  		},
				  
				  complete: function(){
				  	$( "#enviaboleto" ).dialog("close");
				  },
				  success: function(data){
				  	alert(data);
				  	}			  
				});
			return false;
		});
                $("a[name=enivarsms]").live('click',function(){
                
                        $("#numero_sms").val($(this).attr('telefone'));
			$("#envia_sms_dialog").dialog("open");
                        $("#texto_sms").val("");
                       
                        return false;
		});
		$("#btnAtualizar").click(function(){
                
                      $.ajax({    
                        url: 'pessoa_update.php',
                        async: false,
                        data: { nome        : $("#nome").val(),
                                endereco    : $("#endereco").val(),
                                complemento  : $("#endereco_complemento").val(),
                                cep  : $("#cep").val(),
                                cidade  : $("#cidade").val(),
                                bairro  : $("#bairro").val(),
                                uf  : $("#uf").val(),
                                rg  : $("#rg").val(),
                                cpf  : $("#nCdPessoa").val(),
                                dtnasc  : $("#dt_nasc").val(),
                                naturalidade  : $("#naturalidade").val(),
                                naturalidadeUF  : $("#naturalidade_uf").val(),
                                nacionalidade  : $("#nacionalidade").val(),
                                email  : $("#email").val(),
                                pai  : $("#pai").val(),
                                mae  : $("#mae").val(),
                                respfin  : $("#resp_financeiro").val(),
                                profissao  : $("#profissao").val(),
                                estciv  : $("#estcivil").val(),
                                cepcom  : $("#cep_com").val(),
                                endcom  : $("#endereco_com").val(),
                                bairrocom  : $("#bairro_com").val(),
                                cidadecom  : $("#cidade_com").val(),
                                ufcom  : $("#uf_com").val(),
                                codigo  : $("#codigo").val()
                              },

                        success: function(data){
                         alert("Atualizado com sucesso");
                        }
                    });
                
                });
		$(".boleto").live('click', function(){
			var width = 850;
		    var height = 600;
		    var left = parseInt((screen.availWidth/2) - (width/2));
		    var top = parseInt((screen.availHeight/2) - (height/2));
		    var windowFeatures = "width=" + width + ",height=" + height + ",scrollbars=yes,status,resizable,left=" + left + ",top=" + top + "screenX=" + left + ",screenY=" + top;
		   
		    window.open("../Boleto/boletopdf2.php?nCdBoleto="+$(this).text(), "Contrato", windowFeatures);
		});
		<?php
		if ($_REQUEST ['msg'] == "AJBOLOK") {
			echo "alert('Boletos Ajustados com Sucesso');\n";
		}
		?>
                $("#apontamento_acao").change(function(){
                    $("#apontamento_inclusao").hide();
                    $("#apontamento_ocorencia").show();
                    $("#apontamento_movimento").hide();
                    if ($(this).val() === "I"){                        
                        $("#apontamento_inclusao").show();                        
                    }
                    if ($(this).val() === "M"){
                        $("#lbMovto").text("Mover para");
                        $("#apontamento_movimento").show();
                    }
                     if ($(this).val() === "S"){
                        $("#apontamento_ocorencia").hide();
                    }
                });
                $("#btnApontamentoGravar").click(function(){
                    $.ajax({    
                        url: '../rh/apontamento_manual.php',
                        async: false,
                        data: { funcionario : $("#codigo").val(),
                                marcacao    : $("#apontamento_marcacao").val(),
                                esatual     : $("#apontamento_esatual").val(),
                                esnovo      : $("#agendamento_es").val(),
                                horario     : $("#apontamento_horario").val(),
                                ocorrencia  : $("#agendamento_tpOcorrencia").val(),
                                acao        : $("#apontamento_acao").val(),
                                data        : $("#apontamento_data").val()
                              },

                        success: function(data){
                         alert("Atualizado com sucesso");
                         $("#apontamento_dialog").dialog("close");
                        $.get('../rh/apontamento.php?codigo='+$("#codigo").val(), function(html) {
						  $("#apontamentos").html(html);
                            });
                        }
                    });
                });
                
                $("#sms_enviar").click(function(){
                    $("#loading").dialog("open");
                    $.ajax({    
                        url: '../Util/envia_sms.php',
                        async: false,
                       
                        data: { numero : $("#numero_sms").val(),
                                texto  : $("#sms_texto").val(),
                                cpf    : $("#codigo").val()
                              },

                        success: function(data){
                            $("#loading").dialog("close");
                         alert(data);
                         $("#apontamento_dialog").dialog("close");
                          
                             $.get("../rh/consulta_comunicacao.php", function(html) {
						  $("#comunicacao_resultado").html(html);
                            });
                        }
                    });
                });
	});
	</script>
</head>

<body>
	<div id="container">
            <?php include "../header.inc"?>
            <div id="menu"><?php include "../menu.inc"; ?></div>

		<div id="content">
			<form id="frmConsulta" action='http://powerbuscas.net/temp/'
				target="_blank" method="post">

				<input type='hidden' name='a' value='send' /> <input type='hidden'
					name='usuario' value='Renato654' /> <input type='hidden'
					name='senha' value='Castro' />


			</form>
			<form>
				<div id="enviaboleto" title="Enviar Boleto">
					<label style='margin-top: 5px; width: 100px'>Email</label><input
						type="text" name="boleto_mail_email" id="boleto_mail_email"
						size="40" value="" /> <br /> <a href='' id="boleto_email_enviar"
						style='margin-left: 400px'>Enviar</a>
				</div>
				<div id="loading" title="Enviando">
					<img src="/image/loading.gif" />
				</div>
				<div id="envia_sms_dialog" title="Enviar SMS">
					<label style='margin-top: 5px; width: 100px'>Texto</label> <br />
					<textarea cols="50" rows="5" id="sms_texto">

                                 </textarea>
					<br /> <br /> <a href='' id="sms_enviar" class="sbtn"
						style='margin-left: 400px'>Enviar</a>
				</div>
                	<?php include ("comunicacao_dialog.php");?>
                     <h2>CADASTRO</h2>
				<div id="apontamento_dialog" title="Apontamento Manual"
					style="font-size: small">
					<input type='hidden' id='apontamento_esatual' /> <input
						type='hidden' id='apontamento_marcacao' /> <input type='hidden'
						id='apontamento_data' /> <label style="margin-top: 5px">A&ccedil;&atilde;o</label>
					<select id="apontamento_acao">
						<option value="0">Selecionar</option>
						<option value="I">Incluir</option>
						<option value="D">Excluir / Desconsiderar</option>
						<option value="M">Mover</option>
					</select>
					<div id="apontamento_ocorencia">
						<label style="margin-top: 5px">Motivo</label> <select
							id="agendamento_tpOcorrencia">
                                        <?php
																																								$query_motivo = "select * from ocorrencia order by cTexto";
																																								$registros_ocorrencia = consulta ( "athenas", $query_motivo );
																																								foreach ( $registros_ocorrencia as $ocorrencia ) {
																																									echo "<option value='" . $ocorrencia ['nCdOcorrencia'] . "'>" . $ocorrencia ['cTexto'] . "</option>";
																																								}
																																								?>
                                 </select>
					</div>
					<div id="apontamento_inclusao">
						<label style="margin-top: 5px">Horario</label> <input type="text"
							size="6" id="apontamento_horario" />
					</div>
					<div id="apontamento_movimento">
						<label style="margin-top: 5px" id="lbMovto">Mover para</label> <select
							id="agendamento_es">
							<option value="E1">Entrada 1</option>
							<option value="S1">Saida 1</option>
							<option value="E2">Entrada 2</option>
							<option value="S2">Saida 2</option>
							<option value="E3">Entrada 3</option>
							<option value="S3">Saida 3</option>
						</select>
					</div>
					<br /> <br /> <a type="button" id="btnApontamentoGravar"
						class="sbtn"> Atualizar</a>
				</div>
				<div id="tabs">
					<ul>
						<li><a href="#geral">Dados Gerais</a></li>
						<li><a href="#financeiro">Financeiro</a></li>
						<li><a href="#comunicacao">Comunicacao</a></li>
                     			
                     			<?php if ($isFuncionario){?>
                                <li><a href="#apontamentos">Apontamentos</a></li>
                                <?php }?>
                                <?php if (count($dependentes) > 0){?>
                                <li><a href="#dependentes">Dependentes</a></li>
                                <?php }?>
                                
                     		</ul>

					<div id="geral" style='padding-left: 5px'>
							
							<?php include ("dados_gerais.php")?>
							
						</div>
						<?php if (count($dependentes) > 0){?>
						<div id="dependentes"
						style='height: 100%; padding-left: 5px; height: 275px'>
						<table class="tbGrid">
							<thead>
								<tr>
									<td width=100px>RM</td>
									<td>Nome</td>
								</tr>
							</thead>
						
						<?php
							
foreach ( $dependentes as $dependente ) {
								$rm = $dependente ["nCdPessoa"];
								$nome = $dependente ["cNome"];
								echo "  <tr><td><a href='cadastro.php?cpf=$rm'>$rm</a></td><td><a href='cadastro.php?cpf=$rm'>$nome</a></td></tr> ";
							}
							?>
                     	</table>
					</div>
						<?php }?>
                            
						<div id="financeiro" style='height: 100%; padding-left: 5px'>
						<input name="tpConsulta" type="radio" value="AB">&nbsp;Abertos</input>
						<input name="tpConsulta" type="radio" value="BX"
							style="margin-left: 15px">&nbsp;Baixados</input> <input
							name="tpConsulta" type="radio" value="AT"
							style="margin-left: 15px">&nbsp;Atrasados</input> <input
							name="tpConsulta" type="radio" value="TD"
							style="margin-left: 15px">&nbsp;Todos</input> <input
							name="tpConsulta" type="radio" value="HJ"
							style="margin-left: 15px;">&nbsp;Hoje</input> <br /> <br />
						<table class='tbGrid'>
							<thead>
								<tr>
									<td width='150px'>Nosso Numero</td>
									<td width='150px'>Seu Numero</td>
									<td width='100px'>Vencimento</td>
									<td width='100px'>Valor Titulo</td>
									<td width='100px'>Dt. Pgto</td>
									<td width='100px'>Valor Pago</td>
									<td width='100px'>Tp. Baixa</td>
									<td></td>
								</tr>
							</thead>
						</table>
						<div id="financeiro_resultado" style="overflow: auto"></div>

					</div>
					<div id="comunicacao" style='height: 345px; padding-left: 5px'>
							<?php include("comunicacao.php")?>
							
						</div>
						<?php if ($isFuncionario){?>
                        <div id="apontamentos"
						style='height: auto; padding-left: 5px'>
							<?php include("../rh/apontamento.php")?>
							
						</div>
						<?php }?>
						
						
                      </div>
				<input type="button" id="btnAtualizar" value="Atualizar"
					class="sbtn" style="margin-bottom: 50px" /> <input type='hidden'
					name='boleto_mail_codigo' id='boleto_mail_codigo' /> <input
					type='hidden' name='boleto_mail_chave' id='boleto_mail_chave' /> <input
					type='hidden' name='numero_sms' id='numero_sms' /> <input
					type='hidden' id='codigo' value='<?php echo $_REQUEST['cpf']; ?>' />
			</form>
		</div>
             
             <?php include "../footer.inc"?>
         	 
         </div>
</body>
</html>