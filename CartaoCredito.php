<?php

class CartaoCredito {
	private $numero;
	
	/** Função que valida o número do cartão através do Algoritmo de Luhn
	* @link https://en.wikipedia.org/wiki/Luhn_algorithm
	* @param $numero - Número do cartão, deve ter entre 13 e 19 caracteres numéricos
	* @return bool - TRUE caso o número seja válido, FALSE caso contrário
	*/
	function validarCartao($numero){
		$numero = preg_replace("/[^0-9]/", "", $numero); //remove caracteres não numéricos
		if(strlen($numero) < 13 || strlen($numero) > 19)
			return false;
	
		$soma = '';
		foreach(array_reverse(str_split($numero)) as $i => $n){ 
			$soma .= ($i % 2) ? $n * 2 : $n; 
		}
		return array_sum(str_split($soma)) % 10 == 0;
	}
	
	/** Função que procura a bandeira do cartão a partir do seu número
	* Para a criação das expressões foram utilizadas listas encontradas na internet, abaixo link com as listas
	* @link https://gist.github.com/erikhenrique/5931368
	* @link http://pt.stackoverflow.com/questions/3715/express%C3%A3o-regular-para-detectar-a-bandeira-do-cart%C3%A3o-de-cr%C3%A9dito#answer-16779
	* @created 29/07/15
	* @param $numero - Número do cartão, deve ter entre 13 e 19 caracteres numéricos
	* @return $bandeira - Retorna uma string com o nome da bandeira do cartão ou FALSE case não encontre
	* @version 1.0
	*  Ajude a manter a lista atualizada, se souber de alguma BIN equivocado ou que não se encontra na lista, informe.
	*/
	function obterBandeira($numero){
		$numero = preg_replace("/[^0-9]/", "", $numero); //remove caracteres não numéricos
		if(strlen($numero) < 13 || strlen($numero) > 19)
			return false;
			
		//O BIN do Elo é relativamente grande, por isso a separação em outra variável
		$elo_bin = implode("|", array(636368,438935,504175,451416,636297,506699,509048,509067,509049,509069,509050,509074,
			509068,509040,509045,509051,509046,509066,509047,509042,509052,509043,509064,509040));
		$expressoes = array(
			"elo"		=> "/^((".$elo_bin."[0-9]{10})|(36297[0-9]{11})|(5067|4576|4011[0-9]{12}))/",
			"discover" 	=> "/^((6011[0-9]{12})|(622[0-9]{13})|(64|65[0-9]{14}))/",
			"diners" 	=> "/^((301|305[0-9]{11,13})|(36|38[0-9]{12,14}))/",
			"amex" 		=> "/^((34|37[0-9]{13}))/",
			"hipercard" 	=> "/^((38|60[0-9]{11,14,17}))/",
			"aura" 		=> "/^((50[0-9]{14}))/",
			"jcb" 		=> "/^((35[0-9]{14}))/",
			"mastercard" 	=> "/^((5[0-9]{15}))/",
			"visa" 		=> "/^((4[0-9]{12,15}))/"
		);
	
		foreach($expressoes as $bandeira => $expressao){
			if(preg_match($expressao, $numero)){
				return $bandeira;
			}
		}
	
		return false;
	
	}

}
