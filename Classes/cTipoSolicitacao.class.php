<?php
require ("../config.php");
include_once "../bd.php";
include_once "../Util/gravar_comunicacao.php";
include_once "cPerfil.class.php";
class TipoSolicitacao {
	var $Codigo;
	var $Nome;
	var $Grupo;
	function __construct() {
		$this->Grupo = new Perfil ();
	}
	function load($codigo) {
		$query = "call loadTipoSolicitacao($codigo)";
		$resultado = consulta2 ( $query );
		
		$this->Codigo = $resultado [0] ['nCdTpSolicitacao'];
		$this->Nome = $resultado [0] ['cNmTpSolicitacao'];
		$this->Grupo->Codigo = $resultado [0] ['nCdGrupoDestino'];
	}
	function update() {
		$query = "call updateTipoSolicitacao(" . $this->Codigo . ",'" . $this->Nome . "'," . $this->Grupo->Codigo . ")";
		
		$resultado = consulta2 ( $query );
		$this->Codigo = $resultado [0] ['codigo'];
	}
	function lista($valor) {
		$query = "call listTipoSolicitacao('$valor')";
		
		$registros = consulta2 ( $query );
		
		$resultado = array ();
		foreach ( $registros as $registro ) {
			$item = new TipoSolicitacao ();
			$item->Codigo = $registro ['nCdTpSolicitacao'];
			$item->Nome = $registro ['cNmTpSolicitacao'];
			$item->Grupo->Codigo = $resultado ['nCdGrupoDestino'];
			
			$resultado [] = $item;
		}
		
		return $resultado;
	}
}
?>