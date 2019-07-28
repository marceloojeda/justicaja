$(document).ready(function() {
	Initpage();
	Eventos();
});

function Initpage(){
	// SelectOption($("[name=Estado]").val(), "ddlUF");
	SelectOption($("[name=StatusPedido]").val(), "ddlStatus");

	if($("#ddlStatus").val() == 4){
		$("#ddlStatus").addClass('select-readonly');
		$("[name=Analise]").attr("disabled","true");
		$("#btnSalvar").attr("disabled","true");
	}
}

function Eventos(){
	$('#btnBack').on('click', function(){
		window.history.back();
	})
}

function AccordionToggle(id){
	var x = document.getElementById(id);
	x.classList.toggle("w3-hide");
}

function SelectOption(valueToSelect, elementId)
{    
    var element = document.getElementById(elementId);
    element.value = valueToSelect;
}

function excluirAnexo(id, tipo, base_url){
	if(confirmaOperacao()){
		let parametros = {id: id, tipo: tipo};
		$.post(base_url + "admin/Dashboard/excluirAnexao", parametros, function(data, status){
			if(data.erro){
				alert("Erro: " + data.mensagem);
			}else{
				alert(data.mensagem);
				location.reload();
			}
		}, 
		"json");
	}
}