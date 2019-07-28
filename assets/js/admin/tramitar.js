var idProcesso = 0;

$(document).ready(function() {
	Eventos();
});

function Eventos(){
	$('#btnSintese').on('click', function(){
		carregarSintese();
	});

	$('#btnSolucoes').on('click', function(){
		carregarSolucoes();
	});

	$('#btnFase').on('click', function(){
		tramitarProcesso();
	});

	$('#lista-processos tbody tr').on('click', function(linha){
		selecionarProcesso(linha.currentTarget);
	});
}

function selecionarProcesso(linha){
	idProcesso = linha.getAttribute('data-id');

	$('#lista-processos tbody tr').removeClass('w3-yellow');
	linha.setAttribute("class", 'w3-yellow');
}

function highlight(e) {
	if (selected[0]) selected[0].className = '';
		e.target.parentNode.className = 'selected';
}

function fnselect(){
	var $row=$(this).parent().find('td');
	var clickeedID=$row.eq(0).text();
	alert(clickeedID);
}

function carregarSintese(){
	$.get("./getSintese/" + idProcesso, function(data, status){
		$('#sintese').html(data);
		document.getElementById('sintese-modal').style.display='block';
	});
}

function carregarSolucoes(){
	$.get("./getSolucoes/" + idProcesso, function(data, status){
		if(!data){
			return;
		}
		let linhas = '';
		$.each(data, function(index, element) {
			let link = "<a href='assets/uploads/solucoes/" + element.Arquivo + "' class='w3-text-blue'>" + element.Arquivo + "</a>";
			let badge = "<span class='w3-badge w3-right'>" + element.Votos + "</span>";
			linhas += "<li>" + link + " <small> por " + element.Arbitro + "</small>" + badge + "</li>";
		});
		$('#solucoes').html(linhas);
		document.getElementById('solucoes-modal').style.display='block';
	});
}

function tramitarProcesso(){
	$.get("./getTramitacao/" + idProcesso, function(data, status){
		$('#faseAtual').val(data.FaseAtual);
		$('#idProcesso').val(idProcesso);
		$('#faseAtual').prop('disabled', true)

		$.each(data.Fases, function(index, element){
			$('#fases').append("<option value='" + element.Id + "'>" + element.Nome + "</option>");
		});

		document.getElementById('fase-modal').style.display='block';
	});
}

function setStatusLoad(statusLoad){
	let idStatus = statusLoad.value;
	$.post( "./setStatusLoad", {idProcesso: idProcesso, idStatus: idStatus}, function( retorno ) {
	  alert(retorno.mensagem);
	  if(!retorno.erro){
	  	location.reload();
	  }
	});
}