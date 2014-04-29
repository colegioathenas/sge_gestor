<?php
include_once "pessoa_funcoes.php";
$rm = $_REQUEST ['rm'];
$nome = $_REQUEST ['nome'];
$endereco = $_REQUEST ['endereco'];
$complemento = $_REQUEST ['complemento'];
$cep = $_REQUEST ['cep'];
$cidade = $_REQUEST ['cidade'];
$bairro = $_REQUEST ['bairro'];
$uf = $_REQUEST ['uf'];
$rg = $_REQUEST ['rg'];
$cpf = $_REQUEST ['cpf'];
$datanascimento = $_REQUEST ['dtnasc'];
$naturalidade = $_REQUEST ['naturalidade'];
$naturalidadeUF = $_REQUEST ['naturalidadeUF'];
$nacionalidade = $_REQUEST ['nacionalidade'];
$email = $_REQUEST ['email'];
$pai = $_REQUEST ['pai'];
$mae = $_REQUEST ['mae'];
$respfin = $_REQUEST ['respfin'];
$profissao = $_REQUEST ['profissao'];
$estadocivil = $_REQUEST ['estciv'];
$cepcom = $_REQUEST ['cepcom'];
$endcom = $_REQUEST ['endcom'];
$bairrocom = $_REQUEST ['bairrocom'];
$cidadecom = $_REQUEST ['cidadecom'];
$ufcom = $_REQUEST ['ufcom'];
$codigo = $_REQUEST ['codigo'];

atualiza_pessoa ( $rm, $nome, $endereco, $complemento, $cep, $cidade, $bairro, $uf, $rg, $cpf, $datanascimento, $naturalidade, $naturalidadeUF, $nacionalidade, $email, $pai, $mae, $respfin, $profissao, $estadocivil, $cepcom, $endcom, $bairrocom, $cidadecom, $ufcom, $codigo );
?>


