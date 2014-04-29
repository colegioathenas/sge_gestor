
<label id="nCdPessoa_label" style="margin-top: 5px">CPF</label>
<input id="nCdPessoa" type="text" size='21'
	value='<?php echo str_pad( $registro['nCPF'],11,"0",STR_PAD_LEFT); ?>' />
<label style="margin-top: 5px; width: 22px; margin-left: 15px">RG</label>
<input id="rg" name='rg' type="text" size='20'
	value='<?php echo $registro['cRG']; ?>' />
<?php

if ($_SESSION ['CADSISCON'] == "00001") {
	echo "<a href=\"\" id='consultas_login'>[Sistemas de Consulta]</a>";
}
?>
<br />
<label style="margin-top: 5px">Nome</label>
<input id="nome" name="nome" type="text" size='50'
	value='<?php echo $registro['cNome']; ?>' />
<br />
<label style="margin-top: 5px">Dt. Nasc.</label>
<input id="dt_nasc" name="nome" type="text" size='20'
	value='<?php echo date("d/m/Y",strtotime($registro['dNasc'])); ?>' />
<br />
<label style="margin-top: 5px">Naturalidade</label>
<input id="naturalidade" name="nome" type="text" size='39'
	value='<?php echo $registro['cNaturalidade']; ?>' />
<label style="margin-top: 5px; margin-left: 10px; width: 20px">UF</label>
<input id="naturalidade_uf" name="uf" type="text" size='3'
	value='<?php echo $registro['cNaturalidadeUf']; ?>' />
<br />
<label style="margin-top: 5px">Nacionalidade</label>
<input id="nacionalidade" name="nome" type="text" size='39'
	value='<?php echo $registro['cNacionalidade']; ?>' />
<br />
<label style="margin-top: 5px">Profissao</label>
<input id="profissao" name="nome" type="text" size='20'
	value='<?php echo $registro['cProfissao']; ?>' />

<label style="margin-top: 5px" id="estcivil">Estado Civil</label>
<select>
	<option value="0">SELECIONE</option>
	<option value="1">SOLTEIRO(A)</option>
	<option value="2">CASADO(A)</option>
	<option value="3">DIVORCIADO(A)</option>
	<option value="4">VIUVO(A)</option>
</select>
<br />
<label style="margin-top: 5px">Pai</label>
<input id="pai" name="nome" type="text" size='50'
	value='<?php echo $registro['cFiliacaoPai']; ?>' />
<br />
<label style="margin-top: 5px">Mae</label>
<input id="mae" name="nome" type="text" size='50'
	value='<?php echo $registro['cFiliacaoMae']; ?>' />
<br />
<label style="margin-top: 5px">Resp. Fin.</label>
<input id="resp_financeiro" name="nome" type="text" size='20'
	value='<?php echo str_pad( $registro['nCdRespFin'],11,"0",STR_PAD_LEFT); ?>' />
<a href="cadastro.php?cpf=<?php echo $registro['nCdRespFin'];?>"> <input
	id="resp_financeiro_nome" name="nome" type="text" size='30'
	value='<?php echo $registro['cNmRespFin']; ?>' readonly="readonly" /></a>
<br />
<label style="margin-top: 5px">Email</label>
<input id="email" name="nome" type="text" size='50'
	value='<?php echo $registro['cEmail']; ?>' />
<a href="#" class='sbtn2' id="btnEnviarSenha">Enviar Senha</a>
<br />
<div class="divisao">Endereço Residencial</div>
<label style="margin-top: 5px">CEP</label>
<input id="cep" name="cep" type="text" size='10'
	value='<?php echo str_pad( $registro['nCEP'],8,"0",STR_PAD_LEFT); ?>' />
<br />
<label style="margin-top: 5px">Endereco</label>
<input id="endereco" name="endereco" size='50' type="text"
	value='<?php echo $registro['cLogradouro']; ?>' />

<label style="margin-top: 5px">Complemento</label>
<input id="endereco_complemento" name="endereco_complemento" size='10'
	type="text" value='<?php echo $registro['cComplemento']; ?>' />
<br />
<label style="margin-top: 5px">Bairro</label>
<input id="bairro" name="bairro" type="text" size='30'
	value='<?php echo $registro['cBairro']; ?>' />

<label style="margin-top: 5px">Cidade</label>
<input id="cidade" name="cidade" type="text" size='30'
	value='<?php echo $registro['cCidade']; ?>' />

<label style="margin-top: 5px; margin-left: 26px; width: 20px">UF</label>
<input id="uf" name="uf" type="text" size='3'
	value='<?php echo $registro['cUF']; ?>' />
<div class="divisao">Endereço Comercial</div>
<label style="margin-top: 5px">CEP</label>
<input id="cep_com" name="cep" type="text" size='10'
	value='<?php echo str_pad( $registro['cEnd_com_cep'],8,"0",STR_PAD_LEFT); ?>' />
<br />
<label style="margin-top: 5px">Endereco</label>
<input id="endereco_com" name="endereco" size='50' type="text"
	value='<?php echo $registro['cEnd_com_end']; ?>' />
<!--
							<label  style="margin-top:5px">Complemento</label>
							<input id="endereco_complemento" name="endereco_complemento" size='10' type="text" value='<?php echo $registro['cComplemento']; ?>'/>
							-->
<br />
<label style="margin-top: 5px">Bairro</label>
<input id="bairro_com" name="bairro" type="text" size='30'
	value='<?php echo $registro['cEnd_com_bairro']; ?>' />

<label style="margin-top: 5px">Cidade</label>
<input id="cidade_com" name="cidade" type="text" size='30'
	value='<?php echo $registro['cEnd_com_cidade']; ?>' />

<label style="margin-top: 5px; margin-left: 26px; width: 20px">UF</label>
<input id="uf_com" name="uf" type="text" size='3'
	value='<?php echo $registro['cEnd_com_uf']; ?>' />


<br />
<div class='divisao'>Telefones</div>
<input size="6" name='ddd' id='ddd' />
<input size="14" name='telefone' id='telefone' />
<a href="" id='incluir_tel'>[Incluir]</a>



<table>
	<tr style="background-color: black; color: white">
		<td width="50px">DDD</td>
		<td width="150px">Telefone</td>
	</tr>
</table>
<div id='telefone' style='height: 150px; width: 210px; overflow-y: auto'>
	<table id="telefones"></table>
</div>
