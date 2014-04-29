<?php
ini_set ( "display_errors", 0 );
include ("../verifica_logado.php");
require ("../config.php");
include_once "../bd.php";
session_start ();
setlocale ( LC_TIME, 'ptb', 'pt_BR', 'portuguese-brazil', 'bra', 'brazil', 'pt_BR.utf-8', 'pt_BR.iso-8859-1', 'br' );
$consulta = $_REQUEST ['consulta'];
$param1 = $_REQUEST ['param1'];
$param2 = $_REQUEST ['param2'];

if ($consulta == 'cursos_tecnicos') {
	$query = "Select nCdCurso,cNmCurso from Cursos where cTpCurso = 'T'";
	$resultado_sql = consulta ( 'athenas', $query );
	echo "<option value='0'>Selecione</option>";
	foreach ( $resultado_sql as $registro ) {
		echo "<option value='" . $registro ['nCdCurso'] . "'>" . $registro ['cNmCurso'] . "</option>";
	}
}

if ($consulta == 'cursos_regular') {
	$query = "Select nCdCurso,cNmCurso from Cursos where cTpCurso = 'R' and nCdCurso in (select nCdCurso from turma where ( dInicio > CURDATE() or dFim > CURDATE()));";
	$resultado_sql = consulta ( 'athenas', $query );
	echo "<option value='0'>Selecione</option>";
	foreach ( $resultado_sql as $registro ) {
		echo "<option value='" . $registro ['nCdCurso'] . "'>" . $registro ['cNmCurso'] . "</option>";
	}
}

if ($consulta == 'professor_disciplina') {
	$query = "select nCdPessoa, cNome 
  from professor_disciplina 
       inner join pessoa on pessoa.nCdPessoa = professor_disciplina.nCPF
       where nCdDisciplina = $param1";
	$resultado_sql = consulta ( 'athenas', $query );
	echo "<option value='0'>Selecione</option>";
	foreach ( $resultado_sql as $registro ) {
		echo "<option value='" . $registro ['nCdPessoa'] . "'>" . $registro ['cNome'] . "</option>";
	}
}

if ($consulta == 'cursos') {
	if ($param1 == "0") {
		$param1 = date ( "Ym" );
	}
	
	$mes = substr ( $param1, - 2 );
	$ano = substr ( $param1, 0, 4 );
	
	$usuario = $_SESSION ['nCdUsuario'];
	$query = "select distinct cursos.nCdCurso, cursos.cNmCurso
				  from calendario 
				 	   inner join usuario on calendario.nCdProfessor = usuario.nCPF
				 	   inner join turma on calendario.nCdTurma = turma.nCdTurma
				 	   inner join cursos on turma.nCdCurso = cursos.nCdCurso
				 where usuario.nCdUsuario = $usuario
				   and MONTH(dCalendario) = $mes
				   and YEAR(dCalendario) = $ano;";
	$resultado_sql = consulta ( 'athenas', $query );
	echo "<option value='0'>Selecione</option>";
	if (count ( $resultado_sql ) == 1) {
		echo "<option value='" . $resultado_sql [0] ['nCdCurso'] . "' selected>" . $resultado_sql [0] ['cNmCurso'] . "</option>";
	} else {
		
		foreach ( $resultado_sql as $registro ) {
			
			echo "<option value='" . $registro ['nCdCurso'] . "'>" . $registro ['cNmCurso'] . "</option>";
		}
	}
}

if ($consulta == 'turmas') {
	$mes = substr ( $param1, - 2 );
	$ano = substr ( $param1, 0, 4 );
	
	$usuario = $_SESSION ['nCdUsuario'];
	
	$query = "select distinct turma.nCdTurma, turma.cNmTurma, turma.cTurno
				  from calendario 
				 	   inner join usuario on calendario.nCdProfessor = usuario.nCPF
				 	   inner join turma on calendario.nCdTurma = turma.nCdTurma
				 where usuario.nCdUsuario = $usuario
				   and MONTH(dCalendario) = $mes
				   and YEAR(dCalendario) = $ano
				   and turma.nCdCurso = $param2;";
	$resultado_sql = consulta ( 'athenas', $query );
	echo "<option value='0'>Selecione</option>";
	if (count ( $resultado_sql ) == 1) {
		echo "<option value='" . $resultado_sql [0] ['nCdTurma'] . "' turno='" . $resultado ['cTurno'] . "' selected>" . $resultado_sql [0] ['cNmTurma'] . "</option>";
	} else {
		foreach ( $resultado_sql as $registro ) {
			echo "<option value='" . $registro ['nCdTurma'] . "'>" . $registro ['cNmTurma'] . "</option>";
		}
	}
}

