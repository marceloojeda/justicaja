$(document).ready(function() {
	$('.summernote').summernote({ height: 300 });
	eventosTela();
});

function AccordionToggle(id){
	hideAll(id);
	toggleElement(id);
}

function hideAll(id){
	$('.panel-body').each(function(index){
		if(!$($('.panel-body')[index]).hasClass('hide') && 
			$($('.panel-body')[index]).attr("id") != id){
			$($('.panel-body')[index]).addClass('hide');
		}
	});
}

function toggleElement(id){
	var x = document.getElementById(id);
	x.classList.toggle("hide");
}

function eventosTela(){
	$('#btnRejeitaPedido').click(function(){
		$('#manifestacao-tipo-rejeicao').val('Rejeicao');
		$('#razoes-desistencia').modal('show');
	});

	$('#btnAceitarPedido').click(function(){
		$('#manifestacao-tipo-aceito').val('Aceito');
		$('#razoes-aceite').modal('show');
	});

	$('#btnProrrogarDecisao').click(function(){
		$('#manifestacao-tipo-prorrogar').val('Prorrogar');
		$('#razoes-prorrogacao').modal('show');
	});
}


function excluirAnexo(id, tipo, base_url){
	if(confirmaOperacao()){
		let parametros = {id: id, tipo: tipo};
		$.post(base_url + "monitor/Processos/excluirAnexao", parametros, function(data, status){
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