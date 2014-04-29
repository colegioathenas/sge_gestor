<?php
include ("../verifica_logado.php");
ini_set ( "display_errors", 1 );
setlocale ( LC_ALL, NULL );
setlocale ( LC_ALL, 'pt_BR' );

require ("../config.php");
include_once "../bd.php";

$nCdPerfil = $_REQUEST ['codigo'] == "" ? $nCdPerfil : $_REQUEST ['codigo'];

$query_acesso = "SELECT * FROM acesso order by cGrupo, cNmAcesso";

$registros_acessos = consulta ( 'athenas', $query_acesso );

$acessos = array ();
foreach ( $registros_acessos as $acesso ) {
	$acessos [$acesso ["nCdAcesso"]] = $acesso;
}

$query_acesso_perfil = "select * from acesso_perfil where nCdPerfil = $nCdPerfil";
$registros_acesso_perfil = consulta ( "athenas", $query_acesso_perfil );

$acesso_perfil = array ();
foreach ( $registros_acesso_perfil as $reg_acesso_perfil ) {
	$acesso_perfil [$reg_acesso_perfil ['nCdAcesso']] = $reg_acesso_perfil;
}

?>


<table width='100%'>
    <?php
				$grupo_atual = "";
				foreach ( $registros_acessos as $acesso ) {
					
					if ($grupo_atual != $acesso ["cGrupo"]) {
						echo "<tr><td colspan='8' style='background-color:#ccc'>" . $acesso ["cGrupo"] . "</td></tr>";
						$grupo_atual = $acesso ["cGrupo"];
					}
					$tipo = $acesso ['cTpAcesso'] == "C" ? "Cadastro" : "Acesso";
					$tipo_e = $acesso ['cTpAcesso'] == "C" ? " disabled = 'disabled' " : "";
					$tipo_c = $acesso ['cTpAcesso'] == "E" ? " disabled = 'disabled' " : "";
					
					$visualizar = $acesso_perfil [$acesso ['nCdAcesso']] ["bVisualizar"] == 1 ? " checked = 'checked' " : "";
					$editar = $acesso_perfil [$acesso ['nCdAcesso']] ["bEditar"] == 1 ? " checked = 'checked' " : "";
					$incluir = $acesso_perfil [$acesso ['nCdAcesso']] ["bIncluir"] == 1 ? " checked = 'checked' " : "";
					$excluir = $acesso_perfil [$acesso ['nCdAcesso']] ["bExcluir"] == 1 ? " checked = 'checked' " : "";
					$acessar = $acesso_perfil [$acesso ['nCdAcesso']] ["bAcessar"] == 1 ? " checked = 'checked' " : "";
					
					$visualizar_valor = $acesso_perfil [$acesso ['nCdAcesso']] ["bVisualizar"] == true ? " valor='1' " : " valor='0'";
					$editar_valor = $acesso_perfil [$acesso ['nCdAcesso']] ["bEditar"] == true ? " valor='1' " : " valor='0'";
					$incluir_valor = $acesso_perfil [$acesso ['nCdAcesso']] ["bIncluir"] == true ? " valor='1' " : " valor='0'";
					$excluir_valor = $acesso_perfil [$acesso ['nCdAcesso']] ["bExcluir"] == true ? " valor='1' " : " valor='0'";
					$acessar_valor = $acesso_perfil [$acesso ['nCdAcesso']] ["bAcessar"] == true ? " valor='1' " : " valor='0'";
					
					echo "<tr>";
					echo "<td width='200px'>" . $acesso ['cNmAcesso'] . "</td>";
					echo "<td width='100px'>" . $tipo . "</td>";
					echo "<td width='100px'><input type='checkbox' $tipo_c $visualizar codigo='" . $acesso ['nCdAcesso'] . "' acao='visualizar' estado='O' $visualizar_valor /></td>";
					echo "<td width='100px'><input type='checkbox' $tipo_c $editar codigo='" . $acesso ['nCdAcesso'] . "' acao='editar' estado='O' $editar_valor /></td>";
					echo "<td width='100px'><input type='checkbox' $tipo_c $incluir codigo='" . $acesso ['nCdAcesso'] . "' acao='incluir' estado='O' $incluir_valor /></td  >";
					echo "<td width='100px'><input type='checkbox' $tipo_c $excluir codigo='" . $acesso ['nCdAcesso'] . "' acao='excluir'  estado='O' $excluir_valor /></td>";
					echo "<td width='100px'><input type='checkbox' $tipo_e $acessar codigo='" . $acesso ['nCdAcesso'] . "' acao='acessar' estado='O' $acessar_valor /></td>";
					echo "<td></td>";
					echo "</tr>";
				}
				?>
</table>
