
<?php
require ("config.php");
include_once "bd.php";
ini_set ( "display_errors", 0 );
session_start ();

// $matricula = $_SESSION['mat'];

if ($_GET ['matricula'] == "") {
	$matricula = $_SESSION ['mat'];
} else {
	$matricula = $_GET ['matricula'];
}

$query = "select matriculado.*,cursos.cNmCurso,turma.cturno from matriculado inner join cursos on cursos.nCdCurso = matriculado.serie inner join turma on turma.nCdTurma = matriculado.nCdturma where aluno_mat = '$matricula'";
$resultado = consulta ( "athenas", $query );
$registro = $resultado [0];

$curso_name = $registro ['cNmCurso'];

$contratante_nome = $registro ['resp_nome'];
$contratante_grau_parentesco = $registro ['resp_parentesco'];
$contratante_nacionalidade = $registro ['resp_nacionalidade'];
$contratante_rg = $registro ['resp_rg'];
$contratante_cpf = $registro ['resp_cpf'];
$contratante_profissao = $registro ['resp_profissao'];
$contratante_end_residencial = $registro ['v'] . " - " . $registro ['resp_end_res_bairro'] . " - " . $registro ['resp_end_res_cidade'] . " - " . $registro ['resp_end_res_uf'];
$contratante_end_comercial = $registro ['resp_end_com_end'] . " - " . $registro ['resp_end_com_bairro'] . " - " . $registro ['resp_end_com_cidade'] . " - " . $registro ['resp_end_com_uf'];
$contratante_tel_comercial = "(" . $registro ['resp_com_ddd'] . ")" . $registro ['resp_com_tel'];
$contratante_tel_residencial = "(" . $registro ['resp_res_ddd'] . ")" . $registro ['resp_res_tel'];
$contratante_tel_celular = "(" . $registro ['resp_cel_ddd'] . ")" . $registro ['resp_cel_tel'];
$contratante_naturalidade = $registro ['resp_naturalidade'];
$contratante_est_civil = $registro ['resp_est_civ'];

$nome = $registro ['aluno_nome'];
$dtnasc = $registro ['aluno_dtnasc'];
$naturalidade = $registro ['aluno_naturalidade'];
$nacionalidade = $registro ['aluno_nacionalidade'];
$rgra = $registro ['aluno_rg'];

$curso = $curso_name;
$sexo = $registro ['aluno_sexo'];
$endereco = $registro ['aluno_endereco'];
$bairro = $registro ['aluno_bairro'];
$cidade = $registro ['aluno_cidade'];
$uf = $registro ['aluno_uf'];
$fil_pai = $registro ['aluno_pai'];
$fil_mae = $registro ['aluno_mae'];

switch ($registro ['cturno']) {
	case 'M' :
		$periodo = 'MANHA';
		break;
	case 'T' :
		$periodo = 'TARDE';
		break;
	case 'N' :
		$periodo = 'NOITE';
		break;
}

$naturalidade_uf = $registro ['aluno_uf'];
;

$contratante_nome = $registro ['resp_nome'];
$contratante_grau_parentesco = $registro ['resp_parentesco'];
$contratante_nacionalidade = $registro ['resp_nacionalidade'];
$contratante_rg = $registro ['resp_rg'];
$contratante_cpf = $registro ['resp_cpf'];
$contratante_profissao = $registro ['resp_profissao'];
$contratante_end_residencial = $registro ['v'] . " - " . $registro ['resp_end_res_bairro'] . " - " . $registro ['resp_end_res_cidade'] . " - " . $registro ['resp_end_res_uf'];
$contratante_end_comercial = $registro ['resp_end_com_end'] . " - " . $registro ['resp_end_com_bairro'] . " - " . $registro ['resp_end_com_cidade'] . " - " . $registro ['resp_end_com_uf'];
$contratante_tel_comercial = "(" . $registro ['resp_com_ddd'] . ")" . $registro ['resp_com_tel'];
$contratante_tel_residencial = "(" . $registro ['resp_res_ddd'] . ")" . $registro ['resp_res_tel'];
$contratante_tel_celular = "(" . $registro ['resp_cel_ddd'] . ")" . $registro ['resp_cel_tel'];
$contratante_naturalidade = $registro ['resp_naturalidade'];
$contratante_est_civil = $registro ['resp_est_civ'];
$contratante_email = $registro ['resp_email'];

$registro_matricula = $matricula;

?>



<html>
<head>

<style type="text/css" media="all">
body {
	font-family: "Times New Roman";
	font-size: 10;
}

.texto {
	font-family: "Times New Roman";
	font-size: 12;
}

.minititle {
	font-family: "Times New Roman";
	font-size: 8;
}

