<?php
include "cCurso.class.php";
ini_set ( "display_errors", 1 );
class Turma {
	var $Codigo;
	var $Nome;
	var $Curso;
	function __construct() {
		$this->Curso = new Curso ();
	}
}
?>