$("#btnAprovar").click(function(){
	    	 var acordo = <?php echo $_REQUEST['acordo']; ?>;
	    	$("
<div title='Aviso'></div>
").appendTo('body') .html("
<center>
	<span style='font-size: small'>Deseja Aprovar Acordo?</span>
</center>
")
			.dialog({ modal: true
					, title: 'Aviso'
					, zIndex: 10000
					, autoOpen: true
					, width: 'auto'
					, resizable: false
					, buttons: { Sim: function () {
										$.get('acordo_aprovar.php?acordo='+acordo, function(data) {
										});
										$("#lblStatus").html('Aprovado');
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
	    $("#btnReprovar").click(function(){
	    	 var acordo = <?php echo $_REQUEST['acordo']; ?>;
	    	$("
<div title='Aviso'></div>
").appendTo('body') .html("
<center>
	<span style='font-size: small'>Deseja Reprovar Acordo?</span>
</center>
<br />
<span style='font-size: small'>Motivo</span>
<br />
<textarea style='width: 390px; height: 180px;' id='motivo'></textarea>
") .dialog({ modal: true , title: 'Aviso' , zIndex: 10000 , autoOpen:
true , width: 'auto' , resizable: false , buttons: { Sim: function () {
$.get("acordo_reprovar.php?acordo="+acordo+"&motivo="+$("#motivo").val(),
function(data) { }); $("#lblStatus").html('Reprovado');
$(this).dialog("close"); } , Nao: function () { $(this).dialog("close");
} }, close: function (event, ui) { $(this).remove(); } }); return false;

});
