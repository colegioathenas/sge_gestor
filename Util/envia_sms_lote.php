<?php
include ('easy.curl.class.php');
require_once ("../config.php");
include_once "../bd.php";
include_once "../geral.php";
include_once "gravar_comunicacao.php";

$query = "
	SELECT distinct Pessoa.nCdPessoa,  cNome, nDDD,nTelefone  FROM titulos 
	   inner join Pessoa  on titulos.nCdPessoa = Pessoa.nCdPessoa
	   left join Pessoa_Telefone on Pessoa_telefone.nCdPessoa = Pessoa.nCdPessoa and (nTelefone like '9%' or nTelefone like '8%' or nTelefone like '7%')
 where (dVcto >= '2013-01-01'  and dVcto <= '2013-01-31')
   and dVcto < now()
   and TipDtOcorrencia is null 
   and CodOcorRetorno = '02'
   and nTelefone is not null
	and Pessoa.nCdPessoa != 55634901000127
		 and nTelefone != 995368464
   group by Pessoa.nCdPessoa,  cNome, nDDD,nTelefone 
			order by Pessoa.nCdPessoa";

$pessoas = consulta2 ( $query );

$curl = new cURL ();

foreach ( $pessoas as $pessoa ) {
	
	$cpf = $pessoa ['nCdPessoa'];
	$numero = "11" . $pessoa ['nTelefone'];
	$nome = substr ( $pessoa ['cNome'], 0, strpos ( $pessoa ['cNome'], " " ) );
	echo "Enviando sms para: $nome <br/>";
	if (strlen ( $numero ) >= 10) {
		$url = "http://webapi.comtele.com.br/api/api_fuse_connection.php?fuse=get_id&user=60697&pwd=instathenas";
		$id = trim ( $curl->get ( $url ) );
		
		$msg_modelo = ". Nao confirmamos seu(s) pagamento(s) com vcto em Jan/2013, entre em contato para regularizar sua situacao (11)4651-2729. Colegio Athenas";
		
		$msg = $nome . $msg_modelo;
		$msg = urlencode ( $msg );
		
		$url = "http://webapi.comtele.com.br/api/api_fuse_connection.php?fuse=send_msg&id=$id&from=1146512729&msg=$msg&number=$numero";
		
		$id = trim ( $curl->get ( $url ) );
		if ($id == 'true') {
			grava_comunicacao ( $cpf, $_SESSION ['nCdUsuario'], 1, "Enviado SMS para $numero. - Mensgem: $msg" );
			echo "Enviado com sucesso! <br/>";
		} else {
			echo "Erro para $nome (CPF: $cpf). Erro = $id<br/>";
		}
	}
}

?>