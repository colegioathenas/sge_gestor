<?php
// ini_set( "display_errors", 1);
require ("../config.php");
include_once "../bd.php";
include_once "../Util/gravar_comunicacao.php";
include_once "TSqlSelect.class.php";
include_once "cPefil.class.php";
class Setor {
	var $Codigo;
	var $Nome;
	function __construct() {
	}
	function load($codigo) {
		$query = "call loadSetor($codigo)";
		$resultado = consulta2 ( $query );
		
		$this->Codigo = $resultado [0] ['nCdSetor'];
		$this->Nome = $resultado [0] ['cNmSetor'];
	}
	function update() {
		$query = "call updateSetor(" . $this->Codigo . ",'" . $this->Nome . "')";
		
		$resultado = consulta2 ( $query );
		$this->Codigo = $resultado [0] ['codigo'];
	}
	function lista($valor) {
		$query = "call listSetor('$valor')";
		
		$registros = consulta2 ( $query );
		
		$resultado = array ();
		foreach ( $registros as $registro ) {
			$set = new Setor ();
			$set->Codigo = $registro ['nCdSetor'];
			$set->Nome = $registro ['cNmSetor'];
			
			$resultado [] = $set;
		}
		
		return $resultado;
	}
	function interface_consulta() {
		$page_title = "Setor [Consulta]";
		$url_consulta = '../Classes/setor.class.php';
		$page_tab_icon = 'aluno_icon.png';
		$page_tab_text = 'Consulta Setor';
		include '../Interface/consulta.php';
	}
	function interface_detalhe() {
	}
}

?>