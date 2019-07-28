/*
 A função Mascara tera como valores no argumento os dados inseridos no input (ou no evento onkeypress)
 onkeypress="mascara(this, '## ####-####')"
 onkeypress = chama uma função quando uma tecla é pressionada, no exemplo acima, chama a função 
 mascara e define os valores do argumento na função
 O primeiro valor é o this, é o Apontador/Indicador da Mascara, o '## ####-####' é o modelo / formato 
 da mascara no exemplo acima o # indica os números, e o - (hifen) o caracter que será inserido 
 entre os números, ou seja, no exemplo acima o telefone ficara assim: 11-4000-3562
 para o celular de são paulo o modelo deverá ser assim: '## #####-####' [11 98563-1254]
 para o RG '##.###.###.# [40.123.456.7]
 para o CPF '###.###.###.##' [789.456.123.10]
 Ou seja esta mascara tem como objetivo inserir o hifen ou espaço automáticamente quando o usuário inserir o número do celular, cpf, rg, etc 

 lembrando que o hifen ou qualquer outro caracter é contado tambem, como: 11-4561-6543 temos 10 
 números e 2 hifens, por isso o valor de maxlength será 12
 <input type="text" name="telefone" onkeypress="mascara(this, '## ####-####')" maxlength="12">
 neste código não é possivel inserir () ou [], apenas . (ponto), - (hifén) ou espaço
 */

 function mascara(t, mask){
 	var i = t.value.length;
 	var saida = mask.substring(1,0);
 	var texto = mask.substring(i)
 	if (texto.substring(0,1) != saida){
 		t.value += texto.substring(0,1);
 	}
 }

 var options = {
 	onKeyPress: function (cpf, ev, el, op) {
 		var masks = ['000.000.000-000', '00.000.000/0000-00'];
 		$('.cpfOuCnpj').mask((cpf.length > 14) ? masks[1] : masks[0], op);
 	}
 }
//COLOCAR ESSA LINHA NO EVENTO InitPage
//$('.cpfOuCnpj').mask('000.000.000-000', options);

var SPMaskBehavior = function (val) {
  return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
},
spOptions = {
  onKeyPress: function(val, e, field, options) {
      field.mask(SPMaskBehavior.apply({}, arguments), options);
    }
};
//$(".telefone").mask(SPMaskBehavior, spOptions);


function limpa_formulário_cep() {
    // Limpa valores do formulário de cep.
    $("#rua").val("");
    $("#bairro").val("");
    $("#cidade").val("");
    $("#uf").val("");
    $("#ibge").val("");
}
            
//Quando o campo cep perde o foco.
function cepFocused(){
	$("#cep").blur(function() {

	    //Nova variável "cep" somente com dígitos.
	    var cep = $(this).val().replace(/\D/g, '');

    //Verifica se campo cep possui valor informado.
    if (cep != "") {

        //Expressão regular para validar o CEP.
        var validacep = /^[0-9]{8}$/;

        //Valida o formato do CEP.
        if(validacep.test(cep)) {

            //Preenche os campos com "..." enquanto consulta webservice.
            $("#rua").val("...");
            $("#bairro").val("...");
            $("#cidade").val("...");
            $("#uf").val("...");
            $("#ibge").val("...");

            //Consulta o webservice viacep.com.br/
            $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

            	if (!("erro" in dados)) {
                    //Atualiza os campos com os valores da consulta.
                    $("#rua").val(dados.logradouro);
                    $("#bairro").val(dados.bairro);
                    $("#cidade").val(dados.localidade);
                    $("#uf").val(dados.uf);
                    $("#ibge").val(dados.ibge);
                } //end if.
                else {
                    //CEP pesquisado não foi encontrado.
                    limpa_formulário_cep();
                    alert("CEP não encontrado.");
                }
            });
        } //end if.
        else {
            //cep é inválido.
            limpa_formulário_cep();
            alert("Formato de CEP inválido.");
        }
    } //end if.
    else {
        //cep sem valor, limpa formulário.
        limpa_formulário_cep();
    }
});
}