if ($consulta == 'turmas_curso') {
	$mes = substr ( $param1, - 2 );
	$ano = substr ( $param1, 0, 4 );
	
	$usuario = $_SESSION ['nCdUsuario'];
	
	$query = "select nCdTurma, cNmTurma,cTurno from turma where nCdCurso = $param1";
	$resultado_sql = consulta ( 'athenas', $query );
	echo "<option value='0'>Selecione</option>";
	if (count ( $resultado_sql ) == 1) {
		echo "<option value='" . $resultado_sql [0] ['nCdTurma'] . "' turno='" . $resultado_sql [0] ['cTurno'] . "' selected>" . $resultado_sql [0] ['cNmTurma'] . "</option>";
	} else {
		foreach ( $resultado_sql as $registro ) {
			echo "<option value='" . $registro ['nCdTurma'] . "' turno='" . $registro ['cTurno'] . "'>" . $registro ['cNmTurma'] . "</option>";
		}
	}
}

if ($consulta == 'disciplina') {
	$mes = substr ( $param1, - 2 );
	$ano = substr ( $param1, 0, 4 );
	
	$usuario = $_SESSION ['nCdUsuario'];
	
	$query = "select distinct disciplina.nCdDisciplina, disciplina.cNmDisciplina
				  from calendario 
				 	   inner join usuario on calendario.nCdProfessor = usuario.nCPF
				 	   inner join disciplina on disciplina.nCdDisciplina = calendario.nCdDisciplina
				 where usuario.nCdUsuario = $usuario
				   and MONTH(dCalendario) = $mes
				   and YEAR(dCalendario) = $ano
				   and nCdTurma = $param2;";
	$resultado_sql = consulta ( 'athenas', $query );
	echo "<option value='0'>Selecione</option>";
	if (count ( $resultado_sql ) == 1) {
		echo "<option value='" . $resultado_sql [0] ['nCdDisciplina'] . "' selected>" . $resultado_sql [0] ['cNmDisciplina'] . "</option>";
	} else {
		foreach ( $resultado_sql as $registro ) {
			echo "<option value='" . $registro ['nCdDisciplina'] . "'>" . $registro ['cNmDisciplina'] . "</option>";
		}
	}
}
if ($consulta == 'mes') {
	
	list ( $mes, $ano ) = explode ( "/", date ( "m/Y" ) );
	
	echo "<option value='" . date ( "Ym", mktime ( 0, 0, 0, $mes - 1, 1, $ano ) ) . "'>" . strftime ( "%B/%Y", mktime ( 0, 0, 0, $mes - 1, 1, $ano ) ) . "</option>";
	echo "<option value='" . date ( "Ym", mktime ( 0, 0, 0, $mes, 1, $ano ) ) . "' selected>" . strftime ( "%B/%Y", mktime ( 0, 0, 0, $mes, 1, $ano ) ) . "</option>";
	echo "<option value='" . date ( "Ym", mktime ( 0, 0, 0, $mes + 1, 1, $ano ) ) . "'>" . strftime ( "%B/%Y", mktime ( 0, 0, 0, $mes + 1, 1, $ano ) ) . "</option>";
}

if ($consulta == 'disciplina_turma') {
	
	$query_disciplinas = "select disciplina.nCdDisciplina
                                            , disciplina.cNmDisciplina
                                         from turma 
                                              inner join matriz_disciplina on turma.nCdMatriz = matriz_disciplina.nCdMatriz
                                              inner join disciplina on disciplina.nCdDisciplina = matriz_disciplina.nCdDisciplina
                                       where nCdTurma = $param1";
	$disciplinas = consulta ( "athenas", $query_disciplinas );
	echo "<option value='0'>Selecione</option>";
	foreach ( $disciplinas as $disciplina ) {
		$disciplina_cod = $disciplina ['nCdDisciplina'];
		$disciplina_txt = $disciplina ['cNmDisciplina'];
		echo "<option value='$disciplina_cod'>$disciplina_txt</option>";
	}
}

?>