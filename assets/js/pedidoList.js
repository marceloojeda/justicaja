$(document).ready(function() {
	Initpage();
	Eventos();
});

function Initpage(){
	SelectOption($("[name=Estado]").val(), "ddlUF");
	SelectOption($("[name=StatusPedido]").val(), "ddlStatus");

	if($("[name=Target]").val() == "NotificacaoReu"){
		$("#ddlStatus").addClass('select-readonly');
	}
}

function Eventos(){
	
}

function SelectOption(valueToSelect, elementId)
{    
	var element = document.getElementById(elementId);
	element.value = valueToSelect;
}

function verManifestacao(analiseId){
	var url = 'getManifestacaoByAnliseId/' + analiseId;
	$.ajax ({
		url: url,
		type: 'get',
		dataType: 'json'
	}).done(function(result) {
		if(!result){
			console.log("Não foi possivel encontrar a manifestação do réu.");
			return;
		}
		
		$("#txtManifestacao").empty();
		$('#txtManifestacao').append(result);
		document.getElementById('manifestacao-modal').style.display = "block";
	}).fail(function(a,b,c){
		console.log(a.responseText);
	});
}

function verPeca(pedidoId, tipo){
	var url = 'getPecaPedido';
	$.ajax ({
		url: url,
		data: {pedidoId: pedidoId, tipo: tipo},
		type: 'post',
		dataType: 'json'
	}).done(function(result) {
		if(!result){
			alert('Falha ao recuperar essa peça!');
		} else{
			$('#tituloPeca').html(result[0].Titulo);
			$('#textoPeca').html(result[0].Texto);

			if(result[0].Arquivo != ''){
				arquivosLista = "";
				result.forEach(function(item, index){
					arquivosLista += '<li><a href="'+$('#base_url').val();
					arquivosLista += 'assets/uploads/processos/'+item.Arquivo+'" target="_blank">';
					arquivosLista += item.Arquivo+'</a>';
					arquivosLista += '<span class="w3-badge w3-right w3-margin-right w3-tiny">';
					arquivosLista += item.TipoDocumento+'</span></li>';
				});
				$('#arquivosPeca').html(arquivosLista);
			}

			document.getElementById('pecaPedido').style.display='block';
		}
	}).fail(function(a,b,c){
		console.log(a.responseText);
	});
}