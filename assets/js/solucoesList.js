$(document).ready(function() {
	Initpage();
	Eventos();
	ModalConfirmacaoEvents();
});

function Initpage(){
	//$('.dropdown-toggle').dropdown();
}

function Eventos(){
	$('[name=Apoiar]').on('click', function(target){
		var actual = target.currentTarget;
		var solucaoId = actual.getAttribute('data-id');
		$('[name=CodigoSolucao]').val(solucaoId);
		$('#modalConfirmaVoto').modal('toggle');
	})
}

function ModalConfirmacaoEvents(){
	$('#btnConfirmaVoto').on('click', function(){
		$('#modalConfirmaVoto').modal('toggle');
		$.ajax ({
			url: '../RegistrarVoto',
			type: 'post',
			data: {SolucaoId: $('[name=CodigoSolucao]').val()},
			dataType: 'json'
		}).done(function(result) {
			if(result){
				console.log("Voto registrado com sucesso!");
			}
			else{
				console.log("Não foi possivel registrar o voto.");
			}
		}).fail(function(data){
			console.log(data.responseText);
		});
	})
}