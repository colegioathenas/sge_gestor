<?php
ini_set ( "display_errors", 0 );
setlocale ( LC_ALL, NULL );
setlocale ( LC_ALL, 'pt_BR' );
include ("../verifica_logado.php");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Dados Cadastrais</title>
<link href="/css/estilo.css" rel="stylesheet" type="text/css">
	</script>
	<link href="/css/jquery-ui.css" rel="stylesheet" type="text/css">
		</script>
		<script src="/js/jquery.js" type="text/javascript"></script>
		<script src="/js/jquery-ui.js" type="text/javascript"></script>
		<script src="/js/jquery_masc.js" type="text/javascript"></script>

		<script>
	function consultar_titulo(){
		_nossonumero = $("#nossonumero").val();
        	_dt_movimento = $("#dt_movimento").val();
        	
        	$.ajax({
			  url: 'consulta_titulo2.php',
			  dataType: 'json',
			  data: { nossonumero: _nossonumero
			  		, dt_movimento: _dt_movimento },
			  
			  success: function(json){
			  	$("#pessoa_nome").val(json.nome);
			  	$("#seunumero").val(json.seu_num);
			  	$("#vencimento").val(json.vcto);
			  	$("#valor_titulo").val(json.valor);
			  	$("#valor_desconto").val(json.desconto);
			  	$("#valor_multa").val(json.multa);
			  	$("#valor_juros").val(json.juros);
			  	$("#valor_total").val(json.total);
			  	
			 
			  
			  },
			  beforeSend:function(){
				$("#div_loading").show();
		 	  },
			  complete: function(data){
				$("#div_loading").hide();
			  }
			  
			});
	}
	function atualiza_total(){
			_valor_desconto = $("#valor_desconto").val();
		  	_valor_multa = $("#valor_multa").val();
		  	_valor_juros = $("#valor_juros").val();
		  	_valor_titulo = $("#valor_titulo").val();
		  	
		  	_valor_desconto = parseFloat(_valor_desconto.replace(".","").replace(",","."));
		  	_valor_multa	 = parseFloat(_valor_multa.replace(".","").replace(",","."));
		  	_valor_juros = parseFloat(_valor_juros.replace(".","").replace(",","."));
		  	_valor_titulo = parseFloat(_valor_titulo.replace(".","").replace(",","."));
		  	
		  	_total = _valor_titulo + _valor_juros + _valor_multa - _valor_desconto;
		  	
		  	_total = _total.toString().replace(".",",");
		  	
		  	 $("#valor_total").val(_total);
		  	
	}
	$(function() {
		$( "#tabs" ).tabs();
		//$("#nossonumero").mask("999999999999999-9")
        $( "#btnpesq" ).click(function(){
        	
        	consultar_titulo();
        	
        });
        $("#dt_movimento").change(function(){
        	consultar_titulo();
        });
        
        $("#valor_desconto").change(function(){
        	atualiza_total();
        });
        $("#valor_juros").change(function(){
        	atualiza_total();
        });
        $("#valor_multa").change(function(){
        	atualiza_total();
        });
        
        
        $("#btnBaixar").click(function(){
        	_nossonumero  =$("#nossonumero").val()
		  	_valor_titulo = $("#valor_titulo").val();
		  	_valor_desconto = $("#valor_desconto").val();
		  	_valor_multa = $("#valor_multa").val();
		  	_valor_juros = $("#valor_juros").val();
		  	_valor_total = $("#valor_total").val();
		  	_tpMovimento = $("#tpMovimento").val();
		  	_dt_movimento = $("#dt_movimento").val();
		  	
        	$.ajax({
			  url: 'executar_baixa.php',
			  data: { nossonumero:		_nossonumero
			  		, valor_titulo:		_valor_titulo
			  		, valor_desconto:	_valor_desconto
			  		, valor_multa:		_valor_multa
			  		, valor_juros:		_valor_juros
			  		, valor_total:		_valor_total
			  		, tpMovimento:		_tpMovimento
			  		, dt_movimento:		_dt_movimento
			  		},
			  
			  success: function(data){
			  alert(data);
			  	$("#nossonumero").val("");
			  	$("#pessoa_nome").val("");
			  	$("#seunumero").val("");
			  	$("#vencimento").val("");
			  	$("#valor_titulo").val("");
			  	$("#valor_desconto").val("");
			  	$("#valor_multa").val("");
			  	$("#valor_juros").val("");
			  	$("#valor_total").val("");
			  
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
    });
	
    </script>
		</script>

</head>

<body>
	<div id="container">
			<?php include "../loading.inc"?>
            <?php include "../header.inc"?>
            <div id="menu"><?php include "../menu.inc"; ?></div>

		<div id="content">

			<form name="frm1" id="frm1">

				<div id="tabs">
					<ul>
						<li><a href="#geral">Baixar Titulos</a></li>

					</ul>


					<div id="geral"
						style='height: 415px; padding-left: 5px; overflow: auto'>

						<label style="width: 150px">Nosso Numero</label> <input
							type="text" size="19" name="nossonumero" id="nossonumero" /> <img
							src="../image/search-icon.png" name="btnpesq" id="btnpesq"
							height="15px"> <br /> <label
							style="margin-top: 5px; width: 100; width: 150px">Data do
								Movimento</label> <input type="text" size="19"
							name="dt_movimento" id="dt_movimento"
							value="<?php echo date("d/m/Y") ?>" /> <br /> <label
							style="margin-top: 5px; width: 100; width: 150px">Nome do Sacado</label>
							<input type="text" size="40" name="pessoa_nome" id="pessoa_nome"
							readonly="readonly" /> <br /> <label
							style="margin-top: 5px; width: 100; width: 150px">Seu Numero</label>
							<input type="text" size="19" name="seunumero" id="seunumero"
							style="text-align: right" readonly="readonly" /> <br /> <label
							style="margin-top: 5px; width: 100; width: 150px">Data de
								Vencimento</label> <input type="text" size="19"
							name="vencimento" id="vencimento" value="" readonly="readonly" />
							<br /> <label style="margin-top: 5px; width: 100; width: 150px">Valor
								do Titulo</label> <input type="text" size="19"
							name="valor_titulo" id="valor_titulo" value="0,00"
							style="text-align: right" readonly="readonly" /> <br /> <label
							style="margin-top: 5px; width: 100; width: 150px">Valor do
								Desconto</label> <input type="text" size="19"
							name="valor_desconto" id="valor_desconto" value="0,00"
							style="text-align: right" /> <br /> <label
							style="margin-top: 5px; width: 100; width: 150px">Valor da Multa</label>
							<input type="text" size="19" name="valor_multa" id="valor_multa"
							value="0,00" style="text-align: right" /> <br /> <label
							style="margin-top: 5px; width: 100; width: 150px">Valor do Juros</label>
							<input type="text" size="19" name="valor_juros" id="valor_juros"
							value="0,00" style="text-align: right" /> <br /> <label
							style="margin-top: 5px; width: 100; width: 150px">Valor Total</label>
							<input type="text" size="19" name="valor_total" id="valor_total"
							value="0,00" style="text-align: right" readonly="readonly" /> <br />

							<label style="margin-top: 5px; width: 100; width: 150px">Tipo de
								Movimentacao</label> <select name="tpMovimento" id="tpMovimento">
								<option value='92'>92 - Recisao</option>
								<option value='93'>93 - Baixa(Bolsa)</option>
								<option value='94'>94 - Recebido Escola - A Vista</option>
								<option value='95'>95 - Recebido Escola - Cheque</option>
								<option value='96'>96 - Recebido Escola - Cartao de Debito</option>
								<option value='97'>97 - Recebido Escola - Cartao de Credito</option>
								<option value='98'>98 - Acordo</option>
								<option value='99'>99 - Cancelamento</option>
						</select> <br />

							<button style="margin-top: 30px;" id="btnBaixar">Baixar</button>
					
					</div>
				</div>
			</form>
		</div>
             
             <?php include "../footer.inc"?>
         	 
         </div>
</body>