<?php
include ("../verifica_logado.php");
ini_set ( "display_errors", 0 );
require ("../config.php");
include_once "../bd.php";
$codigo = $_REQUEST ['codigo'];

$query = "Select * from centro_custo where nCdCCusto = $codigo";
$ccustos = consulta ( "athenas", $query );
$ccusto = $ccustos [0];
$nCdCCusto = $ccusto ["nCdCCusto"];
/*
 * $query_curso = "SELECT * FROM cursos"; $cursos = consulta("athenas",$query_curso); $query_matriz = "SELECT * FROM matriz where nCdCurso = $nCdCurso and dValidade > CURDATE()"; $matrizes = consulta("athenas",$query_matriz); $html_curso = "<option value='0'>Selecionar</option>"; foreach($cursos as $curso){ $curso_codigo = $curso["nCdCurso"]; $curso_nome = $curso["cNmCurso"]; $selecionado = ""; if ($curso_codigo == $turma["nCdCurso"]){ $selecionado = "selected='selected'"; } $html_curso .= "<option value='$curso_codigo' $selecionado >$curso_nome</option>"; } $html_matriz = "<option value='0'>Selecionar</option>"; foreach($matrizes as $matriz){ $matriz_codigo = $matriz["nCdMatriz"]; $matriz_nome = $matriz["cNmMatriz"]; $selecionado = ""; if ($matriz_codigo == $turma["nCdMatriz"]){ $selecionado = "selected='selected'"; } $html_matriz .= "<option value='$matriz_codigo' $selecionado >$matriz_nome</option>"; }
 */

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SGE - Sistema de Gestão Escolar [Turma]</title>
<link href="/css/estilo.css" rel="stylesheet" type="text/css" />
<link href="/css/jquery-ui.css" rel="stylesheet" type="text/css" />
<link href="/css/jquery-ui.css" rel="stylesheet" type="text/css" />
<script src="/js/jquery.js" type="text/javascript"></script>
<script src="/js/jquery-ui.js" type="text/javascript"></script>
<script src="/js/jquery_masc.js" type="text/javascript"></script>




<script>
             function carrega_turmas(){
        	$.ajax({
			  url: 'centrocusto_lista_turma.php',
			
			  data: { codigo: $("#codigo").val() 
                                , inicio: $("#inicio").val()
                                , fim: $("#fim").val()
                          },
			  
			  success: function(data){
			  	$("#turmas").html(data);
			 
			  }
			  
			});
                
            }
	$(document).ready(function(){
            carrega_turmas();                
            $( "#tabs" ).tabs();
            $("input[type=checkbox]").live("click",function(){
                  if ($(this).is(":checked")){
                      $(this).attr("estado","I");    
                  }else{
                      $(this).attr("estado","E");                         
                  }                         
              });
             $("#inicio").change(function(){
                 carrega_turmas();  
                 
             });
             $("#fim").change(function(){
                 carrega_turmas(); 
             });
             $("#btnAtualizar").click(function(){
                  $.ajax({
                            url: 'centro_custo_update.php',
                            async: false,
                            data: { codigo: $("#codigo").val()
                                  , nome: $("#nome").val()
                                  , inicio: $("#inicio").val()
                                  , fim: $("#fim").val()
                                  , acao: "centro_custo"
                              },
                            success: function(data){
                                $("#codigo").val(data);
                                $("input[type=checkbox]").each(function(){
                                    if ($(this).attr("estado") !== "O" ){                            

                                        $.ajax({
                                                  url: 'centro_custo_update.php',
                                                  async: false,
                                                  data: { ccusto: data
                                                        , turma: $(this).attr("codigo")
                                                        , valor: $(this).attr("valor")
                                                        , estado: $(this).attr("estado")
                                                        , acao: "centro_custo_turma"
                                                    },
                                                  success: function(data){
                                                      

                                                  }

                                          });                                         


                                    }
                                 });  

                            }

                    });
                            
                    
                    alert("Centro de Custo Atualizado com Sucesso!");
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
						<li><a href="#geral">Cadastro da Centro de Custo</a></li>
					</ul>

					<div id="geral" style='height: 345px; padding-left: 5px'>
						<label style="margin-top: 5px">Codigo</label> <input id="codigo"
							type="text" size='4' value='<?php echo $ccusto['nCdCCusto']; ?>' />
						<br /> <label style="margin-top: 5px">Nome</label> <input
							id="nome" size='50' type="text"
							value='<?php echo $ccusto['cNmCCusto']; ?>' /> <br /> <label
							style="margin-top: 5px">Inicio</label> <input id="inicio"
							size='10' type="text"
							value='<?php echo $ccusto['dInicio'] == "" ? "" : date("d/m/Y", strtotime($ccusto['dInicio'])); ?>' />
						<br /> <label style="margin-top: 5px">Fim</label> <input id="fim"
							size='10' type="text"
							value='<?php echo $ccusto['dFim'] == "" ? "" : date("d/m/Y", strtotime($ccusto['dFim'])); ?>' />
						<br />
						<div class="divisao">Turmas</div>
						<div id="turmas" style="height: 200px; overflow: auto"></div>

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