table.externa {
	border-width: 0.3px;
	border-spacing: 0px;
	border-style: solid;
	border-color: black;
	border-collapse: separate;
	width: 100%;
}

table.externa td {
	border-width: 0.5px;
	padding: 5px;
	padding-top: 0px;
	border-style: solid;
	border-top-style: none;
	border-color: black;
	height: 35px;
}

table.externa th {
	border-width: 0.5px;
	padding: 5px;
	padding-top: 0px;
	border-style: solid;
	border-top-style: none;
	border-color: black;
	font-weight: bold;
	text-align: center;
	height: 40px;
}

.
.paragrafo {
	text-align: justify;
	font-family: "Times New Roman";
	font-size: 14;
	line-height: 150%;
}

table.interna {
	border-spacing: 0px;
	border-style: none;
	border-color: black;
	border-collapse: separate;
	width: 100%;
}

table.interna td {
	border-style: none;
}

table.interna th {
	font-weight: bold;
	border-style: none;
	text-align: left;
}

table.assinatura {
	text-align: center;
	width: 100%;
}

table.assinatura td {
	border-style: none;
}

table.assinatura tr {
	height: 50px;
}
</style>
<meta charset="iso-8859-1" />
</head>

<body>

	<div align="center" style="width: 800px; padding: 10px">
		<center>
			<img src="/image/logo_ra.jpg" />
		</center>
		<table class="externa">
			<tr>
				<th> REGISTRO DE MATRICULA N. <?php echo $registro_matricula; ?> </th>
			</tr>
			<tr>
				<th>IDENTIFICA&Ccedil;&Atilde;O DO ALUNO</th>
			</tr>
			<tr>
				<td>
					<table class="interna">
						<tr>
							<th>Nome</th>
							<td><?php echo $nome; ?></td>
						</tr>
						<tr>
							<th>Sexo</th>
							<td><?php echo $sexo; ?></td>
							<th>Naturalidade</th>
							<td><?php echo $naturalidade; ?></td>
							<th>UF</th>
							<td><?php echo $naturalidade_uf; ?></td>

						</tr>
						<tr>
							<th>Nacionalidade</th>
							<td><?php echo $nacionalidade; ?></td>
							<th>Dt. Nascimento</th>
							<td><?php echo $dtnasc; ?></td>
						</tr>
						<tr>
							<th>RG</th>
							<td><?php echo $rgra; ?></td>
							<th>CPF</th>
							<td><?php echo $contratante_cpf; ?></td>


						</tr>
						<tr>
							<th>Pai</th>
							<td><?php echo $fil_pai; ?></td>

						</tr>
						<tr>
							<th>M&atilde;e</th>
							<td><?php echo $fil_mae; ?></td>

						</tr>
						<tr>
							<th>Endere&ccedil;o</th>
							<td><?php echo $endereco; ?></td>


						</tr>
						<tr>
							<th>Bairro</th>
							<td><?php echo $bairro; ?></td>
							<th>Cidade</th>
							<td><?php echo $cidade; ?></td>
							<th>UF</th>
							<td><?php echo $uf; ?></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td>
					<table class="interna">
						<tr>
							<td>CONTATO</td>
						</tr>
						<tr>
							<th>Telefone Res.</th>
							<td><?php echo $contratante_tel_residencial; ?></td>
							<th>Telefone Com.</th>
							<td><?php echo $contratante_tel_comercial; ?></td>
						</tr>
						<tr>
							<th>Celular</th>
							<td><?php echo $contratante_tel_celular; ?></td>
							<th>E-Mail</th>
							<td><?php echo $contratante_tel_email; ?></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td>
					<table class="interna">
						<tr>
							<td colspan="2">SOLICITACAO DE MATRICULA</td>
						</tr>
						<tr>
							<th width="100px">Curso</th>

							<td><?php echo $curso; ?></td>
						</tr>
						<tr>
							<th>Periodo</th>
							<td><?php echo $periodo; ?></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td>
					<table class="assinatura">
						<tr>
							<td><br />
							<br />
							<br />Declaro acatar as normas regimentais desse estabelecimento
								de Ensino.<br />
							<br />
							<br /></td>
						</tr>
						<tr>
							<td>ARUJA <?php setlocale(LC_ALL, "pt_BR"); echo strftime("%d de %B de %Y"); ?><br />
							<br />
							<br />
							<br /></td>
						</tr>
						<tr>
							<td><br />
							<br />
							<br />
							<br />
						<?php echo $contratante_nome ?><br />
						RG <?php echo $contratante_rg; ?> <br />
						CPF <?php echo $contratante_cpf; ?><br /></td>
						</tr>
						<tr>

						</tr>

					</table>

				</td>
			</tr>

		</table>
	</div>
</body>
</html>
