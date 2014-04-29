<?php
ini_set ( "display_errors", 0 );
setlocale ( LC_TIME, 'ptb', 'pt_BR', 'portuguese-brazil', 'bra', 'brazil', 'pt_BR.utf-8', 'pt_BR.iso-8859-1', 'br' );
require ("config.php");
include_once "bd.php";
include_once "geral.php";

session_start ();
$nCdAcordo = $_REQUEST ['acordo'];

$query = "Select * from acordo inner join Pessoa on Pessoa.nCdPessoa = Acordo.nCPF where nCdAcordo = $nCdAcordo";

$resultado = consulta ( "athenas", $query );

$registro = $resultado [0];
?>
<html>
<head>
<style type="text/css" media="all">
.variavel {
	font-family: Courier New;
	font-weight: normal;
	font-size: medium;
	border-bottom-style: dashed;
	border-bottom-width: 1px;
	text-align: center;
	font-size: 13px;
}

body {
	font-family: Verdana;
	background-image: url("image/digitalizar000.jpg");
	background-repeat: no-repeat;
	background-position: 10px 0px;
}

td {
	font-size: 10px;
}

table.promissoria {
	border-style: solid;
}

.bordaBox {
	bbackground: ttransparent;
	width: 100%;
}

.bordaBox .b1,.bordaBox .b2,.bordaBox .b3,.bordaBox .b4,.bordaBox .b1b,.bordaBox .b2b,.bordaBox .b3b,.bordaBox .b4b
	{
	display: block;
	overflow: hidden;
	font-size: 1px;
}

.bordaBox .b1,.bordaBox .b2,.bordaBox .b3,.bordaBox .b1b,.bordaBox .b2b,.bordaBox .b3b
	{
	height: 1px;
}

.bordaBox .b2,.bordaBox .b3,.bordaBox .b4 {
	background: #CECECE;
	border-left: 1px solid #999;
	border-right: 1px solid #999;
}

.bordaBox .b1 {
	margin: 0 5px;
	background: #999;
}

.bordaBox .b2 {
	margin: 0 3px;
	border-width: 0 2px;
}

.bordaBox .b3 {
	margin: 0 2px;
}

.bordaBox .b4 {
	height: 1px;
	margin: 0 1px;
}

