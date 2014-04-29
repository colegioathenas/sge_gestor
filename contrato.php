<?php
require ("config.php");
include_once "bd.php";
include_once "geral.php";
ini_set ( "display_errors", 0 );
session_start ();

if ($_GET ['matricula'] == "") {
	$matricula = $_SESSION ['mat'];
} else {
	$matricula = $_GET ['matricula'];
}

$query = "SELECT matriculado.*,turma.dInicio, turma.dFim,cursos.cNmCurso
FROM matriculado inner join turma on matriculado.nCdturma = turma.nCdTurma  
inner join cursos on turma.nCdCurso = cursos.nCdCurso WHERE aluno_mat = '$matricula'";

$resultado = consulta ( "athenas", $query );

$registro = $resultado [0];

$vigencia_inicio = strtotime ( $registro ['dInicio'] );
$vigencia_fim = strtotime ( $registro ['dFim'] );

$vigencia_inicio = date ( "d/m/Y", $vigencia_inicio );
$vigencia_fim = date ( "d/m/Y", $vigencia_fim );
$curso_name = $registro ['cNmCurso'];

$aluno_nome = $registro ['aluno_nome'];
$aluno_dtnasc = date ( 'd/m/Y', strtotime ( $registro ['aluno_dtnasc'] ) );
$aluno_naturalidade = $registro ['aluno_naturalidade'];
;
$aluno_nacionalidade = $registro ['aluno_nacionalidade'];
;
$aluno_rgra = $registro ['aluno_rg'];
;
$aluno_curso = $curso_name;

$contratante_nome = $registro ['resp_nome'];
$contratante_grau_parentesco = $registro ['resp_parentesco'];
$contratante_nacionalidade = $registro ['resp_nacionalidade'];
$contratante_rg = $registro ['resp_rg'];
$contratante_cpf = $registro ['resp_cpf'];
$contratante_profissao = $registro ['resp_profissao'];
$contratante_end_residencial = $registro ['resp_end_res_end'] . " - " . $registro ['resp_end_res_bairro'] . " - " . $registro ['resp_end_res_cidade'] . " - " . $registro ['resp_end_res_uf'];
$contratante_end_comercial = $registro ['resp_end_com_end'] . " - " . $registro ['resp_end_com_bairro'] . " - " . $registro ['resp_end_com_cidade'] . " - " . $registro ['resp_end_com_uf'];
$contratante_tel_comercial = "(" . $registro ['resp_com_ddd'] . ")" . $registro ['resp_com_tel'];
$contratante_tel_residencial = "(" . $registro ['resp_res_ddd'] . ")" . $registro ['resp_res_tel'];
$contratante_tel_celular = "(" . $registro ['resp_cel_ddd'] . ")" . $registro ['resp_cel_tel'];
$contratante_naturalidade = $registro ['resp_naturalidade'];
$contratante_est_civil = $registro ['resp_est_civ'];

$valor = $registro ['val_mensalidade'];
$qtd_parcela = $registro ['fpg_mensalidade'];

$valor_parcela = 490;

if ($qtd_parcela == 1) {
	$qtd_parcela = 12;
}

$valor_parcela = $valor / $qtd_parcela;

$vencimento = '5. DIA UTIL';
$valor_extenso = htmlentities ( extenso ( $valor ), ENT_QUOTES, 'UTF-8' );

?>
<html>
<head>

<style type="text/css" media="all">
body {
	font-size: 10;
}

.texto {
	font-size: 12;
}

.minititle {
	font-size: 8;
}

table.tabela {
	border-width: 0.3px;
	border-spacing: 0px;
	border-style: solid;
	border-color: black;
	border-collapse: collapse;
}

table.tabela th {
	border-width: 0.3px;
	padding: 5px;
	border-bottom: none;
	border-color: black;
	text-align: left;
}

table.tabela td {
	border-width: 0.5px;
	padding: 5px;
	padding-top: 0px;
	border-style: solid;
	border-top-style: none;
	border-color: black;
}

.paragrafo {
	text-align: justify;
	font-size: 14;
	line-height: 150%;
	border-top-style: solid;
}

