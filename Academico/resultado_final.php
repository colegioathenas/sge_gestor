<?php
// include("../verifica_logado.php");
ini_set ( "display_errors", 0 );
require ("../config.php");
include_once "../bd.php";
include_once "../Util/gravar_comunicacao.php";

$cpf = $_REQUEST ['cpf'];
$cpf = preg_replace ( '#[^0-9]#', '', $cpf );
$_SESSION ['cpf'] = $cpf;
$query = "Select p.*,rf.cNome as cNmRespFin from pessoa p left join pessoa rf on rf.nCPF = p.nCdRespFin  where p.nCdPessoa = $cpf";
$registro = consulta ( "athenas", $query );
$registro = $registro [0];

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SGE - Sistema de Gestão Escolar [Resultado Final]</title>
<link href="/css/estilo.css" rel="stylesheet" type="text/css" />
<link href="/css/jquery-ui.css" rel="stylesheet" type="text/css" />
<script src="/js/jquery.js" type="text/javascript"></script>
<script src="/js/jquery-ui.js" type="text/javascript"></script>
<script src="/js/jquery_masc.js" type="text/javascript"></script>


<script>
            function carrega_lista(){
            $.ajax({
                        url: 'boletim_lista.php',
                        data: { turma: $("#nCdTurma").val()                                          
                              },
                        success: function(html){
                            $("#lista_alunos").html(html);
                        },
                        beforeSend:function(){
                        	$("#div_loading").show();
                        },
                        complete: function(data){
                        	$("#div_loading").hide();
                        }
                      });
            }
        function carrega_turma(){
            if ($("#nCdCurso").val() !== 0){
                $("#nCdTurma").load('selecao_carrega_combos.php?consulta=turmas&param1='+$("#nCdCurso").val(),function(){  
                    carrega_lista();
                });
            }
        }	
	$(document).ready(function(){
		
		$( "#tabs" ).tabs();
                
                  $("#nCdCurso").load('selecao_carrega_combos.php?consulta=cursos',function(){ carrega_turma();});
                  $("#nCdCurso").change(function(){
                      carrega_turma();
                  });
                  $("#nCdTurma").change(function(){
                      
                  });                  
                
		$("#btnImprimir").live('click', function(){
                    
                    var _turma = $("#nCdTurma").val();			
                    
		    var width = 850;
		    var height = 600;
		    var left = parseInt((screen.availWidth/2) - (width/2));
		    var top = parseInt((screen.availHeight/2) - (height/2));
		    var windowFeatures = "width=" + width + ",height=" + height + ",scrollbars=yes,status,resizable,left=" + left + ",top=" + top + "screenX=" + left + ",screenY=" + top;
		   
		    window.open("resultado_final_imprimir.php?turma="+_turma, "Lista de Recuperacao", windowFeatures);
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
			<form>

				<div id="tabs">
					<ul>
						<li><a href="#geral">Resultado Final</a></li>
					</ul>

					<div id="geral" style='padding-left: 5px'>
						<label>Curso</label> <select id='nCdCurso'></select> <label>Turma</label>
						<select id='nCdTurma'></select>
						<div id="lista"></div>
					</div>
					<br />

				</div>
				<input type="button" id="btnImprimir" value="Imprimir" class="sbtn"
					style="margin-bottom: 50px" /> <input type='hidden'
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