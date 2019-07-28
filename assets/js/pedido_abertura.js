$(document).ready(function() {
    Initpage();
    Eventos();
});

function Initpage(){
	// $("#inputRG").fileinput({'showUpload':false, 'previewFileType':'any'});
	// $("#inputCPF").fileinput({'showUpload':false, 'previewFileType':'any'});
	// $("#inputContratoSocial").fileinput({'showUpload':false, 'previewFileType':'any'});
	// $("#inputCNPJ").fileinput({'showUpload':false, 'previewFileType':'any'});
	// $("#inputEndereco").fileinput({'showUpload':false, 'previewFileType':'any'});

	// $("#inputProva").fileinput({'showUpload':false, 'previewFileType':'any'});

	// $("#inputRazoes").fileinput({
	// 	'showUpload':false,
	// 	'previewFileType':'any',
	// 	'showRemove':false,
	// 	'showUpload':false
	// });
	
	if($('[name=PromotorId]').val() == ""){
		// Dados pessoais
		$('[name=Tipo]').attr('readonly','true');
		$('[name=Nome]').attr('readonly','true');
		$('[name=CpfCnpj]').attr('readonly','true');
		$('[name=DocumentoTipo]').attr('readonly','true');
		$('[name=DocumentoNumero]').attr('readonly','true');
		// Dados contato
		$('[name=Email]').attr('readonly','true');
		$('[name=Telefone]').attr('readonly','true');
		$('[name=Celular]').attr('readonly','true');
		// Dados endereço
		$('[name=Endereco]').attr('readonly','true');
		$('[name=Numero]').attr('readonly','true');
		$('[name=ComplementoEndereco]').attr('readonly','true');
		$('[name=Bairro]').attr('readonly','true');
		$('[name=Cidade]').attr('readonly','true');
		$('[name=UF]').attr('readonly','true');
		$('[name=CEP]').attr('readonly','true');
	}

}

function Eventos(){
	$('[name=PlanoId]').on('click', function(elemento){
		var plano = elemento.currentTarget;
		$(':checkbox').each(function() {
            this.checked = false;
        });
        
        plano.checked = true;
	});

	$('[name=NotificacaoPorEmail]').on('click', function(elemento){
		var check = elemento.currentTarget;
		if(check.checked){
			$('[name=ReuEmail]').attr('disabled', false);
			$('[name=ReuEmail]')[0].required = true;
		}
		else{
			$('[name=ReuEmail]').attr('disabled', true);
			$('[name=ReuEmail]')[0].required = false;
		}
	});

	$('#btnBack').on('click', function(){
		window.history.back();
	})
}

function AccordionToggle(id){
	var x = document.getElementById(id);
	x.classList.toggle("w3-hide");
    // if (x.className.indexOf("w3-show") == -1) {
    //     x.className += " w3-show";
    // } else { 
    //     x.className = x.className.replace(" w3-show", "");
    // }
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