<?php
include ("../verifica_logado.php");
ini_set ( "display_errors", 0 );
require ("../config.php");
include_once "../bd.php";

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset='utf-8'>
	<title>SGE - Sistema de Gestão Escolar [ReMatricula]</title>
	<link href="/css/estilo.css" rel="stylesheet" type="text/css" />
	<link href="/css/jquery-ui.css" rel="stylesheet" type="text/css" />
	<script src="/js/jquery.js" type="text/javascript"></script>
	<script src="/js/jquery-ui.js" type="text/javascript"></script>
	<script src="/js/jquery_masc.js" type="text/javascript"></script>
	<script src="/js/jvalidacpf.js" type="text/javascript"></script>


	<script>
	

	$(document).ready(function() {
		$("#cpfresp").mask("999.999.999-99");
		$("#serie").change(function(){
			$("#turma").load('carrega_turno.php?curso='+$(this).val());
		});
		
		$("#btnValidar").click(function(){
			$.ajax({
			  url: '../Util/consulta_receita.php',
			  dataType: 'json',
			  data: { fase: '2', captcha: $("#captcha").val(), viewstate: $("#viewstate").val()  },
			  
			  success: function(json){
			  	$("#imgcaptcha").attr("src",json.img_src);
			 
			  },
			  beforeSend:function(){
				$("#div_loading").show();
			  },
			  complete: function(data){
				$("#div_loading").hide();
			  }
			  
			});
			
		});
        $( "#nome" ).autocomplete({
            source: "search.php?consulta=lista",
            minLength: 2,
            select: function( event, ui ) {
            	$("#serie").val(ui.item.id);
            	$("#mat").val(ui.item.info);
            	$("#cpfresp").val(ui.item.cpfresp);
            	$("#turma").load('carrega_turno.php?curso='+$("#serie").val());
            }
        });
        $("#tabs").tabs();
        
        
        $("#send").click(function(){ 
        	
        	if ( TestaCPF($("#cpfresp").val()) == false ){
        		alert("CPF do Responsavel Invalido");
        		$("#cpfresp").focus();
        		    	return false;	
        	}
    
        	
        	
			$.get( "verifica_irmao.php"
       		 	  , { serie: $("#serie").val()
       		 	  	, cpfresp: $("#cpfresp").val() 
       		 	  	}
       		 	  , function(data) {
       		 	  		$("#irmao_mat").val(data);
       		 	  		if ( $("#irmao_mat").val() == ""){
          					$("<div title='Aviso'></div>").appendTo('body')
                    						.html("<center><span style='font-size:small'>N&atilde;o foi encontrado nenhum irm&atilde; em serie igual ou superior <br/> Se existir favor fazer a matricula deste primeiro para n&atilde;o perder o desconto!</span></center>")
                    						.dialog({ modal: true
                    								, title: 'Aviso'
                    								, zIndex: 10000
                    								, autoOpen: true
                    								, width: 'auto'
                    								, resizable: false
                    								, buttons: { Sim: function () {
									                                	$("#frm1").submit();
									                           		  }
									                           , Nao: function () {
									                               	 	$(this).dialog("close");
									                            	  }
							                        },
							                        close: function (event, ui) {
							                            $(this).remove();
							                        }
                    								});
               			}else{
               				
               				
               				$("#frm1").submit();}
	                
	                
	             		}
          			);
		
						
          	
            return false;
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

			<form name="frm1" id="frm1" method="post" action="verificafin.php">

				<div id="tabs">
					<ul>
						<li><a href="#geral"><img src="../image/matricula.png"
								width="30px" />&nbsp;<?php echo ucwords($_REQUEST['tipo']); ?> Matricula</a></li>

					</ul>


					<div id="geral"
						style='height: 400px; padding-left: 5px; overflow: auto'>
						<div style="height: 390px">
							<label style='margin-top: 5px'>Serie:</label> <select id="serie"
								name="serie">
								<option value='99'>SELECIONE...</option>
							<?php
							$query = 'call lista_cursos_matricula();';
							
							$cursos = consulta ( 'athenas', $query );
							
							foreach ( $cursos as $curso ) {
								$nCdCurso = $curso ['nCdCurso'];
								$cNmCurso = $curso ['cNmCurso'];
								echo "<option value='$nCdCurso'>$cNmCurso</option>";
							}
							?>
   					 	</select> <br /> <label style='margin-top: 5px'>Turno:</label>
							<select id='turma' name='turma'>
							</select> <br /> <label for="cpfresp" style='margin-top: 5px'>CPF
								Resp.: </label> <input id="cpfresp" name="cpfresp" size="15" />


							<input type='hidden' name='viewstate' id='viewstate' /> <input
								type='hidden' name='mat' id='mat' /> <input type='hidden'
								name='irmao_mat' id='irmao_mat' /> <input type='hidden'
								name='tipo' id='tipo' value='<?php echo $_REQUEST['tipo']; ?>' />
							<br />
							<button id='send' style='margin-left: 360px'>Proximo</button>
						</div>
					</div>
				</div>
			</form>
		</div>
             
             <?php include "../footer.inc"?>
         	 
         </div>
</body>
</html>