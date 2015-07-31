
function validarCartao(numero){
	var numero = numero.replace("/[^0-9]/", ""); //remove caracteres não numéricos
	if(numero.length < 13 || numero.length > 19)
		return false;

	var soma = '';
	for(var i = numero.length - 1; i >= 0; i--){
		if(numero.length % 2){
			soma += (i % 2) ? parseInt(numero[i]) * 2 : numero[i];
		} else {
			soma += (i % 2) ? numero[i] : parseInt(numero[i]) * 2;
		}
	}

	var total = 0;
	for(var i = 0; i < soma.length; i++){
		total = total + parseInt(soma[i]);
	}

	return (total % 10) == 0;
}

function obterBandeira(numero){
	numero = numero.replace("/[^0-9]/", ""); //remove caracteres não numéricos
	if(numero.length < 13 || numero.length > 19)
		return false;
	console.log("NUMERO: "+numero);

	expressoes	= [
	 	/(636368|438935|504175|451416|636297|506699|509048|509067|509049|509069|509050|509074|509068|509040|509045|509051|509046|509066|509047|509042|509052|509043|509064|509040)[0-9]{10}|(36297)[0-9]{11}|(5067|4576|4011)[0-9]{12}/g,
		/(6011)[0-9]{12}|(622)[0-9]{13}|(64|65)[0-9]{14}/g,
		/(301|305)[0-9]{11, 13}|(36|38)[0-9]{12,14}/g,
		/(34|37)[0-9]{13}/g,
		/(38|60)[0-9]{11,14,17}/g,
		/50[0-9]{14}/g,
		/35[0-9]{14}/g,
		/5[0-9]{15}/g,
		/4[0-9]{12,15}/g
	];

	bandeiras = [
		"elo",
		"discover",
		"diners",
		"amex",
		"hipercard",
		"aura",
		"jcb",
		"mastercard",
		"visa"
	];

	for(var i = 0; i < expressoes.length; i++){
		if(numero.match(expressoes[i])){
			return bandeiras[i];
		}
	}

	return false;

}
