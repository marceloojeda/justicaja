$(document).ready(function() {
    Initpage();
    Eventos();
});

function Initpage(){
	$("#inputProva").fileinput({'showUpload':false, 'previewFileType':'any'});
	$('.summernote').summernote({ height: 200 });
}

function Eventos(){
	
}

function verPeca(idPedido, tipo){
    $.ajax ({
        url: '../viewPeca',
        type: 'get',
        data: { idPedido: idPedido, tipo: tipo },
		dataType: 'html'
	}).done(function(result) {
		if(!result){
			console.log("Não foi possivel encontrar a manifestação do réu.");
			return;
		}
		
        $('#peca').html(result);
        $('#peca').removeClass('hide');
        $('#contestacaoView').modal('show');
	}).fail(function(a,b,c){
		console.log(a.responseText);
	});
}