table.tbassinatura {
	
}
</style>
<meta charset="utf-8">

</head>

<body>

	<div align="center" style="width: 800px">
<?php
echo "<span style='font-weight: bold;font-size:12pt;font-style:italic'> CONTRATO DE PRESTA&Ccedil;&Atilde;O DE SERVI&Ccedil;OS EDUCACIONAIS </span>";

?>
<p>
		
		
		<table width='635' border='1px' class='tabela'>
			<tr>
				<td colspan='3' align='center'><b>E D U C A N D O(A)</b></td>
			</tr>
			<tr>
				<th colspan='2' align="top" class='minititle'>Nome</th>
				<th align="top" class='minititle'>Data de Nascimento</th>
			</tr>
			<tr>
				<td colspan='2' class='texto'><?php echo $aluno_nome; ?></td>
				<td class='texto'><?php echo $aluno_dtnasc; ?></td>
			</tr>
			<tr>
				<th align="top" class='minititle'>Naturalidade</th>
				<th align="top" class='minititle'>Nacionalidade</th>
				<th align="top" class='minititle'>RG/RA</th>
			</tr>
			<tr>
				<td class='texto'><?php echo $aluno_naturalidade; ?></td>
				<td class='texto'><?php echo $aluno_nacionalidade; ?></td>
				<td class='texto'><?php echo $aluno_rgra; ?></td>
			</tr>
		</table>
		</p>
		<p>
		
		
		<table width='635' border='1px' class='tabela'>
			<tr>
				<td colspan='3' align='center'><b>C O N T R A T A N T E</b></td>
			</tr>
			<tr>
				<th colspan='2' align="top" class='minititle'>Nome</th>
				<th align="top" class='minititle'>Grau de Parentesco</th>
			</tr>
			<tr>
				<td colspan='2' class='texto'><?php echo $contratante_nome; ?></td>
				<td class='texto'><?php echo $contratante_grau_parentesco; ?></td>
			</tr>
			<tr>
				<th align="top" class='minititle'>RG</th>
				<th align="top" class='minititle'>CPF</th>
				<th align="top" class='minititle'>Nacionalidade</th>
			</tr>
			<tr>
				<td class='texto'><?php echo $contratante_rg; ?></td>
				<td class='texto'><?php echo $contratante_cpf; ?></td>
				<td class='texto'><?php echo $contratante_nacionalidade; ?></td>
			</tr>
			<tr>
				<th align="top" class='minititle'>Naturalidade</th>
				<th align="top" class='minititle'>Estado Civil</th>
				<th align="top" class='minititle'>Profissao</th>
			</tr>
			<tr>
				<td class='texto'><?php echo $contratante_naturalidade; ?></td>
				<td class='texto'><?php echo $contratante_est_civil; ?></td>
				<td class='texto'><?php echo $contratante_profissao; ?></td>
			</tr>
			<tr>
				<th colspan='3' align="top" class='minititle'>Endereco Residencia</th>

			</tr>
			<tr>
				<td colspan='3' class='texto'><?php echo $contratante_end_residencial; ?></td>

			</tr>
			<tr>
				<th colspan='3' align="top" class='minititle'>Endereco Comercial</th>

			</tr>
			<tr>
				<td colspan='3' class='texto'><?php echo $contratante_end_comercial; ?></td>

			</tr>
			<tr>
				<th align="top" class='minititle'>Tel. Residencial</th>
				<th align="top" class='minititle'>Tel. Comercial</th>
				<th align="top" class='minititle'>Tel. Celular</th>
			</tr>
			<tr>
				<td class='texto'><?php echo $contratante_tel_residencial; ?></td>
				<td class='texto'><?php echo $contratante_tel_comercial; ?></td>
				<td class='texto'><?php echo $contratante_tel_celular; ?></td>
			</tr>
		</table>
		</p>
		<p>
		
		
		<table width='635' border='1px' class='tabela'>
			<tr>
				<td colspan='3' align='center'><b>C O N T R A T A D O</b></td>
			</tr>
			<tr>
				<th colspan='2' align="top" class='minititle'>Nome</th>
				<th align="top" class='minititle'>CNPJ</th>
			</tr>
			<tr>
				<td colspan='2' class='texto'>INSTITUTO EDUCACIONAL JR LTDA</td>
				<td class='texto'>07.228.276/0001-70</td>
			</tr>
			<tr>
				<th colspan='3' align="top" class='minititle'>Endereco</th>

			</tr>
			<tr>
				<td colspan='3' class='texto'>PRACA NARCISO JOSE LOPES, 138</td>

			</tr>
			<tr>
				<th align="top" class='minititle'>Bairro</th>
				<th align="top" class='minititle'>Cidade</th>
				<th align="top" class='minititle'>Estado</th>
			</tr>
			<tr>
				<td class='texto'>CENTRO</td>
				<td class='texto'>ARUJA</td>
				<td class='texto'>SAO PAULO</td>
			</tr>
		</table>
		</p>
		<p class='paragrafo'>
			Pelo presente instrumento particular de Contrato de
			Presta&ccedil;&atilde;o de Servi&ccedil;os Educacionais do Curso de <b><?php echo $curso_name ?></b>,
			as partes acima descritas t&ecirc;m entre si justas e contratadas as
			cl&aacute;usulas e condi&ccedil;&otilde;es a seguir especificadas e
			cujo cumprimento se obrigam mutuamente:
		</p>
		<p class='paragrafo'>
			<b>Cl&aacute;usula 1&ordf;</b>: A CONTRATADA prestar&aacute; a(o)
			CONTRATANTE, durante o per&iacute;odo de dura&ccedil;&atilde;o do
			curso, servi&ccedil;os educacionais correspondentes &agrave; serie e
			per&iacute;odo a que estiver a(o) EDUCANDO(A) matriculado(a),
			conforme Requerimento de Matr&iacute;cula que deste faz parte
			integrante, por meio de aulas ministradas por seu corpo docente e
			demais atividades escolares, conforme legisla&ccedil;&atilde;o
			vigente, assim como Programas de Ensino, Matriz Curricular,
			Calend&aacute;rio Escolar, do Instituto Educacional JR Ltda e seu
			Regimento Escolar. <br /> &sect; 1&deg; A confirma&ccedil;&atilde;o
			da matr&iacute;cula pressup&otilde;e ci&ecirc;ncia de todos os
			documentos citados nesta cl&aacute;usula; <br /> &sect; 2&deg; A
			configura&ccedil;&atilde;o formal do ato de matr&iacute;cula ocorre
			com o deferimento do Requerimento de Matr&iacute;cula e seu
			respectivo pagamento; <br /> &sect; 3&deg; O(A) CONTRATANTE tem pleno
			conhecimento de que a presta&ccedil;&atilde;o dos servi&ccedil;os
			mencionados nesta cl&aacute;usula somente ocorrer&aacute; se o
			n&uacute;mero de alunos por classe for preenchido, de acordo com as
			normas internas estabelecidas pela CONTRATADA; <br /> &sect; 4&deg;
			Ocorrendo a hip&oacute;tese do par&aacute;grafo anterior e o curso
			n&atilde;o sendo oferecido, ter-se-&aacute; por rescindido o presente
			contrato podendo o(a) CONTRATANTE retirar os valores pagos &agrave;
			CONTRATADA diretamente em seu Departamento Financeiro ou os receber
			atrav&eacute;s de deposito banc&aacute;rio, ap&oacute;s 10 (dez)
			dias, com exce&ccedil;&atilde;o dos pagamentos efetuados
			atrav&eacute;s de cart&otilde;es de cr&eacute;dito, caso existente
			essa modalidade de pagamento, cujos valores ser&atilde;o estornados,
			de acordo com os procedimentos das respectivas operadoras; <br />
			&sect; 5&deg; As aulas ser&atilde;o ministradas em salas ou locais
			indicados pela CONTRATADA, tendo em vista a natureza das disciplinas
			e a t&eacute;cnicas pedag&oacute;gicas pertinentes, inclusive quanto
			&agrave; realiza&ccedil;&atilde;o de eventos externos; <br /> &sect;
			6&deg; &eacute; de inteira responsabilidade da CONTRATADA a
			orienta&ccedil;&atilde;o t&eacute;cnica e pedag&oacute;gica dos
			servi&ccedil;os educacionais prestados, no que se refere &agrave;
			fixa&ccedil;&atilde;o de datas para provas de aproveitamento e da
			carga hor&aacute;ria, bem como indica&ccedil;&atilde;o de
			professores, a orienta&ccedil;&atilde;o
			did&aacute;tico-pedag&oacute;gica , al&eacute;m de outras
			provid&ecirc;ncias que as atividades docentes e administrativas
			exijam, obedecendo ao seu exclusivo crit&eacute;rio. <br />&sect;
			7&deg; No caso de atividades &aacute; dist&acirc;ncia o suporte
			t&eacute;cnico da CONTRATADA restringe-se ao ambiente do curso,
			ficando a cargo do(a) CONTRATANTE adquirir equipamentos com as
			especifica&ccedil;&otilde;es t&eacute;cnicas pertinentes. <br />&sect;
			8&deg; Nos casos que a lei estabelecer a carga hor&aacute;ria para
			est&aacute;gio,o aluno ter&aacute; que cumprir a
			freq&uuml;&ecirc;ncia de 100% nas aulas pr&aacute;ticas,e 75% nas
			aulas te&oacute;ricas-pr&aacute;ticas em cada um dos componentes
			curriculares (disciplina).Em caso de faltas a responsabilidade
			&eacute; exclusiva do aluno,onde o mesmo ser&aacute; submetido aos
			crit&eacute;rios de reposi&ccedil;&atilde;o da contratada,inclusive o
			valor cobrado pelas reposi&ccedil;&otilde;es necess&aacute;rias para
			a conclus&atilde;o do curso,exceto nos casos de Doen&ccedil;as
			Infectam - Contagiosas,problemas relacionados &agrave;
			gesta&ccedil;&atilde;o e interna&ccedil;&atilde;o mediante
			apresenta&ccedil;&atilde;o de laudo m&eacute;dico. <br />
			<b>Cl&aacute;usula 2&ordf;</b>: A CONTRATADA poder&aacute; promover
			altera&ccedil;&atilde;o de turmas, agrupamentos de classes,
			hor&aacute;rios de aulas, calend&aacute;rio escolar, bem como outras
			medidas que por raz&otilde;es de ordem administrativa e/ou
			pedag&oacute;gicas se fizerem necess&aacute;rias, a seu
			crit&eacute;rio, desde que preservadas as disposi&ccedil;&otilde;es
			legais pertinentes. <br />
			<b>Cl&aacute;usula 3&ordf;</b>: O(A) CONTRATANTE pagar&aacute; &agrave; CONTRATADA em raz&atilde;o dos servi&ccedil;os educacionais, taxas administrativas e parcelas  a anuidade de 
