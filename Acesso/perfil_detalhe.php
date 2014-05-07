<?php
include ("../verifica_logado.php");
ini_set ( "display_errors", 1 );
setlocale ( LC_ALL, NULL );
setlocale ( LC_ALL, 'pt_BR' );

require ("../config.php");
include_once "../bd.php";

$nCdPerfil = $_REQUEST ['codigo'];

$query = "SELECT * FROM perfil where nCdPerfil = $nCdPerfil;";

$registros = consulta ( 'athenas', $query );

$registro = $registros [0];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SGE - Sistema de Gestão Escolar [Perfil]</title>
<link href="/css/estilo.css" rel="stylesheet" type="text/css" />
<link href="/css/jquery-ui.css" rel="stylesheet" type="text/css" />
<script src="/js/jquery.js" type="text/javascript"></script>
<script src="/js/jquery-ui.js" type="text/javascript"></script>
<script src="/js/jquery_masc.js" type="text/javascript"></script>



<script>
	$(document).ready(function(){
		$( "#tabs" ).tabs();
		$( "#btnConsultar" ).click(function(){
        	_valor = $("#consulta_valor").val()
        	$.ajax({
			  url: 'perfil_consultar.php',
			
			  data: { valor: _valor },
			  
			  success: function(data){
			  	$("#resultado").html(data);
			 
			  },
			  beforeSend:function(){
				$("#div_loading").show();
				},
			  complete: function(data){
				$("#div_loading").hide();
				} 
			  
			});
			return false;
        	
                 });
                 $("#btnAtualizar").click(function(){
                    $("input[type=checkbox]").each(function(){
                        if ($(this).attr("estado") !== "O" ){                            
                             
                             _acao = $("input[type=checkbox][codigo="+$(this).attr("codigo")+"][acao='visualizar']").attr("valor")
                                     + $("input[type=checkbox][codigo="+$(this).attr("codigo")+"][acao='editar']").attr("valor")
                                     + $("input[type=checkbox][codigo="+$(this).attr("codigo")+"][acao='incluir']").attr("valor")
                                     + $("input[type=checkbox][codigo="+$(this).attr("codigo")+"][acao='excluir']").attr("valor")
                                     + $("input[type=checkbox][codigo="+$(this).attr("codigo")+"][acao='acessar']").attr("valor");
                             
                           
                            _acesso = $(this).attr("codigo");
                            _perfil = $("#codigo").val();
                            $.ajax({
                                    url: 'perfil_update.php',

                                    data: { perfil: _perfil
                                          , acesso: _acesso
                                          , acao: _acao
                                      },

                                    success: function(data){
                                          

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
                    alert("Perfil Atualizado com Sucesso!");
                    return false;
                 });
                 $("input[type=checkbox]").click(function(){
                     if ($(this).is(":checked")){
                         $(this).attr("estado","I");    
                         $(this).attr("valor","1");    
                     }else{
                         $(this).attr("estado","E");                         
                         $(this).attr("valor","0");    
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

			<form method="post" id="frmPrincipal">
				<input type="hidden" id="codigo"
					value="<?php echo $_REQUEST['codigo']; ?>" />

				<div id="tabs">
					<ul>
						<li><a href="#geral">Consultar Perfil</a></li>

					</ul>

					<div id="consulta"
						style='height: 385px; padding-left: 5px; overflow: auto'>
						<label style="margin-top: 15px">Nome</label> <input id="nome"
							name="nome" type="text" size="50"
							value='<?php  echo $registro['cNmPerfil']; ?>' />
						<table class="tbGrid">
							<thead>
								<tr>
									<td width='200px'>Acesso</td>
									<td width='100px'>Tipo de Acesso</td>
									<td width='100px'>Visualizar</td>
									<td width='100px'>Editar</td>
									<td width='100px'>Incluir</td>
									<td width='100px'>Excluir</td>
									<td width='100px'>Acessar</td>
									<td></td>
								</tr>
							</thead>
						</table>
						<div id="lista_acesso"></div>
                                                    <?php include("perfil_lista_acesso.php"); ?>
						</div>


				</div>
				<input type="button" id="btnAtualizar" value="Atualizar"
					class="sbtn" style="margin-bottom: 50px" />
			</form>
		</div>
             
             <?php include "../footer.inc"?>
         	 
         </div>
</body>
</html>