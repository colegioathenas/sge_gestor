<?php
include_once "verifica_logado.php";
function envia_email($email, $assunto, $mensagem, $cpf, $comunicacao) {
	require_once ('phpgmailer/class.phpgmailer.php');
	require_once ("../config.php");
	include_once "../bd.php";
	include_once "gravar_comunicacao.php";
	
	$ret = "";
	try {
		$mail = new PHPGMailer ();
		// sistema.colegioathenas.com.br
		$mail->Mailer = 'smtp';
		$mail->Host = 'ssl://smtp.gmail.com';
		$mail->Port = 465;
		$mail->SMTPAuth = true;
		$mail->Username = 'atendimento@colegioathenas.com.br';
		$mail->Password = 'senha123';
		$mail->From = 'atendimento@institutoathenas.net';
		$mail->FromName = 'Atendimento Athenas';
		$mail->Subject = $assunto;
		$mail->AddAddress ( $email );
		$mail->Body = $mensagem;
		
		if ($mail->Send ()) {
			grava_comunicacao ( $cpf, $_SESSION ['nCdUsuario'], 1, $comunicacao );
			$ret = "Email enviado com Sucesso";
		}
	} catch ( Exception $e ) {
		$ret = "Exceção: " . $e->getMessage () . "\n";
	}
	
	return $ret;
}

?>
