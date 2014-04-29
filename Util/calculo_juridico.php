<?php

/*
 * To change this template, choose Tools | Templates and open the template in the editor.
 */

/*
 * descricao=Teste&mes=4&ano=2013&categoria=1&indice=3&jcjuro=2&jcperiodojuro=m&jccapitalizacao=s&jcdata=&jcvencto=S&jmjuro=0%2C00&jmperiodojuro=m&jmcapitalizacao=l&jmdata=&jmvencto=s&jmsobrejc=S&multa=10&honorario=10&tipohonorario=percentual&qt1=6&item1=1&dia1=01/11/2012&valor1=358&descri1=teste&tipoparcela1=1&item2=2&dia2=01/12/2012&valor2=358&descri2=teste&tipoparcela2=1&item3=3&dia3=01/01/2013&valor3=358&descri3=teste&tipoparcela3=1&item4=4&dia4=01/02/2013&valor4=358&descri4=teste&tipoparcela4=1&item5=5&dia5=01/03/2013&valor5=358&descri5=teste&tipoparcela5=1&item6=6&dia6=01%2F04%2F2013&valor6=358&descri6=teste&tipoparcela6=1&ini=S&ml=Calc&it=1&modo=&path=&result=
 */

$curl = curl_init ( 'http://drcalc.net/planilhacalc.asp' );
curl_setopt ( $curl, CURLOPT_RETURNTRANSFER, true );
$dados = array (
		"descricao" => "Teste",
		"mes" => "4",
		"ano" => "2013",
		"categoria" => "1",
		"indice" => "3",
		"jcjuro" => "2",
		"jcperiodojuro" => "m",
		"jccapitalizacao" => "s",
		"jcdata" => "",
		"jcvencto" => "S",
		"jmjuro" => "0%2C00",
		"jmperiodojuro" => "m",
		"jmcapitalizacao" => "l",
		"jmdata" => "",
		"jmvencto" => "s",
		"jmsobrejc" => "S",
		"multa" => "10",
		"honorario" => "10",
		"tipohonorario" => "percentual",
		"qt1" => "6",
		"item1" => "1",
		"dia1" => "01%2F11%2F2012",
		"valor1" => "358",
		"descri1" => "teste",
		"tipoparcela1" => "1",
		"item2" => "2",
		"dia2" => "01%2F12%2F2012",
		"valor2" => "358",
		"descri2" => "teste",
		"tipoparcela2" => "1",
		"item3" => "3",
		"dia3" => "01%2F01%2F2013",
		"valor3" => "358",
		"descri3" => "teste",
		"tipoparcela3" => "1",
		"item4" => "4",
		"dia4" => "01%2F02%2F2013",
		"valor4" => "358",
		"descri4" => "teste",
		"tipoparcela4" => "1",
		"item5" => "5",
		"dia5" => "01%2F03%2F2013",
		"valor5" => "358",
		"descri5" => "teste",
		"tipoparcela5" => "1",
		"item6" => "6",
		"dia6" => "01%2F04%2F2013",
		"valor6" => "358",
		"descri6" => "teste",
		"tipoparcela6" => "1",
		"ini" => "S",
		"ml" => "Calc",
		"it" => "1",
		"modo" => "",
		"path" => "",
		"result" => "" 
);

print_r ( $dados );
curl_setopt ( $curl, CURLOPT_POST, true );
// Definimos quais informações serão enviadas pelo POST (array)
curl_setopt ( $curl, CURLOPT_POSTFIELDS, $dados );

$result = curl_exec ( $curl );

echo $result;

?>
