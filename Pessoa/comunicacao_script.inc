$("#comunicacao_dialog").dialog({modal: true, autoOpen: false,width:
500, heigth: 800} ); $("#comunicacao_add").click(function(){
$("#comunicacao_dialog").dialog("open"); });
$("#comunicacao_gravar").click(function(){ $.ajax({ url:
'../Util/gravar_comunicacao.php', data: { tipo:
$("#comunicacao_tipo").val() , mensagem:
$("#comunicacao_mensagem").val() }, complete: function(){ $(
"#comunicacao_dialog" ).dialog("close"); }, success: function(data){
alert(data); $.get('../Util/consulta_comunicacao.php', function(html) {
$("#comunicacao_resultado").html(html); }); } }); return false; });