.bordaBox .conteudo {
	padding: 1px;
	display: block;
	background: #CECECE;
	border-left: 1px solid #999;
	border-right: 1px solid #999;
}
</style>
</head>
<body>
	<table class='promissoria'>
		<tr>
			<td rowspan='11'"><img src='../image/rfbfundo.jpg'
				style='border-right-style: solid; border-right-width: 0.5px' /></td>
			<td>
				<table>
					<tr>
						<td width=230px></td>
						<td width=80px>Vencimento</td>
						<td width=50px class='variavel'><?php echo date('d');?></td>
						<td width=25px>de</td>
						<td width=215px class='variavel'><?php echo strftime("%B") ;?></td>
						<td width=25px>de</td>
						<td width=55px class='variavel'><?php echo date('Y');?></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table>
					<tr>
						<td><span style="font-size: 25px; font-weight: bold">N&deg;</span>
						</td>
						<td width='200px'>

							<div class="bordaBox">
								<b class="b1"></b><b class="b2"></b><b class="b3"></b><b
									class="b4"></b>
								<div class="conteudo">
									<?php echo str_pad($registro['nCdAcordo'], 6, '0', STR_PAD_LEFT)."/".date("Y",strtotime($registro['dAcordo'])); ?>
								</div>
								<b class="b4"></b><b class="b3"></b><b class="b2"></b><b
									class="b1"></b>
							</div>
						</td>
						<td width=220px></td>
						<td><span style="font-size: 25px; font-weight: bold">R$</span></td>
						<td width='200px'>

							<div class="bordaBox">
								<b class="b1"></b><b class="b2"></b><b class="b3"></b><b
									class="b4"></b>
								<div class="conteudo">
									<?php echo str_pad(number_format($registro['nVlrDivida'],2,",","."),32,"*",STR_PAD_BOTH); ?>
								</div>
								<b class="b4"></b><b class="b3"></b><b class="b2"></b><b
									class="b1"></b>
							</div>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table>
					<tr>
						<td width=20px>Ao(s)</td>
						<td width=670px class='variavel'>
						<?php
						$dia = extenso ( date ( 'd' ) );
						$ano = extenso ( date ( 'Y' ) );
						$mes = strftime ( "%B" );
						
						$dia = str_replace ( "real", "", $dia );
						$dia = str_replace ( "reais", "", $dia );
						
						$ano = str_replace ( "real", "", $ano );
						$ano = str_replace ( "reais", "", $ano );
						
						if (date ( 'd' ) == 1) {
							$dia = $dia . " dia";
						} else {
							$dia = $dia . " dias";
						}
						
						$texto = $dia . " do mes de " . $mes . " do ano de " . $ano;
						
						echo str_pad ( strtoupper ( $texto ), 86, '*', STR_PAD_RIGHT );
						?>
					</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table>
					<tr>
						<td width=150px class='variavel'>*************************************</td>
						<td>pagar</td>
						<td width=60px class='variavel'>ei</td>
						<td>por esta &uacute;nica via de <span
							style="font-size: 18px; font-weight: bold">NOTA PROMISSORIA</span></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table>
					<tr>
						<td width=10px>a</td>
						<td width=410px class='variavel'>INSTITUTO EDUCACIONAL JR LTDA</td>
						<td width=40px>CNPJ</td>
						<td width=245px class='variavel'>07.228.276/0001-70</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table>
					<tr>
						<td width=150px>ou &agrave; sua ordem, a quantia de</td>
						<td width=560px>

							<div class="bordaBox">
								<b class="b1"></b><b class="b2"></b><b class="b3"></b><b
									class="b4"></b>
								<div class="conteudo">
						<?php
						$valor_extenso = htmlentities ( extenso ( $registro ['nVlrDivida'] ), ENT_QUOTES, 'UTF-8' );
						echo str_pad ( strtoupper ( $valor_extenso ), 90, '*', STR_PAD_RIGHT );
						?>
					</div>
								<b class="b4"></b><b class="b3"></b><b class="b2"></b><b
									class="b1"></b>
							</div>

						</td>

					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table>
					<tr>

						<td width=715px>

							<div class="bordaBox">
								<b class="b1"></b><b class="b2"></b><b class="b3"></b><b
									class="b4"></b>
								<div class="conteudo">
									***************************************************************************************************************
								</div>
								<b class="b4"></b><b class="b3"></b><b class="b2"></b><b
									class="b1"></b>
							</div>

						</td>

					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table>
					<tr>
						<td width=220px>em moeda corrente deste pa&iacute;s,
							pag&aacute;vel em</td>
						<td width=490px class='variavel'>ARUJA / SP</td>

					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table>
					<tr>
						<td width=40px>EMITENTE</td>
						<td width=300px class='variavel'><?php echo $registro['cNome']; ?></td>
						<td width=30px></td>
						<td width=290px class='variavel'>ARUJA, <?php  echo strtoupper(strftime("%d de %B de %Y")); ?></td>
					</tr>
					<tr>
						<td width=40px>CPF</td>
						<td width=300px class='variavel'><?php echo mask( str_pad($registro['nCdPessoa'],11,'0',STR_PAD_LEFT), "###.###.###-##"); ?></td>
						<td width=30px></td>
						<td width=300px class='variavel'>&nbsp;</td>


					</tr>
					<tr>
						<td width=40px>ENDERECO</td>
						<td width=300px class='variavel'><?php echo $registro['cLogradouro']." - ".$registro['cCidade']."- ".$registro['cUF']; ?></td>
						<td width=30px></td>
						<td width=290px style='vertical-align: top; text-align: center'><?php echo $registro['cNome'];?></td>

					</tr>
				</table>
			</td>
		</tr>
	</table>
</body>
</html>