<script src="/js/jquery.dropdownPlain.js"></script>
<link rel="stylesheet" href="/css/menu.css" type="text/css"
	media="screen, projection" />
<div
	style="display: inline-block; background-color: #666666; z-index: 999; width: 100%">
 <?php
	session_start ();
	if (($_SESSION ['RHCADFUN'] == "00001") || ($_SESSION ['RHREP'] == "00001")) {
		$mostra_rh = true;
	}
	
	if (($_SESSION ['CNTMOV'] == "00001") || ($_SESSION ['CNTCONT'] == "00001") || ($_SESSION ['CTBIMPOFX'] == "00001") || ($_SESSION ['CTBCONCI'] == "00001")
		//CTBCONCI
	  ){) 

		$mostra_cnt = true;
	}
	
	if (($_SESSION ['COBACORDO'] == "00001") || ($_SESSION ['RELCARTCOBL'] == "00001") || ($_SESSION ['RELCARTCOB'] == "00001") || ($_SESSION ['RELINA'] == "00001")) {
		$mostra_cob = true;
	}
	
	if (($_SESSION ['RELINA'] == "00001") || ($_SESSION ['RELPREV'] == "00001") || ($_SESSION ['RELTITBX'] == "00001")) {
		$mostra_fin_rel = true;
	}
	
	if (($_SESSION ['FININCTIT'] == "00001") || ($_SESSION ['FINCARNE'] == "00001") || ($_SESSION ['FINBXTIT'] == "00001") || ($_SESSION ['FINAJTIT'] == "00001")) 

	{
		$mostra_fin_bol = true;
	}
	
	if (($mostra_fin_rel == true) || ($mostra_fin_rel == true) || ($_SESSION ['FINRET'] == "00001")) {
		$mostra_fin = true;
	}
	
	if (($_SESSION ['RELINA'] == "00001") || ($_SESSION ['RELCARTCOB'] == "00001") || ($_SESSION ['RELCARTCOBL'] == "00001") || ($_SESSION ['COBACORDO'] == "00001")) {
		$mostra_cob = true;
	}
	
	if (($_SESSION ['SECREMAT'] == "00001") || ($_SESSION ['SECMAT'] == "00001") || ($_SESSION ['SECLSTVAGA'] == "00001") || ($_SESSION ['CTBIMPOFX'] == "00001")) 

	{
		$mostra_sec = true;
	}
	
	if (($_SESSION ['CADGER'] [4] == "1")) {
		$mostra_cad = true;
	}
	
	if (($_SESSION ['ACCADCURSO'] == "00001") || ($_SESSION ['ACCADPROF'] == "00001") || ($_SESSION ['ACCADMATRIZ'] == "00001")) 

	{
		$mostra_aca = true;
	}
	
	if (($_SESSION ['ACGRDHRREG'] == "00001") || ($_SESSION ['ACGRDHRTEC'] == "00001")) 

	{
		$mostra_grd = true;
	}
	
	if (($_SESSION ['SOLINC'] == "00001") || ($_SESSION ['SOLCNS'] == "00001")) 

	{
		$mostra_sol = true;
	}
	if (($_SESSION ['INTVENCEEXTNOTA'] == "00001")) 

	{
		$mostra_int = true;
	}
	if (($_SESSION ['INTVENCEEXTNOTA'] == "00001")) 

	{
		$mostra_int_vence = true;
	}
	
	echo "<ul class=\"dropdown\">
                <li><a href=\"/index.php\">Painel</a>";
	echo "<li><a href=\"\">Seguranca</a>
	  		  	<ul class=\"sub_menu\">";
	echo "		<li><a href=\"/Acesso/alterar_senha.php\">Alterar Senha</a></li>";
	if ($_SESSION ['ACCADUSU'] == "00001") {
		echo "		<li><a href=\"/Acesso/controle_usuario.php\">Gerenciar Usuario</a>
	        			<ul>
	        				<li><a href=\"/Acesso/cadastro_usuario.php?codigo=0\">Incluir</a></li>
	        			</ul>
	        		</li>";
	}
	echo "	</ul>
		  	  </li>";
	
	// ************************* CADASTRO **************************** //
	
	if ($mostra_cad == true) {
		echo "<li><a href=\"\">Cadastro</a>
	  		  	<ul class=\"sub_menu\">";
	}
	if ($_SESSION ['CADGER'] [4] == "1") {
		echo "<li><a href=\"/Pessoa/consultar.php\">Consultar</a></li>";
	}
	
	if ($mostra_cad == true) {
		echo "	</ul>
			  </li>";
	}
	// ************************* CADASTRO **************************** //
	
	// ************************* A C A D E M I C O *************************//
	if ($mostra_aca == true) {
		echo "<li><a href=\"\">Academico</a>
	  		  	<ul class=\"sub_menu\">";
	}
	if ($_SESSION ['ACCADCURSO'] == "00001") {
		echo "<li><a href=\"/Academico/cursos.php\">Cursos</a></li>";
	}
	if ($_SESSION ['ACCADPROF'] == "00001") {
		echo "<li><a href=\"/Academico/professor_consultar.php\">Professores</a>
			  <ul>
                 <li><a href=\"/Academico/professor_detalhe.php?cpf=0\">Incluir</a></li>
              </ul>
		
		</li>";
	}
	if ($_SESSION ['ACCADMATRIZ'] == "00001") {
		echo "<li><a href=\"/Academico/matriz_consultar.php\">Matriz Curricular</a>
                <ul>
                    <li><a href=\"/Academico/matriz_detalhe.php?codigo=0\">Incluir</a></li>
                </ul>
             </li>";
	}
	if ($mostra_grd == true) {
		echo "<li><a href=\"/Academico/matriz_consultar.php\">Grade Hor&aacute;ria</a>            
                <ul class=\"sub_menu\">";
	}
	if ($_SESSION ['ACGRDHRTEC'] == "00001") {
		echo "<li><a href=\"/Academico/grade_regular.php\">Regular</a></li>";
	}
	if ($_SESSION ['ACGRDHRREG'] == "00001") {
		echo "<li><a href=\"/Academico/calendario.php\">Tecnico</a></li>";
	}
	if ($mostra_grd == true) {
		echo "</ul>
             </li>";
	}
	
	if ($_SESSION ['ACCALENDARIO'] == "00001") {
		
		echo "<li><a href=\"/Academico/calendario.php\">Calendario</a></li>";
	}
	if ($_SESSION ['ACTURMA'] == "00001") {
		echo "<li><a href=\"/Academico/turma.php\">Turma</a></li>";
	}
	if ($_SESSION ['ACBOLETIM'] == "00001") {
		echo "<li><a href=\"/Academico/boletim.php\">Boletim</a></li>";
	}
	
	if ($_SESSION ['ACLSTREC'] == "00001") {
		echo "<li><a href=\"/Academico/lista_recuperacao.php\">Lista de Recuperação</a></li>";
	}
	
	if ($_SESSION ['ACRESFN'] == "00001") {
		echo "<li><a href=\"/Academico/resultado_final.php\">Resultado Final</a></li>";
	}
	
	if ($_SESSION ['ACCONS'] == "00001") {
		echo "<li><a href=\"/Academico/concelho.php\">Conselho Final</a></li>";
	}
	
	if ($mostra_aca == true) {
		echo "	</ul>
			  </li>";
	}
	
	// ************************ A C A D E M I C O ************************ //
	
	// ************************* SECRETARIA **************************** //
	
	if ($mostra_sec == true) {
		echo "<li><a href=\"\">Secretaria</a>
	  		  	<ul class=\"sub_menu\">";
	}
	
	if ($_SESSION ['SECMAT'] == "00001") {
		echo "<li><a href=\"/Secretaria/matricula.php\">Matricula</a></li>";
	}
	if ($_SESSION ['SECREMAT'] == "00001") {
		echo "<li><a href=\"/Secretaria/rematricula.php\">Rematricula</a></li>";
	}
	if ($_SESSION ['SECLSTVAGA'] == "00001") {
		echo "<li><a href=\"/Secretaria/lista_vagas.php\">Lista de Vagas</a></li>";
	}
	
	if ($mostra_sec == true) {
		echo "	</ul>
			  </li>";
	}
	// ************************* SECRETARIA **************************** //
	// ************************* FINANCEIRO **************************** //
	
	if ($mostra_fin == true) {
		echo "<li><a href=\"\">Financeiro</a>
	  		  	<ul class=\"sub_menu\">";
	}
	if ($mostra_fin_bol == true) {
		echo "<li><a href=\"\">Boleto</a>
	  		  	<ul class=\"sub_menu\">";
	}
	if ($_SESSION ['FININCTIT'] == "00001") {
		echo "<li><a href=\"/Financeiro/titulo.php\">Novo Boleto</a></li>";
	}
	if ($_SESSION ['FINCARNE'] == "00001") {
		echo "<li><a href=\"/Financeiro/carne.php\">Imprime Carne</a></li>";
	}
	if ($_SESSION ['FINBXTIT'] == "00001") {
		echo "<li><a href=\"/Financeiro/baixa.php\">Baixar</a></li>";
	}
	if ($_SESSION ['FINAJTIT'] == "00001") {
		echo "<li><a href=\"/Financeiro/ajuste_boleto.php\">Ajustar Boleto</a></li>";
	}
	
	if ($mostra_fin_bol == true) {
		echo "	</ul>
			  </li>";
	}
	
	if ($mostra_fin_rel == true) {
		echo "<li><a href=\"\">Relatorios</a>
	  		  	<ul class=\"sub_menu\">";
	}
	if ($_SESSION ['RELINA'] == "00001") {
		echo "<li><a href=\"/Relatorio/inadimplencia.php\">Relatorio de Inadimplencia</a></li>";
	}
	if ($_SESSION ['RELPREV'] == "00001") {
		echo "<li><a href=\"/Relatorio/prev.php\">Previsao de Recebimento</a></li>";
	}
	if ($_SESSION ['RELTITBX'] == "00001") {
		echo "<li><a href=\"/Relatorio/titulos_baixados.php\">Titulos Baixados</a></li>";
	}
	// ( $_SESSION['RELTITBX'] == "00001" )
	
	if ($mostra_fin_rel == true) {
		echo "	</ul>
			  </li>";
	}
	
	if ($_SESSION ['FINRET'] == "00001") {
		echo "<li><a href=\"/Financeiro/enviar_arquivo_retorno.php\">Capturar Retorno</a></li>";
	}
	if ($_SESSION ['FINLIBREST'] == "00001") {
		echo "<li><a href=\"/Financeiro/liberar_restricao.php\">Liberar Restricao</a></li>";
	}
	if ($mostra_fin == true) {
		echo "	</ul>
			  </li>";
	}
	
	// ************************* FINANCEIRO **************************** //
	
	// ************************* COBRANCA **************************** //
	
	if ($mostra_cob == true) {
		echo "<li><a href=\"\">Cobranca</a>
	  		  	<ul class=\"sub_menu\">";
	}
	if ($_SESSION ['RELINA'] == "00001") {
		echo "<li><a href=\"/Relatorio/inadimplencia.php\">Relatorio de Inadimplencia</a></li>";
	}
	if ($_SESSION ['RELCARTCOB'] == "00001") {
		echo "<li><a href=\"/Relatorio/carta_cobranca.php\">Carta de Cobranca</a></li>";
	}
	if ($_SESSION ['RELCARTCOBL'] == "00001") {
		echo "<li><a href=\"/Relatorio/carta_cobranca_lote.php\">Carta de Cobranca - Lote</a></li>";
	}
	if ($_SESSION ['COBACORDO'] == "00001") {
		echo "<li><a href=\"/Cobranca/acordo_consultar.php\">Acordo</a>
		  	<ul class=\"sub_menu\">
				<li><a href=\"/Cobranca/acordo.php\">Novo Acordo</a>
			</ul>
		  </li>";
	}
	
	if ($mostra_cob == true) {
		echo "	</ul>
			  </li>";
	}
	// ************************* COBRANCA **************************** //
	
	// ************************* CONTABILIDADE **************************** //
	
	if ($mostra_cnt == true) {
		echo "<li><a href=\"\">Contabilidade</a>
	  		  	<ul class=\"sub_menu\">";
	}
	if ($_SESSION ['CNTMOV'] == "00001") {
		echo "<li><a href=\"/Relatorio/inadimplencia.php\">Movimentacao</a></li>";
	}
	if ($_SESSION ['CNTCONT'] == "00001") {
		echo "<li><a href=\"/Relatorio/carta_cobranca.php\">Cadastro de Contas</a></li>";
	}
	// CTBCONCI
	if ($_SESSION ['CTBIMPOFX'] == "00001") {
		echo "<li><a href=\"/Contabilidade/conciliacao.php\">Concilia&ccedil;&atilde;o Bancaria</a></li>";
	}
	if ($_SESSION ['CTBIMPOFX'] == "00001") {
		echo "<li><a href=\"/Contabilidade/importarofx.php\">Importar OFX</a></li>";
	}
	if ($mostra_cnt == true) {
		echo "	</ul>
			  </li>";
	}
	// ************************* CONTABILIDADE **************************** //
	// ************************* RECURSOS HUMANOS ************************* //
	
	if ($mostra_rh == true) {
		echo "<li><a href=\"\">RH</a>
	  		  	<ul class=\"sub_menu\">";
	}
	if ($_SESSION ['RHCADFUN'] == "00001") {
		echo "<li><a href=\"\">Cadastro de Funcionario</a></li>";
	}
	if ($_SESSION ['RHCADHOR'] == "00001") {
		echo "<li><a href=\"\">Cadastro de Horário</a></li>";
	}
	if ($_SESSION ['RHCADESC'] == "00001") {
		echo "<li><a href=\"\">Cadastro de Escala</a></li>";
	}
	if ($_SESSION ['RHCADEMP'] == "00001") {
		echo "<li><a href=\"\">Cadastro de Empresa</a></li>";
	}
	
	if ($mostra_rh == true) {
		echo "	</ul>
			  </li>";
	}
	// ************************* RECURSOS HUMANOS **************************** //
	// ************************* SOLICITAÇÃO / PROTOCOLO ************************* //
	
	if ($mostra_sol == true) {
		echo "<li><a href=\"\">Solicitação</a>
	<ul class=\"sub_menu\">";
	}
	if ($_SESSION ['SOLINC'] == "00001") {
		echo "<li><a href=\"/Solicitacao/solicitacao.php\">Incluir Solicitação</a></li>";
	}
	if ($_SESSION ['SOLCNS'] == "00001") {
		echo "<li><a href=\"/Solicitacao/consulta.php\">Consultar Solicitação</a></li>";
	}
	
	if ($mostra_sol == true) {
		echo "	</ul>
	</li>";
	}
	// ************************* SOLICITAÇÃO / PROTOCOLO **************************** //
	// ************************* CADASTRO **************************** //
	
	if ($mostra_int == true) {
		echo "<li><a href=\"\">Integrações</a>
	  		  	<ul class=\"sub_menu\">";
	}
	if ($mostra_int_vence == true) {
		echo "<li><a href=\"\">VENCE</a>
	  		  	<ul class=\"sub_menu\">";
	}
	if ($_SESSION ['INTVENCEEXTNOTA'] [4] == "1") {
		echo "<li><a href=\"/IntegracaoVence/extrair_notas.php\">Extrair Notas</a></li>";
	}
	if ($mostra_int_vence == true) {
		echo "	</ul>
			  </li>";
	}
	
	if ($mostra_int == true) {
		echo "	</ul>
			  </li>";
	}
	// ************************* CADASTRO **************************** //
	echo "<li><a href=\"/logout.php\">Sair</a>";
	echo "</ul>";
	?>
 

		
</div>
