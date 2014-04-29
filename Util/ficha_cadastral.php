<?php
require ("../config.php");
include_once "../bd.php";
include_once "../geral.php";
ini_set ( "display_errors", 1 );
$query = "SELECT DISTINCT  turma.`cNmTurma`, matricula.`nChamada`
     , aluno.`cNome` AS aluno_nome
     , contratante.`cNome`
     , matriculado.`resp_nacionalidade`  
     , matriculado.`resp_est_civ`
     , matriculado.`resp_profissao`
     , matriculado.`resp_rg`
     , contratante.nCdPessoa
     , contratante.`dNasc`
     , contratante.`cLogradouro`
     , contratante.`cBairro`
     , contratante.`nCEP`
     , contratante.`cCidade`    
       , contratante.`cUF`    
  FROM matricula
       INNER JOIN pessoa aluno ON aluno.nCdPessoa = matricula.nCdPessoa
       INNER JOIN pessoa contratante ON contratante.nCdPessoa = aluno.`nCdRespFin`
       LEFT JOIN matriculado ON resp_cpf= contratante.nCdPessoa
       INNER JOIN turma ON turma.ncdturma = matricula.`nCdTurma`
  WHERE nCdStatus = 1
     AND matricula.nCdTurma <> 21
     ORDER BY matricula.nCdTurma, nChamada ;
	";

$resultado = consulta ( "athenas", $query );

?>

<html>
<style>
table {
	border-style: solid;
	border-collapse: collapse;
	border-width: 1px
}

table tr {
	border-style: solid;
	border-width: 1px;
}

table td {
	border-style: solid;
	border-width: 1px;
}

p.quebra {
	page-break-before: always;
}
</style>
<meta charset="utf-8">
<body>
<?php
$cpf_ant = 0;
foreach ( $resultado as $registro ) {
	// $registro = $resultado[0];
	$turma = $registro ['cNmTurma'];
	$aluno = $registro ['aluno_nome'];
	$nome = $registro ['cNome'];
	$rg = $registro ['resp_rg'];
	$cpf = str_pad ( $registro ['nCdPessoa'], 11, '0', STR_PAD_LEFT );
	$dtNasc = $registro ['dNasc'];
	$nacionalidade = $registro ['resp_nacionalidade'];
	$estado_civil = $registro ['resp_est_civ'];
	$cep = str_pad ( $registro ['nCEP'], 8, '0', STR_PAD_LEFT );
	$cep = substr ( $cep, 0, 5 ) . "-" . substr ( $cep, - 3 );
	$endereco = $registro ['cLogradouro'];
	$bairro = $registro ['cBairro'];
	$cidade = $registro ['cCidade'];
	$uf = $registro ['cUF'];
	
	if ($cpf != $cpf_ant) {
		
		?>
<h3><?php echo $turma?><br /><?php echo $aluno?></h3>
	<table>
		<tr>
			<td width=150px bgcolor='#dddddd'>Nome</td>
			<td colspan='5'><?php echo $nome?>			
		
		
		</tr>
		<tr>
			<td bgcolor='#dddddd'>RG</td>
			<td width=300px><?php echo $rg?></td>
			<td width=150px bgcolor='#dddddd'>CPF</td>
			<td colspan='3'><?php echo $cpf?></td>
		</tr>
		<tr>
			<td bgcolor='#dddddd'>Dt. Nasc</td>
			<td colspan='5'><?php echo $dtNasc?>			
		
		
		</tr>
		<tr>
			<td bgcolor='#dddddd'>Nacionalidade</td>
			<td><?php echo $nacionalidade?></td>
			<td bgcolor='#dddddd'>Est Civil</td>
			<td colspan='3'><?php echo $estado_civil?></td>
		</tr>
		<tr>
			<td bgcolor='#dddddd'>CEP</td>
			<td colspan='5'><?php echo $cep?>			
		
		
		</tr>
		<tr>
			<td bgcolor='#dddddd'>Endereço</td>
			<td colspan='5'><?php echo $endereco?>			
		
		
		</tr>
		<tr>
			<td bgcolor='#dddddd'>Bairro</td>
			<td><?php echo $bairro?></td>
			<td bgcolor='#dddddd'>Cidade</td>
			<td width=300px><?php echo $cidade?></td>
			<td width=50px bgcolor='#dddddd'>UF</td>
			<td width=50px><?php echo $uf?></td>
		</tr>
		<tr>
			<td colspan='6' bgcolor='#dddddd'><center>Telefones</center></td>
		</tr>		
		
			<?php
		$query_tel = "select distinct * from pessoa_telefone where nCdPessoa = $cpf";
		$telefones = consulta ( "athenas", $query_tel );
		for($i = 0; $i <= 9; $i ++) {
			if ($i < count ( $telefones )) {
				echo "<tr>";
				echo "<td>" . $telefones [$i] ['nDDD'] . "";
				echo "<td>" . $telefones [$i] ['nTelefone'] . "</td><td colspan='4'><INPUT TYPE='checkbox'/> Excluir</td>";
				echo "</tr>";
			} else {
				echo "<tr>
				    	<td>.</td>
				    	<td>.</td>
				    	<td colspan='4'>.</td>
				    	</tr>";
			}
		}
		?>		
	</table>
	<INPUT TYPE='checkbox' /> Desejo Renovar Matricula
	<br />
	<INPUT TYPE='checkbox' /> Não Desejo Renovar Matricula
	<h2>Atualizar</h2>
	<table>
		<tr>
			<td width=150px bgcolor='#dddddd'>Nome</td>
			<td colspan='5'>
		
		</tr>
		<tr>
			<td bgcolor='#dddddd'>RG</td>
			<td width=300px></td>
			<td width=150px bgcolor='#dddddd'>CPF</td>
			<td colspan='3'></td>
		</tr>
		<tr>
			<td bgcolor='#dddddd'>Dt. Nasc</td>
			<td colspan='5'>
		
		</tr>
		<tr>
			<td bgcolor='#dddddd'>Nacionalidade</td>
			<td></td>
			<td bgcolor='#dddddd'>Est Civil</td>
			<td colspan='3'></td>
		</tr>
		<tr>
			<td bgcolor='#dddddd'>CEP</td>
			<td colspan='5'>
		
		</tr>
		<tr>
			<td bgcolor='#dddddd'>Endereço</td>
			<td colspan='5'>
		
		</tr>
		<tr>
			<td bgcolor='#dddddd'>Bairro</td>
			<td></td>
			<td bgcolor='#dddddd'>Cidade</td>
			<td width=300px></td>
			<td width=50px bgcolor='#dddddd'>UF</td>
			<td width=50px></td>
		</tr>
	</table>
	<p class='quebra' />
		<?php
	
}
	$cpf_ant = $cpf;} ?>
</body>
</html>