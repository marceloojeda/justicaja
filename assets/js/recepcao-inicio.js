var ultimaAtualizacao;

$(document).ready(function() {
    Initpage();
    Eventos();
});

function Initpage(){
	var atualizacaoPost = [];
	$.each($('.boxRecepcao'), function(index, el){
		atualizacaoPost.push({ApartamentoId: el.attributes[1].value, Situacao: el.attributes[3].value});
	});


	ultimaAtualizacao = setInterval(verificaAtualizacao, 3000, atualizacaoPost);
}

function Eventos(){
	$(".boxRecepcao").click(function(el){
		var box = el.currentTarget;
		var quartoId = box.getAttribute('data-id');
		var quartoNumero = box.getAttribute('data-numero');

		$("label[id = apartamento-label]").attr('data-id', quartoId);

		$("label[id = apartamento-label]").text(quartoNumero);

		$('#quarto-detalhes-modal').modal('show');
	});

	$('[name=confirma-aluguel]').on('click', function(el){
		$.ajax({
		  type: "POST",
		  url: getBaseUrl() + 'Welcome/alugarQuarto',
		  data: { apartamentoId: $("label[id = apartamento-label]").attr('data-id') },
		  success: function(result){
		  	if(result){
		  		$('#quarto-detalhes-modal').modal('hide');
		  		location.reload();
		  	}
		  },
		  error: function(erro){
		  	console.log(erro);
		  },
		  dataType: "json"
		});
	});
}


function verificaAtualizacao(quartos){
	$.ajax({
	  type: "POST",
	  url: getBaseUrl() + 'Welcome/temAtualizacao',
	  dataType: "json",
	  data: { apartamentos: JSON.stringify(quartos) },
	  success: function(result){
	  	if(result){
	  		location.reload();
	  	}
	  },
	  error: function(erro){
	  	console.log(erro);
	  }
	});
}