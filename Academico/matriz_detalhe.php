<?php
include ("../verifica_logado.php");
ini_set ( "display_errors", 0 );
require ("../config.php");
include_once "../bd.php";
include_once "../Util/gravar_comunicacao.php";
session_start ();
$codigo = $_REQUEST ['codigo'];

$query = "SELECT * from matriz where nCdMatriz = $codigo";

$registros = consulta ( "athenas", $query );
$registro = $registros [0];

$_SESSION ['cpf'] = $codigo;
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
<script src="/js/jquery_masc.js" type="text/javascript"></script>

<script>
  	$(function() {
  		$( "#tabs" ).tabs();
  		$("#disciplina_dialog").dialog({modal: true, autoOpen: false,width: 500, heigth: 800} );
		$("#disciplina_add, a[name=btnEditar]").live('click',function(){                                       
                    var _codigo = $(this).attr("codigo");
                    $("#disciplina_cod").val(_codigo);                        
                    if (_codigo !== ""){
                        var _linha = $(this).parent().parent();
                        var _input = _linha.find('input[name=action]');
                        $("#disciplina_disciplina").val(_input.attr("disciplina"));
                        $("#disciplina_divisao").val(_input.attr("modulo"));
                        $("#disciplina_chtp").val(_input.attr("chtp"));
                        $("#disciplina_che").val(_input.attr("che"));
                    }else{
                        $("#disciplina_disciplina").val(0);
                        $("#disciplina_divisao").val(0);
                        $("#disciplina_chtp").val("");
                        $("#disciplina_che").val("");
                    }
                    
                    $("#disciplina_dialog").dialog("open");
                    return false;
		});
		$("#disciplina_gravar").click(function(){
                    var _codigo = $("#disciplina_cod").val();
                    var _disciplina_txt = $("#disciplina_disciplina  option:selected").text();
                    var _disciplina_cod = $("#disciplina_disciplina").val();
                    var _modulo = $("#disciplina_divisao").val();
                    var _modulo_txt = $("#disciplina_divisao option:selected").text();
                    var _chtp = $("#disciplina_chtp").val();
                    var _che = $("#disciplina_che").val();

                    if ( _codigo === ""){
                        _codigo = ($("#tbComponentes tr").length + 1) * - 1;
                        $("#tbComponentes").last().append("<tr><td><a href='' name='btnEditar' codigo='"+_codigo+"' ><img src='/image/icon_edit.png' /></a></td>"+
                            "<td><a href='' name='btnExcluir'  codigo='"+_codigo+"'><img src='/image/icon_delete.png'/></a></td>"+
                              "<td valing='top'>"+_disciplina_txt+"</td>"+
                              "<td valing='top'>"+_modulo_txt+"</td>"+
                              "<td valing='top'>"+_chtp+"</td>"+
                              "<td valing='top'>"+_che+"</td>"+
                            "<td><input type='hidden' name='action' codigo='"+_codigo+"' value='A' disciplina='"+_disciplina_cod+"' chtp='"+_chtp+"' che='"+_che+"' modulo='"+_modulo+"' ></td>");
                    }else{
                         var _row = $("input[name=action][codigo="+_codigo+"]").parent().parent();
                                             
                         _row.find('td').eq(2).text(_disciplina_txt);
                         _row.find('td').eq(3).text(_modulo_txt);
                         _row.find('td').eq(4).text(_chtp);
                         _row.find('td').eq(5).text(_che);
                         
                         $("input[name=action][codigo="+_codigo+"]").attr("value","A");
                         $("input[name=action][codigo="+_codigo+"]").attr("disciplina",_disciplina_cod);
                         $("input[name=action][codigo="+_codigo+"]").attr("chtp",_chtp);
                         $("input[name=action][codigo="+_codigo+"]").attr("che",_che);
                         $("input[name=action][codigo="+_codigo+"]").attr("modulo",_modulo);
                    }
			
                        $("#disciplina_dialog").dialog("close");
			return false;
			
		});
		 $("a[name=btnExcluir]").live('click',function(){
                        var _row = $(this).parent().parent();
                        var _input = $(_row).find("input");
                        var _codigo = $(this).attr("codigo");                        
		    	$("<div title='Aviso'></div>").appendTo('body')
				.html("<center><span style='font-size:small'>Deseja Remover Componente Curricular?</span></center>")
				.dialog({ modal: true
						, title: 'Aviso'
						, zIndex: 10000
						, autoOpen: true
						, width: 'auto'
						, resizable: false
						, buttons: { Sim: function () {
                                                                _row.hide();
                                                                _input.val("E");
                                                                $(this).dialog("close");
		                           		  }
		                           , Nao: function () {
		                               	 	$(this).dialog("close");
		                            	  }
	                    },
	                    close: function (event, ui) {
	                        $(this).remove();
	                    }
						}); 
				return false;
		 });
		 $("#validade").mask('99/99/9999');
         $("#btnGravar").click(function(){
			$.ajax({
				url	  : 'matriz_update.php',
                async : false,
                data  : { codigo: $("#matriz_codigo").val()
                	    , nome: $("#nome").val()
                        , curso: $("#curso").val()
                        , validade: $("#validade").val()
                        },
			   success: function(data){
							$("#matriz_codigo").val(data);
						}
					});
			$("input[name=action]").each(function(){
				if($(this).val() === "A"){                           
                	$.ajax({
                    	url		: 'matriz_componentes_update.php',
                        async	: false,
				  		data	: { codigo : $(this).attr("codigo")
                                  , matriz: $("#matriz_codigo").val()
								  , disciplina: $(this).attr("disciplina")
                                  , chtp: $(this).attr("chtp")
                                  , che: $(this).attr("che")
                                  , modulo: $(this).attr("modulo")
                                  },
                        beforeSend:function(){
                           		$("#div_loading").show();
                          	},
                        complete: function(data){
                           		$("#div_loading").hide();
                           	} 				  
					});
				 }
                 if($(this).val() === "E"){
                     $.ajax({
                         url: 'matriz_componentes_remover.php',
                         async: false,
				  		 data: { codigo: $(this).attr("codigo")
					 	 	   },				  
					});
                  }
             });
         alert('Registro atualizado com Sucesso');
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
			<form id="frm1" action='incluir_acordo.php' target="_blank"
				method="post">
				<div id="tabs">
					<ul>
						<li><a href="#cadastro">Matriz Curricular</a></li>
					</ul>

					<div id="cadastro"
						style='height: 390px; padding-left: 5px; overflow: auto'>
						<input id='matriz_codigo' type='hidden'
							value='<?php echo $_REQUEST['codigo'];?>' /> <label>Nome</label>
						<input id='nome' type='text' size='40'
							value='<?php echo $registro['cNmMatriz'];?>' /> <br /> <label
							style='margin-top: 5px;'>Curso</label> <select id="curso">
	                	 	 	<?php
																						$query_cursos = "Select * from cursos order by cNmCurso";
																						$cursos = consulta ( "athenas", $query_cursos );
																						foreach ( $cursos as $curso ) {
																							echo "<option value='" . $curso ['nCdCurso'] . "'";
																							if ($registro ['nCdCurso'] == $curso ['nCdCurso']) {
																								echo " selected=\"selected\" ";
																							}
																							echo "'>" . $curso ['cNmCurso'] . "</option>";
																						}
																						?>
	                	 	 </select> <br /> <label style='margin-top: 5px;'>Validade</label>
						<input id='validade' type='text' size='10'
							value='<?php echo date("d/m/Y",strtotime($registro['dValidade']));?>' />
						<br />
						<div id="disciplina_dialog">
							<input id='disciplina_cod' type='hidden' /> <label
								style='margin-top: 5px; width: 100px'>Disciplina</label> <select
								id="disciplina_disciplina">
		                	 	 	<?php
																							$query_disciplinas = "Select * from disciplina order by cNmDisciplina";
																							$disciplinas = consulta ( "athenas", $query_disciplinas );
																							foreach ( $disciplinas as $disciplina ) {
																								echo "<option value='" . $disciplina ['nCdDisciplina'] . "'>" . $disciplina ['cNmDisciplina'] . " (" . $disciplina ['cSigla'] . ")</option>";
																							}
																							?>
		                	 	 </select> <label
								style='width: 200px; margin-top: 5px'>Divis&atilde;o</label> <select
								id='disciplina_divisao'>
								<option value='0'>Todas</option>
								<option value='1'>1º Divisão</option>
								<option value='2'>2º Divisão</option>
								<option value='3'>3º Divisão</option>
								<option value='4'>4º Divisão</option>
							</select> <br /> <label style='width: 200px; margin-top: 5px'>CH.
								Teorico Pratico</label> <input id='disciplina_chtp' type='text'
								size='3'></input> <br /> <label
								style='width: 200px; margin-top: 5px'>CH. Estagio</label> <input
								id='disciplina_che' type='text' size='3'></input> <a href=''
								id="disciplina_gravar" style='margin-left: 400px'>Gravar</a>
						</div>
						<br /> <br />
						<div class="divisao">Componentes Curriculares</div>
						<a href="#" id="disciplina_add">[ Adicionar ]</a> <br /> <br />

						<div id="disciplina_resultado"
							style="height: 200px; overflow: auto">
								<?php include "matriz_componentes.php"?>
							</div>



					</div>
				</div>
				<br /> <a href="#" id="btnGravar" class="sbtn"
					style="padding-bottom: 40px">Atualizar</a>
			</form>
		</div>
            <?php include "../footer.inc" ?>	
     </div>
</body>
</html>