R$ <?php echo number_format($valor,2,",","."); ?> (<?php echo $valor_extenso; ?>) que poder&aacute; ser quitada, mediante uma das op&ccedil;&otilde;es abaixo relacionadas:

</p>
		<p>
		
		
		<table width='635' border='1px' class='tabela'>
			<tr>
				<th align="top" class='minititle'>Op&ccedil;&atilde;o 1:</th>
				<th align="top" class='minititle'>Valor</th>
				<th align="top" class='minititle'>Vencimento</th>
				<th align="top" class='minititle'>Cobran&ccedil;a Bancaria</th>
			</tr>
			<tr>
				<td class='texto'><b>A VISTA </b></td>
				<td class='texto'><b>R$ <?php echo number_format($valor,2,",","."); ?></b></td>
				<td class='texto'><b><?php echo date('d/m/Y') ?></b></td>
				<td class='texto'>(x)SIM ( )N&Atilde;O</td>
			</tr>
			<tr>
				<th align="top" class='minititle'>Op&ccedil;&atilde;o 2:</th>
				<th align="top" class='minititle'>Valor</th>
				<th align="top" class='minititle'>Vencimento</th>
				<th align="top" class='minititle'>Cobran&ccedil;a Bancaria</th>
			</tr>
			<tr>
				<td class='texto'><b>EM <?php echo $qtd_parcela ?> PARCELAS</b></td>
				<td class='texto'><b>R$ <?php echo number_format($valor_parcela,2,",","."); ?></b></td>
				<td class='texto'><b><?php echo $vencimento ?></b></td>
				<td class='texto'>(x)SIM ( )N&Atilde;O</td>
			</tr>
		</table>
		</p>
		<p class='paragrafo'>
			<br />&sect; 1&deg; Os descontos que porventura forem concedidos
			s&oacute; ter&atilde;o validade para os pagamentos at&eacute; a data
			do vencimento previamente estipulado no boleto banc&aacute;rio. <br />&sect;
			2&deg; No caso de pagamento parcelado o vencimento das parcelas
			ocorrer&aacute; sempre no dia 5&deg; (quinto) dia &uacute;til de cada
			m&ecirc;s, devendo referidos valores serem quitados atrav&eacute;s da
			rede banc&aacute;ria, atrav&eacute;s do respectivo boleto, que
			ser&aacute; enviado no endere&ccedil;o fornecido, o qual o(a)
			CONTRATANTE se obriga a manter atualizado; <br />&sect; 3&deg; O(A)
			CONTRATANTE obriga-se a retirar o boleto banc&aacute;rio junto ao
			Departamento Financeiro do Instituto Educacional JR Ltda situado no
			endere&ccedil;o indicado no pre&acirc;mbulo desta, caso n&atilde;o o
			receba, com 02 (dois) dias &uacute;teis antes do respectivo
			vencimento. <br />&sect; 4&deg; Em caso de falta de pagamento no
			vencimento de qualquer das parcelas relativas ao curso ministrado,
			o(a) CONTRATANTE 0icar&aacute; constitu&iacute;do(a) em mora, nos
			termos do artigo 397 do C&oacute;digo Civil Brasileiro (Lei Federal
			no 10.406, de 10 de janeiro de 2002), independentemente de
			interpela&ccedil;&atilde;o ou notifica&ccedil;&atilde;o judicial ou
			extrajudicial, passando o valor n&atilde;o pago a constituir
			d&iacute;vida l&iacute;quida, certa e exig&iacute;vel. O valor devido
			ser&aacute; acrescido de multa de 10% (dez por cento) e de
			corre&ccedil;&atilde;o monet&aacute;ria, de acordo com a
			varia&ccedil;&atilde;o acumulada do IPC/FIPE, al&eacute;m de juros de
			mora de 1% (um por cento) ao m&ecirc;s, ficando a CONTRATADA
			autorizada a proceder &agrave; cobran&ccedil;a pelas vias
			administrativas e/ou judicial. <br />&sect; 5&deg; Em havendo atraso
			no pagamento das parcelas, a CONTRATADA poder&aacute; negativar o
			nome do devedor em cadastro ou servi&ccedil;os legalmente
			constitu&iacute;dos e destinados &agrave; prote&ccedil;&atilde;o de
			cr&eacute;dito, ap&oacute;s pr&eacute;via notifica&ccedil;&atilde;o;
			promover as medidas judiciais e legais que entender pertinentes, e
			utilizar os servi&ccedil;os de advogados ou de empresas
			especializadas para a cobran&ccedil;a dos d&eacute;bitos, arcando o
			devedor com o pagamento dos custos operacionais e honor&aacute;rios
			profissionais, ficando estes &uacute;ltimos estabelecidos em valores
			n&atilde;o superiores a 20% (vinte por cento) do d&eacute;bito
			apurado, e n&atilde;o inferiores a 10% (dez por cento) daquele; <br />&sect;
			6&deg; As medidas mencionadas no par&aacute;grafo anterior
			poder&atilde;o ser tomadas pela CONTRATADA isolada, gradativa ou
			cumulativamente, a seu exclusivo crit&eacute;rio. <br />&sect; 7&deg;
			O(A) CONTRATANTE declara ter plena ci&ecirc;ncia do fato de que o
			pagamento de parcelas mensais posteriores n&atilde;o quita as
			anteriores em atraso, sendo inaplic&aacute;vel, no caso do presente
			contrato, a presun&ccedil;&atilde;o estabelecida no artigo 322 do
			C&oacute;digo de Processo Civil Brasileiro. <br />&sect; 8&deg; Os
			valores das parcelas estar&atilde;o sujeitos &agrave;
			atualiza&ccedil;&atilde;o ou reajuste conforme a
			legisla&ccedil;&atilde;o vigente. Na aus&ecirc;ncia de &iacute;ndice
			legalmente definido e autorizado para atualiza&ccedil;&atilde;o, bem
			como na impossibilidade de aplica&ccedil;&atilde;o de alternativa
			equivalente, fica acordado que o respectivo reajuste ser&aacute;
			efetivado com base na varia&ccedil;&atilde;o dos custos, obedecidas
			&agrave;s normas que disciplinam a mat&eacute;ria. Em caso de
			altera&ccedil;&atilde;o legislativa, conven&ccedil;&atilde;o ou
			diss&iacute;dio coletivo que reflitam na presta&ccedil;&atilde;o do
			servi&ccedil;o, os valores pactuados poder&atilde;o ser revistos,
			garantindo-se assim o equil&iacute;brio econ&ocirc;mico-financeiro do
			contrato. <br />&sect; 9&deg; Ser&atilde;o cobrados dos alunos,
			independentemente dos valores ora contratados, os servi&ccedil;os
			extracurriculares e as taxas administrativas, tais como
			hist&oacute;ricos escolares,certificados,carteira de estudante e
			outros; <br />&sect; 10&deg; N&atilde;o est&atilde;o ainda
			inclu&iacute;dos neste contrato os servi&ccedil;os especiais de
			refor&ccedil;o, depend&ecirc;ncia, transporte escolar, os opcionais e
			de uso facultativo a(o) EDUCANDO(A), as segundas chamadas de prova ou
			exame, a segunda via de documentos, o uniforme, a
			alimenta&ccedil;&atilde;o e o material did&aacute;tico de uso
			exclusivo do(a) EDUCANDO(A). <br />&sect; 11&deg; Os descontos
			concedidos pela CONTRATADA, a seu crit&eacute;rio, a(o) CONTRATANTE,
			ser&atilde;o v&aacute;lidos especificamente para o per&iacute;odo em
			quest&atilde;o, n&atilde;o caracterizando redu&ccedil;&atilde;o
			definitiva do valor das parcelas cobradas e/ou divulgadas. <br />
			<b>Cl&aacute;usula 4&ordf;</b>: O cancelamento da matr&iacute;cula
			poder&aacute; ser feito antes do in&iacute;cio das aulas, ap&oacute;s
			a reten&ccedil;&atilde;o pela CONTRATADA da taxa de 5% (cinco por
			cento) sobre o valor total da anuidade, a t&iacute;tulo de
			ressarcimento das despesas administrativas e operacionais. Se o
			cancelamento foi solicitado, ap&oacute;s, iniciadas as aulas, o aluno
			dever&aacute; pagar o valor proporcional &agrave; carga
			hor&aacute;ria j&aacute; ministrada, at&eacute; a
			formaliza&ccedil;&atilde;o da desist&ecirc;ncia, podendo, portanto,
			haver restitui&ccedil;&atilde;o de valores pagos antecipadamente ou
			cobran&ccedil;a do aluno da diferen&ccedil;a paga a menor. <br />
			<b>Cl&aacute;usula 5&ordf;</b>: A CONTRATADA, a qualquer tempo
			durante a vig&ecirc;ncia deste contrato, poder&aacute; cancelar e/ou
			rever os valores das bolsas de estudo por ela concedidas a(o)
			CONTRATANTE, mediante notifica&ccedil;&atilde;o pr&eacute;via de 30
			(trinta) dias realizada, inclusive, por carta com aviso de
			recebimento. <br />
			<b>Cl&aacute;usula 6&ordf;</b>: Os cr&eacute;ditos decorrentes do
			presente contrato, em favor da CONTRATADA contra o(a) CONTRATANTE
			poder&atilde;o ser cedidos ou negociados com terceiro, parcial ou
			totalmente, com o objetivo de possibilitar estruturas de
			financiamento, sendo que o(a) CONTRATANTE desde j&aacute; expressa
			sua pr&eacute;via anu&ecirc;ncia. <br />
			<b>Cl&aacute;usula 7&ordf;</b>: O(A) CONTRATANTE obriga-se a
			ressarcir ou, se for o caso, a indenizar os danos materiais que
			causar, por dolo ou culpa, &agrave; CONTRATADA, bem como a terceiros
			que tenham bens sob a sua guarda ou em suas depend&ecirc;ncias. <br />&sect;
			1&deg; Ocorrendo reincid&ecirc;ncia na hip&oacute;tese do caput desta
			cl&aacute;usula, al&eacute;m do pagamento da
			indeniza&ccedil;&atilde;o, o(a) CONTRATANTE, conforme as
			disposi&ccedil;&otilde;es do regimento interno da CONTRATADA
			poder&aacute; vir a ser exclu&iacute;do do quadro discente do
			Instituto Educacional JR Ltda. <br />
			<b>Cl&aacute;usula 8&ordf;</b>: O contrato ser&aacute;
			automaticamente cancelado em caso de desacordo do previsto nos
			artigos 4&deg; e 5&deg; deste. <br />&sect; 1&deg; O pagamento da
			primeira parcela corresponder&aacute; &agrave;
			manifesta&ccedil;&atilde;o formal do(a) CONTRATANTE em efetuar a
			matr&iacute;cula. <br />&sect; 2&deg; A CONTRATADA poder&aacute;
			recusar a matr&iacute;cula do(a) CONTRATANTE e,
			conseq&uuml;entemente, a prorroga&ccedil;&atilde;o autom&aacute;tica
			do contrato em caso de inadimpl&ecirc;ncia de quaisquer
			obriga&ccedil;&otilde;es constantes deste instrumento. <br />
			<b>Cl&aacute;usula 9&ordf;</b>: O presente contrato poder&aacute; ser
			rescindido nas seguintes hip&oacute;teses: <br />&sect; 1&deg; Por
			parte do(a) CONTRATANTE: <br />I - por desist&ecirc;ncia formal,
			mediante o cancelamento de matr&iacute;cula por meio de
			solicita&ccedil;&atilde;o feita por escrito, ficando ajustado que o
			simples abandono de curso por parte do(a) EDUCANDO(A) n&atilde;o
			ser&aacute; considerado para este fim, permanecendo devido, neste
			caso, o pagamento proporcional &agrave; carga hor&aacute;ria
			j&aacute; ministrada at&eacute; a regulariza&ccedil;&atilde;o de
			desist&ecirc;ncia, ou at&eacute; o final do curso; o que ocorrer
			primeiro. <br />II - por eventual inadimpl&ecirc;ncia por parte da
			CONTRATADA no cumprimento do presente contrato, ap&oacute;s,
			pr&eacute;via notifica&ccedil;&atilde;o do(a) CONTRATANTE mencionado
			a irregularidade havida e concedendo prazo para san&aacute;-la. <br />&sect;
			2&deg; Por parte da CONTRATADA: <br />I - por viola&ccedil;&atilde;o
			dos dispositivos e/ou ocorr&ecirc;ncia de qualquer fato previsto no
			regimento do Instituto Educacional JR Ltda. <br />
			<b>Cl&aacute;usula 10&ordf;</b>: O presente instrumento &eacute;
			elaborado, dentre outros, sob a &eacute;gide dos seguintes
			dispositivos legais, estatut&aacute;rios e/ou regimentais: <br />I -
			artigo 5&deg;, II; 173,&sect; 4&deg;; 206, II e III; 207 e 209 da
			Constitui&ccedil;&atilde;o da Rep&uacute;blica Federativa do Brasil;
			<br />II - artigos 104, 421, 422 e 427 do C&oacute;digo Civil
			Brasileiro; <br />III - artigos 2&deg;, 3&deg; ,&sect; 2&deg;; e 54,
			&sect; 3&deg; da Lei Federal no 8.078, de 11 de setembro de 1990; <br />IV
			- Resolu&ccedil;&atilde;o CNE/CES no 01, de 03 de abril de 2001; <br />V
			- Do Regimento Geral e Interno do Instituto Educacional JR Ltda. <br />
			<b>Cl&aacute;usula 11&ordf;</b>: A CONTRATADA, livre de quaisquer
			&ocirc;nus perante o(a) CONTRATANTE, poder&aacute; utilizar-se da
			imagem do(a) EDUCANDO(A) para fins exclusivos de
			divulga&ccedil;&atilde;o, podendo reproduzi-la ou divulg&aacute;-la
			junto &agrave; internet, jornais e todos os demais meios de
			comunica&ccedil;&atilde;o p&uacute;blico ou privado,nos termos da
			Lei. <br />
			<b>Cl&aacute;usula 12&ordf;</b>: As partes atribuem ao presente
			instrumento particular plena efic&aacute;cia e for&ccedil;a executiva
			extrajudicial, nos termos do art. 585 do C&oacute;digo Civil
			Brasileiro. <br />
			<b>Cl&aacute;usula 13&ordf;</b>: N&atilde;o se aplicam aos EDUCANDOS
			beneficiados com Bolsa de Estudos as cl&aacute;usulas
			econ&ocirc;micas deste instrumento particular. <br />
			<b>Cl&aacute;usula 14&ordf;</b>:Esse contrato ter&aacute; sua vig&ecirc;ncia de <?php echo $vigencia_inicio;?> a <?php echo $vigencia_fim;?> .
