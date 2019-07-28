$(document).ready(function() {
	Initpage();
	Eventos();
});

function Initpage(){
	// with plugin options
	$("#input-1").fileinput({'showUpload':false, 'previewFileType':'any'});
}

function Eventos(){
	$('#linkPromotor').on('click', function(){
		$('#form-step1').removeClass('hide');
		$('#papel').addClass('hide');
	})

	$('[name=Apoiar]').on('click', function(target){
		let actual = target.currentTarget;
		let solucaoId = actual.getAttribute('data-id');
		if(confirm("Confirma seu voto nessa solução?")){
			processarVoto(solucaoId);
		}
	})
}

function addSolucao(){
	$('#dialog_message').html('Proposta de solução enviada com sucesso!');
	$('#dialogInfoModal').modal('show');
}

function processarVoto(idSolucao){
	$.ajax ({
		url: $('#urlVotacao').val(),
		type: 'post',
		data: {SolucaoId: idSolucao},
		dataType: 'json'
	}).done(function(result) {
		let msg = '';
		if(result.erro){
			msg = 'Atenção: ' + result.mensagem;
		}else{
			msg = result.mensagem;
		}
		alert(msg);
	}).fail(function(data){
		alert('Um erro desconhecido ocorreu.');
	});
}