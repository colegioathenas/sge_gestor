<?php
ini_set ( "display_errors", 1 );

require_once ('phpgmailer/class.phpgmailer.php');
require_once ("../config.php");
include_once "../bd.php";
include_once "gravar_comunicacao.php";

session_start ();

$email = $_REQUEST ['email'];
$codigo = $_REQUEST ['codigo'];
$chave = $_REQUEST ['chave'];

if ($chave == "") {
	
	$chave = md5 ( uniqid () );
	$query = "UPDATE titulos set cId = '$chave' where nCdBoleto = $codigo";
	
	consulta ( "athenas", $query );
}

try {
	$mail = new PHPGMailer ();
	// sistema.colegioathenas.com.br
	$mail->Mailer = 'smtp';
	$mail->Host = 'ssl://smtp.gmail.com';
	$mail->Port = 465;
	$mail->SMTPAuth = true;
	
	$mail->Username = 'cobranca@institutoathenas.net';
	$mail->Password = '85545386';
	$mail->From = 'cobranca@institutoathenas.net';
	$mail->FromName = 'Cobranca Athenas';
	$mail->Subject = 'Boleto';
	$mail->AddAddress ( $email );
	$mail->Body = "Para acessar o boleto utilize o link:

http://sistema.colegioathenas.com.br/Boleto/boleto_online.php?codigo=$codigo&chave=$chave

";
	if ($mail->Send ()) {
		grava_comunicacao ( $_SESSION ['cpf'], $_SESSION ['nCdUsuario'], 1, "Enviado Boleto (Cod. $codigo) por e-mail" );
		echo "Email enviado com Sucesso";
	}
} catch ( Exception $e ) {
	echo "Exceção pega: ", $e->getMessage (), "\n";
}

?>