<br />
			<b>Cl&aacute;usula 15&ordf;</b>: Fica eleito o foro da Vara Distrital
			de Aruj&aacute;, da Comarca de Santa Isabel para dirimir quaisquer
			d&uacute;vidas ou controv&eacute;rsias oriundas do presente
			instrumento particular, com a exclus&atilde;o de qualquer outro, por
			mais privilegiado que seja.

		</p>
		<p class='paragrafo'>E por estarem assim de acordo, justas e
			contratadas, as partes assinam o presente instrumento particular em
			02 (duas) vias de igual teor e conte&uacute;do, e para um s&oacute;
			efeito, na presente das testemunhas abaixo, para que produzam seus
			efeitos legais.</p>
		<table width='100%'>
			<tr>
				<td colspan='3' align="center">ARUJA <?php
				
setlocale ( LC_TIME, 'ptb', 'pt_BR', 'portuguese-brazil', 'bra', 'brazil', 'pt_BR.utf-8', 'pt_BR.iso-8859-1', 'br' );
                                                       echo strftime("%d de %B de %Y"); 
                                                     ?></td>
			</tr>
			<tr height="100px">

			</tr>
			<tr>
				<td width='300px'
					style="border-top-style: solid; border-top-color: black; border-top-width: 0.5;">INSTITUTO
					EDUCACIONAL JR LTDA</td>
				<td></td>
				<td width='300px'
					style="border-top-style: solid; border-top-color: black; border-top-width: 0.5">Testemunha</td>
			</tr>
			<tr height="100px">

			</tr>
			<tr>
				<td width='300px'
					style="border-top-style: solid; border-top-color: black; border-top-width: 0.5">CONTRATANTE
				</td>
				<td></td>
				<td width='300px'
					style="border-top-style: solid; border-top-color: black; border-top-width: 0.5;"
					align="top">Testemunha</td>
			</tr>
			<tr>
				<td><?php echo $contratante_nome; ?>
			<br />
			CPF:<?php echo $contratante_cpf; ?></td>
				<td></td>
				<td></td>
			</tr>
		</table>
	</div>
</body>
</html>
