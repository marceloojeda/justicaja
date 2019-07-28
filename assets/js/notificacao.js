$(document).ready(function() {
	Initpage();
	Eventos();
});

function Initpage(){
	$(document).ready(function() {
      $('.summernote').summernote({ height: 200 });
    });

    if($('#hiddenNotificacoes').val() == "Não"){
    	$('#ddlMeioComunicacao').val('Email');
    	$('#ddlMeioComunicacao').addClass("select-readonly");
    	$("#EmailDestino").removeClass("w3-hide");
    	$("input[name='Destinatario']").val($('#txtEmailReu').val());
    }
}

function Eventos(){
	$("#ddlMeioComunicacao").on("click", function(){
		if($("#ddlMeioComunicacao").val() == "Email")
			$("#EmailDestino").removeClass("w3-hide");
		else
			$("#EmailDestino").addClass("w3-hide");
	})
}